(function( $ ) {
	'use strict';

	$.fn.deadSimpleCarousel = function () {
		var self = this;
		var speed = self.data('speed') || 3000;
		var slideCount = self.find('img').length;
		var slideWidth = self.width();

		self.find('.dscw__slides').css('width', slideCount * slideWidth + 'px');
		self.find('.dscw__slides__image').css('width', slideWidth+'px');
		self.find('.dscw__slides').css('transform', 'translateX(0px)');

		// Prevent content flickering
		self.find('.dscw__slides').css('opacity', '1');

		var currentSlide = 1;

		var slideInterval = setInterval(function () {
			self.find('.dscw__slides').css('transform', 'translateX(' + (-slideWidth * currentSlide + slideWidth) + 'px)');

			if (currentSlide == slideCount) {
				currentSlide = 1;
			} else {
				currentSlide++;
			}
		}, speed);

		return self;
	};

	$(function(){
		$('.dscw').deadSimpleCarousel();
	});
})( jQuery );
