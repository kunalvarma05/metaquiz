@extends('global.layout')
@section('body')
<div class="activation-page ground-clear animated fadeIn">
	<div class="container-xs page-center-3">
		<div class="text-center">
			<a href="{{url('/')}}" class="logo"><img src="{{asset('assets/images/logo.png')}}" alt="MetaQuiz" /></a>
		</div>
		<div class="card activation-card">
			<div class="card-header">
				<h3>Set New Password</h3>
			</div>
			<div class="card-inside">
				<div class="card-thumb">
					<img src="{{profilePic(Auth::user()->picture)}}" alt="Profile Picture"/>
					<h3 class="thumb-title"> {{Auth::user()->name}} </h3>
				</div>
				<div class="card-body">
					@if($errors->count())
					<div class="alert alert-danger text-center well-sm">
						<small>{{$errors->first()}}</small>
					</div>
					@endif
					{{Form::open(array('route' => "store-password"))}}
					<div class="form-group">
						{{Form::password('password', array('placeholder' => "Password", 'class' => "form-control", 'required' => "required"))}}
					</div>
					<div class="form-group">
						{{Form::password('password_confirmation', array('placeholder' => "Confirm Password", 'class' => "form-control", 'required' => "required"))}}
					</div>
					{{Form::submit('Set Password', array('class' => "btn btn-lg btn-primary btn-block"))}}
					{{Form::close()}}
				</div>
				<div class="card-footer">
					<a href="#"> Don't have an Activation Code?</a>
					<a href="{{route('logout')}}" class="pull-right">Log out</a>
				</div>
			</div>
		</div>
	</div>
</div>
@stop