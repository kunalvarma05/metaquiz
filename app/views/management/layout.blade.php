<!DOCTYPE html>
<html lang="en">
<head>
	@include('partials.head')
	<?= stylesheet_link_tag('global') ?>
</head>
<body class="{{bodyClass()}} management-page">
	<div class="site">
		@include('management.navbar')
		@yield('body')		
		{{javascript_include_tag('management.js')}}
	</div>
</body>
</html>
