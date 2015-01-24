@extends('app.partials.layout')
@section('main')
<div class="quiz-challenge-page">
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<h3 class="text-muted">Challenge Requests</h3>
			<div class="row activity-feed">
				@foreach($challengeRequests as $challengeRequest)
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="activity-item">
						<img src="{{profilePic($challengeRequest->challenge->challenger->picture)}}" class="activity-item-image">
						<div class="activity-item-text">
							<a href="#">{{$challengeRequest->challenge->challenger->name}}</a>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</div>
@stop