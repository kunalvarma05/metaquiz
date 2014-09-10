@extends('backend.layout')
@section('main-content')
<div class="create-course-page">
	@section('sub-header-title')
		{{$subject->name}}
	@stop
	@section('sub-header-breadcrumbs')
	{{ Breadcrumbs::render('management-subject', $course, $subject) }}
	@stop
	@section('sub-header-actions')
		<a href="{{route('management.courses.subjects.create', $course->id)}}" class="btn btn-lg btn-block btn-success"><span class="glyphicon glyphicon-plus"></span> Create Subject</a>
	@stop
	<div class="course">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<div class="page-header clearfix">
						<h4 class="pull-left">{{$subject->name}}</h4>
						<a href="{{route('management.courses.subjects.edit', array($course->id, $subject->id))}}" class="btn btn-info btn-sm pull-right">Edit</a>
					</div>
					<p>
						{{$subject->description}}
					</p>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
					<div class="page-header clearfix">
						<h4 class="pull-left">Chapters</h4>
						<a href="{{route('management.courses.subjects.chapters.create', array($course->id, $subject->id))}}" class="btn btn-success btn-sm pull-right">Add Chapter</a>
					</div>
					<div class="row">
						@if(count($subject->chapters))
						@foreach($subject->chapters as $chapter)
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
							<div class="brick brick-solid brick-shadow">
								<div class="brick-content">
									<a href="{{route('management.courses.subjects.chapters.show', array($course->id, $subject->id, $chapter->id))}}" class="brick-title">{{$chapter->name}}</a>
									<span class="timeago brick-micro-info">Created on {{$chapter->created_at->format('jS M, Y')}}</span>
									<div class="brick-info">
										{{$chapter->description}}
									</div>
								</div>
								<div class="brick-footer">
									<a href="{{route('management.courses.subjects.chapters.questions.index', array($course->id, $subject->id, $chapter->id))}}" class="text-muted">Questions</a>
									<a href="{{route('management.courses.subjects.chapters.edit', array($course->id, $subject->id, $chapter->id))}}" class="btn btn-xs btn-default pull-right">EDIT</a>
								</div>
							</div>
						</div>
						@endforeach
						@else
						<div class="empty-state alert text-center">
							<p>
								No Chapters Found!
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