@extends('backend.layout')
@section('sub-header-title')
	Add Question
@stop
@section('sub-header-breadcrumbs')
{{ Breadcrumbs::render('management-chapters-create', $course, $subject) }}
@stop
@section('sub-header-actions')
	<a href="{{route('management.courses.subjects.chapters.questions.index', array($course->id, $subject->id, $chapter->id))}}" class="btn btn-lg btn-default btn-block"><span class="glyphicon glyphicon-list"></span> All Questions</a>
@stop
@section('main-content')
<div class="create-chapter-page from-top-6">
	<div class="container container-xs">
	{{Form::open(array('route' => array("management.courses.subjects.chapters.questions.store", $course->id, $subject->id, $chapter->id), 'class' => "form", 'method' => "post"))}}
	@if($errors->count())
	<div class="alert alert-danger text-center well-sm">
		<small>{{$errors->first()}}</small>
	</div>
	@endif
	<div class="form-group">
		{{Form::text('title', Input::old('title'), array('class' => "form-control input-lg", 'required' => "required", 'placeholder' => "Title"))}}
	</div>
	<div class="form-group">
		{{Form::text('option_one', Input::old('option_one'), array('class' => "form-control input-lg", 'required' => "required", 'placeholder' => "Option One"))}}
	</div>
	<div class="form-group">
		{{Form::text('option_two', Input::old('option_two'), array('class' => "form-control input-lg", 'required' => "required", 'placeholder' => "Option Two"))}}
	</div>
	<div class="form-group">
		{{Form::text('option_three', Input::old('option_three'), array('class' => "form-control input-lg", 'required' => "required", 'placeholder' => "Option Three"))}}
	</div>
	<div class="form-group">
		{{Form::text('answer', Input::old('answer'), array('class' => "form-control input-lg", 'required' => "required", 'placeholder' => "Answer"))}}
	</div>
	<div class="form-group">
		{{Form::submit('Create', array('class' => "btn btn-success btn-lg"))}}
	</div>
	{{Form::close()}}
	</div>
</div>
@stop