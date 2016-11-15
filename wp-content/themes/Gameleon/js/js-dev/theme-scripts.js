jQuery(document).ready(function($) {



// Home tabs

$('.tabs .tab-links a').on('click', function(e)  {

  var currentAttrValue = $(this).attr('href');



        // Show/Hide Tabs

        $('.tabs ' + currentAttrValue).fadeIn(400).siblings().hide();



        // Change/remove current tab to active

        $(this).parent('li').addClass('active').siblings().removeClass('active');



        e.preventDefault();

      });



// game progressbar

setTimeout('loadgame(400)', 0);



// Social sidebar tabs

$('.socialtabs .tab-links a').on('click', function(e)  {



  var currentAttrValue = $(this).attr('href');



        // Show/Hide Tabs

        $('.socialtabs ' + currentAttrValue).fadeIn(400).siblings().hide();



        // Change/remove current tab to active

        $(this).parent('li').addClass('active').siblings().removeClass('active');



        e.preventDefault();

      });





// Game tabs

$('#gametabs .tab-links a').on('click', function(e)  {

  var currentAttrValue = $(this).attr('href');



        // Show/Hide Tabs

        $('#gametabs ' + currentAttrValue).fadeIn(400).siblings().hide();



        // Change/remove current tab to active

        $(this).parent('li').addClass('active').siblings().removeClass('active');



        e.preventDefault();

      });





  // Lights On / Off

  $('embed, iframe').allofthelights({

    'is_responsive': false,

    'switch_selector': 'td-switch',

    'callback_turn_off': function() {

      $("h1").addClass('light');

      $("#content-arcade .widget-title, .td-game-ad-space").addClass('light');

    },

    'callback_turn_on': function() {

      $("h1").removeClass('light');

      $("#content-arcade .widget-title, td-game-ad-space").removeClass('light');

    }

  });





// Newsticker

jQuery(".modern-ticker").modernTicker({

  effect: "scroll",

  scrollType: "continuous",

  scrollStart: "inside",

  scrollInterval: 20,

  transitionTime: 500,

  linksEnabled: true,

  pauseOnHover: true,

  autoplay: true

});



// Flexslider

$( '.flexslider' ).flexslider({

  animation: "fade",

  slideshow: true,

  slideshowSpeed: 4000,

  animationSpeed: 600,

  pauseOnHover: true,

  useCSS: false,

  prevText: "",

  nextText: ""

});



// Facebook Like box

(function(d, s, id) {

  var js, fjs = d.getElementsByTagName(s)[0];

  if (d.getElementById(id)) return;

  js = d.createElement(s); js.id = id;

  js.async=true; js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&appId=170983219647466&version=v2.0";

  fjs.parentNode.insertBefore(js, fjs);

}(document, 'script', 'facebook-jssdk'));



// making fitvids to work only on max-width: 767px

$(function() {

  "use strict";

    $(window).resize(function(){

          if(window.matchMedia('(max-width: 767px)')){

              $(".showfitvids").fitVids();

          }

    });

});



// FitVids - Target content div.

$("#homepage-wrap, #widgets, #content").fitVids();



// HTML5 full screen with target content div

var target = $('#full-screen-wrapp')[0]; // Get DOM element from jQuery collection

$('.td-fullscreen').click(function () {

    if (screenfull.enabled) {

        screenfull.toggle(target);

         $('#td-game-wrap').removeClass('showfitvids');

    }

});



// Vertical Ticker

$('#vertical-ticker').totemticker({

  row_height  :   '123px',

  speed       :   500,

  interval    :   5000

});



// Owl Carousel Sidebar

$("#owl-sidebar").owlCarousel({

  slideSpeed        : 300,

  paginationSpeed   : 500,

  autoPlay          : 4000,

  singleItem        :true

});



$("#owl-home").owlCarousel({

  items             : 7,

  slideSpeed        : 300,

  paginationSpeed   : 500,

  autoPlay          : 2000,

  navigation        : false,

  pagination        : false,

  stopOnHover       : true,

  goToFirstSpeed    : 2000

});



$("#owl-home-carousel").owlCarousel({

  items             : 3,

  slideSpeed        : 300,

  paginationSpeed   : 500,

  autoPlay          : 1000,

  navigation        : false,

  pagination        : true,

  navigationText    : ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],

  stopOnHover       : true,

  goToFirstSpeed    : 2000

});



// Sticky menu

$(".td-sticky").sticky({topSpacing:0});





(function($) {

  "use strict";

  /**

   * Copyright 2012, Digital Fusion

   * Licensed under the MIT license.

   * http://teamdf.com/jquery-plugins/license/

   *

   * @author Sam Sehnert

   * @desc A small plugin that checks whether elements are within

   *     the user visible viewport of a web browser.

   *     only accounts for vertical position, not horizontal.

   */



   $.fn.visible = function(partial) {



    var $t            = $(this),

    $w            = $(window),

    viewTop       = $w.scrollTop(),

    viewBottom    = viewTop + $w.height(),

    _top          = $t.offset().top,

    _bottom       = _top + $t.height(),

    compareTop    = partial === true ? _bottom : _top,

    compareBottom = partial === true ? _top : _bottom;



    return ((compareBottom <= viewBottom) && (compareTop >= viewTop));



  };



})(jQuery);



// Fly-in effect

var win = $(window);



var allMods = $(".td-fly-in");



// Already visible modules

allMods.each(function(i, el) {



  if ($(el).visible(true)) {

    $(el).addClass("already-visible");

  }



});



win.scroll(function(event) {



  allMods.each(function(i, el) {



    var el = $(el);



    if (el.visible(true)) {

      el.addClass("td-fly-in-effect");

    } else {

      el.removeClass("td-fly-in already-visible");

    }



  });



});





// Nicescroll for SEO block

$("#td-seo-block").niceScroll( {

  cursorwidth: 15,

  railpadding: {top:0,right:0,left:0,bottom:0},

  cursorborder: 0,

  scrollspeed: 2500,

  background: "#F1F2F7",

  cursorborderradius: 0,

  cursorcolor: "#63676C",

  autohidemode: false,

  cursorfixedheight: 20,

  horizrailenabled: false

});



// Smooth scrollbar functionality

if($('.td-smooth-scrollbar').length){

 $("html").niceScroll( {

  cursorwidth: 13,

  zindex: 99999,

  cursorborder: 0,

  cursorborderradius: 0,

  cursorcolor: "#63676C",

  hidecursordelay: 2000,

  horizrailenabled: false

});

}



// Scrolling to the Top and Bottom: http://tympanus.net/codrops/2010/01/03/scrolling-to-the-top-and-bottom-with-jquery/





$('#scroll_up').fadeIn('slow');

$('#scroll_down').fadeIn('slow');



$(window).bind('scrollstart', function(){

  $('#scroll_up,#scroll_down').stop().animate({'opacity':'1'});

});

$(window).bind('scrollstop', function(){

  $('#scroll_up,#scroll_down').stop().animate({'opacity':'0'});

});



$('#scroll_down').click(

  function (e) {

    $('html, body').animate({scrollTop: $(document).height()}, 800);

  }

  );

$('#scroll_up').click(

  function (e) {

    $('html, body').animate({scrollTop: '0px'}, 800);

  }

  );







// Add a class to all linked images to initialize magnific popup

$('img').parent('.td-content-inner-single a').addClass('td-popup-image');





// Initializing Magnific Popup

$('.post-entry').magnificPopup({

   delegate: '.td-popup-image', // child items selector, by clicking on it popup will open

   type: 'image',

   gallery:{

    enabled:true

  },

  zoom: {

    enabled: true,

    duration: 300,

    opener: function(element) {

      return element.find("img");

    }

  },

});



// qtip2 tooltip

$( 'div[title!=""]' ).qtip({



  position: {

    effect: false,

              my: 'center left',  // Position my top left...

              at: 'center right', // at the bottom right of...

             target: 'mouse', // Track the mouse as the positioning target

             adjust: { x: 60, y: 40 } // Offset it slightly from under the mouse

           }



         });



// Responsive Menu

(function (a) {

  var d = a(".main-nav li.current-menu-item a").html(),

  d = a(".main-nav li.current_page_item a").html();

  if (a("span").hasClass("custom-mobile-menu-title")) d = a("span.custom-mobile-menu-title").html();

  else if ("undefined" == typeof d || null === d) d = a("body").hasClass("home") ? a("#logo span").hasClass("site-name") ? a("#logo .site-name a").html() : a("#logo img").attr("alt") : a("body").hasClass("woocommerce") && a("h1").hasClass("page-title") ? a("h1.page-title").html() : a("body").hasClass("woocommerce") && a("h1").hasClass("entry-title") ?

    a("h1.entry-title").html() : a("body").hasClass("archive") && a("h6").hasClass("title-archive") ? a("h6.title-archive").html() : a("body").hasClass("search-results") && a("h6").hasClass("title-search-results") ? a("h6.title-search-results").html() : a("body").hasClass("page-template-blog-excerpt-php") && a("li").hasClass("current_page_item") ? a("li.current_page_item").text() : a("body").hasClass("page-template-blog-php") && a("li").hasClass("current_page_item") ? a("li.current_page_item").text() : a("h1").hasClass("post-title") ?

  a("h1.post-title").html() : "&nbsp;";

  a(".main-nav").append('<a id="mobile_menu_button"></a>');

  a(".main-nav").prepend('<div id="responsive_current_menu_item">' + d + "</div>");

  a("a#mobile_menu_button, #responsive_current_menu_item").click(function () {

    a(".js .main-nav .menu").slideToggle(function () {

      a(this).is(":visible") ? a("a#mobile_menu_button").addClass("responsive-toggle-open") : (a("a#mobile_menu_button").removeClass("responsive-toggle-open"), a(".js .main-nav .menu").removeAttr("style"))

    })

  })

})(jQuery);



(function (a) {

  a("html").click(function () {

    a("a#mobile_menu_button").hasClass("responsive-toggle-open") && a(".js .main-nav .menu").slideToggle(function () {

      a("a#mobile_menu_button").removeClass("responsive-toggle-open");

      a(".js .main-nav .menu").removeAttr("style")

    })

  })

})(jQuery);



// Stop propagation on click on menu.

$('.main-nav').click(function (event) {

  var pathname = window.location.pathname;

  if (pathname != '/wp-admin/customize.php') {

    event.stopPropagation();

  }

});



});