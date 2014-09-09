@extends('global.layout')
@section('body')
<div class="login-page animated fadeIn">
	<div class="container-xs page-center">
		<div class="alert text-center">
			<a href="{{url('/')}}" class="logo"><img src="{{asset('assets/images/logo.png')}}" alt="MetaQuiz" /></a>
		</div>
		<div class="text-center well-sm text-muted alert">
			<b>Log in to your Account</b>
		</div>
		@if($errors->count())
		<div class="alert alert-danger well-sm text-center">
			<small>{{$errors->first()}}</small>
		</div>
		@endif
		<div class="password-set-form">
			{{Form::open(array('route' => "login/post", 'files' => true))}}
			<div class="form-group">
				{{Form::text('email', '', array('placeholder' => "Email", 'class' => "form-control", 'required' => "required"))}}
			</div>
			<div class="form-group">
				{{Form::password('password', array('placeholder' => "Password", 'class' => "form-control", 'required' => "required"))}}
			</div>
			<div class="form-group">
				{{Form::submit('Log in', array('class' => "btn btn-lg btn-primary btn-block"))}}
			</div>
			<p class="text-center text-muted">
				OR
			</p>
			<p>
				<a href="{{route('facebook-connect')}}" class="btn btn-facebook btn-loading btn-block btn-lg">Login with Facebook</a>
			</p>
			<div class="form-group">				
					<a href="#" class="small text-muted">Forgot Password?</a>
					<a href="{{route('signup')}}" class="small pull-right text-muted">Create an Account</a>				
			</div>
			{{Form::close()}}
		</div>
	</div>
</div>
@stop