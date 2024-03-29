<?php
/**
 * Functions which hook into ACF to add additional functionality to the website.
 *
 * @package ezpzconsultations
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
* Move location of ACF-JSON local Json folder
* https://www.advancedcustomfields.com/resources/local-json/
*/
add_filter('acf/settings/load_json', 'ezpzconsultations_acf_json_load_point');
add_filter('acf/settings/save_json', 'ezpzconsultations_acf_json_save_point');
if (! function_exists('ezpzconsultations_acf_json_load_point') ) {
  function ezpzconsultations_acf_json_load_point( $paths ) {
    // remove original path (optional)
    unset($paths[0]);
    // append path
    $paths[] = get_stylesheet_directory() . '/assets/acf-json';
    // return
    return $paths;
  }
}
if (! function_exists('ezpzconsultations_acf_json_save_point') ) {
function ezpzconsultations_acf_json_save_point( $path ) {
    // update path
    $path = get_stylesheet_directory() . '/assets/acf-json';
    // return
    return $path;
  }
}

/**
 * Restricts TinyMCE options for ACF Wysiwig field
 */
add_filter('acf/fields/wysiwyg/toolbars', 'ezpzconsultations_restrict_acf_tinymce_opts');
if (!function_exists('ezpzconsultations_restrict_acf_tinymce_opts')) {
  function ezpzconsultations_restrict_acf_tinymce_opts( $toolbars )
  {
    $toolbars['Full' ] = array(
    1 => array('formatselect', 'bold', 'italic', 'blockquote', 'bullist', 'numlist', 'link', 'unlink', 'spellchecker', 'wp_adv'),
    2 => array('styleselect', 'pastetext', 'removeformat', 'charmap', 'alignleft', 'aligncenter', 'alignright', 'undo', 'redo' )
    );
    return $toolbars;
  }
}

/**
  * Adds ACF options pages
  */
if(function_exists('acf_add_options_page') ) {
  acf_add_options_page(
    array(
      'page_title' 	=> __('Information and SEO', 'ezpzconsultations'),
      'menu_title'	=> __('Theme Setup', 'ezpzconsultations'),
      'menu_slug' 	=> 'theme-options',
      'capability'	=> 'edit_posts',
      'redirect'		=> true,
      'icon_url' => 'dashicons-info',
      'position' => 90.1,
      )
  );
  acf_add_options_sub_page(
    array(
    'page_title'     => __('Contact Details', 'ezpzconsultations'),
    'menu_title'    => __('Contact Details', 'ezpzconsultations'),
    'menu_slug'     => 'contact-details',
    'parent_slug' => 'theme-options',
    'capability'    => 'edit_posts',
    'autoload' => true, // Speeds up load times
    'updated_message' => __("Successfully updated Contact Details", 'ezpzconsultations'),
    )
  );
  acf_add_options_sub_page(
    array(
    'page_title'     => __('Opening Hours', 'ezpzconsultations'),
    'menu_title'    => __('Opening Hours', 'ezpzconsultations'),
    'menu_slug'     => 'opening-hours',
    'parent_slug' => 'theme-options',
    'capability'    => 'edit_posts',
    'autoload' => true, // Speeds up load times
    'updated_message' => __("Successfully updated Opening Hours", 'ezpzconsultations'),
    )
  );
  acf_add_options_sub_page(
    array(
    'page_title'     => __('Social Media and SEO', 'ezpzconsultations'),
    'menu_title'    => __('Social Media/SEO', 'ezpzconsultations'),
    'menu_slug'     => 'social-seo',
    'parent_slug' => 'theme-options',
    'capability'    => 'edit_posts',
    'autoload' => true, // Speeds up load times
    'updated_message' => __("Successfully updated Social Media and SEO", 'ezpzconsultations'),
    )
  );
  acf_add_options_sub_page(
    array(
    'page_title'     => __('APIs', 'ezpzconsultations'),
    'menu_title'    => __('APIs', 'ezpzconsultations'),
    'menu_slug'     => 'apis',
    'parent_slug' => 'theme-options',
    'capability'    => 'edit_posts',
    'autoload' => true, // Speeds up load times
    'updated_message' => __("Successfully updated APIs", 'ezpzconsultations'),
    )
  );
  acf_add_options_sub_page(
    array(
    'page_title'     => __('Theme Designer', 'ezpzconsultations'),
    'menu_title'    => __('Theme Designer', 'ezpzconsultations'),
    'menu_slug'     => 'theme-designer',
    'parent_slug' => 'theme-options',
    'capability'    => 'edit_posts',
    'autoload' => true, // Speeds up load times
    'updated_message' => __("Successfully updated Theme Design Settings", 'ezpzconsultations'),
    )
  );


  acf_add_options_sub_page(
    array(
    'page_title'     => __('Misc Settings', 'ezpzconsultations'),
    'menu_title'    => __('Misc Settings', 'ezpzconsultations'),
    'menu_slug'     => 'theme-misc',
    'parent_slug' => 'theme-options',
    'capability'    => 'edit_posts',
    'autoload' => true, // Speeds up load times
    'updated_message' => __("Successfully updated Misc Settings", 'ezpzconsultations'),
    )
  );

}

