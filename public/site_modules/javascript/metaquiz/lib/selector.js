/**
 * Name: Selector
 * Description: A Simple to use, no configuration multiselect plugin
 * Author: Kunal Varma
 * @param {Object} $
 */
 (function($) {

	// $ plugin definition
	$.fn.mqSelector = function(params) {

		// merge default and user parameters
		params = $.extend({}, params);

		// traverse all nodes
		this.each(function() {
			$.map($(this).find('option'), function(e){
				return $(e).text();
			});
		});

		// allow jquery chaining
		return this;
	};

})($);
