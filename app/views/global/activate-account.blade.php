@extends('global.layout')
@section('body')
<div class="activation-page">
	<div class="container-xs page-center-3">
		<div class="text-center">
			<a href="{{url('/')}}" class="logo"><img src="{{asset('assets/images/logo.png')}}" alt="MetaQuiz" /></a>
		</div>
		<div class="card activation-card animated fadeIn">
			<div class="card-header">
				<h3>Activate your Account</h3>
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
					{{Form::open(array('route' => "activate/post"))}}
					<div class="form-group">
						{{Form::text('code', '', array('placeholder' => "Activation Code", 'class' => "form-control",'required' => "required", 'autocomplete' => "off"))}}
					</div>
					{{Form::submit('Activate My Account', array('class' => "btn btn-block btn-primary"))}}
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