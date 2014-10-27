@extends('app.partials.layout')
@section('extra-footer')
{{javascript_include_tag('quiz.js')}}
@stop
@section('main')
<div class="play-quiz-page">
	<div class="quiz-question-timer fade" data-timer="11"></div>
	<div class="quiz-canvas">
	</div>
</div>
<div class="quiz-result-page no-show">
	<div class="alert alert-success alert-block text-center">
		Congratulations! You've completed the quiz!
	</div>
</div>
<input type="hidden" id="quiz_id" value="{{$quiz->id}}">
@stop