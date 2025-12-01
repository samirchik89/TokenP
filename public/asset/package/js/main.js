//==================== Nav Menu ========================//
$(window).scroll(function() {
    if ($(".navbar").offset().top > 150) {
        $(".navbar-fixed-top").addClass("top-nav-collapse");
    } else {
        $(".navbar-fixed-top").removeClass("top-nav-collapse");
    }
});

//==================== Smooth Page Scroll ========================//
//jQuery for page scrolling feature - requires jQuery Easing plugin
$(function() {
    $('.page-scroll a').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });
});

//==================== Intro Text Slider ========================//
// $(document).ready(function() {
//     $('#intro-slider').flexslider({
//         animation: "fade",
//         controlNav: false,
//         DirectionNav: false,
//         slideshowSpeed: 4000,
//         animationSpeed: 600
//     });
// });

//==================== Testimonials Slider ========================//
$(document).ready(function() {
    $('#quote-slider').flexslider({
        animation: "slide",
        controlNav: "thumbnails",
        DirectionNav: "true"
    });
});

//==================== Project Slider ========================//
$(document).ready(function() {
    $('#project-slider').flexslider({
        animation: "slide",
        controlNav: "false",
        DirectionNav: "true"
    });
});

//==================== Animated Facts ========================//
jQuery(document).ready(function($) {
    "use strict";
    $('.facts-content').appear(function() {
        $('#lines').animateNumber({ number: 75 }, 2000);
        $('#lines1').animateNumber({ number: 25 }, 2000);
        $('#lines2').animateNumber({ number: 100 }, 2000);
        $('#lines3').animateNumber({ number: 150 }, 2000);
    }, { accX: 0, accY: -50 });
});

//==================== Portfolio ========================//
$(function() {
    var filterList = {
        init: function() {
            // MixItUp plugin
            // http://mixitup.io
            $('#portfoliolist').mixitup({
                targetSelector: '.portfolio',
                filterSelector: '.filter',
                effects: ['fade'],
                easing: 'snap',
                // call the hover effect
                onMixEnd: filterList.hoverEffect()
            });
        },
        hoverEffect: function() {}
    };
    // Run the show!
    filterList.init();
});

//==================== Parallax ========================//
jQuery(document).ready(function($) {

    $.stellar({
        horizontalOffset: 50
    });

    var links = $('.navigation').find('li');
    slide = $('.slide');
    button = $('.button');
    mywindow = $(window);
    htmlbody = $('html,body');

    function goToByScroll(dataslide) {
        htmlbody.animate({
            scrollTop: $('.slide[data-slide="' + dataslide + '"]').offset().top
        }, 2000, 'easeInOutQuint');
    }

});
$(window).load(function() {
    $('.post-module').hover(function() {
        $(this).find('.description').stop().animate({
            height: "toggle",
            opacity: "toggle"
        }, 300);
    });
});

function copymyFunction() {
    /* Get the text field */
    var copyText = document.getElementById("myInput");

    /* Select the text field */
    copyText.select();

    /* Copy the text inside the text field */
    document.execCommand("copy");

    /* Alert the copied text */
    alert("Copied the text: " + copyText.value);
}

//==================== Match Height ========================//
$(function() {
    $('.equal-height').matchHeight({
        byRow: true,
        property: 'min-height'
    });
});

//==================== Select JS ========================//
// $(document).ready(function() {
//     $('select').niceSelect();
// });

//==================== Slick Slider ========================//
$('.pro-slider').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    infinity: 2,
    arrows: false,
    fade: false,
    speed: 900,
    autoplay: true,
    asNavFor: '.pro-slider-nav'
});
$('.pro-slider-nav').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    asNavFor: '.pro-slider',
    dots: false,
    centerMode: true,
    focusOnSelect: true
});

// Google Map
(function() {
    $("#map").googleMap({
        zoom: 10, // Initial zoom level (optional)
        coords: [48.895651, 2.290569], // Map center (optional)
        type: "ROADMAP" // Map type (optional)
    });
})

// Collapse
function toggleIcon(e) {
    $(e.target)
        .prev('.panel-heading')
        .find(".more-less")
        .toggleClass('glyphicon-plus glyphicon-minus');
}
$('.panel-group').on('hidden.bs.collapse', toggleIcon);
$('.panel-group').on('shown.bs.collapse', toggleIcon);

//
$(".view-collapse").click(function() {
    $(this).toggleClass("active");
});




function resize() {
    if ($(window).width() < 514) {
     $('.overview-menu').addClass('mobile');
    }
    else {$('.overview-menu').removeClass('mobile');}
}

// Overview Menu
$(document).ready( function() {
    $(window).resize(resize);
    resize();
});

$(".overview-menu").click(function(){
  $(".property-nav-tabs").toggleClass("active");
});

$(".property-nav-tabs.nav-tabs li a").click(function(){
  $(".property-nav-tabs").toggleClass("active");
});

// Social Share
$('a.social-share').on('click',function(event){
  event.preventDefault();

  $(this).parent().parent().find('a').not('.social-share').each(function(index){
    if(!$(this).hasClass('show')){
      $(this).addClass('show');
      TweenMax.to($(this), 0.4, {y:((index+1)*50), autoAlpha:1});
    }else{
      TweenMax.staggerTo($(this), 0.2, {y:0, autoAlpha:0}, 0.1, function(){
        $('.share-buttons a').removeClass('show');
      });
    }
  });
});

// Tool tip
 $('.tooltip_sto').tooltipster({
    theme: 'tooltipster-punk'
});

$('.collapse').on('show.bs.collapse', function () {
    $('.collapse.in').each(function(){
        $(this).collapse('hide');
    });
  });
