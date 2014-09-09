@extends('management.layout')
@section('body')
<div class="courses-page">
	{{ Breadcrumbs::render('management-chapters', $course, $subject) }}
	<div class="container page-center-1">
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<h4 class="page-header"><a href="{{route('management.courses.subjects.chapters.create', array($course->id, $subject->id))}}" class="btn btn-xs btn-success pull-right">Create</a> {{$subject->name}} | Chapters</h4>
			<div class="list-group">
				@if(count($subject->chapters))
				@foreach($subject->chapters as $chapter)
				<a href="{{route('management.courses.subjects.chapters.show', array($course->id, $subject->id, $chapter->id))}}" class="list-group-item">
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