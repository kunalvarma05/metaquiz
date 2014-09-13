@extends('backend.layout')
@section('main-content')
<div class="create-student-page">
	@section('sub-header-title')
		{{$student->name}}
	@stop
	@section('sub-header-breadcrumbs')
	{{ Breadcrumbs::render('management-student', $student) }}
	@stop
	@section('sub-header-actions')
		<a href="{{route('management.students.create')}}" class="btn btn-lg btn-block btn-success"><span class="glyphicon glyphicon-plus"></span> Create Student</a>
	@stop
	<div class="student">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<div class="page-header clearfix">
						<h4 class="pull-left">{{$student->name}}</h4>
						<a href="{{route('management.students.edit', $student->id)}}" class="btn btn-info btn-sm pull-right">Edit</a>
					</div>
					<p>
						<div class="alert alert-info alert-sm">
							Roll no: <b>{{$student->accountable->roll_no}}</b>
						</div>
					</p>
					@if($student->is_activated)
					<p>
						<b class="block text-center alert alert-success">Account Activated</b>
					</p>
					@else
					<p>
						Activation Code: <b>{{$student->activable->code}}</b>
					</p>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@stop