if (! function_exists('ezpzconsultations_hide_acf_admin') ) {
    /**
     * Hides ACF settings on the live site. Settings will still be available locally.
     * This snippet is used because we are using ACF Json to manage field groups and keep them in sync
     * When pulling the database from the live site (eg. with WP Migrate DB), it is necessary
     * to sync the json back in - as the production site should never have the ACF fields
     * stored in the database (only the local site will have this)
     *
     * @link https://www.awesomeacf.com/snippets/hide-the-acf-admin-menu-item-on-selected-sites/
     * @link https://support.advancedcustomfields.com/forums/topic/the-acf-json-workflow/
     */
    function ezpzconsultations_hide_acf_admin()
    {
        // get the current site url
        $site_url = get_bloginfo('url');
        // an array of development environment URLs
        $dev_urls = array(
         DEV_URL, // Constant defined in functions.php
        );
        // check if the current site url is in the protected urls array
        if (!in_array($site_url, $dev_urls) ) {
            // hide the acf menu item
            return false;
        } else {
            // show the acf menu item
            return true;
        }
    }
}
add_filter('acf/settings/show_admin', 'ezpzconsultations_hide_acf_admin');

/**
 * Adds Google Maps API Key if the user has added one to the options page
 */
add_action('acf/init', 'ezpzconsultations_google_maps_api_key');
if (! function_exists('ezpzconsultations_google_maps_api_key') ) {
  function ezpzconsultations_google_maps_api_key() {
    $get_gmaps_api = get_global_option('google_maps_api_key');
    if ($get_gmaps_api) {
        acf_update_setting('google_api_key', $get_gmaps_api);
    }
  }
}

/**
 * Adds Dashicons to ACF allowing us to use them in labels etc.
 * Usage: <span class="dashicons dashicons-menu"></span>
 */
add_action('admin_init', 'ezpzconsultations_acf_dashicons_support');
if (! function_exists('ezpzconsultations_acf_dashicons_support') ) {
  function ezpzconsultations_acf_dashicons_support() {
      wp_enqueue_style('dashicons');
  }
}

/**
 * Extend WordPress search to include custom fields
 * Note: if using Search and Filter Pro, this isn't always reliable and
 * it's best to use a plugin like "Search Everything" or try
 * https://gist.github.com/charleslouis/5924863
 *
 * @link https://adambalee.com/search-wordpress-by-custom-fields-without-a-plugin/
 */

/**
 * Join posts and postmeta tables
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_join
 */
if (! function_exists('ezpzconsultations_search_acf_join') ) {
    function ezpzconsultations_search_acf_join( $join )
    {
        global $wpdb;
        if (is_search() ) {
            $join .=' LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
        }
        return $join;
    }
}
add_filter('posts_join', 'ezpzconsultations_search_acf_join');

/**
* Modify the search query with posts_where
* http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_where
*/
if (! function_exists('ezpzconsultations_search_acf_where') ) {
    function ezpzconsultations_search_acf_where( $where )
    {
        global $pagenow, $wpdb;
        if (is_search() ) {
            $where = preg_replace(
                "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
                "(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where
            );
        }
        return $where;
    }
}
add_filter('posts_where', 'ezpzconsultations_search_acf_where');

/**
* Prevent duplicates
* http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_distinct
*/
if (! function_exists('ezpzconsultations_search_acf_distinct') ) {
    function ezpzconsultations_search_acf_distinct( $where )
    {
        global $wpdb;
        if (is_search() ) {
            return "DISTINCT";
        }
        return $where;
    }
}
add_filter('posts_distinct', 'ezpzconsultations_search_acf_distinct');

/**
 * Hooks into Flexible Content Fields to append useful titles to header handles,
 * so that editors can see at a glance what content is contained within a block.
 */
