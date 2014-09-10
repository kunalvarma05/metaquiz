@extends('backend.layout')
@section('main-content')
<div class="create-faculty-page">
	@section('sub-header-title')
		{{$faculty->name}}
	@stop
	@section('sub-header-breadcrumbs')
	{{ Breadcrumbs::render('management-faculty', $faculty) }}
	@stop
	@section('sub-header-actions')
		<a href="{{route('management.faculties.create')}}" class="btn btn-lg btn-block btn-success"><span class="glyphicon glyphicon-plus"></span> Create Faculty</a>
	@stop
	<div class="faculty">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<div class="page-header clearfix">
						<h4 class="pull-left">{{$faculty->name}}</h4>
						<a href="{{route('management.faculties.edit', $faculty->id)}}" class="btn btn-info btn-sm pull-right">Edit</a>
					</div>
					<p>
						{{$faculty->description}}
					</p>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
					<div class="page-header clearfix">
						<h4 class="pull-left">Assigned Subjects</h4>
					</div>
					<div class="row">
						@if(count($faculty->accountable->subjects))
						@foreach($faculty->accountable->subjects as $subject)
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
							<div class="brick brick-solid brick-shadow">
								<div class="brick-content">
									<a href="{{route('management.courses.subjects.show', array($subject->course_id, $subject->id))}}" class="brick-title">{{$subject->name}}</a>
									<span class="timeago brick-micro-info">Created on {{$subject->created_at->format('jS M, Y')}}</span>
									<div class="brick-info">
										{{$subject->description}}
									</div>
								</div>
								<div class="brick-footer">
									<a href="{{route('management.courses.subjects.edit', array($subject->course_id, $subject->id))}}" class="btn btn-xs btn-default pull-right">EDIT</a>
								</div>
							</div>
						</div>
						@endforeach
						@else
						<div class="empty-state text-center alert">
							<p>
								No Subjects Found!
							</p>
						</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop