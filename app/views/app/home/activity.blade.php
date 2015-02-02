<div class="activity-feed">
	@foreach($activities as $activity)
	<div class="activity-item">
		@if($activity->type === "quiz_win")
			@include('app.partials.activity.quiz_win')
		@elseif($activity->type === "quiz_start")
			@include('app.partials.activity.quiz_start')
		@endif
	</div>
	@endforeach
</div>