<?php
/**
 * Theme Customizer
 *
 * @package ezpzconsultations
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'ezpzconsultations_customize_register' ) ) {
  /**
   * Add postMessage support for site title and description for the Theme Customizer.
   *
   * @param WP_Customize_Manager $wp_customize Theme Customizer object.
   */
  function ezpzconsultations_customize_register( $wp_customize ) {
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->remove_control('site_icon'); // Remove site icon from customizer as we do this with favicon instead
    $wp_customize->remove_control( 'custom_css' ); // Removes Custom CSS as this should not be editable by the client
    if ( isset( $wp_customize->selective_refresh ) ) {
      $wp_customize->selective_refresh->add_partial(
        'blogname',
        array(
          'selector'        => '.site-title a',
          'render_callback' => 'ezpzconsultations_customize_partial_blogname',
        )
      );
      $wp_customize->selective_refresh->add_partial(
        'blogdescription',
        array(
          'selector'        => '.site-description',
          'render_callback' => 'ezpzconsultations_customize_partial_blogdescription',
        )
      );
    }
  }
}
add_action( 'customize_register', 'ezpzconsultations_customize_register' );

if ( ! function_exists( 'ezpzconsultations_customize_partial_blogname' ) ) {
  /**
   * Render the site title for the selective refresh partial.
   *
   * @return void
   */
  function ezpzconsultations_customize_partial_blogname() {
    bloginfo( 'name' );
  }
}

if ( ! function_exists( 'ezpzconsultations_customize_partial_blogdescription' ) ) {
  /**
   * Render the site tagline for the selective refresh partial.
   *
   * @return void
   */
  function ezpzconsultations_customize_partial_blogdescription() {
    bloginfo( 'description' );
  }
}

if ( ! function_exists( 'ezpzconsultations_customize_preview_js' ) ) {
  /**
   * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
   */
  function ezpzconsultations_customize_preview_js() {
    wp_enqueue_script( 'ezpzconsultations-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
  }
}
add_action( 'customize_preview_init', 'ezpzconsultations_customize_preview_js' );
