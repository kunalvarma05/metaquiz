<!DOCTYPE html>
<html lang="en">
<head>
	@include('partials.head')
	<?= stylesheet_link_tag('backend') ?>
</head>
<body class="{{bodyClass()}} backend-page">
	<div class="site">
		@include('backend.partials.navbar')
		@include('backend.partials.links-menu')
		@include('backend.partials.sub-header')
		<div class="main-content full-height">
		@yield('main-content')
		</div>
		@include('backend.partials.footer')
	</div>
	{{javascript_include_tag('backend.js')}}
</body>
</html>
