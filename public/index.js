//Dependencies
var http = require('http');
var redis = require('redis');
var shard = require('./shard');
var port = 3000;

// HTTP Server configuration & launch
var server = require('http').Server();
var io = require('socket.io').listen(server);
var chat = io.of('/chat');
server.listen(port);

//Redis Clients
var pub = redis.createClient();
var sub = redis.createClient();
var db = redis.createClient();

//io.set('heartbeat interval', 30);
//io.set('close timeout', 30);

//Connection
chat.on('connection', function(socket) {

	//Initialization
	socket.on('init', function(data) {
		var chat_shard = shard.get(data.user_id, "chatShard_", 500);
		//Set to database
		db.hset([chat_shard, data.user_id, socket.id], redis.print);
		//Find friends online
		for ( i = 0; i < data.friends.length; i++) {
			var friend = data.friends[i];
			var ushard = shard.get(friend, "chatShard_", 500);
			db.hget([ushard, friend], function(err, sock_id) {
				if (chat.connected[sock_id] != undefined) {
					chat.connected[sock_id].emit("friend_online", data.user_id);
				}
			});
		}
	});

	//Send Friend Online Acknowledgement
	socket.on('friend_online_acknowledge', function(data) {
		var ushard = shard.get(data.friend_id, "chatShard_", 500);
		db.hget([ushard, data.friend_id], function(err, sock_id) {
			chat.connected[sock_id].emit("friend_online_acknowledge", data.user_id);
		});
	});

	//New Message
	socket.on('message', function(data) {
		var ushard = shard.get(data.receiver_id, "chatShard_", 500);
		db.hget([ushard, data.receiver_id], function(err, sock_id) {
			console.log(data, socket.id, sock_id);
			chat.connected[sock_id].emit("message", data);
		});
	});

	//IsTyping
	socket.on('isTyping', function(data) {
		var ushard = shard.get(data.receiver_id, "chatShard_", 500);
		console.log(data);
		db.hget([ushard, data.receiver_id], function(err, sock_id) {
			if (chat.connected[sock_id] != undefined) {
				chat.connected[sock_id].emit("isTyping", data);
			} else {
				console.log(chat.connected[sock_id]);
			}
		});
	});

	//Disconnect
	socket.on('disconnect', function() {
		db.hget([socket.id, "userID"], function(err, uid) {
			if (db.del([uid], function(err, res) {
				return true;
			})) {
				db.del([socket.id], function(err, res) {
					return true;
				});
			}
		});
	});
});

//server.listen(port);
