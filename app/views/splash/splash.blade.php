@extends('splash.layout')
@section('body')
<div class="splash-intro">
	<div class="container">
		<div class="header clearfix">
			<h1 class="pull-left logo"><a href="#"><img src="{{asset('assets/images/logo.png')}}" alt="MetaQuiz"> MetaQuiz</a></h1>
			<ul class="nav pull-right nav-pills">
				<li>
					<a href="#">Tour</a>
				</li>
				<li>
					<a href="#">About</a>
				</li>
				<li>
					<a href="{{route('login')}}">Log in</a>
				</li>
			</ul>
		</div>
		<div class="splash-hero row">
			<div class="col-lg-9 col-md-9 col-sm-6 col-xs-12 splash-tagline">
				<h2>Challenge. Play. Learn.</h2>
				<p>
					MetaQuiz lets you challenge your friends for Ultimate Quizzes which contain questions from your study syllabus.
				</p>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 splash-buttons">
				<p>
					<a href="{{route('facebook-connect')}}" class="btn btn-primary signup-button btn-loading">Login with Facebook</a>
					<a href="{{route('signup')}}" class="email-signup">Sign up with Email</a>
				</p>
			</div>
		</div>
	</div>
</div>
<div class="splash-post-intro">
	<div class="container"></div>
</div>
@stop