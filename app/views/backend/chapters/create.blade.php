@extends('backend.layout')
@section('sub-header-title')
	Create Chapter
@stop
@section('sub-header-breadcrumbs')
{{ Breadcrumbs::render('management-chapters-create', $course, $subject) }}
@stop
@section('sub-header-actions')
	<a href="{{route('management.courses.subjects.chapters.index', array($course->id, $subject->id))}}" class="btn btn-lg btn-default btn-block"><span class="glyphicon glyphicon-list"></span> All Chapters</a>
@stop
@section('main-content')
<div class="create-chapter-page from-top-6">
	<div class="container container-xs">
	{{Form::open(array('route' => array("management.courses.subjects.chapters.store", $course->id, $subject->id), 'class' => "form", 'method' => "post"))}}
	@if($errors->count())
	<div class="alert alert-danger text-center well-sm">
		<small>{{$errors->first()}}</small>
	</div>
	@endif
	<div class="form-group">
		{{Form::text('name', Input::old('name'), array('class' => "form-control input-lg", 'required' => "required", 'placeholder' => "Name"))}}
	</div>
	<div class="form-group">
		{{Form::textarea('description', Input::old('description'), array('class' => "form-control input-lg", 'required' => "required", 'placeholder' => "Description", 'rows' => '6'))}}
	</div>
	<div class="form-group">
		{{Form::submit('Create', array('class' => "btn btn-success btn-lg"))}}
	</div>
	{{Form::close()}}
	</div>
</div>
@stop