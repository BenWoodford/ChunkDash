(function ( $ ) {
	$.fn.ignorantHeight = function() {
		return $(this).clone().css('display', 'block').css('visibility', 'visible').css('position', 'absolute').height();
	});
})( jQuery );