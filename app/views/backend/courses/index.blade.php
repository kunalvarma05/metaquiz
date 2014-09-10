@extends('backend.layout')
@section('main-content')
<div class="courses-page">
	@section('sub-header-title')
		Courses
	@stop
	@section('sub-header-breadcrumbs')
	{{ Breadcrumbs::render('management-courses') }}
	@stop
	@section('sub-header-actions')
		<a href="{{route('management.courses.create')}}" class="btn btn-lg btn-block btn-success"><span class="glyphicon glyphicon-plus"></span> Create Course</a>
	@stop
	<div class="courses">
		<div class="container">
			<div class="row">
				@if(count($courses))
				@foreach($courses as $course)
					<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<div class="brick brick-solid brick-shadow">
							<div class="brick-content">
								<a href="{{route('management.courses.show', $course->id)}}" class="brick-title">{{$course->name}}</a>
								<span class="timeago brick-micro-info">Created on {{$course->created_at->format('jS M, Y')}}</span>
								<div class="brick-info">
									{{$course->description}}
								</div>
							</div>
							<div class="brick-footer">
								<a href="{{route('management.courses.subjects.index', $course->id)}}" class="text-muted">{{count($course->subjects)}} Subjects</a>
								<a href="{{route('management.courses.edit', $course->id)}}" class="btn btn-xs btn-default pull-right">EDIT</a>
							</div>
						</div>
					</div>
				@endforeach
				@else
				<div class="empty-state container-xs from-top-6">
					<div class="text-center">
						<h1 class="glyphicon glyphicon-folder-open text-primary"></h1>
						<h4 class="text-muted">There are no courses in your organization!</h4>
						<p class="alert">
							<a href="{{route('management.courses.create')}}" class="btn btn-lg btn-success"><span class="glyphicon glyphicon-plus"></span> Create Course</a>
						</p>
					</div>
				</div>
				@endif
			</div>
		</div>
	</div>
</div>
@stop