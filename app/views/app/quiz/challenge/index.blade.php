@extends('app.partials.layout')
@section('main')
<div class="quiz-challenge-page">
	<h3 class="text-muted">Challenge Requests</h3>
	<div class="row">
		@foreach($challengeRequests as $challengeRequest)
		<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
			<div class="media well">
				<div class="pull-left">
					<a href="#">
						<img src="{{profilePic($challengeRequest->challenge->challenger->picture)}}" class="activity-item-image" width="32px">
					</a>
				</div>
				<div class="media-body">
					<h4 class="media-heading">
						Challenger: <a href="#">{{$challengeRequest->challenge->challenger->name}}</a>
					</h4>
					<b>Chapters</b>
					<ul class="nav nav-stacked">
						@foreach($challengeRequest->challenge->referenceQuiz->chapters as $chapter)
						<li>
							{{$chapter->name}}
						</li>
						@endforeach
					</ul>
					<br>
					{{Form::open(array('route' => "app.challenges.accept", 'class' => "pull-left"))}}
					{{Form::submit('Accept', array('class' => 'btn btn-sm btn-success'))}}
					{{Form::hidden('challenge_request_id', $challengeRequest->id)}}
					{{Form::close()}}
					{{Form::open(array('route' => "app.challenges.reject", 'class' => "pull-left"))}}
					{{Form::submit('Reject', array('class' => 'btn btn-sm btn-default'))}}
					{{Form::hidden('challenge_request_id', $challengeRequest->id)}}
					{{Form::close()}}
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div>
@stop