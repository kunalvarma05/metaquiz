jQuery(document).ready(function($) {

	/**
	 * Course Toggle
	 * Toggles the courses and their related subjects drawers
	 */
	jQuery('#course-list').find('.topic').on('click', function() {
		//Get the target to toggle
		var target = jQuery(this).data('target');
		//Get the parent to toggle
		var parent = jQuery(this).data('parent');
		if(jQuery(this).hasClass('is_open')){
			//Hide the parent
			jQuery(parent).slideUp(200);
		}else{
		//Show the parent
		jQuery(parent).slideDown(200);
	}
	jQuery(this).toggleClass('is_open');
	jQuery('.topic').not(this).removeClass('is_open');
		//Hide the drawer from the parent that is not the one we are clicking on
		jQuery(parent).find('.drawer').not(target).slideUp(0);
		//Slide Down the drawer that we clicked on
		jQuery(parent).find(target).delay(100).slideToggle(100);
	});


	/**
	 * Subject Toggle
	 * Toggles the subjects and their related sub-drawers
	 */
	jQuery('#subject-list').find('.topic').on('click', function() {
		//Get the target to toggle
		var target = jQuery(this).data('target');
		jQuery('.sub-menu-collapse').not(target).slideUp(100);
		jQuery(target).slideToggle(200);
	});
});