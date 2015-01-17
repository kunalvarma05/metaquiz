@extends('backend.layout')
@section('sub-header-title')
Question
@stop
@section('sub-header-breadcrumbs')
{{ Breadcrumbs::render('management-question', $course, $subject, $chapter, $question) }}
@stop
@section('sub-header-actions')
<a href="{{route('management.courses.subjects.chapters.questions.index', array($course->id, $subject->id, $chapter->id))}}" class="btn btn-lg btn-default btn-block"><span class="glyphicon glyphicon-list"></span> All Questions</a>
@stop
@section('main-content')
<div class="courses-page">
	<div class="container-sm page-center-1">
		<div class="brick brick-shadow">
			<div class="brick-content">
				<a href="{{route('management.courses.subjects.chapters.questions.show', array($course->id, $subject->id, $chapter->id, $question->id))}}" class="brick-title">{{$question->title}}</a>
				<span class="timeago brick-micro-info">Created on {{$question->created_at->format('jS M, Y')}}</span>
			</div>
			<div class="well-sm clearfix">
				{{Form::open(array('route' => array('management.courses.subjects.chapters.questions.destroy', $course->id, $subject->id, $chapter->id, $question->id), 'method' => "DELETE", 'onsubmit' => "return confirm('Are you sure you want to delete this question? It is irreversible!');", 'class' => "pull-left"))}}
				{{Form::submit('Delete', array('class' => "btn-danger btn btn-sm"))}}
				{{Form::close()}}
				<a href="{{route('management.courses.subjects.chapters.questions.edit', array($course->id, $subject->id, $chapter->id, $question->id))}}" class="btn btn-sm btn-default pull-right">Edit</a>
			</div>
		</div>
		@if(count($question->options))
		<div class="row from-top-2">
			@foreach($question->options as $option)
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
				@if($option->is_answer)
				<div class="btn-success alert btn text-center btn-block">
					<b>{{$option->title}}</b>
				</div>
				@else
				<div class="btn-default btn-block btn alert text-center">
					<b>{{$option->title}}</b>
				</div>
				@endif
			</div>
			@endforeach
		</div>
		@endif
	</div>
</div>
@stop