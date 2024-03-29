  /**
   * forEach implementation for Objects/NodeLists/Arrays, automatic type loops and context options
   *
   * @private
   * @author Todd Motto
   * @link https://github.com/toddmotto/foreach
   * @param {Array|Object|NodeList} collection - Collection of items to iterate, could be an Array, Object or NodeList
   * @callback requestCallback      callback   - Callback function for each iteration.
   * @param {Array|Object|NodeList} scope=null - Object/NodeList/Array that forEach is iterating over, to use as the this value when executing callback.
   * @returns {}
   */
    var forEach=function(t,o,r){if("[object Object]"===Object.prototype.toString.call(t))for(var c in t)Object.prototype.hasOwnProperty.call(t,c)&&o.call(r,t[c],c,t);else for(var e=0,l=t.length;l>e;e++)o.call(r,t[e],e,t)};

    var hamburgers = document.querySelectorAll(".hamburger");
    if (hamburgers.length > 0) {
      forEach(hamburgers, function(hamburger) {
        hamburger.addEventListener("click", function() {
          this.classList.toggle("is-active");
        }, false);
      });
    }
;
/**
 * File skip-link-focus-fix.js.
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 */
( function() {
	var isIe = /(trident|msie)/i.test( navigator.userAgent );

	if ( isIe && document.getElementById && window.addEventListener ) {
		window.addEventListener( 'hashchange', function() {
			var id = location.hash.substring( 1 ),
				element;

			if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {
				return;
			}

			element = document.getElementById( id );

			if ( element ) {
				if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
					element.tabIndex = -1;
				}

				element.focus();
			}
		}, false );
	}
}() );
;
// Note: These should match the values set in scss. Currently it is a manual process to keep them in sync
var breakPoints = {
  navBar: 900,
  sm: 600,
  md: 900,
  lg: 1200,
  xl: 1800,
};
;
/**
 * Function to allow the user to change the root font-size to increase legibility.
 */
jQuery('button.font-size').click(function () {
  if ($(this).hasClass('font-size-sm')) {
    $(document.body).removeClass('font-size-md font-size-lg').addClass('font-size-sm');
    $('button.font-size').removeClass('active');
    $(this).addClass('active');
    jfCreateCookie('fontsize', 'sm');
  }
  else if ($(this).hasClass('font-size-md')) {
    $(document.body).removeClass('font-size-sm font-size-lg').addClass('font-size-md');
    $('button.font-size').removeClass('active');
    $(this).addClass('active');
    jfCreateCookie('fontsize', 'md');
  }
  else if ($(this).hasClass('font-size-lg')) {
    $(document.body).removeClass('font-size-sm font-size-md').addClass('font-size-lg');
    $('button.font-size').removeClass('active');
    $(this).addClass('active');
    jfCreateCookie('fontsize', 'lg');
  };
});

/**
 * Function to allow the user to change the contrast mode.
 */
jQuery('button.toggle-contrast').click(function () {
  if ($(this).hasClass('active')) {
    $(document.body).removeClass('dark-ui');
    $(this).removeClass('active');
    jfCreateCookie('ui-mode', 'light');
  }
  else {
    $(document.body).addClass('dark-ui');
    $(this).addClass('active');
    jfCreateCookie('ui-mode', 'dark');
  }
});

/**
 * Check for Accessibility cookies 'fontsize' and 'ui-mode' on document ready. Append appropriate classes to body element
 */
jQuery(document).ready(function ($) {
  var docFontSize = jfReadCookie('fontsize');
  switch (docFontSize) {
    case 'sm':
      $(document.body).removeClass('font-size-md font-size-lg').addClass('font-size-sm');
      $('button.font-size').removeClass('active');
      $('button.font-size-sm').addClass('active');
      break;
    case 'md':
      $(document.body).removeClass('font-size-sm font-size-lg').addClass('font-size-md');
      $('button.font-size').removeClass('active');
      $('button.font-size-md').addClass('active');
      break;
    case 'lg':
      $(document.body).removeClass('font-size-md font-size-md').addClass('font-size-lg');
      $('button.font-size').removeClass('active');
      $('button.font-size-lg').addClass('active');
      break;
    default:
      break;
  };
  var docUiMode = jfReadCookie('ui-mode');
  switch (docUiMode) {
    case 'dark' :
      $(document.body).addClass('dark-ui');
      $('button.toggle-contrast').addClass('active');
      break;
  }
});

;
/**
 * Creates a cookie
 * @param {string} name
 * @param {string} value
 * @param {number} days before expiry (optional)
 */
function jfCreateCookie(name, value, days) {
  var expires;
  if (days) {
    var date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    expires = ";expires="+ date.toUTCString();
  }
  else {
    expires = "";
  }
  // Sets the cookie site-wide with path=/
  document.cookie = name + "=" + encodeURIComponent(value) + expires + ";path=/";
}

