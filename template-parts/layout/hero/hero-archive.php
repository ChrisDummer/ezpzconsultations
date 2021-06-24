<?php
/**
 * Template part for displaying hero content on archive.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ezpzconsultations
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

?>
<header class="block hero hero-archive hero__small bg-neutral-200">
  <div class="hero-main">
    <div class="container">
      <div class="row justify-center">
        <div class="col md-10 lg-8">
          <header class="page-header">
            <?php
            the_archive_title( '<h1 class="page-title">', '</h1>' );
            //the_archive_description( '<div class="archive-description">', '</div>' );
            ?>
          </header>
        </div>
      </div>
    </div>
  </div>
</header>
