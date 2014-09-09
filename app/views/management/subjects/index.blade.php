@extends('management.layout')
@section('body')
<div class="courses-page">
	{{ Breadcrumbs::render('management-subjects', $course) }}
	<div class="container page-center-1">
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<h3 class="page-header">{{$course->name}} | Subjects <a href="{{route('management.courses.subjects.create', $course->id)}}" class="btn btn-xs btn-success pull-right">Create</a></h3>
			<div class="list-group">
				@if(count($course->subjects))
				@foreach($course->subjects as $subject)
				<a href="{{route('management.courses.subjects.show', array($course->id, $subject->id))}}" class="list-group-item">
					<b class="list-group-item-heading">{{$subject->name}}</b>
					<p class="list-group-item-text">{{$subject->description}}</p>
				</a>
				@endforeach
				@else
				<div class="list-group-item-text text-center">
					<p>
						No Subjects Found!
					</p>
				</div>
				@endif
			</div>
		</div>
	</div>
</div>
@stop