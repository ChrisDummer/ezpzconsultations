<?php
/**
 * Theme functions and definitions
 * This file simply pulls in partials from /inc
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ezpzconsultations
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if(file_exists( get_template_directory() . '/env.json' )) {
  $vars = file_get_contents(get_template_directory() . '/env.json');
  $vars = json_decode($vars, true);
  foreach ($vars as $key => $value) putenv("$key=$value");
}

if(!function_exists('ezpzconsultations_env')) {
  function ezpzconsultations_env($key, $default = null)
  {
    $value = getenv($key);
    if ($value === false) return $default;
    return $value;
  }
}

if (! defined('DEV_URL') ) define('DEV_URL', ezpzconsultations_env('DEV_URL'));
if (! defined('STAGING_URL') ) define('STAGING_URL', ezpzconsultations_env('STAGING_URL'));
if (! defined('PROD_URL') ) define('PROD_URL', ezpzconsultations_env('PROD_URL'));

$ezpzconsultations_includes = array(
  'inc/tgm-plugin-activation.php',   // Third party script to allow required/recommended plugins
  'inc/plugins.php',                 // Require and recommend plugins for this theme
  'inc/helpers.php',                 // Useful helper functions
	'inc/theme-setup.php',             // Basic theme setup
	'inc/widgets.php',                 // Register widget areas
  'inc/enqueue.php',                 // Register and enqueue scripts and styles.
  'inc/editor.php',                  // Customise editor
  'inc/remove-comments.php',         // Include this to completely remove support for comments
  'inc/template-tags.php',           // Custom template tags for this theme.
  'inc/template-functions.php',      // Functions which enhance the theme by hooking into WordPress.
	'inc/pagination.php',              // Custom pagination for this theme.
  'inc/acf.php',                     // Functions which hook into ACF to add additional functionality to the site.
  'inc/dry.php',                     // Don't repeat yourself! Functions which reduce repetition in the theme code.
  'inc/video-embed.php',             // Functions to help with embedding videos.
	'inc/customizer.php',              // Customizer additions.
  'inc/ajax-loadmore/loadmore.php',  // Uses Wordpress AJAX to lazyload more posts.
  'inc/remote-images.php',           // Uses images from a remote production URL if working in the local dev environment.
  'inc/schema.php',                  // Hook into WP_Footer to print Structured Schema markup
  'inc/modals.php',                  // Initialize and manipulate modals
  'inc/slider.php',                  // Integrate sliders using SplideJS
  'inc/countdown.php',               // Initialize countdowns
  'inc/charts.php',                  // Functions which work with charts.js library
  'inc/compare.php',                 // Functions which work with TwentyTwenty Image Comparison
  'inc/theme_settings.php',                 // Functions for theme settings

  //~~~~~ CUSTOM POST TYPES
  'inc/post_types/post.php',
  'inc/post_types/page.php',
  'inc/post_types/stack.php',
  //~~~~~ USER CAPABILITIES
  //'inc/user_caps/client-admin.php',  // Example for how to restrict user capabilities for a specific role
);

foreach ( $ezpzconsultations_includes as $file ) {
  $filepath = get_template_directory() . '/' . $file;
  if(file_exists($filepath)) require_once $filepath;
}

if ( class_exists( 'woocommerce' ) ) {
  // Only include Woo Support if Woo Installed
  $woo_support = get_template_directory() . '/inc/woocommerce.php';
  if(file_exists($woo_support)) require_once $woo_support;
};

if(!function_exists('ezpzconsultations_fav')) {
  function ezpzconsultations_fav($key, $default = null)
  {
    $field_group_json = 'group_60c219d0bd368.json'; // Replace with the name of your field group JSON.
    $field_group_array = json_decode( file_get_contents( get_stylesheet_directory() . "/assets/acf-json/{$field_group_json}" ), true );
    $theme_options = get_all_custom_field_meta( 'option', $field_group_array );

    ?>
    <link rel="shortcut icon" type="image/jpg" href="<?php echo $theme_options['favicon']; ?>"/>

    <?php
  }
}

if (! function_exists('ezpzconsultations_px_convert') ) {
  // Convert PX to em
  function ezpzconsultations_px_convert(&$px_variable, $um = 'rem'){
    $px_variable = $px_variable /= 16;
    $px_variable = $px_variable . $um;
  }
}



if (! function_exists('ezpzconsultations_add_favicon') ) {
  // Add favicon to admin areas
  function ezpzconsultations_add_favicon()
  {
    $field_group_json = 'group_60c219d0bd368.json'; // Replace with the name of your field group JSON.
    $field_group_array = json_decode( file_get_contents( get_stylesheet_directory() . "/assets/acf-json/{$field_group_json}" ), true );
    $theme_options = get_all_custom_field_meta( 'option', $field_group_array );
    // TODO; IF FWVICON EXISTS - get url of it

    $favicon = wp_get_attachment_image_src( $theme_options['favicon'], $size  = 'Thumbnail');  $favicon[0];
      echo '<link rel="shortcut icon" type="image/png" href="' . $favicon[0] . '" />';

  }
}
add_action('login_head', 'ezpzconsultations_add_favicon');
add_action('admin_head', 'ezpzconsultations_add_favicon');
add_action('wp_head', 'ezpzconsultations_add_favicon');
