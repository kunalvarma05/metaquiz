<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>MetaQuiz</title>
		<meta name="description" content="Challenge. Play. Learn.">
		<meta name="author" content="Creation Machine">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" href="/favicon.ico">
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
		<?= stylesheet_link_tag() ?>
	</head>
	<body>
		<!--Site-->
		<div class="site">
			<!--Nav-Main-->
			@include('app.partials.main-navigation')
			<!--End: Nav-Main-->
			<!--Main-->
			<div class="main">
				<!--Main-Header-->
				<div class="main-header clearfix">
					@include('app.partials.main-header')
				</div>
				<!--End: Main-Header-->
				<!--Main-Body-->
				<div class="main-body">
					@yield('main')
				</div>
				<!--End: Main-Body-->
			</div>
			<!--End: Main-->
			<!--Sidebar-->
			<div class="sidebar hidden-xs hidden-sm">
				@include('app.partials.sidebar')
			</div>
			<!--End: Sidebar-->
		</div>
		@if(Session::has('flash-message'))
		<!--Flash Message-->
		<div class="flash-message">
			{{Session::get('flash-message')}}
		</div>
		<!--End: Flash Message-->
		@endif
		<!--End: Site-->
		<!--Modals-->
		@include('app.partials.modals')
		<!--End: Modals-->
		<!--Templates-->
		@include('app.partials.templates')
		<!--End: Template-->
		<!--Scripts-->
		<input type="hidden" id="current_user" value="{{Auth::user()->id}}">		
		<?= javascript_include_tag() ?>
		<!--End: Scripts-->
	</body>
</html>