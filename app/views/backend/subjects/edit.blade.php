@extends('backend.layout')
@section('sub-header-title')
	{{$subject->name}}
@stop
@section('sub-header-breadcrumbs')
{{ Breadcrumbs::render('management-subject-edit', $course, $subject) }}
@stop
@section('sub-header-actions')
	<a href="{{route('management.courses.subjects.index', $course->id)}}" class="btn btn-lg btn-default btn-block"><span class="glyphicon glyphicon-book-open"></span> All Subjects</a>
@stop
@section('main-content')
<div class="create-course-page from-top-6">
		<div class="container container-xs">
		{{Form::open(array('route' => array("management.courses.subjects.update", $subject->course_id, $subject->id), 'class' => "form", 'method' => "put"))}}
		@if($errors->count())
		<div class="alert alert-danger text-center well-sm">
			<small>{{$errors->first()}}</small>
		</div>
		@endif
		<div class="form-group">
			{{Form::text('name', $subject->name, array('class' => "form-control input-lg", 'required' => "required", 'placeholder' => "Name"))}}
		</div>
		<div class="form-group">
			{{Form::textarea('description', $subject->description, array('class' => "form-control input-lg", 'required' => "required", 'placeholder' => "Description", 'rows' => '6'))}}
		</div>
		<div class="form-group">
			{{Form::submit('Update', array('class' => "btn btn-success btn-lg"))}}
		</div>
		{{Form::close()}}
	</div>
</div>
@stop