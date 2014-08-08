jQuery(document).ready(function() {
	/**
	 * Online Users
	 */
	//Get the current logged in user
	var current_user_id = parseInt(getCurrentUserInfo('id'));
	//The chatting channel
	var chat = io.connect('http://localhost:3000/users-online');

	//On Connection Establish
	chat.on('connect', function() {
		//Get the user's friends
		jQuery.getJSON('ajax/user/friends', function(data) {
			log(data);
			//Emit data to the server with the current user id to mark the user as online and friends of the current user to determine which friends are online
			chat.emit('init', {
				user_id : current_user_id,
				friends : data
			});
		});
	});

	//Listen to the event, when a friend comes online
	chat.on('friend_online', function(friend_id) {
		if (!jQuery(".friends-online-widget").find("[data-user-id=" + friend_id + "]").length) {
			jQuery.getJSON('ajax/user_info/' + friend_id, function(data) {
				var html = jQuery("#online-user-template").inject(data);
				jQuery('.friends-online-widget').find('.widget-body').append(html);
				log(data);
			});
		}
		log("friend online: " + friend_id);
		//Send acknowledgement/reply to the friend, stating him that the current user/you are also online
		chat.emit("friend_online_acknowledge", {
			user_id : current_user_id,
			friend_id : friend_id
		});
	});

	//Listen for any reply/acknowledgement from a friend
	chat.on('friend_online_acknowledge', function(friend_id) {
		if (!jQuery(".friends-online-widget").find("[data-user-id=" + friend_id + "]").length) {
			jQuery.getJSON('ajax/user_info/' + friend_id, function(data) {
				var html = jQuery("#online-user-template").inject(data);
				jQuery('.friends-online-widget').find('.widget-body').append(html);
				log(data);
			});
		}
		log("friend online: " + friend_id);
	});

	//When a friend goes offline
	chat.on('friend_offline', function(friend_id) {
		//Find the user in the friends online widget
		var ele = jQuery(".friends-online-widget").find("[data-user-id=" + friend_id + "]");
		//If the user exists
		if (ele.length) {
			//Remove user's listing
			ele.remove();
		}
		log("friend offline: " + friend_id);
	});

});
