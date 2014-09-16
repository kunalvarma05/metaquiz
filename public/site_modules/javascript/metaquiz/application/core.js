/**
 * The CORE Javascript file for the Application Part
 * @return {[type]} [description]
 */
jQuery(document).ready(function() {

	//Dropdown Fixes
	jQuery(".dropdown").on("show.bs.dropdown", function() {
		jQuery(this).find(".dropdown-menu").first().stop(!0, !0).slideDown(200);
	});
	jQuery(".dropdown").on("hide.bs.dropdown", function() {
		jQuery(this).find(".dropdown-menu").first().stop(!0, !0).slideUp(200);
	});

	//Application Search Autosuggest
	jQuery(".app-search").autoSuggest({
		urlEndpoint : "results.json",
		callback : function(e, n) {
			jQuery(".search-results").inject(jQuery("#search-results-template"), n).slideDown(200);
		}
	});

	//User Performance Chart
	jQuery('.user-performance-chart').circliful();

	//Tooltips
	jQuery("[data-toggle=tooltip]").tooltip({
		container : "body"
	});

	//Challenge User Modal
	jQuery('[data-pop="modal"]').click(function() {
		var modal = jQuery(this).data('modal');
		jQuery('#' + modal + "-modal").modal('show');
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
});
