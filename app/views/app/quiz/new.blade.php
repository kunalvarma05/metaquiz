@extends('app.partials.layout')
@section('main')
<div class="new-quiz-page">
	<div class="new-quiz-chapters">
		<div class="alert alert-block alert-info">
			Select the chapters you want to include the questions from, in the quiz
		</div>
		{{Form::open(array('route' => "app.quiz.generate"))}}
		{{Form::select('chapters[]', $chapters, array(), array('class' => "form-control input-lg", 'required' => "required", 'placeholder' => "Chapters", 'rows' => '6', 'multiple' => "multiple"))}}
		{{Form::submit('Start Quiz', array('class' => "btn btn-lg btn-success btn-block"))}}
		{{Form::close()}}
	</div>
</div>
@stop