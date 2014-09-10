@extends('backend.layout')
@section('sub-header-title')
	{{$chapter->name}}
@stop
@section('sub-header-breadcrumbs')
{{ Breadcrumbs::render('management-chapter-edit', $course, $subject, $chapter) }}
@stop
@section('sub-header-actions')
	<a href="{{route('management.courses.subjects.chapters.index', array($course->id, $subject->id))}}" class="btn btn-lg btn-default btn-block"><span class="glyphicon glyphicon-list"></span> All Chapters</a>
@stop
@section('main-content')
<div class="create-course-page from-top-6">
		<div class="container container-xs">
	{{Form::open(array('route' => array("management.courses.subjects.chapters.update", $course->id, $subject->id, $chapter->id), 'class' => "form", 'method' => "put"))}}
	@if($errors->count())
	<div class="alert alert-danger text-center well-sm">
		<small>{{$errors->first()}}</small>
	</div>
	@endif
	<div class="form-group">
		{{Form::text('name', $chapter->name, array('class' => "form-control", 'required' => "required", 'placeholder' => "Name"))}}
	</div>
	<div class="form-group">
		{{Form::textarea('description', $chapter->description, array('class' => "form-control", 'required' => "required", 'placeholder' => "Description", 'rows' => '6'))}}
	</div>
	<div class="form-group">
		{{Form::submit('Update', array('class' => "btn btn-success btn-lg"))}}
	</div>
	{{Form::close()}}
	{{Form::open(array('route' => array('management.courses.subjects.chapters.destroy', $course->id, $subject->id, $chapter->id), 'method' => "DELETE", 'onsubmit' => "return confirm('Are you sure you want to delete this chapter? It is irreversible!');"))}}
	{{Form::submit('Delete', array('class' => "btn-link btn-block text-muted small"))}}
	{{Form::close()}}
	</div>
</div>
@stop