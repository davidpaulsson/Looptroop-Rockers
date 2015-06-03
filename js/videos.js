/* global jQuery */

/**
 * videos.js
 *
 * Handles toggling between Youtube videos in the sidebar.
 */

(function ($) {
  'use strict';

  $('.watchvideo').on('click', function (event) {
    event.preventDefault();

    var href = $(this).attr('href'),
      $area = $('.widget-area__yt'),
      $iframe = $area.find('iframe'),
      $parent = $iframe.parent(),
      width = $iframe.width(),
      height = $iframe.height();


    $iframe.remove();
    $area.find('.active').removeClass('active');
    $(this).parent().parent().addClass('active');
    $parent.html('<iframe width="' + width + '" height="' + height + '" src="' + href + '" frameborder="0" allowfullscreen ></iframe>');

  });
}(jQuery));
