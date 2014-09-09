@extends('admin.layout')
@section('body')
<div class="container-xs">
	<div class="page-header clearfix text-center">
		<h3>Edit Course</h3>
	</div>
	{{Form::open(array('route' => array("admin.organizations.courses.update", $course->organization_id, $course->id), 'class' => "form", 'method' => "put"))}}
	@if($errors->count())
	<div class="alert alert-danger text-center well-sm">
		<small>{{$errors->first()}}</small>
	</div>
	@endif
	<div class="form-group">
		{{Form::text('name', $course->name, array('class' => "form-control", 'required' => "required", 'placeholder' => "Name"))}}
	</div>
	<div class="form-group">
		{{Form::textarea('description', $course->description, array('class' => "form-control", 'required' => "required", 'placeholder' => "Description", 'rows' => '6'))}}
	</div>
	<div class="form-group">
		{{Form::submit('Update', array('class' => "btn btn-primary btn-block btn-lg"))}}
	</div>
	{{Form::close()}}
	{{Form::open(array('route' => array('admin.organizations.courses.destroy', $course->organization_id, $course->id), 'method' => "DELETE", 'onsubmit' => "return confirm('Are you sure you want to delete this course? It is irreversible!');"))}}
	{{Form::submit('Delete', array('class' => "btn-link btn-block text-muted small"))}}
	{{Form::close()}}
</div>
@stop