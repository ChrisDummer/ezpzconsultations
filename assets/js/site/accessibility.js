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

