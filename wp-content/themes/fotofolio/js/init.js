(function($) {
  FotofolioLandscape = {
    init: function() {
      $('.nav').superfish();

      var slider_h = $('.slideshow').css('height');
      $('.slideshow').xfade({
        height:   slider_h,
        effect:   FotofolioLandscape_Settings.sliderEffect,
        speed:    FotofolioLandscape_Settings.sliderSpeed,
        timeout:  FotofolioLandscape_Settings.sliderTimeout,
        onBefore: FotofolioLandscape.beforeSlide
      });

      $('a.full').fancybox({
        autoScale:          FotofolioLandscape_Settings.fancybox_autoScale,
        titleShow:          FotofolioLandscape_Settings.fancybox_titleShow,
        titlePosition:      FotofolioLandscape_Settings.fancybox_titlePosition,
        centerOnScroll:     FotofolioLandscape_Settings.fancybox_centerOnScroll,
        hideOnContentClick: FotofolioLandscape_Settings.fancybox_hideOnContentClick
      });

      if (FotofolioLandscape_Settings.preventRightClick) {
        $(document).bind('contextmenu', function(e) {
          return false;
        });
      }
    },
    beforeSlide: function(curr, last, el_curr, el_last, elements) {
      if ($('h2', el_last).length == 0) return;

      if (last !== null) $('h2', el_last).slideUp('fast');
      $('h2', el_curr).slideDown();
    }
  }
})(jQuery);

jQuery(document).ready(function() { 
    FotofolioLandscape.init();
});
