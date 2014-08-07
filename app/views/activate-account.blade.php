@extends('layout')
@section('content')
<div class="site">
	<div class="container">
		<div class="card activation-card">
			<div class="card-header">
				<h3>Activate your Account</h3>
			</div>
			<div class="card-inside">
				<div class="card-thumb">
					<img src="{{profilePic(Auth::user()->picture)}}" alt="Profile Picture"/>
					<h3 class="thumb-title"> {{Auth::user()->name}} </h3>
				</div>
				<div class="card-body">
					@if(Session::has('error'))
					<div class="alert alert-danger text-center alert-sm">
						{{Session::get('error')}}
					</div>
					@endif
					{{Form::open(array('route' => "activate-account"))}}
					<div class="form-group">
						{{Form::label('code','Enter Activation Code')}}
						{{Form::text('code', '', array('placeholder' => "Activation Code", 'class' => "form-control"))}}
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