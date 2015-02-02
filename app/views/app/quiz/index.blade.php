@extends('app.partials.layout')
@section('main')
<div class="quiz-quiz-page">
	<h3 class="sub-header">Quizzes</h3>
	@if(count($quizzes))
	<div class="row">
		@foreach($quizzes as $quiz)
		<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
			<div class="media well">
				<div class="pull-left">
					<a href="#">
						<img src="{{profilePic($quiz->user->picture)}}" width="32px" height="32px" class="activity-item-image img-circle">
					</a>
				</div>
				<div class="media-body">
					<b>Chapters</b>
					<ul class="nav nav-stacked">
						@foreach($quiz->chapters as $chapter)
						<li>
							{{$chapter->name}}
						</li>
						@endforeach
					</ul>
					<br>
					@if($quiz->status === "complete")
						<a href="{{route('app.quiz.play', array($quiz->id))}}" class="btn btn-success btn-sm">Play</a>
					@else
						<a href="{{route('app.quiz.play', array($quiz->id))}}" class="btn btn-primary btn-sm">View</a>
					@endif
				</div>
			</div>
		</div>
		@endforeach
		@else
		<div class="well-sm sub-header">No quizzes yet!</div>
		@endif
	</div>
</div>
@stop