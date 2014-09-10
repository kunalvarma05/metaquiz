@extends('backend.layout')
@section('main-content')
@section('sub-header-title')
	{{$chapter->name}}
@stop
@section('sub-header-breadcrumbs')
{{ Breadcrumbs::render('management-chapter', $course, $subject, $chapter) }}
@stop
@section('sub-header-actions')
	<a href="{{route('management.courses.subjects.chapters.create', array($course->id, $subject->id))}}" class="btn btn-lg btn-block btn-success"><span class="glyphicon glyphicon-plus"></span> Create Chapter</a>
@stop
<div class="course">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<div class="page-header clearfix">
					<h4 class="pull-left">{{$chapter->name}}</h4>
					<a href="{{route('management.courses.subjects.chapters.edit', array($course->id, $subject->id, $chapter->id))}}" class="btn btn-info btn-sm pull-right">Edit</a>
				</div>
				<p>
					{{$chapter->description}}
				</p>
			</div>
			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
				<div class="page-header clearfix">
					<h4 class="pull-left">Questions</h4>
					<a href="{{route('management.courses.subjects.chapters.questions.create', array($course->id, $subject->id, $chapter->id))}}" class="btn btn-success btn-sm pull-right">Add Questions</a>
				</div>
				<div class="row">
					@if(count($chapter->questions))
					@foreach($chapter->questions as $question)
					<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<div class="brick brick-solid brick-shadow">
							<div class="brick-content">
								<a href="{{route('management.courses.subjects.chapters.questions.show', array($course->id, $subject->id, $chapter->id, $question->id))}}" class="brick-title">{{$question->title}}</a>
								<span class="timeago brick-micro-info">Created on {{$question->created_at->format('jS M, Y')}}</span>
							</div>
							<div class="brick-footer">
								<a href="{{route('management.courses.subjects.chapters.questions.edit', array($course->id, $subject->id, $chapter->id, $question->id))}}" class="btn btn-xs btn-default pull-right">EDIT</a>
							</div>
						</div>
					</div>
					@endforeach
					@else
					<div class="empty-state alert text-center">
						<p>
							No Questions Found!
						</p>
					</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@stop