<?php

/**
 * Register a Custom Post Type for 'Campaigns' - more args available at the link
 * @link https://developer.wordpress.org/reference/functions/register_post_type/
 *
 * REMEMBER TO FLUSH PERMALINKS AFTER REGISTERING A CPT!
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'ezpzconsultations_create_campaign_cpt' ) ) :

  /**
   * Register a CPT Campaign
   */
  function ezpzconsultations_create_campaign_cpt() {

    $labels = array(
      'name' => _x( 'Campaigns', 'Post Type General Name', 'ezpzconsultations' ),
      'singular_name' => _x( 'Campaign', 'Post Type Singular Name', 'ezpzconsultations' ),
      'menu_name' => _x( 'Campaigns', 'Admin Menu text', 'ezpzconsultations' ),
      'name_admin_bar' => _x( 'Campaign', 'Add New on Toolbar', 'ezpzconsultations' ),
      'archives' => __( 'Campaign Archives', 'ezpzconsultations' ),
      'attributes' => __( 'Campaign Attributes', 'ezpzconsultations' ),
      'parent_item_colon' => __( 'Parent Campaign:', 'ezpzconsultations' ),
      'all_items' => __( 'All Campaigns', 'ezpzconsultations' ),
      'add_new_item' => __( 'Add New Campaign', 'ezpzconsultations' ),
      'add_new' => __( 'Add New', 'ezpzconsultations' ),
      'new_item' => __( 'New Campaign', 'ezpzconsultations' ),
      'edit_item' => __( 'Edit Campaign', 'ezpzconsultations' ),
      'update_item' => __( 'Update Campaign', 'ezpzconsultations' ),
      'view_item' => __( 'View Campaign', 'ezpzconsultations' ),
      'view_items' => __( 'View Campaigns', 'ezpzconsultations' ),
      'search_items' => __( 'Search Campaign', 'ezpzconsultations' ),
      'not_found' => __( 'Not found', 'ezpzconsultations' ),
      'not_found_in_trash' => __( 'Not found in Trash', 'ezpzconsultations' ),
      'featured_image' => __( 'Featured Image', 'ezpzconsultations' ),
      'set_featured_image' => __( 'Set featured image', 'ezpzconsultations' ),
      'remove_featured_image' => __( 'Remove featured image', 'ezpzconsultations' ),
      'use_featured_image' => __( 'Use as featured image', 'ezpzconsultations' ),
      'insert_into_item' => __( 'Insert into Campaign', 'ezpzconsultations' ),
      'uploaded_to_this_item' => __( 'Uploaded to this Campaign', 'ezpzconsultations' ),
      'items_list' => __( 'Campaigns list', 'ezpzconsultations' ),
      'items_list_navigation' => __( 'Campaigns list navigation', 'ezpzconsultations' ),
      'filter_items_list' => __( 'Filter Campaigns list', 'ezpzconsultations' ),
    );
    $args = array(
      'label' => __( 'Campaign', 'ezpzconsultations' ),
      'description' => __( 'This is an example file which can be edited or duplicated to quickly create a CPT. Do not forget to include it in functions.php', 'ezpzconsultations' ),
      'labels' => $labels,
      'menu_icon' => 'dashicons-heart',
      'supports' => array(
                    'title',
                    'editor',
                    'excerpt',
                    'thumbnail',
                    'revisions',
                    'author',
                    //'comments',
                    //'trackbacks',
                    //'page-attributes',
                    //'post-formats',
                    //'custom-fields'
                  ), // Core feature(s) the post type supports.
      'taxonomies' => array('campaign-tag'), // An array of taxonomy identifiers that will be registered for the post type. Taxonomies can be registered later with register_taxonomy()
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
      'show_in_rest' => true, // Whether to expose this post type in the REST API. Must be true to enable Gutenberg.
      'publicly_queryable' => true, // Whether queries can be performed on the front end for the post type as part of parse_request().
      'capability_type' => 'page', // The string to use to build the read, edit, and delete capabilities.
    );
    register_post_type( 'campaign', $args );

  }
