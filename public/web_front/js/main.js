jQuery(function ($) {
    'use strict';
	
	// Header Sticky
	$(window).on('scroll',function() {
		if ($(this).scrollTop() > 30){  
			$('.navbar-area').addClass("is-sticky");
		}
		else{
			$('.navbar-area').removeClass("is-sticky");
		}
	});

	// Mean Menu
	jQuery('.mean-menu').meanmenu({
		meanScreenWidth: "1199"
	});
	
	// Others Option For Responsive JS
	$(".others-option-for-responsive .dot-menu").on("click", function(){
		$(".others-option-for-responsive .container .container").toggleClass("active");
	});

	// TweenMax JS
	$('.main-banner-area').mousemove(function(e){
		var wx = $(window).width();
		var wy = $(window).height();
		var x = e.pageX - this.offsetLeft;
		var y = e.pageY - this.offsetTop;
		var newx = x - wx/2;
		var newy = y - wy/2;
		$('.main-banner-content-with-search, .main-banner-image-with-doctor').each(function(){
			var speed = $(this).attr('data-speed');
			if($(this).attr('data-revert')) speed *= -.4;
			TweenMax.to($(this), 1, {x: (1 - newx*speed), y: (1 - newy*speed)});
		});
	});
	$('.main-banner-area-with-man-doctor').mousemove(function(e){
		var wx = $(window).width();
		var wy = $(window).height();
		var x = e.pageX - this.offsetLeft;
		var y = e.pageY - this.offsetTop;
		var newx = x - wx/2;
		var newy = y - wy/2;
		$('.main-banner-with-man-content, .main-banner-image-with-man-doctor').each(function(){
			var speed = $(this).attr('data-speed');
			if($(this).attr('data-revert')) speed *= -.4;
			TweenMax.to($(this), 1, {x: (1 - newx*speed), y: (1 - newy*speed)});
		});
	});
	$('.main-banner-area-wrap').mousemove(function(e){
		var wx = $(window).width();
		var wy = $(window).height();
		var x = e.pageX - this.offsetLeft;
		var y = e.pageY - this.offsetTop;
		var newx = x - wx/2;
		var newy = y - wy/2;
		$('.main-banner-wrap-content, .main-banner-image-wrap, .banner-dot-shape').each(function(){
			var speed = $(this).attr('data-speed');
			if($(this).attr('data-revert')) speed *= -.4;
			TweenMax.to($(this), 1, {x: (1 - newx*speed), y: (1 - newy*speed)});
		});
	});
	$('.home-slides').mousemove(function(e){
		var wx = $(window).width();
		var wy = $(window).height();
		var x = e.pageX - this.offsetLeft;
		var y = e.pageY - this.offsetTop;
		var newx = x - wx/2;
		var newy = y - wy/2;
		$('.main-slides-content').each(function(){
			var speed = $(this).attr('data-speed');
			if($(this).attr('data-revert')) speed *= -.4;
			TweenMax.to($(this), 1, {x: (1 - newx*speed), y: (1 - newy*speed)});
		});
	});
	$('.why-choose-area').mousemove(function(e){
		var wx = $(window).width();
		var wy = $(window).height();
		var x = e.pageX - this.offsetLeft;
		var y = e.pageY - this.offsetTop;
		var newx = x - wx/2;
		var newy = y - wy/2;
		$('.why-choose-shape-1, .why-choose-shape-2').each(function(){
			var speed = $(this).attr('data-speed');
			if($(this).attr('data-revert')) speed *= -.4;
			TweenMax.to($(this), 1, {x: (1 - newx*speed), y: (1 - newy*speed)});
		});
	});
	$('.healthcare-doctor-area').mousemove(function(e){
		var wx = $(window).width();
		var wy = $(window).height();
		var x = e.pageX - this.offsetLeft;
		var y = e.pageY - this.offsetTop;
		var newx = x - wx/2;
		var newy = y - wy/2;
		$('.healthcare-doctor-content, .healthcare-doctor-image').each(function(){
			var speed = $(this).attr('data-speed');
			if($(this).attr('data-revert')) speed *= -.4;
			TweenMax.to($(this), 1, {x: (1 - newx*speed), y: (1 - newy*speed)});
		});
	});
	$('.testimonials-area, .testimonials-area-without-image').mousemove(function(e){
		var wx = $(window).width();
		var wy = $(window).height();
		var x = e.pageX - this.offsetLeft;
		var y = e.pageY - this.offsetTop;
		var newx = x - wx/2;
		var newy = y - wy/2;
		$('.testimonials-shape-1').each(function(){
			var speed = $(this).attr('data-speed');
			if($(this).attr('data-revert')) speed *= -.4;
			TweenMax.to($(this), 1, {x: (1 - newx*speed), y: (1 - newy*speed)});
		});
	});
	$('.blog-area').mousemove(function(e){
		var wx = $(window).width();
		var wy = $(window).height();
		var x = e.pageX - this.offsetLeft;
		var y = e.pageY - this.offsetTop;
		var newx = x - wx/2;
		var newy = y - wy/2;
		$('.blog-shape-1').each(function(){
			var speed = $(this).attr('data-speed');
			if($(this).attr('data-revert')) speed *= -.4;
			TweenMax.to($(this), 1, {x: (1 - newx*speed), y: (1 - newy*speed)});
		});
	});
	$('.appointment-form-area').mousemove(function(e){
		var wx = $(window).width();
		var wy = $(window).height();
		var x = e.pageX - this.offsetLeft;
		var y = e.pageY - this.offsetTop;
		var newx = x - wx/2;
		var newy = y - wy/2;
		$('.appointment-form-wrap, .appointment-form-image').each(function(){
			var speed = $(this).attr('data-speed');
			if($(this).attr('data-revert')) speed *= -.4;
			TweenMax.to($(this), 1, {x: (1 - newx*speed), y: (1 - newy*speed)});
		});
	});
	$('.care-area').mousemove(function(e){
		var wx = $(window).width();
		var wy = $(window).height();
		var x = e.pageX - this.offsetLeft;
		var y = e.pageY - this.offsetTop;
		var newx = x - wx/2;
		var newy = y - wy/2;
		$('.care-content, .care-image, .care-shape').each(function(){
			var speed = $(this).attr('data-speed');
			if($(this).attr('data-revert')) speed *= -.4;
			TweenMax.to($(this), 1, {x: (1 - newx*speed), y: (1 - newy*speed)});
		});
	});
	$('.quality-healthcare-area').mousemove(function(e){
		var wx = $(window).width();
		var wy = $(window).height();
		var x = e.pageX - this.offsetLeft;
		var y = e.pageY - this.offsetTop;
		var newx = x - wx/2;
		var newy = y - wy/2;
		$('.quality-healthcare-content-with-image, .quality-vector-image, .quality-healthcare-image-shape').each(function(){
			var speed = $(this).attr('data-speed');
			if($(this).attr('data-revert')) speed *= -.4;
			TweenMax.to($(this), 1, {x: (1 - newx*speed), y: (1 - newy*speed)});
		});
	});
	$('.services-area-without-color').mousemove(function(e){
		var wx = $(window).width();
		var wy = $(window).height();
		var x = e.pageX - this.offsetLeft;
		var y = e.pageY - this.offsetTop;
		var newx = x - wx/2;
		var newy = y - wy/2;
		$('.services-shape-wrap').each(function(){
			var speed = $(this).attr('data-speed');
			if($(this).attr('data-revert')) speed *= -.4;
			TweenMax.to($(this), 1, {x: (1 - newx*speed), y: (1 - newy*speed)});
		});
	});
	$('.video-area').mousemove(function(e){
		var wx = $(window).width();
		var wy = $(window).height();
		var x = e.pageX - this.offsetLeft;
		var y = e.pageY - this.offsetTop;
		var newx = x - wx/2;
		var newy = y - wy/2;
		$('.video-view-content').each(function(){
			var speed = $(this).attr('data-speed');
			if($(this).attr('data-revert')) speed *= -.4;
			TweenMax.to($(this), 1, {x: (1 - newx*speed), y: (1 - newy*speed)});
		});
	});
	$('.page-banner-area').mousemove(function(e){
		var wx = $(window).width();
		var wy = $(window).height();
		var x = e.pageX - this.offsetLeft;
		var y = e.pageY - this.offsetTop;
		var newx = x - wx/2;
		var newy = y - wy/2;
		$('.page-banner-content, .page-banner-image').each(function(){
			var speed = $(this).attr('data-speed');
			if($(this).attr('data-revert')) speed *= -.4;
			TweenMax.to($(this), 1, {x: (1 - newx*speed), y: (1 - newy*speed)});
		});
	});
	$('.portfolio-details-area').mousemove(function(e){
		var wx = $(window).width();
		var wy = $(window).height();
		var x = e.pageX - this.offsetLeft;
		var y = e.pageY - this.offsetTop;
		var newx = x - wx/2;
		var newy = y - wy/2;
		$('.video-view').each(function(){
			var speed = $(this).attr('data-speed');
			if($(this).attr('data-revert')) speed *= -.4;
			TweenMax.to($(this), 1, {x: (1 - newx*speed), y: (1 - newy*speed)});
		});
	});

	// Home Slides
	$('.home-slides').owlCarousel({
		loop: true,
		nav: true,
		dots: false,
		animateOut: 'fadeOut',
		smartSpeed: 1000,
		autoplayTimeout: 8000,
		autoplayHoverPause: true,
		autoplay: true,
		items: 1,
		navText: [
			"<i class='ri-arrow-left-s-line'></i>",
			"<i class='ri-arrow-right-s-line'></i>"
		],
	});

	// Professional Doctors Slides
	$('.professional-doctors-slides').owlCarousel({
		loop: true,
		nav: false,
		dots: true,
		autoHeight: true,
		smartSpeed: 500,
		margin: 25,
		autoplayHoverPause: true,
		autoplay: true,
		
		responsive: {
			0: {
				items: 1
			},
			768: {
				items: 2
			},
			1200: {
				items: 3
			}
		}
	});

	// Testimonials Slides
	$('.testimonials-slides').owlCarousel({
		loop: true,
		nav: false,
		dots: true,
		autoHeight: true,
		smartSpeed: 500,
		margin: 25,
		autoplayHoverPause: true,
		autoplay: true,
		
		responsive: {
			0: {
				items: 1
			},
			768: {
				items: 2
			},
			1200: {
				items: 2
			}
		}
	});
	$('.testimonials-slides-two').owlCarousel({
		loop: true,
		nav: true,
		dots: false,
		autoHeight: true,
		smartSpeed: 500,
		margin: 25,
		autoplayHoverPause: true,
		autoplay: true,
		navText: [
			"<i class='ri-arrow-left-s-line'></i>",
			"<i class='ri-arrow-right-s-line'></i>"
		],
		responsive: {
			0: {
				items: 1
			},
			768: {
				items: 2
			},
			1200: {
				items: 2
			}
		}
	});

	// Blog Slides
	$('.blog-slides').owlCarousel({
		loop: true,
		nav: false,
		dots: true,
		autoHeight: true,
		smartSpeed: 500,
		margin: 20,
		autoplayHoverPause: true,
		autoplay: true,
		
		responsive: {
			0: {
				items: 1
			},
			768: {
				items: 2
			},
			1200: {
				items: 3
			}
		}
	});
	$('.blog-slides-two').owlCarousel({
		loop: true,
		nav: true,
		dots: false,
		autoHeight: true,
		smartSpeed: 500,
		margin: 20,
		autoplayHoverPause: true,
		autoplay: true,
		navText: [
			"<i class='ri-arrow-left-s-line'></i>",
			"<i class='ri-arrow-right-s-line'></i>"
		],
		responsive: {
			0: {
				items: 1
			},
			768: {
				items: 2
			},
			1200: {
				items: 3
			}
		}
	});

	// Offer Slides
	$('.offer-slides').owlCarousel({
		loop: true,
		nav: true,
		dots: false,
		autoHeight: true,
		smartSpeed: 500,
		margin: 25,
		autoplayHoverPause: true,
		autoplay: true,
		navText: [
			"<i class='ri-arrow-left-s-line'></i>",
			"<i class='ri-arrow-right-s-line'></i>"
		],
		responsive: {
			0: {
				items: 1
			},
			768: {
				items: 2
			},
			1200: {
				items: 4
			}
		}
	});

	// Portfolio Slides
	$('.portfolio-slides').owlCarousel({
		loop: true,
		nav: true,
		dots: false,
		autoHeight: true,
		smartSpeed: 500,
		margin: 20,
		autoplayHoverPause: true,
		autoplay: true,
		navText: [
			"<i class='ri-arrow-left-s-line'></i>",
			"<i class='ri-arrow-right-s-line'></i>"
		],
		responsive: {
			0: {
				items: 1
			},
			768: {
				items: 2
			},
			1200: {
				items: 3
			}
		}
	});

	// Quality Healthcare Slides
	$('.quality-healthcare-slides').owlCarousel({
		loop: true,
		nav: true,
		dots: false,
		autoHeight: true,
		smartSpeed: 500,
		margin: 20,
		autoplayHoverPause: true,
		autoplay: true,
		navText: [
			"<i class='ri-arrow-left-s-line'></i>",
			"<i class='ri-arrow-right-s-line'></i>"
		],
		responsive: {
			0: {
				items: 1
			},
            768: {
                items: 1,
            },
            1200: {
                items: 1,
            },
        }
    });

    // Datepicker
    $('#datepicker').datepicker({
        minDate: 0,
    });

    // Selectize
    $('.doctor-name-filter').selectize({
        create: true,
        sortField: 'text',
    });
    $('.product-filter').selectize({
        create: true,
        sortField: 'text',
    });

	// Odometer JS
	$('.odometer').appear(function(e) {
		var odo = $(".odometer");
		odo.each(function() {
			var countNumber = $(this).attr("data-count");
			$(this).html(countNumber);
		});
	});
	
	// Popup Video
	$('.popup-youtube').magnificPopup({
		disableOn: 320,
		type: 'iframe',
		mainClass: 'mfp-fade',
		removalDelay: 160,
		preloader: false,
		fixedContentPos: false
	});

	// Count Time 
	function makeTimer() {
		var endTime = new Date("September 20, 2025 17:00:00 PDT");			
		var endTime = (Date.parse(endTime)) / 1000;
		var now = new Date();
		var now = (Date.parse(now) / 1000);
		var timeLeft = endTime - now;
		var days = Math.floor(timeLeft / 86400); 
		var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
		var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600 )) / 60);
		var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));
		if (hours < "10") { hours = "0" + hours; }
		if (minutes < "10") { minutes = "0" + minutes; }
		if (seconds < "10") { seconds = "0" + seconds; }
		$("#days").html(days + "<span>Days</span>");
		$("#hours").html(hours + "<span>Hours</span>");
		$("#minutes").html(minutes + "<span>Minutes</span>");
		$("#seconds").html(seconds + "<span>Seconds</span>");
	}
	setInterval(function() { makeTimer(); }, 0);

	// Tabs
	$('.tab ul.tabs').addClass('active').find('> li:eq(0)').addClass('current');
	$('.tab ul.tabs li').on('click', function (g) {
		var tab = $(this).closest('.tab'), 
		index = $(this).closest('li').index();
		tab.find('ul.tabs > li').removeClass('current');
		$(this).closest('li').addClass('current');
		tab.find('.tab_content').find('div.tabs_item').not('div.tabs_item:eq(' + index + ')').slideUp();
		tab.find('.tab_content').find('div.tabs_item:eq(' + index + ')').slideDown();
		g.preventDefault();
	});

	// Subscribe form
	$(".newsletter-form").validator().on("submit", function (event) {
		if (event.isDefaultPrevented()) {
			// handle the invalid form...
			formErrorSub();
			submitMSGSub(false, "Please enter your email correctly.");
		} 
		else {
			// everything looks good!
			event.preventDefault();
		}
	});
	function callbackFunction (resp) {
		if (resp.result === "success") {
			formSuccessSub();
		}
		else {
			formErrorSub();
		}
	}
	function formSuccessSub(){
		$(".newsletter-form")[0].reset();
		submitMSGSub(true, "Thank you for subscribing!");
		setTimeout(function() {
			$("#validator-newsletter").addClass('hide');
		}, 4000)
	}
	function formErrorSub(){
		$(".newsletter-form").addClass("animated shake");
		setTimeout(function() {
			$(".newsletter-form").removeClass("animated shake");
		}, 1000)
	}
	function submitMSGSub(valid, msg){
		if(valid){
			var msgClasses = "validation-success";
		} 
		else {
			var msgClasses = "validation-danger";
		}
		$("#validator-newsletter").removeClass().addClass(msgClasses).text(msg);
	}
	// AJAX MailChimp
	$(".newsletter-form").ajaxChimp({
		url: "https://envytheme.us20.list-manage.com/subscribe/post?u=60e1ffe2e8a68ce1204cd39a5&amp;id=42d6d188d9", // Your url MailChimp
		callback: callbackFunction
	});

	// Input Plus & Minus Number JS
	$('.input-counter').each(function() {
		var spinner = jQuery(this),
		input = spinner.find('input[type="text"]'),
		btnUp = spinner.find('.plus-btn'),
		btnDown = spinner.find('.minus-btn'),
		min = input.attr('min'),
		max = input.attr('max');
		
		btnUp.on('click', function() {
			var oldValue = parseFloat(input.val());
			if (oldValue >= max) {
				var newVal = oldValue;
			} else {
				var newVal = oldValue + 1;
			}
			spinner.find("input").val(newVal);
			spinner.find("input").trigger("change");
		});
		btnDown.on('click', function() {
			var oldValue = parseFloat(input.val());
			if (oldValue <= min) {
				var newVal = oldValue;
			} else {
				var newVal = oldValue - 1;
			}
			spinner.find("input").val(newVal);
			spinner.find("input").trigger("change");
		});
	});

	// AOS JS
	AOS.init();

	// WOW Animation JS
	if($('.wow').length){
		var wow = new WOW({
			mobile: false
		});
		wow.init();
	}

	// Go to Top
	$(window).on('scroll', function(){
		var scrolled = $(window).scrollTop();
		if (scrolled > 600) $('.go-top').addClass('active');
		if (scrolled < 600) $('.go-top').removeClass('active');
	});  
	$('.go-top').on('click', function() {
		$("html, body").animate({ scrollTop: "0" },  500);
	});
	
	// Preloader JS
	jQuery(window).on('load',function(){
		jQuery(".preloader").fadeOut(500);
	});

}(jQuery));
