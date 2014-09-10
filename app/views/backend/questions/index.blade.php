@extends('backend.layout')
@section('main-content')
<div class="chapters-page">
	@section('sub-header-title')
		Questions
	@stop
	@section('sub-header-breadcrumbs')
		{{ Breadcrumbs::render('management-questions', $course, $subject, $chapter) }}
	@stop
	@section('sub-header-actions')
		<a href="{{route('management.courses.subjects.chapters.questions.create', array($course->id, $subject->id, $chapter->id))}}" class="btn btn-lg btn-block btn-success"><span class="glyphicon glyphicon-plus"></span> Add Questions</a>
	@stop
	<div class="chapters">
		<div class="container">
			@if(count($questions))
			<div class="text-center">
				{{$questions->links()}}
			</div>
			<div class="row">
				@foreach($questions as $question)
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="brick brick-shadow">
							<div class="brick-content">
								<a href="{{route('management.courses.subjects.chapters.questions.show', array($course->id, $subject->id, $chapter->id, $question->id))}}" class="brick-title">{{$question->title}}</a>
								<span class="timeago brick-micro-info">Created on {{$question->created_at->format('jS M, Y')}}</span>
							</div>
						</div>
					</div>
				@endforeach
				<div class="text-center">
				{{$questions->links()}}
				</div>
			</div>
				@else
				<div class="empty-state container-xs from-top-6">
					<div class="text-center">
						<h1 class="glyphicon glyphicon-box text-primary"></h1>
						<h4 class="text-muted">There are no questions in this chapter!</h4>
						<p class="alert">
							<a href="{{route('management.courses.subjects.chapters.questions.create', $course->id, $subject->id, $chapter->id)}}" class="btn btn-lg btn-success"><span class="glyphicon glyphicon-plus"></span> Add Questions</a>
						</p>
					</div>
				</div>
				@endif
			</div>
		</div>
	</div>
</div>
@stop