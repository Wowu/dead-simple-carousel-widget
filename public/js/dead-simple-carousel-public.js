(function( $ ) {
	'use strict';

	$.fn.deadSimpleCarousel = function () {
		var self = this;
		var speed = self.data('speed') || 3000;
		var slideCount = self.find('img').length;
		var slideWidth = 0;

		var maxHeight = 0

		function RWD() {
			slideWidth = self.width();

			self.find('img').each(function(index) {
				if (maxHeight < this.height) {
					maxHeight = this.height;
				}
			});

			self.find('.dscw__slides').css('height', maxHeight + 'px');
			self.find('.dscw__slides').css('width', slideCount * slideWidth + 'px');
			self.find('.dscw__slides__image').css('width', slideWidth+'px');
			self.find('.dscw__slides').css('transform', 'translateX(0px)');

		}

		window.onresize = function(event) {
			RWD();
		};

		RWD();

		// Prevent content flickering
		self.find('.dscw__slides').css('opacity', '1');

		var currentSlide = 1;

		var slideInterval = setInterval(function () {
			if (currentSlide == slideCount) {
				currentSlide = 1;
			} else {
				currentSlide++;
			}

			self.find('.dscw__slides').css('transform', 'translateX(' + (-slideWidth * currentSlide + slideWidth) + 'px)');
		}, speed);


		var arrowLeft = self.find('.dscw__arrow--left');
		var arrowRight = self.find('.dscw__arrow--right');

		arrowLeft.click(function(event) {
			if (currentSlide == 1) {
				currentSlide = slideCount;	
			} else {
				currentSlide--;
			}

			self.find('.dscw__slides').css('transform', 'translateX(' + (-slideWidth * currentSlide + slideWidth) + 'px)');
		});

		arrowRight.click(function(event) {
			if (currentSlide == slideCount) {
				currentSlide = 1;
			} else {
				currentSlide++;
			}

			self.find('.dscw__slides').css('transform', 'translateX(' + (-slideWidth * currentSlide + slideWidth) + 'px)');
		});

		return self;
	};

	$(function(){
		$('.dscw').deadSimpleCarousel();
	});
})( jQuery );
