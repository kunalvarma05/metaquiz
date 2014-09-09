/**
 *	Name: MetaQuizJS
 *  Author: Kunal Varma
 *  Package: MetaQuiz
 */

//Dependencies
//HTTP Library
var http = require('http');
//Redis Library
var redis = require('redis');
//Sharding Library
var shard = require('./shard');
//Port Number
var port = 3000;

// HTTP Server configuration & launch
var server = require('http').Server();
//Servio I/O Listening on Server
var io = require('socket.io').listen(server);
//Namespace for Users Online
var chat = io.of('/users-online');
//Listen
server.listen(port);

//Redis Storage
var db = redis.createClient(6379,'127.0.0.1', {auth_pass: "K@NT@R@NIV@RM@7600965334"});

//Initiate Connection
chat.on('connection', function(socket) {
	//Initialization
	socket.on('init', function(data) {
		//Chat Shard
		var chat_shard = shard.get(data.user_id, "userShard_", 500);
		//Friend Shard
		var friend_shard = shard.get(data.user_id, "friendsShard_", 500);
		//Set User & Socket ID key-value to database
		db.hset([chat_shard, data.user_id, socket.id], redis.print);
		//Set the User's Friends to database
		db.hset([friend_shard, data.user_id, data.friends], redis.print);
		//Set User & Socket ID in a hashtable to database
		db.hset(["activeSockets", socket.id, data.user_id], redis.print);
		if (data.friends) {
			//Find friends online
			for ( i = 0; i < data.friends.length; i++) {
				//The Friend
				var friend = data.friends[i];
				//The Friend's user shard
				var ushard = shard.get(friend, "userShard_", 500);
				//Check if the friend is online
				db.hget([ushard, friend], function(err, sock_id) {
					//If the friend's user_id was found
					if (chat.connected[sock_id] !== undefined) {
						//Emit to the friend that the current user is online
						chat.connected[sock_id].emit("friend_online", data.user_id);
					}
					//Log any errors
					if (err) {
						console.log(err);
					}
				});
			}
		}
	});

	//Send Friend-Online Acknowledgement
	socket.on('friend_online_acknowledge', function(data) {
		//The User Shard
		var ushard = shard.get(data.friend_id, "userShard_", 500);
		//Find the user from friend_id
		db.hget([ushard, data.friend_id], function(err, sock_id) {
			//If the friend's user_id was found
			if (chat.connected[sock_id] != undefined) {
				//Emit to the friend that the current user is online
				chat.connected[sock_id].emit("friend_online_acknowledge", data.user_id);
			}
			//Log any errors
			if (err) {
				console.log(err);
			}
		});
	});

	//Disconnect
	socket.on('disconnect', function() {
		console.log("disconnecting: " + socket.id);
		//Find the active socket
		db.hget(["activeSockets", socket.id], function(err, uid) {
			//User Shard
			var ushard = shard.get(uid, "userShard_", 500);
			//Friend Shard
			var friend_shard = shard.get(uid, "friendsShard_", 500);
			console.log('offlining user: ' + uid);
			//Find the friends of the current user
			db.hget([friend_shard, uid], function(err, friends) {
				console.log(friends);
				if (friends.length) {
					//Find friends online
					for ( i = 0; i < friends.length; i++) {
						//Friend
						var friend = friends[i];
						console.log(friend);
						//User Shard
						var ushard = shard.get(friend, "userShard_", 500);
						//Find if the friend is online
						db.hget([ushard, friend], function(err, sock_id) {
							//If the friend's user_id was found
							if (chat.connected[sock_id] != undefined) {
								console.log(sock_id);
								//Emit to the friend that the current user is offline
								chat.connected[sock_id].emit("friend_offline", uid);
							}
							//Log any errors
							if (err) {
								console.log(err);
							}
						});
					}
				}
				//Delete the user from the user shard, since the user is offline
				db.hdel([ushard, uid], function(err, res) {
					console.log("del user from the user shard: " + res);
					return true;
				});
				//Delete the user from the friend shard, since the user is offline
				db.hdel([friend_shard, uid], function(err, res) {
					console.log("del user from the friend shard: " + res);
					return true;
				});
				//Delete the user's socket from the active sockets hash
				db.hdel(["activeSockets", socket.id], function(err, res) {
					console.log("del user's socket from the active socket hash: " + res);
					return true;
				});
			});
});
});
});
