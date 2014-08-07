@extends('app.partials.layout')
@section('main')
<div class="row">
	<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
		<!--Activity Feed-->
		@include('app.home.activity')
		<!--End: Activity Feed-->
	</div>
	<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
		<!--Performance-->
		@include('app.home.performance')
		<!--End: Performance-->
	</div>
</div>
@stop