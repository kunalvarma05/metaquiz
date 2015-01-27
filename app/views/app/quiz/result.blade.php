@extends('app.partials.layout')
@section('extra-footer')
{{{javascript_include_tag('quiz-result.js')}}}
<script type="text/javascript">
var labels = ['Question 1', 'Question 2', 'Question 3', 'Question 4', 'Question 5'];
var data = {{{json_encode($marksPerQuestion)}}};
quizResultChart(labels, data);
</script>
@stop
@section('main')
<div class="quiz-result-page">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<div class="result-challenge-section">
					<h3 class="section-title">Quiz Results</h3>
					<div class="challenge-section">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<a href="{{route('app.subjects')}}" class="btn btn-primary btn-lg btn-block"><i class="glyphicon glyphicon-refresh"></i> New Quiz</a>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<button class="btn btn-lg btn-success btn-block" data-toggle="collapse" data-target="#challenge-friend-box" type="button">Challenge your friends</button>
							</div>
						</div>
					</div>
					@include('app.quiz.create-challenge')
				</div>
				<h3 class="section-title">Points earned per question</h3>
				<div class="quiz-result-section">
					<canvas class="quiz-result-chart white block alert" height="300px" id="quiz-result-chart"></canvas>
				</div>
			</div>
			<div class="colg-lg-6 col-md-6 col-sm-12 col-xs-12">
				<div class="quiz-result-questions">
					<h3 class="section-title">Questions Asked</h3>
					<div id="questions-asked-carousel" class="questions-asked-carousel carousel slide" data-ride="carousel" data-interval="5000">
						<div class="carousel-inner" role="listbox">
							{{--Set the active flag as false--}}
							<?php
							$active = "active";
							$qNo = 1;
							?>
							@foreach($questions_asked as $question)
							<div class="item question-asked {{{$active}}}">
								<div class="question-answer clearfix">
									<div class="marks"><span>{{{$question->answer->marks}}}</span> XP</div>
									@if(!$question->answer->attempted)
									<div class="status">You didn't attemp this question</div>
									@endif
									<div class="time-taken"><span>{{{$question->answer->time_taken}}}</span> seconds</div>
								</div>
								<div class="quiz-question">
									Q.{{{$qNo}}}:  {{{$question->question->title}}}
								</div>
								<div class="question-options">
									@foreach($question->question->options as $option)
									<?php
									$optionClass = '';
									?>
									{{--If the option is the one selected by the user and was attempted--}}
									@if($question->answer->option_id === $option->id && $question->answer->attempted)
									{{--If the option is correct answer--}}
									@if($option->is_answer)
									<?php
									$optionClass .= " correct-option ";
									?>
									@else
									<?php
									$optionClass .= " incorrect-option ";
									?>
									@endif
									<?php
									$optionClass .= " selected-option ";
									?>
									@else
									{{--If the option is correct answer--}}
									@if($option->is_answer)
									<?php
									$optionClass .= " correct-option ";
									?>
									@endif
									@endif
									<div class="question-option {{{$optionClass}}}">
										{{{$option->title}}}
									</div>
									@endforeach
								</div>
							</div>
							<?php $active = ''; $qNo++; ?>
							@endforeach
						</div>
						<a class="left carousel-control" href="#questions-asked-carousel" role="button" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="right carousel-control" href="#questions-asked-carousel" role="button" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<input type="hidden" id="quiz_id" value="{{{$quiz->id}}}">
@stop