@extends('admin.layout')
@section('body')
<div class="container">
	<div class="page-header clearfix">
		<h3>{{$course->name}} <div class="pull-right"><a href="{{route('admin.organizations.courses.edit', array($course->organization_id, $course->id))}}" class="btn btn-sm btn-default">Edit</a> </div></h3>
	</div>
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="media panel panel-default alert">
				<img src="{{orgPic()}}" class="media-object img-120 img-rounded pull-left">
				<div class="media-body">{{$course->description}}</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			@if(count($course->subjects))
			<div class="well-sm"><b>Subjects</b></div>
			<div class="list-group">
				@foreach($course->subjects as $subject)
				<a href="#{{$subject->id}}" class="list-group-item">
					{{$subject->name}}
				</a>
				@endforeach
			</div>
			@endif
		</div>
	</div>
</div>
@stop