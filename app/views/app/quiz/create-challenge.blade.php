{{Form::open(array('route' => "app.challenges.create", 'class' => "well collapse", 'id' => "challenge-friend-box"))}}
<div class="form-group" id="challenge-friend-box">
	{{Form::label('friends', 'Select Friends to Challenge')}}
	{{Form::select('friends[]', $friend_list, '', array('class' => "form-control", 'multiple' => "true", 'id' => "challenge-friends-select", 'placeholder' => "Select friends you wanna challenge..."))}}
</div>
{{Form::hidden('quiz_id', $quiz->id, array('class' => "hidden"))}}
{{Form::submit('Start Challenge', array('class' => "btn btn-lg btn-success"))}}
{{Form::close()}}