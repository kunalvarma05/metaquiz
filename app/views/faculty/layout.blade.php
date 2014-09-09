<!DOCTYPE html>
<html lang="en">
<head>
	@include('partials.head')
	<?= stylesheet_link_tag('global') ?>
</head>
<body class="{{bodyClass()}} faculty-page">
	<div class="site">
		@include('faculty.navbar')
		@yield('body')
		{{javascript_include_tag('management.js')}}
	</div>
</body>
</html>
