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
	<body class="{{bodyClass()}}">
		@yield('content')
		{{javascript_include_tag('jquery.js')}}
		<script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery('body').height(jQuery(window).height());
				jQuery(window).resize(function() {
					jQuery('body').height(jQuery(window).height());
				});
				jQuery('.signup-button').click(function() {
					jQuery(this).addClass('loading');
				});
			});
		</script>
	</body>
</html>
