<!DOCTYPE html>
<html lang="en">
	<head>
		@include('partials.head')
		<?= stylesheet_link_tag('global') ?>
	</head>
	<body class="{{bodyClass()}} global-page">
		<div class="site">
			@yield('body')
			{{javascript_include_tag('jquery.js')}}
			{{javascript_include_tag('global.js')}}
		</div>
	</body>
</html>
