/**
 * Function to play youTube embedded video
 */
 function playYouTubeVideo() {
  event.target.playVideo();
}

function playVimeoVideo() {
  event.target.play();
  //vimeoPlayer.play();
}

(function ($) {

  $(document).on('click touch', '.video-wrapper', function () {
    var $wrapper = $(this),
        $button = $wrapper.find('.play'),
        $iframe = $wrapper.find('iframe'),
        iframe = $iframe[0];

    if(!$wrapper.hasClass('has-modal')) {
      $wrapper.addClass('playing'); // Fades out the overlay

      if ($button.hasClass('platform-vimeo')) {
        if (typeof $iframe.attr('src') === 'undefined') {
          $iframe.attr('src', $button.data('src')); // Insert the src from the button's data-attr
          vimeoPlayer = new Vimeo.Player(iframe); // Create Vimeo Player
          vimeoPlayer.on('loaded', playVimeoVideo); // Play when loaded
        } else {
          // If the video already has a src, play it
          vimeoPlayer = new Vimeo.Player(iframe);
          playVimeoVideo();
        }
        vimeoPlayer.play();
      }
      else if ($button.hasClass('platform-youtube')) {
        if (typeof $iframe.attr('src') === 'undefined') {
          $iframe.attr('src', $button.data('src')); // Insert the src from the button's data-attr

          var youTubePlayer = new YT.Player(iframe, {
            // Use the YouTube API to create a new player
            events: {
              "onReady": playYouTubeVideo,
              //"onError": function (e) {
              //  console.log(e);
              //}
            },
          });

          // Fallback if the API doesn't work
          if (typeof youTubePlayer.playVideo === 'undefined') {
            youTubePlayer = $iframe;
            $iframe.attr('src', $iframe.attr('src').replace('autoplay=0', 'autoplay=1'));
          }
        }
        else {
          // If the video already has a src, play it
          var youTubePlayer = new YT.Player(iframe);
          playYouTubeVideo;
        }
      }
  }
  else {
    $button.trigger('click');
  }
  });
})(jQuery);

function playVideoScript(videoWrapper, iFrameObject, buttonObject) {
  var iframeElement = iFrameObject[0];

  videoWrapper.addClass('playing'); // Fades out the overlay

  if (buttonObject.hasClass('platform-vimeo')) {
    if (typeof iFrameObject.attr('src') === 'undefined') {
      iFrameObject.attr('src', buttonObject.data('src')); // Insert the src from the button's data-attr
      var vimeoPlayer = new Vimeo.Player(iframeElement); // Create Vimeo Player
      vimeoPlayer.on('loaded', playVimeoVideo); // Play when loaded
    } else {
      // If the video already has a src, play it
      var vimeoPlayer = new Vimeo.Player(iframeElement);
      playVimeoVideo();
    }
    vimeoPlayer.play();
  }
  else if (buttonObject.hasClass('platform-youtube')) {
    if (typeof iFrameObject.attr('src') === 'undefined') {
      iFrameObject.attr('src', buttonObject.data('src')); // Insert the src from the button's data-attr

      var youTubePlayer = new YT.Player(iframeElement, {
        // Use the YouTube API to create a new player
        events: {
          "onReady": playYouTubeVideo,
          //"onError": function (e) {
          //  console.log(e);
          //}
        },
      });

      // Fallback if the API doesn't work
      if (typeof youTubePlayer.playVideo === 'undefined') {
        youTubePlayer = iFrameObject;
        iFrameObject.attr('src', iFrameObject.attr('src').replace('autoplay=0', 'autoplay=1'));
      }
    }
    else {
      // If the video already has a src, play it
      var youTubePlayer = new YT.Player(iframeElement);
      playYouTubeVideo;
    }
}
}

function stopVideo(videoContainer) {
  // When a modal with class modal__video is closed, stop autoplay
  var iframe = videoContainer.find('iframe'),
      src = iframe.prop("src");
      src = src.replace("&autoplay=1", "");
      iframe.prop("src",src);
};
