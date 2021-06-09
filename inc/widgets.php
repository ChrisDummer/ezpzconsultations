<?php
/**
 * Declare widgets
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 * TODO: Remove this file if not required by your theme
 *
 * @package ezpzconsultations
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'ezpzconsultations_widgets_init' ) ) :
  function ezpzconsultations_widgets_init() {
    register_sidebar( array(
      'name'          => esc_html__( 'Sidebar', 'ezpzconsultations' ),
      'id'            => 'default-sidebar',
      'description'   => esc_html__( 'Add your widgets here.', 'ezpzconsultations' ),
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h4 class="widget-title">',
      'after_title'   => '</h4>',
    ) );
  }
endif;
add_action( 'widgets_init', 'ezpzconsultations_widgets_init' );
