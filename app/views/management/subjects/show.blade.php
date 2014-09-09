@extends('management.layout')
@section('body')
<div class="subjects-page">
{{ Breadcrumbs::render('management-subject', $course, $subject) }}
	<div class="container page-center-1">
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<h3 class="page-header">{{$subject->name}} <a href="{{route('management.courses.subjects.edit', array($subject->course_id, $subject->id))}}" class="btn btn-xs btn-default pull-right">Edit</a></h3>
			<p>
				{{$subject->description}}
			</p>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<h3 class="page-header">Chapters <a href="{{route('management.courses.subjects.chapters.create', array($course->id, $subject->id))}}" class="btn btn-xs btn-success pull-right">Create</a></h3>
			<div class="list-group">
				@if(count($subject->chapters))
				@foreach($subject->chapters as $chapter)
				<a href="{{route('management.courses.subjects.chapters.show', array($subject->course_id, $subject->id, $chapter->id))}}" class="list-group-item">
					<b class="list-group-item-heading">{{$chapter->name}}</b>
					<p class="list-group-item-text">{{$chapter->description}}</p>
				</a>
				@endforeach
				@else
				<div class="list-group-item-text text-center">
					<p>
						No Chapters Found!
					</p>
				</div>
				@endif
			</div>
		</div>
	</div>
</div>
@stop