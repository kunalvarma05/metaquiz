!function(t){t.fn.autoSuggest=function(n){return n=t.extend({minLength:3,urlEndpoint:"",target:".search-results",loadingClass:"loading",method:"POST",dataType:"json",callback:function(t,n){console.log(t+"=>"+n)}},n),this.each(function(){t(this).focusout(function(){var a=t(this);a.removeClass(n.loadingClass)}),t(this).keyup(function(){var a=t(this),o=a.val();o.length>=n.minLength&&(a.addClass(n.loadingClass),t.ajax({type:n.method,url:n.urlEndpoint,data:{query:o}}).done(function(t){a.removeClass(n.loadingClass),n.callback(n.target,t)}))}),t(n.target).click(function(t){t.stopPropagation()}),t(this).click(function(t){t.stopPropagation()}),t(document).click(function(){t(n.target).slideUp(300)})}),this}}($);