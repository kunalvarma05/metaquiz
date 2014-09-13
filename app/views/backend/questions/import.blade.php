@extends('backend.layout')
@section('sub-header-title')
Import Questions
@stop
@section('sub-header-breadcrumbs')
{{ Breadcrumbs::render('management-questions-import', $course, $subject, $chapter) }}
@stop
@section('sub-header-actions')
<a href="{{route('management.courses.subjects.chapters.questions.index', array($course->id, $subject->id, $chapter->id))}}" class="btn btn-lg btn-default btn-block"><span class="glyphicon glyphicon-list"></span> All Questions</a>
@stop
@section('main-content')
<div class="create-chapter-page from-top-6">
	<div class="container container-xs">
		{{Form::open(array('route' => array("management.courses.subjects.chapters.questions.do-import", $course->id, $subject->id, $chapter->id), 'class' => "form", 'method' => "post", "files" => true))}}
		@if($errors->count())
		<div class="alert alert-danger text-center well-sm">
			<small>{{$errors->first()}}</small>
		</div>
		@endif
		<div class="form-group">
			<div class="alert brick">
				{{Form::file('file')}}
			</div>
			<div class="alert alert-info text-center ">
				<b class="block well-sm">Choose an Excel File with Questions ,Options and Answers</b>
				Allowed formats are: <b>.xlsx</b>, <b>.xls</b>
			</div>
		</div>
		<div class="form-group">
			{{Form::submit('Import', array('class' => "btn btn-primary btn-block btn-lg"))}}
		</div>
		{{Form::close()}}
	</div>
</div>
@stop