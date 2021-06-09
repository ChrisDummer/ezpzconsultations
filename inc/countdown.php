<?php
/**
 * Initialize a countdown
 *
 * @package ezpzconsultations
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'ezpzconsultations_countdown_init' ) ) :
  function ezpzconsultations_countdown_init($element_id, $deadline) {
    // FIXME: Countdowns dont seem to work in Safari?
    $output =
      "<script type='text/javascript'>
      const countTo = '$deadline';
      jfInitializeClock('$element_id', countTo);
      </script>";
    $output = str_replace(array("\r", "\n","  "), '', $output)."\n";
    $func = function () use($output) {
      print $output;
    };
    return $func;
  }
endif;
