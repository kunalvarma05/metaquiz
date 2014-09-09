jQuery(document).ready(function() {

	/**
	 * Check Password Strength
	 *
	 * @param Object element
	 */
	 function checkStrength(element) {
	 	var element = jQuery(element);
	 	var progress = jQuery(element.data('progress-box'));
	 	var progressBar = progress.find('.strength-bar');
		//set the width
		function set(width) {
			var total = progress.width();
			return total * width / 100;
		}

		//Must contain 5 characters or more
		var WeakPass = /(?=.{5,}).*/;
		//Must contain lower case letters and at least one digit.
		var MediumPass = /^(?=\S*?[a-z])(?=\S*?[0-9])\S{5,}$/;
		//Must contain at least one upper case letter, one lower case letter and one digit.
		var StrongPass = /^(?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9])\S{5,}$/;
		//Must contain at least one upper case letter, one lower case letter and one digit.
		var VryStrongPass = /^(?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9])(?=\S*?[^\w\*])\S{5,}$/;

		element.focus(function() {
			progress.addClass('show');
		}).blur(function() {
			progress.removeClass('show');
		}).keyup(function() {
			//initial strength
			var password = element.val();
			if (password.length == 0) {
				progressBar.removeClass('progress-bar-danger progress-bar-warning progress-bar-success').addClass('progress-bar-danger').css('width', set(0));
			} else {
				//if the password length is less than 5, return message.
				if (password.length < 5) {
					progressBar.removeClass('progress-bar-danger progress-bar-warning progress-bar-success').addClass('progress-bar-danger').css('width', set(5));
				}

				if (VryStrongPass.test(password)) {
					progressBar.removeClass('progress-bar-danger progress-bar-warning progress-bar-success').addClass('progress-bar-success').css('width', set(100));
				} else if (StrongPass.test(password)) {
					progressBar.removeClass('progress-bar-danger progress-bar-warning progress-bar-success').addClass('progress-bar-success').css('width', set(80));
				} else if (MediumPass.test(password)) {
					progressBar.removeClass('progress-bar-danger progress-bar-warning progress-bar-success').addClass('progress-bar-success').css('width', set(60));
				} else if (WeakPass.test(password)) {
					progressBar.removeClass('progress-bar-danger progress-bar-warning progress-bar-success').addClass('progress-bar-danger').css('width', set(25));
				} else {
					progressBar.removeClass('progress-bar-danger progress-bar-warning progress-bar-success').addClass('progress-bar-danger').css('width', set(15));
				}
			}
		});
}

	//Height Fix
	jQuery('body').height(jQuery(window).height());
	jQuery(window).resize(function() {
		jQuery('body').height(jQuery(window).height());
	});
	//Loading button
	jQuery('.btn-loading').click(function() {
		jQuery(this).addClass('loading');
	});		
	//Check Strength
	checkStrength('[type=password]');
});
