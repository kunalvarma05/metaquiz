@extends('admin.layout')
@section('body')
<div class="container">
	<div class="page-header clearfix">
		<h3>{{$organization->name}} <div class="pull-right"><a href="{{route('admin.organizations.edit', $organization->id)}}" class="btn btn-sm btn-default">Edit</a> </div></h3>
	</div>
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="media panel panel-default alert">
				<img src="{{orgPic()}}" class="media-object img-120 img-rounded pull-left">
				<div class="media-body">{{$organization->description}}</div>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			@if(count($organization->manager))
			<div class="media panel-default alert">
				<a href="#{{$organization->manager->id}}" class="pull-left">
					<img src="{{profilePic($organization->manager->picture)}}" class="media-object img-64 img-circle img-thumbnail">
				</a>
				<div class="media-body">
					<a href="#{{$organization->manager->id}}" class="">
						{{$organization->manager->name}}
					</a>
					<p>
						Joined on: <b>{{$organization->manager->created_at->format('d-m-Y')}} </b> at <b> {{$organization->manager->created_at->format('h:i A')}}</b>
					</p>
				</div>
			</div>
			@endif
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			@if(count($organization->faculties))
			<div class="well-sm"><b>Faculties</b></div>
			<div class="list-group">
				@foreach($organization->faculties as $faculty)
				<a href="#{{$faculty->id}}" class="list-group-item">
					{{$faculty->name}}
				</a>
				@endforeach
			</div>
			@endif
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			@if(count($organization->courses))
			<div class="well-sm"><b>Courses</b></div>
			<div class="list-group">
				@foreach($organization->courses as $course)
				<a href="{{route('admin.organizations.courses.show', array($organization->id, $course->id))}}" class="list-group-item">
					{{$course->name}}
				</a>
				@endforeach
			</div>
			@endif
		</div>
	</div>
</div>
@stop