if (! function_exists('ezpzconsultations_acf_flexible_titles') ) {
    function ezpzconsultations_acf_flexible_titles($title, $field, $block_layout, $i)
    {
        $block_layout = get_row_layout();
        $block_bg_color = 'bg-'.strtolower(get_sub_field('background_color'));

        if($disabled = get_sub_field('disable')) {
          echo '<div class="acf-block-disabled"></div>';
        }

        $block_show_from = get_sub_field('show_from');
        $block_show_until = get_sub_field('show_until');
        $current_wp_time = current_time('Y-m-d H:i:s');
        if (($block_show_from == NULL OR $block_show_from <= $current_wp_time) AND ($block_show_until == NULL OR $block_show_until>= $current_wp_time)) {
        }
        else {
          echo '<div class="acf-block-disabled"></div>';
        }

        if($block_title = get_sub_field('title')) {
            // If there is a title, use that as priority over anything else
            return '<span class="swatch '.$block_bg_color.'"></span>'.ezpzconsultations_trimpara($block_title,30).'<span class="acf-handle-right">'.$title.'</span>';
        }
        elseif($block_layout == 'image') {
            // If the layout is an image, try to use the image title or alt tag, before resorting to filename
            $image_id = get_sub_field('image');
            if($image_title = get_the_title($image_id)) {
                // Start by looking for a title...
            }
            elseif ($image_title = get_post_meta($image_id, '_wp_attachment_image_alt', true)) {
                // If that fails, look for an Alt tag....
            }
            else {
                // If all else fails.... use the filename
                $image_title = get_post_meta($image_id, '_wp_attached_file', true);
            }
            return '<span class="swatch '.$block_bg_color.'"></span>'.ezpzconsultations_trimpara($image_title,50).'<span class="acf-handle-right">'.$title.'</span>';
        }
        elseif($block_layout == 'gallery') {
            // If the layout is a gallery, we want to find the first image with either a title or alt tag and append '+ $i'
            if ($images_images = get_sub_field('images') ) :
                $i = 0;
                $gallery_img_title = '';
                foreach ( $images_images as $images_image ):
                    if(($images_image['alt']!= null OR $images_image['title']!= null) AND $gallery_img_title == null) {
                        // If the image has a title or alt tag, and we have not previously found a qualifying image...
                        if($gallery_img_title = $images_image['title']) {
                                // First use the title
                        }
                        else {
                            $gallery_img_title = $images_image['alt'];
                            // Otherwise use the alt text
                        }
                    };
                    $i++;
                endforeach;
                if($gallery_img_title AND $i==1) {
                    // We found a good title, and there is only one image - return the title
                    $images_list = $gallery_img_title;
                }
                elseif ($gallery_img_title AND $i>1) {
                    // We found a good title and there is more than one images - append the total number of images -1
                    $images_list = $gallery_img_title.' and '.($i - 1).' more';
                }
                else {
                    // No title found, echo out the amount of images
                    $images_list = $i.' images';
                }
            endif;
            return '<span class="swatch '.$block_bg_color.'"></span>'.ezpzconsultations_trimpara($images_list,50).'<span class="acf-handle-right">'.$title.'</span>';
        }
        elseif($block_layout == 'iframe') {
          $website_url = get_sub_field( 'website_url' );
          return '<span class="swatch '.$block_bg_color.'"></span>'.$website_url.'<span class="acf-handle-right">'.$title.'</span>';
      }
        else {
            // If nothing found, return the block name
            return '<span class="swatch '.$block_bg_color.'"></span>'.$title;
        }
    }
}
add_filter('acf/fields/flexible_content/layout_title', 'ezpzconsultations_acf_flexible_titles', 10, 4);

/**
* Sanitizes ACF fields on save to prevent XSS.
* https://support.advancedcustomfields.com/forums/topic/is-sanitization-required-for-front-end-form/
* https://github.com/Hube2/acf-filters-and-functions/blob/master/acf-form-kses.php
*/
if (! function_exists('ezpzconsultations_kses_acf') ) :
    function ezpzconsultations_kses_acf( $data, $post_id, $field )
    {
        if (!is_array($data)) {
          $allowed_fields = ['unfiltered_html', 'font_links', 'custom_css'];
            // If it's not an array, sanitize
            if(in_array($field['_name'], $allowed_fields)) {
              return $data;
            }
            else {
              return wp_kses_post($data);
            }
        }
        $return = array();
        if (count($data)) {
            // If it's an array (eg. repeater, group, etc) repeat this function on each value
            foreach ($data as $index => $value) {
                $return[$index] = ezpzconsultations_kses_acf($value, $post_id, $field);
            }
        }
        return $return;
    }
endif;
add_filter('acf/update_value', 'ezpzconsultations_kses_acf', 10, 3);

