/**
 * Functions
 */

//Allowing Logging
window.allowLog = true;

//Debugging
function log(data) {
	if (window.allowLog) {
		console.log(data);
	}
}

/**
 * Get Current User Info
 * @param {Object} info
 */
function getCurrentUserInfo(info) {
	switch(info) {
		case 'id' :
			return jQuery('#current_user').val();
			break;
	}
}

//Responsive Fix
function responsiveFix() {
	if (!jQuery('.nav-main').is(":visible")) {
		jQuery('.main').addClass('no-nav');
	} else {
		jQuery('.main').removeClass('no-nav');
	}
	if (!jQuery('.sidebar').is(":visible")) {
		jQuery('.main').addClass('no-sidebar');
	} else {
		jQuery('.main').removeClass('no-sidebar');
	}
}

//Height Fix
function heightFix() {
	var bodyHeight = jQuery(window).height();
	jQuery('.sidebar').height(bodyHeight);
	var sidebarHeight = jQuery('.sidebar').height();
	jQuery('.recent-activity-widget').css("max-height", sidebarHeight / 2 + 20);
	jQuery('.friends-online-widget').css("max-height", sidebarHeight / 2 + 20);
}