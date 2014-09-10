@extends('backend.layout')
@section('main-content')
<div class="chapters-page">
	@section('sub-header-title')
		Chapters
	@stop
	@section('sub-header-breadcrumbs')
		{{ Breadcrumbs::render('management-chapters', $course, $subject) }}
	@stop
	@section('sub-header-actions')
		<a href="{{route('management.courses.subjects.chapters.create', array($course->id, $subject->id))}}" class="btn btn-lg btn-block btn-success"><span class="glyphicon glyphicon-plus"></span> Create Chapter</a>
	@stop
	<div class="chapters">
		<div class="container">
			<div class="row">
				@if(count($chapters))
				@foreach($chapters as $chapter)
					<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
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
				<div class="empty-state container-xs from-top-6">
					<div class="text-center">
						<h1 class="glyphicon glyphicon-folder-open text-primary"></h1>
						<h4 class="text-muted">There are no chapters in this subject!</h4>
						<p class="alert">
							<a href="{{route('management.courses.subjects.chapters.create', $course->id, $subject->id)}}" class="btn btn-lg btn-success"><span class="glyphicon glyphicon-plus"></span> Create Chapter</a>
						</p>
					</div>
				</div>
				@endif
			</div>
		</div>
	</div>
</div>
@stop