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
		<div class="alert">
			<p>
				<b>To bulk add questions, please use our easy-to-use Importer</b>
			</p>
			<p>
			<a href="{{route('management.courses.subjects.chapters.questions.import', array($course->id, $subject->id, $chapter->id))}}" class="btn btn-info"><span class="glyphicon glyphicon-upload"></span> Import Questions</a>
			</p>
		</div>
	{{Form::open(array('route' => array("management.courses.subjects.chapters.questions.store", $course->id, $subject->id, $chapter->id), 'class' => "form", 'method' => "post"))}}
	@if($errors->count())
	<div class="alert alert-danger text-center well-sm">
		<small>{{$errors->first()}}</small>
	</div>
	@endif
	<div class="form-group">
		{{Form::label('title', 'Question')}}
		{{Form::text('title', Input::old('title'), array('class' => "form-control input-lg", 'required' => "required", 'placeholder' => "Title"))}}
	</div>
	<div class="form-group">
		{{Form::label('option_one', 'Option 1')}}
		{{Form::text('option_one', Input::old('option_one'), array('class' => "form-control input-lg", 'required' => "required", 'placeholder' => "Option One"))}}
	</div>
	<div class="form-group">
		{{Form::label('option_two', 'Option 2')}}
		{{Form::text('option_two', Input::old('option_two'), array('class' => "form-control input-lg", 'required' => "required", 'placeholder' => "Option Two"))}}
	</div>
	<div class="form-group">
		{{Form::label('option_three', 'Option 3')}}
		{{Form::text('option_three', Input::old('option_three'), array('class' => "form-control input-lg", 'required' => "required", 'placeholder' => "Option Three"))}}
	</div>
	<div class="form-group">
		{{Form::label('answer', 'Answer')}}
		{{Form::text('answer', Input::old('answer'), array('class' => "form-control input-lg", 'required' => "required", 'placeholder' => "Answer"))}}
	</div>
	<div class="form-group">
		{{Form::submit('Create', array('class' => "btn btn-success btn-lg"))}}
	</div>
	{{Form::close()}}
	</div>
</div>
@stop