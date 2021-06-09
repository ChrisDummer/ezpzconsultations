<?php
/**
 * Hook Schema markup into WP Footer
 *
 * @package ezpzconsultations
 */

add_action( 'wp_footer', 'ezpzconsultations_faq_schema', 100 );
if ( ! function_exists( 'ezpzconsultations_faq_schema' ) ) :
  function ezpzconsultations_faq_schema() {
    global $faq_schema;
    if(!empty($faq_schema)) echo '<script type="application/ld+json">'. json_encode($faq_schema) .'</script>';
  }
endif;
