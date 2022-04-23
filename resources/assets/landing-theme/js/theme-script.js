/* ------------------------------------------------
  Project:   Sassaht - SaaS, Startup & WebApp Prebuilt Template
  Author:    ThemeHt
------------------------------------------------ */
/* ------------------------
    Table of Contents

  1. Predefined Variables
  2. Preloader
  3. FullScreen
  4. Counter
  5. Owl carousel
  6. Testimonial Carousel
  7. Magnific Popup
  8. Scroll to top
  9. Banner Section
  10. Fixed Header
  11. Scrolling Animation
  12. Text Color, Background Color And Image
  13. Contact Form
  14. ProgressBar
  15. Countdown
  16. Wow Animation
  17. HT Window load and functions


------------------------ */

'use strict';

/*------------------------------------
  HT Predefined Variables
--------------------------------------*/
var $window = $(window),
    $document = $(document),
    $body = $('body'),
    $fullScreen = $('.fullscreen-banner') || $('.section-fullscreen'),
    $halfScreen = $('.halfscreen-banner'),
    searchActive = false;

//Check if function exists
$.fn.exists = function () {
    return this.length > 0;
};

/*------------------------------------
  HT PreLoader
--------------------------------------*/
function preloader () {
    $('#ht-preloader').fadeOut();
};

/*------------------------------------
  HT Menu
--------------------------------------*/
function menu () {
    $('.dropdown-menu a.dropdown-toggle').on('click', function (e) {
        if (!$(this).next().hasClass('show')) {
            $(this).
                parents('.dropdown-menu').
                first().
                find('.show').
                removeClass('show');
        }
        var $subMenu = $(this).next('.dropdown-menu');
        $subMenu.toggleClass('show');

        $(this).
            parents('li.nav-item.dropdown.show').
            on('hidden.bs.dropdown', function (e) {
                $('.dropdown-submenu .show').removeClass('show');
            });

        return false;
    });
};

/*------------------------------------
  HT Sidemenu
--------------------------------------*/
function sidemenu () {
    $('#dismiss').on('click', function () {
        $('#sidebar').removeClass('active');
    });
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').addClass('active');
        $('.collapse.in').toggleClass('in');
        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
    });
};

/*------------------------------------
  HT FullScreen
--------------------------------------*/
function fullScreen () {
    if ($fullScreen.exists()) {
        $fullScreen.each(function () {
            var $elem = $(this),
                elemHeight = $window.height();
            if ($window.width() < 768) $elem.css('height', elemHeight / 1);
            else $elem.css('height', elemHeight);
        });
    }
    if ($halfScreen.exists()) {
        $halfScreen.each(function () {
            var $elem = $(this),
                elemHeight = $window.height();
            $elem.css('height', elemHeight / 2);
        });
    }
};

/*------------------------------------
  HT Counter
--------------------------------------*/
function counter () {
    $('.count-number').countTo({
        refreshInterval: 2,
    });
};

/*------------------------------------
  HT Owl Carousel
--------------------------------------*/
function owlcarousel () {
    $('.owl-carousel').each(function () {
        var $carousel = $(this);
        $carousel.owlCarousel({
            items: $carousel.data('items'),
            slideBy: $carousel.data('slideby'),
            center: $carousel.data('center'),
            loop: true,
            margin: $carousel.data('margin'),
            dots: $carousel.data('dots'),
            nav: $carousel.data('nav'),
            autoplay: $carousel.data('autoplay'),
            autoplayTimeout: $carousel.data('autoplay-timeout'),
            navText: [
                '<span class="fas fa-long-arrow-alt-left"><span>',
                '<span class="fas fa-long-arrow-alt-right"></span>'],
            responsive: {
                0: {
                    items: $carousel.data('xs-items') ? $carousel.data(
                        'xs-items') : 1,
                },
                576: { items: $carousel.data('sm-items') },
                768: { items: $carousel.data('md-items') },
                1024: { items: $carousel.data('lg-items') },
                1200: { items: $carousel.data('items') },
            },
        });
    });
};

/*------------------------------------
  HT Testimonial Carousel
--------------------------------------*/
function testimonialcarousel () {
    $('.testimonial-carousel').on('slide.bs.carousel', function (evt) {
        $('.testimonial-carousel .controls li.active').removeClass('active');
        $('.testimonial-carousel .controls li:eq(' +
            $(evt.relatedTarget).index() + ')').addClass('active');
    });
};

/*------------------------------------
  HT Magnific Popup
--------------------------------------*/
function magnificpopup () {
    $('.popup-gallery').magnificPopup({
        delegate: 'a.popup-img',
        type: 'image',
        tLoading: 'Loading image #%curr%...',
        mainClass: 'mfp-img-mobile',
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0, 1], // Will preload 0 - before current, and 1 after the current image
        },
        image: {
            tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
            titleSrc: function (item) {
                return item.el.attr('title') +
                    '<small>by Marsel Van Oosten</small>';
            },
        },
    });
    if ($('.popup-youtube, .popup-vimeo, .popup-gmaps').exists()) {
        $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
            disableOn: 700,
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false,
        });
    }

};

