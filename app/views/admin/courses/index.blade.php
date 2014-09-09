@extends('admin.layout')
@section('body')
<div class="container">
	<div class="page-header clearfix">
		<h3>{{$organization->name}} | Courses <a href="{{route('admin.organizations.courses.create', $organization->id)}}" class="btn btn-success pull-right btn-sm">Create Course</a></h3>
	</div>
	@if(count($organization->courses))
	<div class="row">
		@foreach($organization->courses as $course)
		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			<div class="media panel panel-default well-sm">
				<a class="pull-left" href="{{route('admin.organizations.courses.show', array($organization->id, $course->id))}}">{{$course->name}}</a>
			</div>
		</div>
		@endforeach
	</div>
	@else
	<div class="alert text-center text-muted">
		No courses found!
	</div>
	@endif
</div>
@stop