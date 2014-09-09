<h1>Welcome to Metaquiz!</h1>
<p>
	Hello {{$name}},
	<br>
	<p>
		You've been invited to join <b>{{$organization}}</b> as a Faculty by <b>{{$manager}}</b>.
	</p>
	<br>
	<p style="background: #2e7aeb; color: rgba(255,255,255,0.6); display: block; margin: 10px 0; border-radius: 2px; padding: 10px; text-align: center;">
		Your account activation code is: <b style="color: #fff; text-decoration: underline;">{{$code}}</b>
	</p>
	<br>
	<p>
		<a href="{{url('/')}}"><b>Get Started</b></a>
	</p>
	<br>
	Best,
	Kunal.
</p>
