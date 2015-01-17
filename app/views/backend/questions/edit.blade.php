@extends('backend.layout')
@section('sub-header-title')
Edit Question
@stop
@section('sub-header-breadcrumbs')
{{ Breadcrumbs::render('management-question-edit', $course, $subject, $chapter, $question) }}
@stop
@section('sub-header-actions')
<a href="{{route('management.courses.subjects.chapters.questions.index', array($course->id, $subject->id, $chapter->id))}}" class="btn btn-lg btn-default btn-block"><span class="glyphicon glyphicon-list"></span> All Questions</a>
@stop
@section('main-content')
<div class="create-chapter-page from-top-6">
	<div class="container container-xs">
		{{Form::open(array('route' => array("management.courses.subjects.chapters.questions.update", $course->id, $subject->id, $chapter->id, $question->id), 'class' => "form", 'method' => "PUT"))}}
		@if($errors->count())
		<div class="alert alert-danger text-center well-sm">
			<small>{{$errors->first()}}</small>
		</div>
		@endif
		<div class="form-group">
			{{Form::label('title', 'Question')}}
			{{Form::text('title', $question->title, array('class' => "form-control input-lg", 'required' => "required", 'placeholder' => "Title"))}}
		</div>
		<div class="form-group">
			{{Form::label('option_one', 'Option 1')}}
			{{Form::text('option_one', $option_one->title, array('class' => "form-control input-lg", 'required' => "required", 'placeholder' => "Option One"))}}
		</div>
		<div class="form-group">
			{{Form::label('option_two', 'Option 2')}}
			{{Form::text('option_two', $option_two->title, array('class' => "form-control input-lg", 'required' => "required", 'placeholder' => "Option Two"))}}
		</div>
		<div class="form-group">
			{{Form::label('option_three', 'Option 3')}}
			{{Form::text('option_three', $option_three->title, array('class' => "form-control input-lg", 'required' => "required", 'placeholder' => "Option Three"))}}
		</div>
		<div class="form-group">
			{{Form::label('answer', 'Answer')}}
			{{Form::text('answer', $answer->title, array('class' => "form-control input-lg", 'required' => "required", 'placeholder' => "Answer"))}}
		</div>
		<div class="form-group">
			{{Form::submit('Update', array('class' => "btn btn-success btn-lg"))}}
		</div>
		{{Form::close()}}
	</div>
</div>
@stop