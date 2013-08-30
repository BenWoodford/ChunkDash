(function ( $ ) {
	$.fn.ignorantHeight = function() {
		var ret $(this).css('display', 'block').css('visibility', 'visible').css('position', 'absolute').height();
		$(this).css('display', '').css('visibility', '').css('position', '');
		return ret;
	};
})( jQuery );