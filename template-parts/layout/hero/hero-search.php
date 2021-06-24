<?php
/**
 * Template part for displaying hero content on search.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ezpzconsultations
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

?>
<header class="block hero hero-search bg-neutral-200 hero__small">
  <div class="hero-main">
    <div class="container">
      <div class="row justify-center">
        <div class="col md-10 lg-8">
          <header class="page-header">
            <h1 class="page-title">
              <?php
                /* translators: %s: search query. */
                printf( esc_html__( 'Search Results for: %s', 'ezpzconsultations' ), '<span>' . get_search_query() . '</span>' );
                ?>
            </h1>
          </header>
        </div>
      </div>
    </div>
  </div>
</header>
