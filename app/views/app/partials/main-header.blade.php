<!--Page-Title-->
<h4 class="page-title"><a href="#" class="glyphicon glyphicon-align-justify text-large toggle-navigation visible-xs visible-sm hidden-lg hidden-md"></a> {{$pageTitle or "MetaQuiz"}} </h4>
<!--End: Page-Title-->
<!--User-Account-Menu-->
<div class="pull-right">
	<div class="dropdown pull-left">
		<a href="#" class="dropdown-toggle pull-right notifications-count btn {{ count($notifications) ? "btn-danger" : "btn-info"}} btn-lg" data-toggle="dropdown"> <i class="icon-bell icon"></i> <span class="count">{{count($notifications)}}</span></a>
		<ul class="dropdown-menu">
			@if(count($notifications))
			@foreach($notifications as $notification)
			<li>
				<a href="{{route('app.notifications.show', array($notification->id))}}">{{$notification->message}}</a>
			</li>
			@endforeach
			@else
			<li class="dropdown-header">
				No notifications!
			</li>
			@endif
		</ul>
	</div>
	<div class="dropdown pull-left">
		<a href="#" class="dropdown-toggle btn btn-hollow user-account-menu pull-right" data-toggle="dropdown" data-target="#account-dropdown"> <img src="{{profilePic(Auth::user()->picture)}}" alt="User"> <span class="inside">{{substr(Auth::user()->username, 0, 10)}}.. <i class="caret"></i></span> </a>
		<ul class="dropdown-menu">
			<li>
				<a href="#">Profile</a>
			</li>
			<li>
				<a href="{{url('logout')}}">Logout</a>
			</li>
		</ul>
	</div>
	<a href="#" class="glyphicon glyphicon-tasks pull-left toggle-sidebar visible-xs visible-sm hidden-lg hidden-md"></a>
</div>
<!--End: User-Account-Menu-->