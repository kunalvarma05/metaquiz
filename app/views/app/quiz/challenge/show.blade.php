@extends('app.partials.layout')
@section('main')
<div class="quiz-challenge-page">
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<div class="brick user-performance-brick">
				<div class="brick-title">
					Players
				</div>
				<div class="brick-body">
					<div class="row activity-feed">
						@foreach($players as $player)
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="activity-item">
								<img src="{{profilePic($player->picture)}}" class="activity-item-image">
								<div class="activity-item-text">
									<a href="#">{{$player->name}}</a>
								</div>
							</div>
						</div>
						@endforeach
						{{--@include('app.quiz.create-challenge')--}}
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<div class="brick user-performance-brick">
				<div class="brick-title">
					Details
				</div>
				<div class="brick-footer">
					<div class="meta">
						<span class="value">{{$status}}</span>
						<span class="field">Status</span>
					</div>
					<div class="meta">
						<span class="value">{{$challenger->name}}</span>
						<span class="field">Challenger</span>
					</div>
					<div class="meta">
						<span class="value">{{$winner}}</span>
						<span class="field">Winner</span>
					</div>
					<div class="meta">
						<span class="value">{{count($players)}}</span>
						<span class="field">Players</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<input type="hidden" id="challenge_id" value="{{{$challenge->id}}}">
@stop