/**
 * Reads and returns the value of a cookie
 * @param {string} cookiename
 */
function jfReadCookie(cookiename) {
  var name = cookiename + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}
;
function jfdebug() {
  // Trigger debug mode by applying .jf-debug to document
  var docBody = document.getElementsByTagName('body')[0];
  docBody.classList.toggle('jf-debug');
};
;
/**
 * Send interaction events to Google Analytics
 */
(function ($) {
  if (typeof gtag == "function") {
    // Send mailto: events
    $('a[href^="mailto:"]').click(function () {
      gtag("event", "contact", {
        event_category: "Email Enquiry",
        event_action: "Mailto Click",
        event_label: $(this).attr("href"),
      });
      return true;
    });

    // Send tel: events
    $('a[href^="tel:"]').click(function () {
      gtag("event", "contact", {
        event_category: "Telephone Enquiry",
        event_action: "Tel Link Click",
        event_label: $(this).attr("href"),
      });
      return true;
    });

    // Send *.pdf download events
    $('a[href$=".pdf"]').click(function () {
      gtag("event", "contact", {
        event_category: "PDF Download",
        event_action: "Download",
        event_label: $(this).attr("href"),
      });
      return true;
    });

    // Send external link clicks
    $(
      "a:not([href*='" +
        document.domain +
        "'],[href*='mailto'],[href*='tel'],a[href$='.pdf'])"
    ).click(function (event) {
      // Prevent # and javascript links being sent
      if (
        $(this).attr("href").charAt(0) != "#" &&
        !$(this).attr("href").startsWith("javascript")
      ) {
        gtag("event", "contact", {
          event_category: "External Link",
          event_action: "Link Click",
          event_label: $(this).attr("href"),
        });
        return true;
      }
    });
  }
})(jQuery);
;
/**
 * Lazy Load of BG Images
 * Forked from @link https://web.dev/lazy-loading-images/
 */

function jfLazyLoadBackgroundImage(element) {
  var bgImage = element.getAttribute('data-bg-img');
  element.style.backgroundImage = "url("+bgImage+")";
  element.removeAttribute('data-bg-img');
}
document.addEventListener("DOMContentLoaded", function() {
  var lazyBackgroundElements = [].slice.call(document.querySelectorAll(".has-bg-img"));

  if("IntersectionObserver" in window) {
    let lazyBackgroundObserver = new IntersectionObserver(function(entries, observer) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          jfLazyLoadBackgroundImage(entry.target);
          lazyBackgroundObserver.unobserve(entry.target);
        }
      });
    }, {rootMargin: "0px 0px 300px 0px"}); // Pre-empt by loading 300px early

    lazyBackgroundElements.forEach(function(lazyBackground) {
      lazyBackgroundObserver.observe(lazyBackground);
    });
  }
  else {
    // For browsers that don't support intersection observer, load all images straight away
    lazyBackgroundElements.forEach(function(lazyBackground){
      jfLazyLoadBackgroundImage(lazyBackground);
    });
  }
});
;
jQuery(document).ready(function ($) {
  // Expand and Collapse .navbar-menu when clicking .hamburger
  $(".hamburger").on("click touch", function (e) {
    // Search the parent .navbar for the .navbar-menu and store as a variable
    var navmenu = $(this).parents(".navbar").find(".navbar-menu");
    // Slide the navmenu into view
    $(navmenu).slideToggle();
    // Toggle the state of the aria-expanded attribute for screen readers
    var menuItem = $(e.currentTarget);
    if (menuItem.attr("aria-expanded") === "true") {
      $(this).attr("aria-expanded", "false");
    } else {
      $(this).attr("aria-expanded", "true");
    }
  });

  // If a menu item with children is clicked...
  $(document).on(
    "click",
    'li.has-children > a:not(".clicked"), li.menu-item-has-children > a:not(".clicked")',
    function (e) {
      // ...and the window width is smaller than the breakPoints.navBar
      if ($(window).width() < breakPoints.navBar) {
        // add .clicked class to the anchor element
        $(this).addClass("clicked");
        // prevent the link from firing
        e.preventDefault();
        // add .drop-active class and aria-expanded to parent li
        $(this)
          .parent("li")
          .toggleClass("drop-active")
          .attr("aria-expanded", "true");
      }
    }
  );
});

// NAVBAR SHOW/HIDE ON SCROLL

