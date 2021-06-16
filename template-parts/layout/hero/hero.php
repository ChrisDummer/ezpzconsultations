<?php
/**
 * Template part for displaying hero content when no other more specific
 * partial exists eg on single.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package dunhamco
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

  $hero_class = '';
  $hero_main_class = 'hero-main';

  if('post' === get_post_type() || 'crb_research' === get_post_type()) {
    $field_group_array = json_decode( file_get_contents( get_stylesheet_directory() . "/assets/acf-json/group_60228bab3a12f.json" ), true );
    $hero_data = get_all_custom_field_meta( $id, $field_group_array );
  }

  //var_dump($hero_data);
  if($hero_height = $hero_data['hero_height']) $hero_class .= ' hero__'. $hero_height;
  else $hero_class .= ' hero__small';


  if(has_post_thumbnail()) {
    $background_image_id = get_post_thumbnail_id();
    $hero_class .= ' bg-image';
    $hero_class .= ' has-overlay';
    $overlay_color = $hero_data['hero_overlay_color'];
    if($overlay_color) {
      $hero_class .= ' overlay-'.$overlay_color;
      $hero_class .= ' overlay-opacity-'.$hero_data['overlay_opacity'];
    }
  }
  else {
    $hero_class .= ' bg-dark';
  }



?>
<header class="block hero hero-<?php echo get_post_type() . $hero_class;?>" <?php if($background_image_id) { echo 'style="background-image:url('.wp_get_attachment_image_url($background_image_id, 'hero').')"';}?>>
  <div class="<?php echo $hero_main_class;?>">

      <div class="container">

      <?php
      $header_col_class = 'col md-10';
      $header_row_class = 'row justify-center';
      ?>

      <div class="<?php echo $header_row_class;?>">

        <div class="<?php echo $header_col_class;?>" data-aos="fade-up" data-aos-duration="600">
            <?php
            echo '<h1 class="page-title">';
              the_title();
            echo '</h1>';
            echo '<div class="entry-meta-wrapper"><div class="entry-meta">';
            if('post' === get_post_type()) if($post_author = get_field('post_author')) echo '<span class="byline"><a href="#author">' .dunhamco_icon('pencil') .  ucwords(strtolower(get_the_title($post_author))) . '</a></span>';
            dunhamco_posted_on();
            dunhamco_categories();
            if('post' === get_post_type()) {
              if(!$reading_time = get_field('reading_time')) $reading_time = dunhamco_calculate_reading_time(get_the_content());
              if ($reading_time == 1) $postfix = __(' minute', 'dunhamco');
              else $postfix = __(' minutes', 'dunhamco');

              $reading_time = $reading_time . $postfix;
              echo '<span class="reading-time">'.dunhamco_icon('clock').$reading_time.__(' read', 'dunhamco').'</span>';
            }
            elseif('crb_research' === get_post_type()) {

            }

            echo '</div></div>'; // .entry-meta
             ?>
        </div>
      </div>
    </div>
  </div>
</header>
