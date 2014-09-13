@extends('backend.layout')
@section('sub-header-title')
Students
@stop
@section('sub-header-breadcrumbs')
{{ Breadcrumbs::render('management-students') }}
@stop
@section('sub-header-actions')
<a href="{{route('management.students.create')}}" class="btn btn-lg btn-block btn-success"><span class="glyphicon glyphicon-plus"></span> Create Student</a>
@stop
@section('main-content')
<div class="students-page">
	<div class="container">
		@if(count($students))
		<div class="row">
			@foreach($students as $student)
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<div class="brick">
					<div class="brick-content media">
						<img src="{{profilePic($student->picture)}}" class="pull-left img-64 img-circle media-object">
						<div class="media-body">
							<a href="{{route('management.students.show', $student->id)}}" class="brick-title">{{$student->name}}</a>
							<span class="timeago brick-micro-info">Added on {{$student->created_at->format('jS M, Y')}}</span>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
		@else
		<div class="well-sm panel panel-default text-center">
			<p>
				No students Found!
			</p>
		</div>
		@endif
	</div>
</div>
@stop