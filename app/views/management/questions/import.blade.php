@extends('management.layout')
@section('body')
{{ Breadcrumbs::render('management-questions-import', $course, $subject, $chapter) }}
<div class="container-xs">
	<div class="page-header clearfix text-center">
		<h3>Import Questions</h3>
	</div>
	{{Form::open(array('route' => array("management.courses.subjects.chapters.questions.do-import", $course->id, $subject->id, $chapter->id), 'class' => "form", 'method' => "post", "files" => true))}}
	@if($errors->count())
	<div class="alert alert-danger text-center well-sm">
		<small>{{$errors->first()}}</small>
	</div>
	@endif
	<div class="form-group">
		{{Form::label('file', "Select an Excel file with Questions")}}
		<div class="well well-sm">
			{{Form::file('file')}}
		</div>
		<div class="alert well-sm text-center">
			Allowed formats are: <b>.xlsx</b>, <b>.xls</b>
		</div>
	</div>
	<div class="form-group">
		{{Form::submit('Import', array('class' => "btn btn-primary btn-block btn-lg"))}}
	</div>
	{{Form::close()}}
</div>
@stop