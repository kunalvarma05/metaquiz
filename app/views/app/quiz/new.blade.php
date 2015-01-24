@extends('app.partials.layout')
@section('main')
<div class="new-quiz-page">
	<div class="new-quiz-chapters">
		<div class="panel panel-default well-sm">
			Select the chapters you want to include the questions from, in the quiz
		</div>
		{{Form::open(array('route' => "app.quiz.generate"))}}
		<div class="form-group">
			{{Form::select('chapters[]', $chapters, array(), array('class' => "form-control input-lg", 'required' => "required", 'placeholder' => "Chapters", 'rows' => '6', 'multiple' => "multiple", 'data-selector' => "true"))}}
		</div>
		{{Form::submit('Start Quiz', array('class' => "btn btn-lg btn-success btn-block"))}}
		{{Form::close()}}
	</div>
</div>
@stop