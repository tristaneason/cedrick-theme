// @codekit-prepend "../libs/modernizr.js"
// @codekit-prepend "../libs/jquery.bxslider.min.js"
// @codekit-prepend "../libs/fastclick.js"
// @codekit-prepend "../libs/aos.js"
// @codekit-prepend "../libs/jquery.stellar.min.js"
// @codekit-prepend "../libs/barba.min.js"
// @codekit-prepend "../libs/jquery.waypoints.min.js"
// @codekit-prepend "../libs/jquery.easing.min.js"

// DOM Ready
(function($, window, undefined) {
	$(function() {

		// =================================================================
			//Add libraries above and initialize them here.
			//If you are making a new function that needs to be called on ajax page load, initialize it in ajax.js
		// =================================================================


		if ($('html').hasClass('touch')) {
			// Helps mobile/touch devices to "click" faster
			FastClick.attach(document.body);
		}



		// Vertical Align Elements
		var vAlignShow = function() {
			$('.vAlign').fadeIn(50).css('visibility', 'visible'); // fixes the css "hidden" style for the flash before complete page load (.vAlign in _common.scss)
		};
		vAlignShow();
		var vAlignFun = function() {
			(function ($) {
			$.fn.vAlign = function() {
				return this.each(function(){
					var el = $(this).children('.vAlign');
					var ph = $(this).innerHeight();
					var dh = el.height();
					var mh = (ph - dh) / 2;
					el.css('top', mh);
				});
			};
			})(jQuery);
			$('.vAlign').parent().vAlign();
		};
		$(window).load(function() {
			vAlignFun();
		});

		$(window).resize(function() {
			vAlignFun();
		}).resize();

		// Listen for resize changes (mobile orientation change)
		window.addEventListener("resize", function() {
			vAlignFun();
		}, false);



		// AOS - Animate On Scroll
		/* global AOS */
		var aosInit = function() {
			AOS.init({
				disable: 'mobile'
			});
		};
		aosInit();



		// Stellar.js - parallax effects
		var stellarJsInit = function(){
			if ( ! $('html').hasClass('touch') ) {
				$(window).on('scroll', function(){
					$.stellar({
						horizontalScrolling: false,
						responsive: true,
						positionProperty: 'transform',
						hideDistantElements: false
					});
				});
			}
		};
		stellarJsInit();



		// Dynamic bxSliders
		var bxInit = function() {
			var sliderSets = $('.sliderSet');
			function initSliders(targetSlider, numSlides, slideNext, slidePrev) {
				$(targetSlider).bxSlider({
					mode: 'fade',
					nextSelector: slideNext,
					prevSelector: slidePrev,
					nextText: '',
					prevText: '',
					pager: false
				});
			}
			$(sliderSets).each(function() {
				var targetSlider = "#" + $(this).find('.slideshow-container').attr('id');
				var numSlides = $(this).find('.slideshow-container').find('.slideshow-box').length;
				var slideNext = "#" + $(this).find('.nextSlide').attr('id');
				var slidePrev = "#" + $(this).find('.prevSlide').attr('id');

				// Hide arrows if there is only one slide
				var sliderControls = $(this).find('.slider-arrows');
				if ( numSlides <= 1 ) {
					sliderControls.addClass('hidden');
				}

				initSliders(targetSlider, numSlides, slideNext, slidePrev);
			});
		};
		bxInit();



		// Screen Size Calculations
		var vpHeight;
		var screenSizeCalc = function(){
			vpHeight = $(window).height();
			$('.fullVP').css('min-height', vpHeight);
			$('.mediumVP').css('min-height', vpHeight * 0.7);
		};
		screenSizeCalc();


		$(window).resize(function() {
			screenSizeCalc();
		}).resize();



		// Smooth scrolling to anchors
		var smoothScroll = function() {
			$('a[href*=#]:not([href=#])').click(function() {
				if (location.pathname.replace(/^\//,'') === this.pathname.replace(/^\//,'') && location.hostname === this.hostname) {
					var target = $(this.hash);
					target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
					if (target.length) {
						$('html,body').animate({
							scrollTop: target.offset().top
						}, 900, "easeInOutQuart");
						return false;
					}
				}
			});
		};
		setTimeout(function() {
			smoothScroll();
		}, 260);



		//Waypoints.js
		var waypointInit = function() {
			// var stickyHeader = new Waypoint({
			// 	element: document.getElementById('belowHero'),
			// 	handler: function(direction) {
			// 		if (direction === 'down') {
			// 			$(".fixed-nav").removeClass("non-sticky");
			// 		} else {
			// 			$(".fixed-nav").addClass("non-sticky");
			// 		}
			// 	}
			// });
		};
		waypointInit();




		// MAKE SURE TO ADD ANY NEW LIBRARIES TO THIS INIT FUNCTION - - - - - - -
		/* jshint ignore:start */
		var libsInit = function() {
			vAlignShow();
			vAlignFun();
			aosInit();

			$.stellar('destroy');
			setTimeout(function(){
				stellarJsInit();
			}, 200);

			bxInit();
			screenSizeCalc();
			smoothScroll();

			setTimeout(function(){
				Waypoint.refreshAll();
				waypointInit();
			}, 200);

			$(window).resize(function() {
				vAlignFun();
				screenSizeCalc();
			}).resize();

			// Listen for resize changes (mobile orientation change)
			window.addEventListener("resize", function() {
				vAlignFun();
			}, false);
		};
		/* jshint ignore:end */


	});
})(jQuery, window);
