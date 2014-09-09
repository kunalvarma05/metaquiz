@extends('management.layout')
@section('body')
{{ Breadcrumbs::render('management-subject-edit', $course, $subject) }}
<div class="container-xs">
	<div class="page-header clearfix text-center">
		<h3>Edit Subject</h3>
	</div>
	{{Form::open(array('route' => array("management.courses.subjects.update", $subject->course_id, $subject->id), 'class' => "form", 'method' => "put"))}}
	@if($errors->count())
	<div class="alert alert-danger text-center well-sm">
		<small>{{$errors->first()}}</small>
	</div>
	@endif
	<div class="form-group">
		{{Form::text('name', $subject->name, array('class' => "form-control", 'required' => "required", 'placeholder' => "Name"))}}
	</div>
	<div class="form-group">
		{{Form::textarea('description', $subject->description, array('class' => "form-control", 'required' => "required", 'placeholder' => "Description", 'rows' => '6'))}}
	</div>
	<div class="form-group">
		{{Form::submit('Update', array('class' => "btn btn-primary btn-block btn-lg"))}}
	</div>
	{{Form::close()}}
</div>
@stop