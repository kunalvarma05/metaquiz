@extends('app.partials.layout')
@section('main')
<div class="play-quiz-page">
	<div id="user-wins" class="user-performance-chart" data-info="" data-dimension="150" data-text="15" data-width="20" data-fontsize="24" data-part="18" data-fgcolor="#5858f6" data-total="20" data-bgcolor="rgba(55, 55, 85, 0.8)" ></div>
	<div class="quiz-canvas">
		<div class="quiz-question">
			{{$questions->first()->question->title}}
		</div>
		<div class="quiz-question-options row">
			@foreach($questions->first()->question->options as $option)
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<div class="quiz-question-option block">
					{{$option->title}}
				</div>
			</div>
			@endforeach
		</div>
	</div>
	<div class="quiz-user-score-card clearfix">
		<div class="quiz-user-progress progress">
			<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
				<span class="hidden-lg hidden-md hidden-sm">40</span>
			</div>
		</div>
		<div class="quiz-user-pic col-lg-1 col-md-1 col-sm-1 hidden-xs">
			<img src="{{profilePic(Auth::user()->picture)}}" alt="{{Auth::user()->name}}">
		</div>
		<div class="quiz-user-performance col-lg-10 col-md-10 col-sm-10 col-xs-12">
			<div class="quiz-user-info hidden-xs">
				<span class="quiz-user-name">{{Auth::user()->name}}</span>
				<span class="quiz-user-level">Level {{userLevel(Auth::user()->stat->points)}}</span>
			</div>
		</div>
		<div class="quiz-user-score col-lg-1 col-md-1 col-sm-1 hidden-xs">
			40
		</div>
	</div>
</div>
@stop