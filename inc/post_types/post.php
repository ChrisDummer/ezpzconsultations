<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Change "Posts" to "News". Customise as you wish.
add_action( 'init', 'ezpzconsultations_change_post_object_labels', 0 );

/**
 * Remove support for WP Editor if you are using ACF exclusively for content
 */

add_action('init', 'ezpzconsultations_post_type_supports_post');
if (! function_exists('ezpzconsultations_post_type_supports_post') ) :
  function ezpzconsultations_post_type_supports_page() {
    remove_post_type_support( 'post', 'editor' );
    add_post_type_support( 'post', 'excerpt' );
  }
endif;

//if ( ! function_exists( 'ezpzconsultations_change_post_object_labels' ) ) :
//  function ezpzconsultations_change_post_object_labels() {
//      global $wp_post_types;
//      $labels = &$wp_post_types['post']->labels;
//      $labels->singular_name = _x( 'News', 'Post Type Singular Name', 'ezpzconsultations' );
//      $labels->menu_name = _x( 'News', 'Admin Menu text', 'ezpzconsultations' );
//      $labels->name_admin_bar = _x( 'News Article', 'Add New on Toolbar', 'ezpzconsultations' );
//      $labels->archives = __( 'News Archives', 'ezpzconsultations' );
//      $labels->attributes = __( 'News Attributes', 'ezpzconsultations' );
//      $labels->parent_item_colon = __( 'Parent News:', 'ezpzconsultations' );
//      $labels->all_items = __( 'All News', 'ezpzconsultations' );
//      $labels->add_new_item = __( 'Add New Article', 'ezpzconsultations' );
//      $labels->add_new = __( 'Add New', 'ezpzconsultations' );
//      $labels->new_item = __( 'New Article', 'ezpzconsultations' );
//      $labels->edit_item = __( 'Edit Article', 'ezpzconsultations' );
//      $labels->update_item = __( 'Update Article', 'ezpzconsultations' );
//      $labels->view_item = __( 'View Article', 'ezpzconsultations' );
//      $labels->view_items = __( 'View Article', 'ezpzconsultations' );
//      $labels->search_items = __( 'Search News', 'ezpzconsultations' );
//      $labels->not_found = __( 'Not found', 'ezpzconsultations' );
//      $labels->not_found_in_trash = __( 'Not found in Trash', 'ezpzconsultations' );
//      $labels->featured_image = __( 'Featured Image', 'ezpzconsultations' );
//      $labels->set_featured_image = __( 'Set featured image', 'ezpzconsultations' );
//      $labels->remove_featured_image = __( 'Remove featured image', 'ezpzconsultations' );
//      $labels->use_featured_image = __( 'Use as featured image', 'ezpzconsultations' );
//      $labels->insert_into_item = __( 'Insert into Article', 'ezpzconsultations' );
//      $labels->uploaded_to_this_item = __( 'Uploaded to this Article', 'ezpzconsultations' );
//      $labels->items_list = __( 'News list', 'ezpzconsultations' );
//      $labels->items_list_navigation = __( 'News list navigation', 'ezpzconsultations' );
//      $labels->filter_items_list = __( 'Filter News list', 'ezpzconsultations' );
//  }
//endif;

// Change "Posts" icon
//add_filter( 'register_post_type_args', 'ezpzconsultations_change_post_object_args', 20, 2 );

//if ( ! function_exists( 'ezpzconsultations_change_post_object_args' ) ) :
//  function ezpzconsultations_change_post_object_args( $args, $post_type ) {
//    if ( $post_type == 'post' ) {
//        $args['menu_icon'] = 'dashicons-megaphone';
//        $args['menu_position'] = 10;
//    }
//
//    return $args;
//  }
//endif;