/**
 * Speed up the post edit page
 * @link https://www.advancedcustomfields.com/blog/acf-pro-5-5-13-update/
 */
add_filter('acf/settings/remove_wp_meta_box', '__return_true');

/**
 * Hooks into ACF Save Post to allow the editor to clone Flexible Content Fields from another post
 * @Link https://support.advancedcustomfields.com/forums/topic/copy-flexible-content-layout-from-one-post-to-another/
 */
add_action( 'acf/save_post', 'ezpzconsultations_import_blocks_from_other_post', 1 );
if (! function_exists('ezpzconsultations_import_blocks_from_other_post') ) :
  function ezpzconsultations_import_blocks_from_other_post( $post_id ) {

    // Bail early if no ACF data or if 'enable_block_import' is not TRUE
    if ( empty( $_POST['acf'] ) || $_POST['acf']['field_5fa6c5ffe671c'] != 1 ) {
      return;
    }

    // If the post already has 'sections' (Page Blocks field_5d403805052c2) return
    if ( is_array( $_POST['acf']['field_5d403805052c2'] ) && ! empty( $_POST['acf']['field_5d403805052c2'] ) ) {
      return;
    }
    else {
      $current_page_flex_blocks = array(); // Set up empty array

      // Determine which pages/posts to import from field_5fa6c2d0efc19 'import_source' (only one is enabled by default but using the Relationship Field which returns an array)
      $post_blocks_to_import = $_POST['acf']['field_5fa6c2d0efc19'];

      // If there aren't any blocks to import, skip the rest.
      if ( empty( $post_blocks_to_import ) ) {
        return;
      }
      // Loop through all posts to get the flexible content data from them
      foreach ( $post_blocks_to_import as $post_id ) {
        $blocks_from_post = get_field_object( 'sections', $post_id, false, true );
        if ( ! empty( $blocks_from_post['value'] ) ) {
          $current_page_flex_blocks = array_merge( $current_page_flex_blocks, $blocks_from_post['value'] );
        }
      }
      // Insert the found data into 'sections' field_5d403805052c2
      $_POST['acf']['field_5d403805052c2'] = $current_page_flex_blocks;

      // Clear out the import fields
      $_POST['acf']['field_5fa6c2d0efc19'] = array(); // Relationship Field
      $_POST['acf']['field_5fa6c5ffe671c'] = 0; // 'enable_block_import' Boolean
    }
  }
endif;

/**
 * ACF / WPML Options
 * Return the value of an Options field from WPML's default language
 * @link https://barebones.dev/articles/acf-and-wpml-get-global-options-value/
 */
if ( ! function_exists( 'ezpzconsultations_acf_set_language' ) ) :
  function ezpzconsultations_acf_set_language() {
    return acf_get_setting('default_language');
  }
endif;
if ( ! function_exists( 'get_global_option' ) ) :
  function get_global_option($name) {
    add_filter('acf/settings/current_language', 'ezpzconsultations_acf_set_language', 100);
    $option = get_field($name, 'option');
    remove_filter('acf/settings/current_language', 'ezpzconsultations_acf_set_language', 100);
    return $option;
  }
endif;

/**
 * Loop through ACF flexible repeater field 'sections' to find a WYSIWIG field
 *
 * @return string text from a WYSIWIG field
 */
if ( ! function_exists( 'ezpzconsultations_excerpt_from_acf_flexible_content' ) ) :
  function ezpzconsultations_excerpt_from_acf_flexible_content() {
      if ( have_rows( 'sections' ) ) {
        while ( have_rows( 'sections' ) ) : the_row();
        $layout = get_row_layout();
        // Loop through to find first WYSIWIG field - increase performance by only using specified layouts
        //if($layout == 'text' || $layout == 'magic-columns' || $layout == 'text-columns') {
        if(!$post_excerpt) {
          if($layout == 'text') {
            $post_excerpt = get_sub_field( 'text' );
            //break;
          }
          elseif($layout == 'magic-columns') {
            if ( have_rows( 'columns' ) ) :
              while ( have_rows( 'columns' ) ) : the_row();
                $post_excerpt = get_sub_field('text');
                //break 2;
              endwhile;
            endif;
          }
          elseif($layout == 'text-columns') {
            if ( have_rows( 'columns' ) ) :
              while ( have_rows( 'columns' ) ) : the_row();
                $post_excerpt = get_sub_field('editor');
                //break 2;
              endwhile;
            endif;
          }
        }
        endwhile;
      }
      if(isset($post_excerpt)) return $post_excerpt;
      else return false;
  }
endif;
