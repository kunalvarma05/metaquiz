/**
 * Name: FriendSelector
 * Description: A Simple to use, no configuration friend selector plugin
 * Author: Kunal Varma
 * @param {Object} $
 */
 (function($) {

	// $ plugin definition
	$.fn.friendSelector = function(params) {

		// merge default and user parameters
		params = $.extend({
			target: '#challenge-friend-input'
		}, params);

		jQuery(this).on('click', function(){
			var element = jQuery(this);
			var target = jQuery(params.target);
			//Get the value of the hidden input
			var value = target.val();
			//Turn it into an array
			var array = value.length > 0 ?  value.split(',') : [];

			console.log('init array:' + array);

			//The ID of the current friend
			var id = element.data('id');

			//If the friend is already selected
			if(element.hasClass('btn-primary')){
				//Find the selected friend and remove him from the array
				console.log('rem array:' + array);
				var index = array.indexOf(id);
				console.log("rem: " + index);
				if (index > -1) {
					array = array.splice(index, 1);
				}
				target.val(array.join(','));
				element.removeClass('btn-primary');
			}else{
				//Let's add the element
				//Some element(s) already exist
				if(array.length > 0){
					array.push(id);
					target.val(array.join(','));
				}
				else{
					target.val(id);
				}
				element.addClass('btn-primary');
			}

		});

		// allow jquery chaining
		return this;
	};

})($);
