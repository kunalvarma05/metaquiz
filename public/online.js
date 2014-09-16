/**
 *	Name: MetaQuizJS
 *  Author: Kunal Varma
 *  Package: MetaQuiz
 */

//HTTP Library
var http = require('http');

//Redis Library
var redis = require('redis');

//Sharding Library
var Shard = require('./shard');

//Includes
var includes = require('./include');



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
var db = redis.createClient(6379,'127.0.0.1', {auth_pass: includes.db_pass()});


//Debugging
db.debug_mode = true;


//User Shard
var userShard = new Shard("shard_", 500);


//Initiate Connection
chat.on('connection', function(socket) {

	/**
	 * Init
	 * @param  {Object/JSON} data The Data received from the client
	 */
	 socket.on('init', function(data) {

		//User Shard
		var chat_shard = userShard.get(data.user_id);

		//Set User & Socket ID hash key-value to database
		db.hset(["active-users:" + chat_shard, data.user_id, socket.id], redis.print);

		//Set User & Socket ID in a hashtable to database
		db.hset(["active-sockets", socket.id, data.user_id], redis.print);

		//If the user has friends
		if (data.friends.length) {

			//Set the User's Friends to database
			db.sadd([ "users:" + chat_shard + ":" + data.user_id + ":friends", data.friends], redis.print);

			//Find all friends of the user who are online
			for ( i = 0; i < data.friends.length; i++) {

				//The Friend
				var friend = data.friends[i];

				//The Friend's user shard
				var ushard = userShard.get(friend);

				//Check if the friend is online
				db.hget(["active-users:" + ushard, friend], function(err, sock_id) {

					//If the friend's socket_id was found
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
		var ushard = userShard.get(data.friend_id);

		//Find the user from friend_id
		db.hget(["active-users:" + ushard, data.friend_id], function(err, sock_id) {

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

		//The Disconnecting socket ID
		var socket_id = socket.id;

		console.log("Socket: " + socket_id);

		//Fetch the user ID by the Socket ID from the active sockets list
		db.hget(['active-sockets', socket_id], function(err, user_id){

		console.log("Fetching friends of user: " + user_id);
			//User Shard
			var chat_shard = userShard.get(user_id);
			//Find the friends of the user
			db.smembers([ "users:" + chat_shard + ":" + user_id + ":friends" ], function(err, friends){

				console.log("Found friends: " + friends);

				//If the user has friends
				if (friends.length > 0) {
					console.log("Checking friends length");
					//Find all friends of the user who are online
					for ( i = 0; i < friends.length; i++) {

						//The Friend
						var friend = friends[i];

						console.log("Friend: " + friend);

						//The Friend's user shard
						var ushard = userShard.get(friend);

						//Check if the friend is online
						db.hget(["active-users:" + ushard, friend], function(err, sock_id) {

							//If the friend's socket_id was found
							if (chat.connected[sock_id] !== undefined) {

								//Emit to the friend that the current user is online
								chat.connected[sock_id].emit("friend_offline", user_id);

								console.log("Sent friend_offline to: " + sock_id);

							}

							//Log any errors
							if (err) {

								console.log(err);

							}
						});
					}
				}

				console.log("deleting the user from the database: " + user_id);
				//Remove the user from the database
				db.hdel(["active-users:" + chat_shard, user_id], redis.print);

				console.log("deleting the users friendlist from the database: " + user_id);
				//Delete the users friends from the database
				db.del([ "users:" + chat_shard + ":" + user_id + ":friends"], redis.print);

				console.log("deleting the active socket from the database: " + socket_id);
				//Delete Socket ID of the user from the database
				db.hdel(["active-sockets", socket.id], redis.print);

			});

			//Log any errors
			if (err) {

				console.log(err);

			}
		});
});
});