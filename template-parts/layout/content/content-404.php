<?php
/**
 * Template part for displaying a 404 error (page not found)
 *
 * @package ezpzconsultations
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

?>
<section class="block bg-white">
  <div class="container">
    <div class="row">
      <div class="col sm-12 md-8 lg-9">
        <div class="page-content">
          <p>
            <?php esc_html_e( 'It looks like nothing was found at this location. Can we help you find the page you were looking for?', 'ezpzconsultations' ); ?>
          </p>
          <p>
            <a class="button" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">Home Page</a>
            <button class="button outline" onCLick="history.back()"><?php _e('Back to last page', 'ezpzconsultations');?></button>
          </p>
        </div>
      </div>
      <aside class="col sm-12 md-4 lg-3 sidebar">
        <h4><?php _e('Search this website:', 'ezpzconsultations');?></h4>
        <?php
          get_search_form();
          the_widget( 'WP_Widget_Recent_Posts' );
        ?>
      </aside>
    </div>
  </div>
</section>
