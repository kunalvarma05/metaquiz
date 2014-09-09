@extends('management.layout')
@section('body')
{{ Breadcrumbs::render('management-questions-create', $course, $subject, $chapter) }}
<div class="container-xs">
	<div class="page-header clearfix text-center">
		<h3>Add Question</h3>
	</div>
	{{Form::open(array('route' => array("management.courses.subjects.chapters.questions.store", $course->id, $subject->id, $chapter->id), 'class' => "form", 'method' => "post"))}}
	@if($errors->count())
	<div class="alert alert-danger text-center well-sm">
		<small>{{$errors->first()}}</small>
	</div>
	@endif
	<div class="form-group">
		{{Form::text('title', Input::old('title'), array('class' => "form-control", 'required' => "required", 'placeholder' => "Title"))}}
	</div>
	<div class="form-group">
		{{Form::text('option_one', Input::old('option_one'), array('class' => "form-control", 'required' => "required", 'placeholder' => "Option One"))}}
	</div>
	<div class="form-group">
		{{Form::text('option_two', Input::old('option_two'), array('class' => "form-control", 'required' => "required", 'placeholder' => "Option Two"))}}
	</div>
	<div class="form-group">
		{{Form::text('option_three', Input::old('option_three'), array('class' => "form-control", 'required' => "required", 'placeholder' => "Option Three"))}}
	</div>
	<div class="form-group">
		{{Form::text('answer', Input::old('answer'), array('class' => "form-control", 'required' => "required", 'placeholder' => "Answer"))}}
	</div>
	<div class="form-group">
		{{Form::submit('Create', array('class' => "btn btn-primary btn-block btn-lg"))}}
	</div>
	{{Form::close()}}
</div>
@stop