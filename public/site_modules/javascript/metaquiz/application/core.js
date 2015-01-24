/**
 * The CORE Javascript file for the Application Part
 * @return {[type]} [description]
 */
 jQuery(document).ready(function($) {
 	$.ajaxSetup({
 		headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
 	});

	//Dropdown Fixes
	jQuery(".dropdown").on("show.bs.dropdown", function() {
		jQuery(this).find(".dropdown-menu").first().stop(!0, !0).slideDown(200);
	});
	jQuery(".dropdown").on("hide.bs.dropdown", function() {
		jQuery(this).find(".dropdown-menu").first().stop(!0, !0).slideUp(200);
	});

	//User Performance Chart
	jQuery('.user-performance-chart').circliful();

	//Tooltips
	jQuery("[data-toggle=tooltip]").tooltip({
		container : "body"
	});


	//Toggle Navigation
	jQuery('.toggle-navigation').click(function() {
		//Pull in the navigation
		jQuery('.nav-main').toggleClass("come-in");
		//Adjust the main content
		//jQuery('.main').toggleClass('no-nav');
		//jQuery('.main').addClass('no-sidebar');
		//Hide the sidebar
		jQuery('.sidebar').removeClass("come-in");
	});

	//Toggle Sidebar
	jQuery('.toggle-sidebar').click(function() {
		//Pull in the sidebar
		jQuery('.sidebar').toggleClass("come-in");
		//Adjust the main content
		//jQuery('.main').toggleClass('no-sidebar');
		//jQuery('.main').addClass('no-nav');
		//Hide the navigation
		jQuery('.nav-main').removeClass("come-in");
	});

	//Timeago
	jQuery(".timeago").timeago();

	//Scrollbars
	jQuery('.widget').perfectScrollbar();
	jQuery('.nav-main').perfectScrollbar();
	//Responsive Fix
	responsiveFix();
	//Height Fix
	heightFix();

	//Window Resize Events
	jQuery(window).resize(function() {
		//Responsive Fix
		responsiveFix();
		//Height Fix
		heightFix();
		//Scrollbar
		jQuery('.widget').perfectScrollbar();
	});

	//Call in the friend selector
	/*jQuery('[data-trigger=challenge-friend]').friendSelector({
		target: '#challenge-friend-input'
	});*/
	jQuery('#challenge-friends-select').select2({
		placeholder: "Select friends to challenge...",
		theme: "default",
		width: "style"

	});

	jQuery('[data-selector=true]').select2({
		placeholder: "Select the chapters...",
		theme: "default",
		width: "style"
	});

});
