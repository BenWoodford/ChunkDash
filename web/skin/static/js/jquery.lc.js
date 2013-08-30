(function ( $ ) {
	$.fn.ignorantHeight = function() {
		var clone = $(this).clone();
		$(clone).css('display', 'block').css('visibility', 'visible').css('position', 'absolute');
		$(clone).children().css('display', 'block').css('visibility', 'visible').css('position', 'absolute');
		return $(clone).height();
	};
})( jQuery );