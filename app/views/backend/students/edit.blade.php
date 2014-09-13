@extends('backend.layout')
@section('sub-header-title')
	{{$student->name}}
@stop
@section('sub-header-breadcrumbs')
{{ Breadcrumbs::render('management-student-edit', $student) }}
@stop
@section('sub-header-actions')
	<a href="{{route('management.students.index')}}" class="btn btn-lg btn-default btn-block"><span class="glyphicon glyphicon-book-open"></span> All students</a>
@stop
@section('main-content')
<div class="create-student-page from-top-6">
	<div class="container container-xs">
		{{Form::open(array('route' => array("management.students.update", $student->id), 'class' => "form", 'method' => "put"))}}
		@if($errors->count())
		<div class="alert alert-danger text-center well-sm">
			<small>{{$errors->first()}}</small>
		</div>
		@endif
		<div class="form-group">
			{{Form::label('roll_no','Roll Number')}}
			{{Form::text('roll_no', $student->accountable->roll_no, array('class' => "form-control", 'required' => "required", 'placeholder' => "Roll Number"))}}
		</div>
		<div class="form-group">
			{{Form::label('course_id', 'Course')}}
			{{Form::select('course_id', $courses, array($student->accountable->course_id), array('class' => "form-control input-lg", 'required' => "required", 'placeholder' => "Courses", 'rows' => '6'))}}
		</div>
		<div class="form-group">
			{{Form::submit('Update', array('class' => "btn btn-primary btn-block btn-lg"))}}
		</div>
		{{Form::close()}}
	</div>
</div>
@stop