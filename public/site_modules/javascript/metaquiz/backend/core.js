jQuery(document).ready(function($) {
	//Links Menu Toggle
	jQuery('[data-toggle=links-menu]').click(function(){
		//Target
		var target = jQuery(this).data('target');
		jQuery(target).toggleClass('slide-in');
		jQuery(this).toggleClass('active');
	});

	//Main Content Height
	var fullHeight = jQuery(window).height() - (jQuery('.navbar-main').height() + jQuery('.links-menu').height() + jQuery('.sub-header').height());
	jQuery('.full-height').css("min-height", fullHeight);

	jQuery('select').select2({
		placeholder: "Select the chapters...",
		theme: "default",
		width: "style"
	});
});