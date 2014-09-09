@extends('management.layout')
@section('body')
{{ Breadcrumbs::render('management-chapter-edit', $course, $subject, $chapter) }}
<div class="container-xs">
	<div class="page-header clearfix text-center">
		<h3>Edit Chapter</h3>
	</div>
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
		{{Form::submit('Update', array('class' => "btn btn-primary btn-block btn-lg"))}}
	</div>
	{{Form::close()}}
	{{Form::open(array('route' => array('management.courses.subjects.chapters.destroy', $course->id, $subject->id, $chapter->id), 'method' => "DELETE", 'onsubmit' => "return confirm('Are you sure you want to delete this chapter? It is irreversible!');"))}}
	{{Form::submit('Delete', array('class' => "btn-link btn-block text-muted small"))}}
	{{Form::close()}}
</div>
@stop