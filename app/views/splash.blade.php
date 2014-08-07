@extends('layout')
@section('content')
<div class="site">
	<div class="container">
		<div class="header clearfix">
			<h1 class="pull-left logo"><a href="#"><img src="assets/images/logo.png" alt="MetaQuiz"> MetaQuiz</a></h1>
			<ul class="nav pull-right nav-pills">
				<li>
					<a href="#">What is MetaQuiz</a>
				</li>
				<li>
					<a href="#">Contact</a>
				</li>
			</ul>
		</div>
		<div class="intro text-center">
			<h2>Challenge. Play. Learn.</h2>
			<p>
				Challenge your friends for Ultimate Quiz Battles.
			</p>
			<a href="{{route('login')}}" class="btn btn-lg btn-success signup-button">Log in with Facebook</a>
		</div>
	</div>
</div>
@stop