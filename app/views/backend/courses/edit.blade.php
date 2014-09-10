@extends('backend.layout')
@section('sub-header-title')
	{{$course->name}}
@stop
@section('sub-header-breadcrumbs')
{{ Breadcrumbs::render('management-course-edit', $course) }}
@stop
@section('sub-header-actions')
	<a href="{{route('management.courses.index')}}" class="btn btn-lg btn-default btn-block"><span class="glyphicon glyphicon-book-open"></span> All Courses</a>
@stop
@section('main-content')
<div class="create-course-page from-top-6">
	<div class="container container-xs">
		{{Form::open(array('route' => array("management.courses.update", $course->id), 'class' => "form", 'method' => "put"))}}
		@if($errors->count())
		<div class="alert alert-danger text-center well-sm">
			<small>{{$errors->first()}}</small>
		</div>
		@endif
		<div class="form-group">
			{{Form::text('name', $course->name, array('class' => "form-control input-lg", 'required' => "required", 'placeholder' => "Name"))}}
		</div>
		<div class="form-group">
			{{Form::textarea('description', $course->description, array('class' => "form-control input-lg", 'required' => "required", 'placeholder' => "Description", 'rows' => '6'))}}
		</div>
		<div class="form-group">
			{{Form::submit('Update', array('class' => "btn btn-success btn-lg"))}}
		</div>
		{{Form::close()}}
	</div>
</div>
@stop