@extends('app.partials.layout')
@section('main')
<div class="row subject-listing">
	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
		<div class="course-list" id="course-list">
			@include('app.subjects.courses')
		</div>

	</div>
	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
		<div class="subject-list no-show" id="subject-list">
			@include('app.subjects.subjects')
		</div>
	</div>
</div>
@stop