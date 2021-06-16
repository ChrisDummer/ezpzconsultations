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

  // Get all ACF field meta into a single array
  $field_group_array = json_decode( file_get_contents( get_stylesheet_directory() . "/assets/acf-json/group_5ff5b93d03614.json" ), true );
  $hero_data = get_all_custom_field_meta( $id, $field_group_array );
 //var_dump($hero_data);

  $hero_background = $hero_data['background_type'];
  $hero_subhead = $hero_data['subhead'];

  $hero_class = '';
  $hero_main_class = 'hero-main';

  if($hero_height = $hero_data['hero_height']) $hero_class .= ' hero__'. $hero_height;
  else $hero_class .= ' hero__small';

  if($hero_background == 'image' || $hero_background == 'video') $hero_main_class .= ' bg-'. $hero_background;

  if($hero_background == 'image') {
    $background_image = $hero_data['hero_image'];
    if(is_array($background_image)) {
      // Means that the page is using ACF Focal
      $image_focal = $hero_data['hero_image'];
    }
    else {
      // Means that the post is NOT using ACF Focal
      $background_image_id = $background_image;
    }

  }
  elseif($hero_background == 'color') {
    $bg_color = $hero_data['background_color'];
    $hero_main_class .= ' bg-'. $bg_color;
  }
  elseif(!$hero_background) {
    $hero_main_class .= ' bg-dark';
  }
  $title_image = $hero_data['title_image'];

  if($hero_data['title_size_small']) $h1_class = ' h1-small';
  else $h1_class = '';
?>
<header class="block hero hero-<?php echo get_post_type() . $hero_class;?>">
  <?php if($background_image_id) {
    // Post is not using ACF FOCAL - so set image as a bg image
    echo '<div class="'.$hero_main_class.'" style="background-image:url('.wp_get_attachment_image_url($background_image_id, 'hero').')">';
  }
  else {
    echo '<div class="'.$hero_main_class.'">';
    echo '<div class="focal-wrapper"><img class="js-focal-point-image" src="'.wp_get_attachment_image_url($image_focal['id'], 'full').'" data-focus-left="'.$image_focal['left'].'" data-focus-top="'.$image_focal['top'].'" data-focus-right="'.$image_focal['right'].'" data-focus-bottom="'.$image_focal['bottom'].'"></div>';
  }
  ?>

  <?php if($hero_background == 'video') :
  $video_array = $hero_data['background_video'];
    $poster = $video_array['video_poster'];
    ?>
    <video playsinline autoplay muted loop poster="<?php echo wp_get_attachment_image_url($poster, 'large');?>" class="hero-video">
      <?php
        foreach($video_array['video_sources'] as $video_source):
          $video_file_id = $video_source['video_source'];
          $video_file_url = wp_get_attachment_url($video_file_id);
          $video_ext = pathinfo($video_file_url, PATHINFO_EXTENSION);
          echo '<source src="'.$video_file_url.'" type="video/'.$video_ext.'">';
        endforeach;
      ?>
    </video>
  <?php endif; ?>

    <div class="container">

      <?php
      $header_col_class = 'col md-10';
      $header_row_class = 'row justify-center';
      ?>

      <div class="<?php echo $header_row_class;?>">

        <div class="<?php echo $header_col_class;?>">
            <?php
            echo '<h1 class="page-title'.$h1_class.'" data-aos="fade-up" data-aos-duration="600">';
            if($title_image) :
              echo wp_get_attachment_image( $title_image, 'large' );
              the_title('<span class="text-hide">','</span>');
            else:
              the_title();
            endif;
            echo '</h1>';
            if($external_video_link = $video_array['external_video_link']) { ?>
              <div class="text-center">
                <a class="button large secondary play-button video-modal-open" href="#modal-video-hero" data-aos="fade-up-small" data-aos-duration="1000"><?php echo __('Play', 'dunhamco').dunhamco_icon('play-caret'); ?></a>
                <div id="modal-video-hero" class="modal modal-video is-transparent no-padding mfp-hide">
                  <?php dunhamco_embed_video($external_video_link, $video_array['aspect_ratio']); ?>
                </div>
              </div>
            <?php } ?>
      </div>
      </div>
    </div>
  </div>
  <?php if($hero_subhead) : ?>
  <div class="hero-subhead bg-dark-grad">
    <div class="container">
      <div class="row">
        <div class="col text-center" data-aos="fade-up">
          <p><?php echo dunhamco_bracket_tag_replace($hero_subhead); ?></p>
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>
</header>


<?php
if($external_video_link) :
  // Initialize modals
  $func = dunhamco_modal_init('.video-modal-open', 'video');
  add_action('wp_footer', $func, 30); // 30 priority ensures it is placed below the enqueued scripts (priority 20)
endif;
?>
