<?php
/**
 * Enqueue scripts and styles to theme
 *
 * @package ezpzconsultations
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if (! function_exists('ezpzconsultations_add_favicon') ) {
  // Add favicon to admin areas
  function ezpzconsultations_add_favicon()
  {
    if(function_exists('get_all_custom_field_meta')):
      $field_group_json = 'group_60c219d0bd368.json'; // Replace with the name of your field group JSON.
      $field_group_array = json_decode( file_get_contents( get_stylesheet_directory() . "/assets/acf-json/{$field_group_json}" ), true );
      $theme_options = get_all_custom_field_meta( 'option', $field_group_array );

      if($favicon = wp_get_attachment_image_src( $theme_options['favicon'], 'icon'))
        echo '<link rel="shortcut icon" type="image/png" href="' . $favicon[0] . '" />';
    endif;
  }
}
add_action('login_head', 'ezpzconsultations_add_favicon', 10, 0);
add_action('admin_head', 'ezpzconsultations_add_favicon', 10, 0);
add_action('wp_head', 'ezpzconsultations_add_favicon', 10, 0);

if (! function_exists('ezpzconsultations_scripts') ) {
    /**
     * Enqueue scripts and styles.
     */
    function ezpzconsultations_scripts()
    {
        $theme_version = wp_get_theme()->get('Version'); // Get current version of theme
        $css_version = $theme_version . ':' . filemtime(get_template_directory() . '/style.css'); // Appends time stamp to help with cache busting
        $js_version = $theme_version . ':' . filemtime(get_template_directory() . '/dist/js/site.min.js'); // Appends time stamp to help with cache busting

        // NOTE: Not using Gutenberg in this theme? Then remove these comments
        wp_dequeue_style('wp-block-library');
        wp_dequeue_style('wc-block-style'); // WooCommerce - you can remove this if you don't use Woocommerce

        // Enqueue Stylesheets
        wp_enqueue_style('ezpzconsultations-styles', get_stylesheet_uri(), array(), $css_version);
        wp_style_add_data('ezpzconsultations-styles', 'rtl', 'replace');
        //wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap', null, null, 'all');

        /**
         * Register Scripts but don't enqueue them until they are required.
         */

        wp_register_script(
          'ezpzconsultations-scripts',
          get_template_directory_uri() . '/dist/js/site.min.js',
          array('jquery'),
          $js_version,
          true
        );

      //  wp_register_script(
      //    'example-slider-plugin',
      //    get_template_directory_uri() . '/lib/example-slider-plugin.js',
      //    array(),
      //    $js_version,
      //    true
      //  );

        wp_register_script( 'youtube-api',
          '//www.youtube.com/iframe_api',
          array(),
          date('YW'),
          true
        );

        wp_register_script( 'vimeo-api',
          '//player.vimeo.com/api/player.js',
          array(),
          date('YW'),
          true
        );

        wp_register_script( 'aria-accordion',
          get_template_directory_uri() . '/lib/aria.accordion.min.js',
          array(),
          $js_version,
          true
        );

        wp_register_script(
          'magnific-popup',
          get_template_directory_uri() . '/lib/magnific-popup.min.js',
          array('jquery'),
          $js_version,
          true
        );

        wp_register_script(
          'splide-slider',
          get_template_directory_uri() . '/lib/splide.min.js',
          array(),
          $js_version,
          true
        );

        wp_register_script( 'twentytwenty',
          get_template_directory_uri() . '/lib/twentytwenty.min.js',
          array('jquery'),
          $js_version,
          true
        );

        wp_register_script( 'charts',
          get_template_directory_uri() . '/lib/charts.min.js',
          array(),
          $js_version,
          true
        );

        wp_register_script( 'charts-opts',
          get_template_directory_uri() . '/lib/charts-opts.js',
          array('charts'),
          $js_version,
          true
        );

        wp_register_style( 'favicon',
          'https://use.fontawesome.com/releases/v5.5.0/css/all.css',

        );

        $get_gmaps_api = get_global_option('google_maps_api_key');
        if ($get_gmaps_api) {
          wp_register_script(
            'googlemaps',
            'https://maps.googleapis.com/maps/api/js?key='.$get_gmaps_api.'"',
            null,
            null,
            null
          );
        }

        /**
         * Enqueue Required scripts
         */
        wp_enqueue_script('ezpzconsultations-scripts');
        if (is_singular() && comments_open() && get_option('thread_comments') ) {
            wp_enqueue_script('comment-reply');
        }

        /**
         * Move jQuery to footer to reduce render-blocking
         */
        wp_scripts()->add_data('jquery', 'group', 1);
        wp_scripts()->add_data('jquery-core', 'group', 1);
        wp_scripts()->add_data('jquery-migrate', 'group', 1);
    }
}
add_action('wp_enqueue_scripts', 'ezpzconsultations_scripts');
