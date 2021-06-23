<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ezpzconsultations
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$field_group_json = 'group_60c219d0bd368.json'; // Replace with the name of your field group JSON.
      $field_group_array = json_decode( file_get_contents( get_stylesheet_directory() . "/assets/acf-json/{$field_group_json}" ), true );
      $footer_options_data = get_all_custom_field_meta( 'option', $field_group_array );

$footer_selecter = $footer_options_data['footer_selecter'];

?>
  </div><?php //#content .site-content ?>

<?php if ( !is_page_template( 'page-simple.php' ) ) : ?>

	<footer class="site-footer">
  <?php $post = $footer_selecter; // Set $post global variable to the current post object
  setup_postdata( $post ); // Set up "environment" for template tags

    get_template_part( 'template-parts/blocks/acf-flexible-content/view'); // Get flexible content from ACF
    wp_reset_postdata();?>
    <div class="container">
      <div class="row">
        <div class="site-info col" id="colophon">
          <p class="small">
            <?php echo ezpzconsultations_copyright();?>
            <span class="sep"> | </span>
            <span class="eplsdesign">
            <?php
            /* translators: 1: Theme author and link to website. */
            printf( esc_html__( 'Website design and build by %1$s', 'ezpzconsultations' ), '<a href="https://epls.design/?utm_source=client&utm_medium=website&utm_campaign='.sanitize_title(get_bloginfo('name')).'" rel="author">EPLS Design</a>' );
            ?>
            </span>
          </p>
        </div>
      </div>
    </div>
  </footer>

  <?php

 endif; ?>

</div>
<?php wp_footer(); ?>
</body>
</html>
