{{Form::open(array('route' => "app.quiz.create-challenge", 'class' => "well collapse", 'id' => "challenge-friend-box"))}}
<div class="form-group" id="challenge-friend-box">
	{{Form::label('friends', 'Select Friends to Challenge')}}
	{{--Form::text('friends', '', array('placeholder' => "Enter your friends...", 'class' => "friend-suggest form-control", 'data-suggest' => "friends"))--}}
	<!-- <div class="row activity-feed">
		@foreach($friends as $friend)
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<div class="activity-item">
				<img src="{{profilePic($friend->picture)}}" class="activity-item-image">
				<div class="activity-item-text">
					<a href="#">{{$friend->name}}</a>
				</div>
				<div class="activity-item-buttons">
					<a href="#" class="btn btn-default btn-sm" data-trigger="challenge-friend" data-id="{{$friend->id}}"><span class="glyphicon glyphicon-plus"></span></a>
				</div>
			</div>
		</div>
		@endforeach
	</div> -->
	{{Form::select('friends[]', $friend_list, '', array('class' => "form-control", 'multiple' => "true", 'id' => "challenge-friends-select", 'placeholder' => "Select friends you wanna challenge..."))}}
</div>
{{--Form::hidden('friends', '', array('class' => "hidden", 'id' => "challenge-friend-input"))--}}
{{Form::hidden('quiz_id', $quiz->id, array('class' => "hidden"))}}
{{Form::submit('Start Challenge', array('class' => "btn btn-lg btn-success"))}}
{{Form::close()}}