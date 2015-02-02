<img src="{{profilePic($activity->user->picture)}}" class="activity-item-image">
<div class="activity-item-text">
	<a href="#">{{$activity->user->name}}</a> {{$activity->message}} <a href="{{$activity->targetable->id}}">quiz</a>.
</div>
<span class="activity-item-date timeago" title="{{$activity->created_at->format('c')}}"></span>