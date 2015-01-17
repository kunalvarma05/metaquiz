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
<div class="quiz-marks">
	<div class="clearfix">
		<div class="quiz-points">
			<span class="mark-count">{{$marks}}</span> XP
		</div>
		<div class="progress">
			<div class="progress-bar" role="progressbar" style="height:{{$marks/50*100}}%;" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
	</div>
</div>
<div class="text-center well-sm quiz-result-loader">
	<img src='{{asset("assets/images/loader.svg")}}' alt="Loading...">
	<div class="title">Generating Results</div>
</div>
<input type="hidden" id="quiz_id" value="{{$quiz->id}}">
@stop