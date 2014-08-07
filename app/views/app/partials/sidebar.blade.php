<!--Recent Activity Widget-->
<div class="widget recent-activity-widget">
	<div class="widget-title">
		Recent Activity
	</div>
	<div class="widget-body">
		@foreach($activities->take(5) as $activity)
		<div class="widget-item">
			<a href="#"> <img src="{{profilePic($activity->user->picture)}}" class="widget-item-image" alt="pic"> <span class="widget-item-text">{{$activity->user->name}} {{$activity->message}} against {{$activity->targetable->name}}</span></a>
		</div>
		@endforeach
	</div>
</div>
<!--End: Recent Activity Widget-->
<!--Friends Online Widget-->
<div class="widget friends-online-widget">
	<div class="content">
		<div class="widget-title">
			Friends Online
		</div>
		<div class="widget-body"></div>
	</div>
</div>
<!--End: Friends Online Widget-->