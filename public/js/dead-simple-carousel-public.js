(function( $ ) {
	'use strict';

	$.fn.deadSimpleCarousel = function () {
		var self = this;
		var speed = self.data("speed") || '3000';
		var slideCount = self.find('img').length;
		var slideWidth = self.width();

		// Prevent content flickering
		self.find('.dscw__slides').css('opacity', '1');

		self.find('.dscw__slides').css('width', slideCount * slideWidth + 'px');
		self.find('.dscw__slides__image').css('width', slideWidth+'px');

		var currentSlide = 1;

		var slideInterval = setInterval(function () {
			self.find('.dscw__slides').css('transform', 'translateX(' + -slideWidth * currentSlide + 'px)');

			if (currentSlide < slideCount - 1) {
				currentSlide++;
			} else {
				currentSlide = 1;
			}
		}, speed);

		return self;
	};

	$(function(){
		$('.dscw').deadSimpleCarousel();
	});
})( jQuery );
