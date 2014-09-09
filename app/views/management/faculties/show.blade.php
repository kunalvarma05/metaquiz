@extends('management.layout')
@section('body')
<div class="facultys-page">
	<div class="container page-center-1">
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<h3 class="page-header">{{$faculty->name}} <a href="{{route('management.faculties.edit', $faculty->id)}}" class="btn btn-xs btn-default pull-right">Edit</a></h3>
			<p>
				{{$faculty->description}}
			</p>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<h3 class="page-header">Subjects</h3>
			<div class="list-group">
				@if(count($faculty->accountable->subjects))
				@foreach($faculty->accountable->subjects as $subject)
				<a href="{{route('management.courses.subjects.show', array($subject->course_id, $subject->id))}}" class="list-group-item">
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