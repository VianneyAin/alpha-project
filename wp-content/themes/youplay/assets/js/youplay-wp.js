!function( $ ) {
  var $window = $(window);

  // fix for full height banners
  var $banners = $('.youplay-banner.full');

  function resizeBanners() {
    $banners.css('height', $window.height());
  }
  resizeBanners();
  $window.on('resize', resizeBanners);

  // fix widgets area select bars
  $('.side-block select').each(function() {
    $(this).wrap('<div class="youplay-select">');
  });
  // fix widget area rss
  $('.widget_rss cite, .widget_rss .rss-date').addClass('date');

}( jQuery );