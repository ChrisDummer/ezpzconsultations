<?php
/**
 * Template part for displaying hero content on archive.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package dunhamco
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$hero_main_class = 'hero-main bg-dark';

if(is_category()) {
  $category = get_queried_object();
  $term_id_prefixed = 'category_'. $category->term_id;
  $category_image = get_field( 'category_image', $term_id_prefixed );
}

if($category_image) {
  $hero_main_class .= ' bg-image';
}
else {
  $hero_main_class .= ' bg-dark';
}

?>
<header class="block hero hero-archive hero__small">
  <div class="<?php echo $hero_main_class;?>" <?php if($category_image) { echo 'style="background-image:url('.wp_get_attachment_image_url($category_image, 'hero').')"';}?>>
    <div class="container">
      <div class="row justify-center">
        <div class="col md-10 lg-8">
          <header class="page-header">
            <?php
            the_archive_title( '<h1 class="page-title">', '</h1>' );
            the_archive_description( '<div class="archive-description">', '</div>' );
            ?>
          </header>
        </div>
      </div>
    </div>
  </div>
</header>
