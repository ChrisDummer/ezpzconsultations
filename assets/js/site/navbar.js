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
    $(".hero").css("padding-top", navHeight + 65); //65px == $block-padding-small
  }
  $(document).ready(function () {
    hasScrolled(); // FIXME: This isn't working on load.
  });
})(jQuery);

// TODO: We need to fix the padding as it is leaving a chasm of space at the moment.
