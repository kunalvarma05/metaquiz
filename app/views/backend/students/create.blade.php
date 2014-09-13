@extends('backend.layout')
@section('sub-header-title')
Add Student
@stop
@section('sub-header-breadcrumbs')
{{ Breadcrumbs::render('management-students-create') }}
@stop
@section('sub-header-actions')
<a href="{{route('management.students.index')}}" class="btn btn-lg btn-default btn-block"><span class="glyphicon glyphicon-book-open"></span> All students</a>
@stop
@section('main-content')
<div class="create-student-page from-top-6">
	<div class="container container-xs">
		{{Form::open(array('route' => array("management.students.store"), 'class' => "form", 'method' => "post"))}}
		@if($errors->count())
		<div class="alert alert-danger text-center well-sm">
			<small>{{$errors->first()}}</small>
		</div>
		@endif
		<div class="form-group">
			{{Form::label('roll_no','Roll Number')}}
			{{Form::text('roll_no', Input::old('roll_no'), array('class' => "form-control input-lg", 'required' => "required", 'placeholder' => "Roll Number"))}}
		</div>
		<div class="form-group">
			{{Form::label('course_id', 'Course')}}
			{{Form::select('course_id', $courses, array(), array('class' => "form-control input-lg", 'required' => "required", 'placeholder' => "Courses", 'rows' => '6'))}}
		</div>
		<div class="form-group">
			{{Form::submit('Add Student', array('class' => "btn btn-success btn-lg"))}}
		</div>
		{{Form::close()}}
	</div>
</div>
@stop