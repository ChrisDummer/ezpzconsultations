<?php
/**
 * Template part for displaying hero content when nothing is found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ezpzconsultations
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

?>
<header class="block hero hero-not-found hero__small bg-neutral-200">
  <div class="hero-main">
    <div class="container">
      <div class="row justify-center">
        <div class="col md-10 lg-8">
          <header class="page-header">
            <h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'ezpzconsultations' ); ?></h1>
          </header>
        </div>
      </div>
    </div>
  </div>
</header>