(function ($) {
  var navbar = $("#masthead"), // id of navbar
    userDidScroll,
    scrollPosition = 0,
    lastKnownScroll = scrollPosition,
    hero = $(".hero");

  // on scroll, let the interval function know the user has scrolled
  $(window).scroll(function (event) {
    userDidScroll = true;
  });

  $(window).resize(function (event) {
    userDidScroll = true;
  });

  setInterval(function () {
    if (userDidScroll) {
      hasScrolled(); // run this function
      userDidScroll = false; // Reset the scroll variable
    }
  }, 250); // Check every 250ms for the scroll event to be true. Prevents this function running every time the user scrolls

  function hasScrolled() {
    var scrollPosition = $(this).scrollTop(), // Store current scroll position
      navHeight = navbar.outerHeight(), // Get height of navbar
      heroHeight = hero.outerHeight();

    if (scrollPosition >= 1 && !navbar.hasClass("visible")) {
      navbar.addClass("visible");
    } else if (
      scrollPosition < 1 &&
      navbar.hasClass("visible") &&
      !$(document.body).hasClass("menu-active")
    ) {
      navbar.removeClass("visible");
    }

    if (
      $(window).width() < breakPoints.navBar &&
      $(".hamburger").attr("aria-expanded") == "true"
    ) {
      // This heavily assumes we only have one .hamburger element on the page. If you have more - this will break
      // Drop down is active -- do nothing
      return;
    } else if (
      lastKnownScroll < scrollPosition &&
      scrollPosition > heroHeight + navHeight
    ) {
      // Scrolling Down
      navbar.css("transform", "translateY(-" + navHeight + "px)");
    } else if (
      lastKnownScroll > scrollPosition &&
      !(scrollPosition <= navHeight)
    ) {
      // Scrolling Up
      navbar.css("transform", "translateY(0px)").addClass("visible");
    } else {
      navbar.css("transform", "translateY(0px)"); // Catch for fast scrollers
    }
    lastKnownScroll = scrollPosition; // Update pos
    $(".hero").css("padding-top", navHeight); //65px == $block-padding-small
  }
  $(document).ready(function () {
    hasScrolled();
  });
})(jQuery);
;
(function($) {

  $('#searchform').submit(function(e) {
    var s = $( this ).find("#s");
          if (!s.val()) {
      e.preventDefault();
      alert("Please enter a search term");
      $('#s').focus();
    }
  });

})( jQuery );
;
function jfGetTimeRemaining(endtime) {
  const total = Date.parse(endtime) - Date.parse(new Date());
  const seconds = Math.floor((total / 1000) % 60);
  const minutes = Math.floor((total / 1000 / 60) % 60);
  const hours = Math.floor((total / (1000 * 60 * 60)) % 24);
  const days = Math.floor(total / (1000 * 60 * 60 * 24));

  return {
    total,
    days,
    hours,
    minutes,
    seconds
  };
}

