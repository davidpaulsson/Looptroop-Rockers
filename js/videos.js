/**
 * videos.js
 *
 * Handles toggling between Youtube videos in the sidebar.
 */
( function() {
  (function ($) {

    $('.watchvideo').on('click', function(event) {
      event.preventDefault();

      var href = $(this).attr('href'),
          videoid = href.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/),
          $area = $(".widget-area__yt"),
          $iframe = $area.find('iframe'),
          $parent = $iframe.parent(),
          $item = $(this).parent().parent(),
          width = $iframe.width(),
          height = $iframe.height();


      $iframe.remove();
      $area.find('.active').removeClass('active');
      $(this).parent().parent().addClass('active');
      $parent.html('<iframe width="' + width + '" height="' + height + '" src="http://www.youtube.com/embed/' + videoid[1] + '?rel=0" frameborder="0" allowfullscreen ></iframe>');

    });

  }(jQuery));
} )();