/*------------------------------------
  HT Isotope
--------------------------------------*/
function isotope () {
    // init Isotope
    var $grid = $('.grid').isotope({
        itemSelector: '.grid-item',
        layoutMode: 'fitRows',
    });

    // filter functions
    var filterFns = {
        // show if number is greater than 50
        numberGreaterThan50: function () {
            var number = $(this).find('.number').text();
            return parseInt(number, 10) > 50;
        },
        // show if name ends with -ium
        ium: function () {
            var name = $(this).find('.name').text();
            return name.match(/ium$/);
        },
    };

    // bind filter button click
    $('.portfolio-filter').on('click', 'button', function () {
        var filterValue = $(this).attr('data-filter');
        // use filterFn if matches value
        filterValue = filterFns[filterValue] || filterValue;
        $grid.isotope({ filter: filterValue });
    });

    // change is-checked class on buttons
    $('.portfolio-filter').each(function (i, buttonGroup) {
        var $buttonGroup = $(buttonGroup);
        $buttonGroup.on('click', 'button', function () {
            $buttonGroup.find('.is-checked').removeClass('is-checked');
            $(this).addClass('is-checked');
        });
    });
};

/*------------------------------------
  HT Scroll to top
--------------------------------------*/
function scrolltop () {
    var pxShow = 300,
        goTopButton = $('.scroll-top');
    // Show or hide the button
    if ($(window).scrollTop() >= pxShow) goTopButton.addClass('scroll-visible');
    $(window).on('scroll', function () {
        if ($(window).scrollTop() >= pxShow) {
            if (!goTopButton.hasClass('scroll-visible')) goTopButton.addClass(
                'scroll-visible');
        } else {
            goTopButton.removeClass('scroll-visible');
        }
    });
    $('.smoothscroll').on('click', function (e) {
        $('body,html').animate({
            scrollTop: 0,
        }, 1000);
        return false;
    });
};

/*------------------------------------
 HT Banner Section
--------------------------------------*/
function headerheight () {
    $('.fullscreen-banner .align-center').each(function () {
        var headerHeight = $('.header').height();
        // headerHeight+=15; // maybe add an offset too?
        $(this).css('padding-top', headerHeight + 'px');
    });
};

/*------------------------------------
  HT Fixed Header
--------------------------------------*/
function fxheader () {
    $(window).on('scroll', function () {
        if ($(window).scrollTop() >= 100) {
            $('#header-wrap').addClass('fixed-header');
        } else {
            $('#header-wrap').removeClass('fixed-header');
        }
    });
};

