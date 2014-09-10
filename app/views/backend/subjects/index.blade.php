@extends('backend.layout')
@section('main-content')
<div class="subjects-page">
	@section('sub-header-title')
		Subjects
	@stop
	@section('sub-header-breadcrumbs')
		{{ Breadcrumbs::render('management-subjects', $course) }}
	@stop
	@section('sub-header-actions')
		<a href="{{route('management.courses.subjects.create', $course->id)}}" class="btn btn-lg btn-block btn-success"><span class="glyphicon glyphicon-plus"></span> Create Subject</a>
	@stop
	<div class="subjects">
		<div class="container">
			<div class="row">
				@if(count($subjects))
				@foreach($subjects as $subject)
					<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<div class="brick brick-solid brick-shadow">
							<div class="brick-content">
								<a href="{{route('management.courses.subjects.show', array($course->id, $subject->id))}}" class="brick-title">{{$subject->name}}</a>
								<span class="timeago brick-micro-info">Created on {{$subject->created_at->format('jS M, Y')}}</span>
								<div class="brick-info">
									{{$subject->description}}
								</div>
							</div>
							<div class="brick-footer">
								<a href="{{route('management.courses.subjects.chapters.index', array($course->id, $subject->id))}}" class="text-muted">{{count($subject->chapters)}} Chapters</a>
								<a href="{{route('management.courses.subjects.edit', array($course->id, $subject->id))}}" class="btn btn-xs btn-default pull-right">EDIT</a>
							</div>
						</div>
					</div>
				@endforeach
				@else
				<div class="empty-state container-xs from-top-6">
					<div class="text-center">
						<h1 class="glyphicon glyphicon-folder-open text-primary"></h1>
						<h4 class="text-muted">There are no subjects in this course!</h4>
						<p class="alert">
							<a href="{{route('management.courses.subjects.create', $course->id)}}" class="btn btn-lg btn-success"><span class="glyphicon glyphicon-plus"></span> Create Subject</a>
						</p>
					</div>
				</div>
				@endif
			</div>
		</div>
	</div>
</div>
@stop