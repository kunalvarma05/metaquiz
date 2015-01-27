@extends('app.partials.layout')
@section('extra-footer')
{{{javascript_include_tag('quiz-result.js')}}}
<script type="text/javascript">
var labels = ['Question 1', 'Question 2', 'Question 3', 'Question 4', 'Question 5'];
var data = {{json_encode($marksandLabels)}};
challengeResultChart(labels, data);
</script>
@stop
@section('main')
<div class="quiz-challenge-page quiz-result-page">
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<div class="brick user-performance-brick">
				<div class="brick-title">
					Points earned per question by all players
				</div>
				<div class="quiz-result-section">
					<canvas class="quiz-challenge-chart block well-sm" height="300px" id="quiz-result-chart"></canvas>
				</div>
			</div>
		</div>
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
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<a href="#addPlayersForm" class="btn btn-lg btn-info btn-block" data-toggle="collapse" data-target="#addPlayersForm">
								<i class="glyphicon glyphicon-plus"></i> Add Players
							</a>
						</div>
					</div>
					<div class="collapse" id="addPlayersForm">
						{{Form::open(array('route' => "app.challenges.addPlayers", 'class' => "well"))}}
						<div class="form-group" id="challenge-friend-box">
							{{Form::label('friends', 'Select Friends to Challenge')}}
							{{Form::select('friends[]', $friend_list, '', array('class' => "form-control", 'multiple' => "true", 'id' => "challenge-friends-select", 'placeholder' => "Select friends you wanna challenge..."))}}
						</div>
						{{Form::hidden('challenge_id', $challenge->id, array('class' => "hidden"))}}
						{{Form::submit('Add Players', array('class' => "btn btn-lg btn-success"))}}
						{{Form::close()}}
					</div>
				</div>
			</div>
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