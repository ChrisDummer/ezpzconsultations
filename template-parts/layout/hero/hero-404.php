<?php
/**
 * Template part for displaying hero content on 404.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ezpzconsultations
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

?>
<header class="block hero hero-404 bg-neutral-200 hero__small">
  <div class="hero-main">
    <div class="container">
      <div class="row justify-center">
        <div class="col md-10 lg-8">
          <header class="page-header">
            <h1 class="page-title"><?php esc_html_e( 'Page not found', 'ezpzconsultations' ); ?></h1>
          </header>
        </div>
      </div>
    </div>
  </div>
</header>
