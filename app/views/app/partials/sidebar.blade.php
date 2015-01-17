<!--Recent Activity Widget-->
<div class="widget recent-activity-widget">
	<div class="content">
		<div class="widget-title">
			Users you may know
		</div>
		<div class="widget-body">
			@if(count($suggestions))
			@foreach ($suggestions as $user)
			<div class="widget-item">
				<a href="#" title="{{$user->name}}" data-user-id="{{$user->id}}"> <img src="{{profilePic($user->picture)}}" class="widget-item-image" alt="pic"> <span class="widget-item-text">{{$user->name}}</span></a>
			</div>
			@endforeach
			@endif
		</div>
	</div>
</div>
<!--End: Recent Activity Widget-->