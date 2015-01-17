<div class="nav-main hidden-xs hidden-sm">
	<ul>
		<li>
			<a href="{{url('/')}}" class="logo"><img src="{{url('assets/images/logo.png')}}" alt="MetaQuiz"></a>
		</li>
		<li class="{{HTML::activeState('app.home')}}">
			<a href="{{route('app.home')}}" data-toggle="tooltip" data-placement="right" class="icon-home home-icon" title="Home"></a>
		</li>
		<li class="{{HTML::activeState('app.subjects')}}">
			<a href="{{route('app.subjects')}}" data-toggle="tooltip" data-placement="right" class="icon-grid subject-icon" title="Subjects"></a>
		</li>
		<li>
			<a href="#" data-toggle="tooltip" data-placement="right" class="icon-trophy achievement-icon" title="Achievements"></a>
		</li>
		<li class="{{HTML::activeState('app.friends')}}">
			@if($friend_requests > 0)
				<span class="count">{{$friend_requests}}</span>
			@endif
			<a href="{{route('app.friends')}}" data-toggle="tooltip" data-placement="right" class="icon-users friend-icon" title="Friends"></a>
		</li>
		<li>
			<a href="#" data-toggle="tooltip" data-placement="right" class="icon-calendar history-icon" title="History"></a>
		</li>
		<li>
			<a href="#" data-toggle="tooltip" data-placement="right" class="icon-bar-chart ranking-icon" title="Rankings"></a>
		</li>
		<li>
			<a href="#" data-toggle="tooltip" data-placement="right" class="organization" title="{{Auth::user()->organization->name}}"><img src="{{orgPic(Auth::user()->organization->picture)}}" alt="Picture"></a>
		</li>
	</ul>
</div>