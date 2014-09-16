@extends('app.partials.layout')
@section('main')
<div class="row activity-feed">
	@if(count($friends))
	@foreach ($friends as $friend)
	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
		<div class="activity-item">
			<img src="{{profilePic($friend->picture)}}" class="activity-item-image">
			<div class="activity-item-text">
				<a href="#">{{$friend->name}}</a>
			</div>
			<div class="activity-item-date">
				<a href="#" class="btn btn-default btn-sm" data-trigger="unfriend" data-id="{{$friend->id}}">Friends <span class="glyphicon glyphicon-ok"></span></a>
			</div>
		</div>
	</div>
	@endforeach
	@else
	<div class="alert text-center alert-block">
		<b>
			You don't have any friends!
		</b>
	</div>
	@endif
</div>
@stop