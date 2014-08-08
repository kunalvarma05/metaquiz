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
		<?= stylesheet_link_tag('management') ?>
	</head>
	<body>
		<div class="site">
			<!--Main Navbar-->
			@include('management.partials.navbar')
			<!--End: Main Navbar-->
			@yield('body')
			@if(Session::has('flash-message'))
			<!--Flash Message-->
			<div class="flash-message">
				{{Session::get('flash-message')}}
			</div>
			<!--End: Flash Message-->
			@endif
		</div>
		<!--Scripts-->
		<?= javascript_include_tag('jquery') ?>
		<?= javascript_include_tag('bootstrap') ?>
		<?= javascript_include_tag('management') ?>
		<!--End: Scripts-->
	</body>
</html>