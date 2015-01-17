@extends('app.partials.layout')
@section('main')
@if(count($friends))
<div class="row activity-feed">
	@foreach ($friends as $friend)
	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
		<div class="activity-item">
			<img src="{{profilePic($friend->picture)}}" class="activity-item-image">
			<div class="activity-item-text">
				<a href="#">{{$friend->name}}</a>
			</div>
			<div class="activity-item-buttons">
				<a href="#" class="btn btn-default btn-sm" data-trigger="unfriend" data-id="{{$friend->id}}">Friends <span class="glyphicon glyphicon-ok"></span></a>
			</div>
		</div>
	</div>
	@endforeach
</div>
@else
<div class="alert alert-info text-center alert-block">
	<b>
		You don't have any friends!
	</b>
</div>
@endif
@if(count($friend_requests))
<div class="main-header clearfix">
	<!--Page-Title-->
	<h4 class="page-title"><a href="#" class="glyphicon glyphicon-align-justify text-large toggle-navigation visible-xs visible-sm hidden-lg hidden-md"></a> Friend Requests </h4>
	<!--End: Page-Title-->
</div>
<div class="row activity-feed">
	@foreach ($friend_requests as $friend)
	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
		<div class="activity-item">
			<img src="{{profilePic($friend->picture)}}" class="activity-item-image">
			<div class="activity-item-text">
				<a href="#">{{$friend->name}}</a>
			</div>
			<div class="activity-item-buttons">
				<a href="#" class="btn btn-default btn-sm" data-trigger="unfriend" data-id="{{$friend->id}}">Friends <span class="glyphicon glyphicon-ok"></span></a>
			</div>
		</div>
	</div>
	@endforeach
</div>
@endif
@stop