/*------------------------------------
  HT Scrolling Animation
--------------------------------------*/
function scrolling () {
    $('.nav-item a[href*="#"]:not([href="#"])').on('click', function () {
        if (location.pathname.replace(/^\//, '') ==
            this.pathname.replace(/^\//, '') && location.hostname ==
            this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $(
                '[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html, body').animate({
                    scrollTop: (target.offset().top - 54),
                }, 2000, 'easeInOutExpo');
                return false;
            }
        }
    });

    // Closes responsive menu when a scroll trigger link is clicked
    $('.nav-item a[href*="#"]:not([href="#"])').on('click', function () {
        $('.navbar-collapse').collapse('hide');
    });

    // Activate scrollspy to add active class to navbar items on scroll
    $('body').scrollspy({
        target: '.navbar',
        offset: 80,
    });

};

/*------------------------------------------
  HT Text Color, Background Color And Image
---------------------------------------------*/
function databgcolor () {
    $('[data-bg-color]').each(function (index, el) {
        $(el).css('background-color', $(el).data('bg-color'));
    });
    $('[data-text-color]').each(function (index, el) {
        $(el).css('color', $(el).data('text-color'));
    });
    $('[data-bg-img]').each(function () {
        $(this).css('background-image', 'url(' + $(this).data('bg-img') + ')');
    });
};

/*------------------------------------
  HT Contact Form
--------------------------------------*/
function contactform () {
    $('#contact-form').validator();

    // when the form is submitted
    $('#contact-form').on('submit', function (e) {

        // if the validator does not prevent form submit
        if (!e.isDefaultPrevented()) {
            var url = 'php/contact.php';

            // POST values in the background the the script URL
            $.ajax({
                type: 'POST',
                url: url,
                data: $(this).serialize(),
                success: function (data) {
                    // data = JSON object that contact.php returns

                    // we recieve the type of the message: success x danger and apply it to the
                    var messageAlert = 'alert-' + data.type;
                    var messageText = data.message;

                    // let's compose Bootstrap alert box HTML
                    var alertBox = '<div class="alert ' + messageAlert +
                        ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
                        messageText + '</div>';

                    // If we have messageAlert and messageText
                    if (messageAlert && messageText) {
                        // inject the alert to .messages div in our form
                        $('#contact-form').
                            find('.messages').
                            html(alertBox).
                            show().
                            delay(2000).
                            fadeOut('slow');
                        // empty the form
                        $('#contact-form')[0].reset();
                    }
                },
            });
            return false;
        }
    });
};

/*------------------------------------
  HT ProgressBar
--------------------------------------*/
function progressbar () {
    var progressBar = $('.progress');
    if (progressBar.length) {
        progressBar.each(function () {
            var Self = $(this);
            Self.appear(function () {
                var progressValue = Self.data('value');

                Self.find('.progress-bar').animate({
                    width: progressValue + '%',
                }, 1000);
            });
        });
    }
};

/*------------------------------------
  HT Search
--------------------------------------*/
function search () {
    if ($('.search-form').length) {
        var searchForm = $('.search-form');
        var searchInput = $('.search-input');
        var searchButton = $('.search-button');

        searchButton.on('click', function (event) {
            event.stopPropagation();

            if (!searchActive) {
                searchForm.addClass('active');
                searchActive = true;
                searchInput.focus();

                $(document).one('click', function closeForm (e) {
                    if ($(e.target).hasClass('search-input')) {
                        $(document).one('click', closeForm);
                    } else {
                        searchForm.removeClass('active');
                        searchActive = false;
                    }
                });
            } else {
                searchForm.removeClass('active');
                searchActive = false;
            }
        });
    }
};

/*------------------------------------
  HT Countdown
--------------------------------------*/
function countdown () {
    $('.countdown').each(function () {
        var $this = $(this),
            finalDate = $(this).data('countdown');
        $this.countdown(finalDate, function (event) {
            $(this).
                html(event.strftime('<li><span>%-D</span><p>Days</p></li>' +
                    '<li><span>%-H</span><p>Hours</p></li>' +
                    '<li><span>%-M</span><p>Minutes</p></li>' +
                    '<li><span>%S</span><p>Seconds</p></li>'));
        });
    });
};

/*------------------------------------
  HT NiceSelect
--------------------------------------*/
function niceSelect () {
    $('select').niceSelect();
}

/*------------------------------------
  HT particles
--------------------------------------*/

function particles () {
    jQuery('#particles-js').each(function () {
        particlesJS({
            'particles': {
                'number': {
                    'value': 80,
                    'density': {
                        'enable': true,
                        'value_area': 800,
                    },
                },
                'color': {
                    'value': 'random',
                },
                'shape': {
                    'type': 'polygon',

                    'polygon': {
                        'nb_sides': 6,
                    },
                    'image': {
                        'src': 'img/github.svg',
                        'width': 100,
                        'height': 100,
                    },
                },
                'opacity': {
                    'value': 1,
                    'random': !0,
                    'anim': {
                        'enable': false,
                        'speed': 1,
                        'opacity_min': 0.1,
                        'sync': false,
                    },
                },
                'size': {
                    'value': 10,
                    'random': true,
                    'anim': {
                        'enable': false,
                        'speed': 80,
                        'size_min': 0.1,
                        'sync': false,
                    },
                },
            },
            'retina_detect': true,
        });
    });
}

/*------------------------------------
  HT Wow Animation
--------------------------------------*/
function wowanimation () {
    var wow = new WOW({
        boxClass: 'wow',
        animateClass: 'animated',
        offset: 0,
        mobile: false,
        live: true,
    });
    wow.init();
}

/*------------------------------------
  HT Window load and functions
--------------------------------------*/
$(document).ready(function () {
    fullScreen(),
        menu(),
        sidemenu(),
        owlcarousel(),
        testimonialcarousel(),
        counter(),
        magnificpopup(),
        scrolltop(),
        headerheight(),
        fxheader(),
        scrolling(),
        databgcolor(),
        contactform(),
        progressbar(),
        search(),
        countdown(),
        niceSelect(),
        particles();
});

$window.resize(function () {
});

$(window).on('load', function () {
    preloader(),
        isotope(),
        wowanimation();
});

jQuery(document).ready(function () {
    // Define callback
    var myCallbackVivus = function () {};

    // Get HTMLCollection of SVG to animate
    var myElementsVivus = document.getElementsByClassName('icon-vivus');

    // Go across them to create a Vivus instance
    // with each of them
    for (var i = myElementsVivus.length - 1; i >= 0; i--) {
        new Vivus(myElementsVivus[i], { duration: 50, type: 'async' },
            myCallbackVivus);
    }
});

jQuery('#waterdrop').
    raindrops(
        { color: '#7603f3', canvasHeight: 150, density: 0.1, frequency: 20 });
