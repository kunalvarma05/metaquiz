@extends('backend.layout')
@section('main-content')
<div class="create-course-page">
	@section('sub-header-title')
		{{$course->name}}
	@stop
	@section('sub-header-breadcrumbs')
	{{ Breadcrumbs::render('management-course', $course) }}
	@stop
	@section('sub-header-actions')
		<a href="{{route('management.courses.create')}}" class="btn btn-lg btn-block btn-success"><span class="glyphicon glyphicon-plus"></span> Create Course</a>
	@stop
	<div class="course">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<div class="page-header clearfix">
						<h4 class="pull-left">{{$course->name}}</h4>
						<a href="{{route('management.courses.edit', $course->id)}}" class="btn btn-info btn-sm pull-right">Edit</a>
					</div>
					<p>
						{{$course->description}}
					</p>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
					<div class="page-header clearfix">
						<h4 class="pull-left">Subjects</h4>
						<a href="{{route('management.courses.subjects.create', $course->id)}}" class="btn btn-success btn-sm pull-right">Add Subject</a>
					</div>
					<div class="row">
						@if(count($course->subjects))
						@foreach($course->subjects as $subject)
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
							<div class="brick brick-solid brick-shadow">
								<div class="brick-content">
									<a href="{{route('management.courses.subjects.show', array($course->id, $subject->id))}}" class="brick-title">{{$subject->name}}</a>
									<span class="timeago brick-micro-info">Created on {{$course->created_at->format('jS M, Y')}}</span>
									<div class="brick-info">
										{{$subject->description}}
									</div>
								</div>
								<div class="brick-footer">
									<a href="#" class="text-muted">{{count($subject->chapters)}} Chapters</a>
									<a href="{{route('management.courses.subjects.edit', array($course->id, $subject->id))}}" class="btn btn-xs btn-default pull-right">EDIT</a>
								</div>
							</div>
						</div>
						@endforeach
						@else
						<div class="empty-state container-xs text-center">
							<p>
								No Subjects Found!
							</p>
						</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop