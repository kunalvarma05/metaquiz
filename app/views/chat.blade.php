<!DOCTYPE HTML>
<html>
	<head>
		<title>Let's Chat!</title>
		<link rel="stylesheet" href="http://localhost/socket/assets/css/bootstrap.css" />
		<link rel="stylesheet" href="http://localhost/socket/assets/css/style.css" />
	</head>
	<body>
		<div class="navbar navbar-default navbar-static-top main-nav">
			<div class="container">
				<a href="chat.htm" class="navbar-brand">Let's Chat</a>
			</div>
		</div>
		<div class="main">
			<div class="user-online-list"></div>
			<div class="chat-boxes" id="chats"></div>
		</div>
		<input type="hidden" id="current_user" value="{{Auth::user()->id}}">

		<script id="chat-box-template" type="text/x-handlebars-template">
			<div class="chat-box panel panel-default panel-primary" id="chat-box-@{{receiver_id}}-@{{sender_id}}">
			<div class="panel-heading">
			<b data-toggle="collapse" data-parent="#chats" href="#chat-@{{receiver_id}}-@{{sender_id}}" class="pointer collapsed"><span class="unread-count label label-danger"></span>@{{name}}</b>
			</div>
			<div id="chat-@{{receiver_id}}-@{{sender_id}}" class="panel-collapse collapse">
			<span class="is-typing">is typing<i class="typing"></i></span>
			<div class="chat-body panel-body">
			</div>
			<form class="chat-form">
			<input type="text" data-receiver-id="@{{receiver_id}}" name="message" class="form-control input-sm message" autocomplete="off" placeholder="Type your message">
			</form>
			</div>
			</div>
		</script>

		<script id="online-user-template" type="text/x-handlebars-template">
			<div class="media online-user" data-user-id="@{{id}}" data-user-name="@{{name}}"><a class="pull-left" href="#"> <img class="media-object" src="{{url('/assets/pictures')}}/@{{picture}}" alt="user-pic"> </a><div class="media-body"><span class="media-heading">@{{name}}</span><small class="label label-success is-online"></small></div></div>
		</script>
		<script id="new-chat-message-template" type="text/x-handlebars-template">
			<div class="media chat-message"><div class="media-body"><span class="media-heading message-body">@{{msg}}</span></div></div>
		</script>
		<script id="sent-chat-message-template" type="text/x-handlebars-template">
			<div class="media chat-message me"><div class="media-body"><span class="media-heading message-body">@{{msg}}</span></div></div>
		</script>
		<script type="text/javascript" src="http://localhost/socket/assets/js/jquery-1.8.2.min.js"></script>
		<script type="text/javascript" src="http://localhost/socket/assets/js/bootstrap.js"></script>
		<script type="text/javascript" src="https://cdn.socket.io/socket.io-1.0.6.js"></script>
		<script type="text/javascript" src="assets/handlebars.js"></script>
		<script type="text/javascript" src="assets/injector.js"></script>
		<script type="text/javascript" src="assets/sound.js"></script>
		<script type="text/javascript" src="http://localhost/socket/assets/js/core.js"></script>
	</body>
</html>