endif;

add_action( 'init', 'ezpzconsultations_create_campaign_cpt', 0 );

/**
 * Register a custom taxonomy
 */
if ( ! function_exists( 'ezpzconsultations_create_campaign_cpt_taxonomies' ) ) :

  // Register Taxonomy Campaign Tag
  function ezpzconsultations_create_campaign_cpt_taxonomies() {

    $labels = array(
      'name'              => _x( 'Campaign Tags', 'taxonomy general name', 'ezpzconsultations' ),
      'singular_name'     => _x( 'Campaign Tag', 'taxonomy singular name', 'ezpzconsultations' ),
      'search_items'      => __( 'Search Campaign Tags', 'ezpzconsultations' ),
      'all_items'         => __( 'All Campaign Tags', 'ezpzconsultations' ),
      'parent_item'       => __( 'Parent Campaign Tag', 'ezpzconsultations' ),
      'parent_item_colon' => __( 'Parent Campaign Tag:', 'ezpzconsultations' ),
      'edit_item'         => __( 'Edit Campaign Tag', 'ezpzconsultations' ),
      'update_item'       => __( 'Update Campaign Tag', 'ezpzconsultations' ),
      'add_new_item'      => __( 'Add New Campaign Tag', 'ezpzconsultations' ),
      'new_item_name'     => __( 'New Campaign Tag Name', 'ezpzconsultations' ),
      'menu_name'         => __( 'Campaign Tags', 'ezpzconsultations' ),
    );
    // Example of how to rewrite the default slug - eg. to make the URL more SEO-friendly.
    // Just remove 'rewrite' to disable this
    $rewrite = array(
      'slug' => 'tagged',
      'with_front' => true,
      'hierarchical' => true,
    );
    $args = array(
      'labels' => $labels,
      'description' => __( 'Register an example taxonomy for a CPT', 'ezpzconsultations' ),
      'hierarchical' => false, // Whether the taxonomy is hierarchical. Default false.
      'public' => true, // Whether a taxonomy is intended for use publicly either via the admin interface or by front-end users.
      'publicly_queryable' => true, // Whether the taxonomy is publicly queryable.
      'show_ui' => true, // Whether to generate and allow a UI for managing terms in this taxonomy in the admin.
      'show_in_menu' => true, // Whether to show the taxonomy in the admin menu
      'show_in_nav_menus' => false, // Makes this taxonomy available for selection in navigation menus
      'show_tagcloud' => true, // Whether to list the taxonomy in the Tag Cloud Widget controls
      'show_in_quick_edit' => true, // Whether to show the taxonomy in the quick/bulk edit panel
      'show_admin_column' => true, // Whether to display a column for the taxonomy on its post type listing screens
      'show_in_rest' => true, // Whether to include the taxonomy in the REST API. You will need to set this to true in order to use the taxonomy in your gutenberg metablock.
      //'meta_box_cb' => false, // Set to false to hide from the WYSIWIG Editor sidebar
      'rewrite' => $rewrite,
    );
    register_taxonomy( 'campaign-tag', array('campaign'), $args );

  }
endif;

add_action( 'init', 'ezpzconsultations_create_campaign_cpt_taxonomies', 0 );

/**
 * Creates notice for post edit screen to explain what this CPT is for
 */
if ( ! function_exists( 'ezpzconsultations_campaign_cpt_notice' ) ) :
  function ezpzconsultations_campaign_cpt_notice() {
    global $pagenow;
    if (( $pagenow == 'edit.php' ) && ($_GET['post_type'] == 'campaign')) {
        echo '<div class="notice custom-notice"><p>'.__('Please add all of your campaigns here. A campaign is determined as activity focused around a particular community or location. You may have an associated event or other activity however there is not a specific monetary ask.','ezpzconsultations').'</p></div>';
    }
  }
endif;

add_action('admin_notices', 'ezpzconsultations_campaign_cpt_notice');