function jfInitializeClock(id, endtime) {
  const clock = document.getElementById(id);
  const daysSpan = clock.querySelector('.days');
  const hoursSpan = clock.querySelector('.hours');
  const minutesSpan = clock.querySelector('.minutes');
  const secondsSpan = clock.querySelector('.seconds');

  function jfUpdateClock() {
    const t = jfGetTimeRemaining(endtime);

    if (t.total >= 0) {
      daysSpan.innerHTML = ('0' + t.days).slice(-2);
      hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
      minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
      secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);
    }
    if (t.total <= 0) {
      clock.classList.add("complete");
      clearInterval(timeinterval);
    }
  }

  jfUpdateClock();

  const timeinterval = setInterval(jfUpdateClock, 1000);
}
;
(function( $ ) {

/**
 * initMap
 *
 * Renders a Google Map onto the selected jQuery element
 *
 * @date    22/10/19
 * @since   5.8.6
 *
 * @param   jQuery $el The jQuery element.
 * @return  object The map instance.
 */
function initMap( $el ) {

    // Find marker elements within map.
    var $markers = $el.find('.marker');

    // Create generic map.
    var mapArgs = {
        zoom        : $el.data('zoom') || 16,
        styles: [{featureType:"road",elementType:"geometry",stylers:[{lightness:100},{visibility:"simplified"}]},{"featureType":"water","elementType":"geometry","stylers":[{"visibility":"on"},{"color":"#C6E2FF",}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"color":"#C5E3BF"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"color":"#D1D1B8"}]}], // @link https://snazzymaps.com/style/77/clean-cut
        mapTypeId   : google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map( $el[0], mapArgs );

    // Add markers.
    map.markers = [];
    $markers.each(function(){
        initMarker( $(this), map );
    });

    // Center map based on markers.
    centerMap( map );

    // Return map instance.
    return map;
}

/**
 * initMarker
 *
 * Creates a marker for the given jQuery element and map.
 *
 * @date    22/10/19
 * @since   5.8.6
 *
 * @param   jQuery $el The jQuery element.
 * @param   object The map instance.
 * @return  object The marker instance.
 */
function initMarker( $marker, map ) {

    // Get position from marker.
    var lat = $marker.data('lat');
    var lng = $marker.data('lng');
    var latLng = {
        lat: parseFloat( lat ),
        lng: parseFloat( lng )
    };
    var icon = $marker.attr('data-icon');


    // Create marker instance.
    var marker = new google.maps.Marker({
        position : latLng,
        map: map,
        icon: icon
    });

    // Append to reference for later use.
    map.markers.push( marker );

    // If marker contains HTML, add it to an infoWindow.
    if( $marker.html() ){

        // Create info window.
        var infowindow = new google.maps.InfoWindow({
            content: $marker.html()
        });

        // Show info window when marker is clicked.
        google.maps.event.addListener(marker, 'click', function() {
            infowindow.open( map, marker );
        });
    }
}

/**
 * centerMap
 *
 * Centers the map showing all markers in view.
 *
 * @date    22/10/19
 * @since   5.8.6
 *
 * @param   object The map instance.
 * @return  void
 */
function centerMap( map ) {

    // Create map boundaries from all map markers.
    var bounds = new google.maps.LatLngBounds();
    map.markers.forEach(function( marker ){
        bounds.extend({
            lat: marker.position.lat(),
            lng: marker.position.lng()
        });
    });

    // Case: Single marker.
    if( map.markers.length == 1 ){
        map.setCenter( bounds.getCenter() );

    // Case: Multiple markers.
    } else{
        map.fitBounds( bounds );
    }
}

$(document).ready(function(){

    // Render on document ready...
    //$('.google-map').each(function(){
    //   var map = initMap( $(this) );
    //});

    // Use IntersectionObserver to defer loading of maps until nearly in viewport.
    var googleMapElements = [].slice.call(document.querySelectorAll(".google-map"));

    if("IntersectionObserver" in window) {
      let googleMapsObserver = new IntersectionObserver(function(entries, observer) {
        entries.forEach(function(entry) {
          if (entry.isIntersecting) {
            var map = initMap( $(entry.target));
            //console.log('Map initialized');
            googleMapsObserver.unobserve(entry.target);
          }
        });
      }, {rootMargin: "0px 0px 300px 0px"}); // Pre-empt by initializing 300px early

      googleMapElements.forEach(function(lazyInitGoogleMaps) {
        //console.log(lazyInitGoogleMaps);
        googleMapsObserver.observe(lazyInitGoogleMaps);
      });
    }
    else {
      // For browsers that don't support intersection observer, load all images straight away
      googleMapElements.forEach(function(lazyInitGoogleMaps){
        var map = initMap( $(lazyInitGoogleMaps));
      });
    }

});

})(jQuery);
;
(function($) {
  /**
   * For each element with class .count-to, this function looks for the following data attributes:
   * data-count, data-prefix, data-suffix
   * If the element is visible in the viewport, the function will use the data-count attribute to
   * count up to the number, appending the prefix/suffix and adding commas where necessary
   */

  // @link https://stackoverflow.com/questions/49877610/modify-countup-jquery-functions-to-include-commas
  function addCommas(nStr) {
    return nStr.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
  }

  // Only run if IntersectionObserver supported
  if(!!window.IntersectionObserver){
    // @link https://css-tricks.com/a-few-functional-uses-for-intersection-observer-to-know-when-an-element-is-in-view/

  let countUpObserver = new IntersectionObserver(
    (entries, countUpObserver) => {
    entries.forEach(entry => {
      if(entry.isIntersecting){
        countUp(entry.target);
       // countUpObserver.unobserve(entry.target); // Comment in to turn off observing (animate only once)
      }
      });
    }, {rootMargin: "0px 0px -20px 0px"}); // Wait until a slither of the number is visible
    document.querySelectorAll('.count-to').forEach(number => countUpObserver.observe(number));
  }

  function countUp(number) {
      var $this = $(number),
          countTo = $this.attr('data-count'),
          prefix = '', // Defaults
          suffix = '', // Defaults
          countDuration = 3000; // Defaults

      $this.text('0'); // Reset count to 0

      if (number.hasAttribute('data-prefix')) prefix = '<span class="small">'+$this.attr('data-prefix')+'</span>';
      if (number.hasAttribute('data-suffix')) suffix = '<span class="small">'+$this.attr('data-suffix')+'</span>';
      if (number.hasAttribute('data-duration')) countDuration = Number($this.attr('data-duration'));

      $this.removeClass('count-to'); // Prevents event firing in future.

      $({ countNum: $this.text() }).animate(
        {
          countNum: countTo
        },
        {
          duration: countDuration,
          easing: 'linear',
          step: function () {
            $this.html(prefix + addCommas(Math.floor(this.countNum)) + suffix);
          },
          complete: function () {
            $this.html(prefix + addCommas(this.countNum) + suffix);
          }
        });

  };

})( jQuery );
;
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
