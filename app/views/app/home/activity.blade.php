<div class="activity-feed">
	@foreach($activities as $activity)
	<div class="activity-item">
		<img src="{{profilePic($activity->user->picture)}}" class="activity-item-image">
		<div class="activity-item-text">
			<a href="#">{{$activity->user->name}}</a> {{$activity->message}} against <a href="#">{{$activity->targetable->name}}</a>
		</div>
		<span class="activity-item-date timeago" title="{{$activity->created_at->format('c')}}"></span>
	</div>
	@endforeach
</div>