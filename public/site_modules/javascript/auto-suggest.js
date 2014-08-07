/**
 * Name: Auto Suggest
 * Description: A Simple to use, no configuration auto-suggest plugin
 * Author: Kunal Varma
 * @param {Object} $
 */
(function($) {

	// $ plugin definition
	$.fn.autoSuggest = function(params) {

		// merge default and user parameters
		params = $.extend({
			//Minimum length of characters required before firing the query
			minLength : 3,
			//The URL Endpoint to post the query to
			urlEndpoint : "",
			//The Target Element to trigger events on query results
			target : ".search-results",
			//The class to be applied to the input element when the query fires
			loadingClass : "loading",
			//The Request Method for the AJAX request
			method : "POST",
			//The type of data that is expected back from the urlEndpoint
			dataType : "json",
			//The Callback to trigger on the completion of the request
			callback : function(element, data) {
				console.log(element + "=>" + data);
			}
		}, params);

		// traverse all nodes
		this.each(function() {
			//Hide the query results on focus out
			$(this).focusout(function() {
				// The current element in the nodes
				var $input = $(this);
				$input.removeClass(params.loadingClass);
			});
			//When a user starts typing
			$(this).keyup(function() {
				// The current element in the nodes
				var $input = $(this);
				//Value of the input
				var $value = $input.val();
				//If the length of characters exceeds the minimum length, fire the query
				if ($value.length >= params.minLength) {
					$input.addClass(params.loadingClass);
					$.ajax({
						type : params.method,
						url : params.urlEndpoint,
						data : {
							query : $value
						}
					}).done(function(data) {
						//Remove the loading class
						$input.removeClass(params.loadingClass);
						//Fire the success callback
						params.callback(params.target, data);
					});
				}
			});
			//Some DIRTY Tricks
			$(params.target).click(function(e) {
				e.stopPropagation();
			});
			$(this).click(function(e) {
				e.stopPropagation();
			});
			$(document).click(function() {
				$(params.target).slideUp(300);
			});
		});

		// allow jquery chaining
		return this;
	};

})($);
