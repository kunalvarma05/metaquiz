@extends('global.layout')
@section('body')
<div class="signup-page animated fadeIn">
	<div class="container-xs page-center-5">
		<div class="alert text-center">
			<a href="{{url('/')}}" class="logo"><img src="assets/images/logo.png" alt="MetaQuiz" /></a>
		</div>
		<div class="alert well-sm text-muted text-center">
			<b>Create an Account, it's free.</b>
		</div>
		@if($errors->count())
		<div class="alert alert-danger well-sm text-center">
			<small>{{$errors->first()}}</small>
		</div>
		@endif
		<div class="signup-form">
			{{Form::open(array('route' => "signup/post", 'files' => true))}}
			<div class="form-group">
				{{Form::text('name', '', array('placeholder' => "Name", 'class' => "form-control", 'required' => "required"))}}
			</div>
			<div class="form-group">
				{{Form::text('email', '', array('placeholder' => "Email", 'class' => "form-control", 'required' => "required"))}}
			</div>
			<div class="form-group">
				{{Form::text('username', '', array('placeholder' => "Username", 'class' => "form-control", 'required' => "required"))}}
			</div>
			<div class="form-group">
				{{Form::password('password', array('placeholder' => "Password", 'class' => "form-control", 'required' => "required", 'data-progress-box' => "#password-strength"))}}
				<div class="progress password-strength" id="password-strength">
					<div class="progress-bar strength-bar" role="progressbar"></div>
				</div>
			</div>
			<div class="form-group">
				{{Form::submit('Sign Up', array('class' => "btn btn-lg btn-primary btn-block"))}}
			</div>
			<div class="form-group clearfix">
				<a href="{{route('facebook-connect')}}" class="btn btn-lg btn-facebook btn-loading">Signup with Facebook</a>
				<a href="{{route('login')}}" class="btn btn-lg btn-default pull-right">Login</a>
			</div>
			<div class="form-group text-center">
				<p class="small text-muted">
					Creating an account means you’re okay with the
					<a href="#" class="text-muted">Terms of Service</a> &amp; <a href="#" class="text-muted">Privacy Policy</a>
				</p>
			</div>
			{{Form::close()}}
		</div>
	</div>
</div>
@stop