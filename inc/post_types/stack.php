<?php

/**
 * Register a Custom Post Type for 'Stacks' - more args available at the link
 * @link https://developer.wordpress.org/reference/functions/register_post_type/
 *
 * REMEMBER TO FLUSH PERMALINKS AFTER REGISTERING A CPT!
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


if ( ! function_exists( 'ezpzconsultations_create_stack_cpt' ) ) :

  /**
   * Register a CPT Stack
   */
  function ezpzconsultations_create_stack_cpt() {

    $labels = array(
      'name' => _x( 'Stacks', 'Post Type General Name', 'ezpzconsultations' ),
      'singular_name' => _x( 'Stack', 'Post Type Singular Name', 'ezpzconsultations' ),
      'menu_name' => _x( 'Stacks', 'Admin Menu text', 'ezpzconsultations' ),
      'name_admin_bar' => _x( 'Stack', 'Add New on Toolbar', 'ezpzconsultations' ),
      'archives' => __( 'Stack Archives', 'ezpzconsultations' ),
      'attributes' => __( 'Stack Attributes', 'ezpzconsultations' ),
      'parent_item_colon' => __( 'Parent Stack:', 'ezpzconsultations' ),
      'all_items' => __( 'All Stacks', 'ezpzconsultations' ),
      'add_new_item' => __( 'Add New Stack', 'ezpzconsultations' ),
      'add_new' => __( 'Add New', 'ezpzconsultations' ),
      'new_item' => __( 'New Stack', 'ezpzconsultations' ),
      'edit_item' => __( 'Edit Stack', 'ezpzconsultations' ),
      'update_item' => __( 'Update Stack', 'ezpzconsultations' ),
      'view_item' => __( 'View Stack', 'ezpzconsultations' ),
      'view_items' => __( 'View Stacks', 'ezpzconsultations' ),
      'search_items' => __( 'Search Stack', 'ezpzconsultations' ),
      'not_found' => __( 'Not found', 'ezpzconsultations' ),
      'not_found_in_trash' => __( 'Not found in Trash', 'ezpzconsultations' ),
      'featured_image' => __( 'Featured Image', 'ezpzconsultations' ),
      'set_featured_image' => __( 'Set featured image', 'ezpzconsultations' ),
      'remove_featured_image' => __( 'Remove featured image', 'ezpzconsultations' ),
      'use_featured_image' => __( 'Use as featured image', 'ezpzconsultations' ),
      'insert_into_item' => __( 'Insert into Stack', 'ezpzconsultations' ),
      'uploaded_to_this_item' => __( 'Uploaded to this Stack', 'ezpzconsultations' ),
      'items_list' => __( 'Stacks list', 'ezpzconsultations' ),
      'items_list_navigation' => __( 'Stacks list navigation', 'ezpzconsultations' ),
      'filter_items_list' => __( 'Filter Stacks list', 'ezpzconsultations' ),
    );
    $args = array(
      'label' => __( 'Stack', 'ezpzconsultations' ),
      'description' => __( 'Footer', 'ezpzconsultations' ),
      'labels' => $labels,
      'menu_icon' => 'dashicons-layout',
      'supports' => array(
                    'title',
                    //'editor',
                    //'excerpt',
                    //'thumbnail',
                    //'revisions',
                    //'author',
                    //'comments',
                    //'trackbacks',
                    //'page-attributes',
                    //'post-formats',
                    //'custom-fields'
                  ), // Core feature(s) the post type supports.
      //'taxonomies' => array('stack-tag'), // An array of taxonomy identifiers that will be registered for the post type. Taxonomies can be registered later with register_taxonomy()
      'public' => true, // Controls how the type is visible to authors (show_in_nav_menus, show_ui) and readers (exclude_from_search, publicly_queryable).
      'show_ui' => true, // Whether to generate a default UI for managing this post type in the admin.
      'show_in_menu' => true, // Where to show the post type in the admin menu. show_ui must be true.
      'menu_position' => 20, // The position in the menu order the post type should appear. show_in_menu must be true. Default: null - defaults to below Comments
      'show_in_admin_bar' => true, // Whether to make this post type available in the WordPress admin bar.
      'show_in_nav_menus' => true, // Whether post_type is available for selection in navigation menus.
      'can_export' => true, // Can this post_type be exported.
      'has_archive' => true, // Whether there should be post type archives, or if a string, the archive slug to use. Will generate the proper rewrite rules if $rewrite is enabled.
      'hierarchical' => false, // Whether the post type is hierarchical (e.g. page)
      'exclude_from_search' => false, // Whether to exclude posts with this post type from front end search results. Default is the opposite value of $public.
      'show_in_rest' => false, // Whether to expose this post type in the REST API. Must be true to enable Gutenberg.
      'publicly_queryable' => true, // Whether queries can be performed on the front end for the post type as part of parse_request().
      'capability_type' => 'page', // The string to use to build the read, edit, and delete capabilities.
    );
    register_post_type( 'stack', $args );

  }
endif;

add_action( 'init', 'ezpzconsultations_create_stack_cpt', 0 );
