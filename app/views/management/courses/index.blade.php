@extends('management.layout')
@section('body')
<div class="courses-page">
	{{ Breadcrumbs::render('management-courses') }}
	<div class="container page-center-1">
		<div class="courses">
			<h3 class="page-header">Courses <a href="{{route('management.courses.create')}}" class="btn btn-xs btn-success pull-right">Create</a></h3>
			<div class="list-group">
				@if(count($courses))
				@foreach($courses as $course)
				<a href="{{route('management.courses.show', $course->id)}}" class="list-group-item">
					<b class="list-group-item-heading">{{$course->name}}</b>
					<p class="list-group-item-text">{{$course->description}}</p>
				</a>
				@endforeach
				@else
				<div class="list-group-item-text text-center">
					<p>
						No Courses Found!
					</p>
				</div>
				@endif
			</div>
		</div>
	</div>
</div>
@stop