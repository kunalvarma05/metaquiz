/**
 * Name: Injector
 * Description: Compile a template, process it with some data, and then injects a DOM element with the results
 * @param {Object} $
 */
(function($) {
	var compiled = {};
	$.fn.inject = function(data) {
		var template = this.html();
		compiled[template] = Handlebars.compile(template);
		return compiled[template](data);
	};
})(jQuery);
