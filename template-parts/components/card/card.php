<?php
/**
 * Template part for displaying a simple post card
 *
 * @package ezpzconsultations
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$card_class = 'card bg-white';
$loaded = isset($args['loaded']) ? true : false;
if($loaded == true) {
  $card_class.=' loaded';
};

?>

<div <?php post_class($card_class);?>>

  <?php
  if(has_post_thumbnail()) : ?>
    <figure class="post-thumbnail card-image">
      <a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
        <?php the_post_thumbnail('medium'); ?>
      </a>
    </figure>
  <?php endif; ?>

  <header class="card-section entry-header">
    <?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" aria-hidden="true" tabindex="-1">', '</a></h3>' ); ?>
  </header>

  <?php if(ezpzconsultations_generate_excerpt()) echo '<div class="card-section entry-content">'.ezpzconsultations_generate_excerpt(200,true).'</div>'; ?>

  <?php if ( 'post' === get_post_type() ) : // Show if post ?>
    <div class="card-section entry-meta">
      <?php
      ezpzconsultations_posted_on();
      ezpzconsultations_posted_by();
      ?>
    </div>
  <?php endif; ?>

  <footer class="card-section card-footer">
    <a class="button small" href="<?php the_permalink();?>" rel="bookmark"><?php _e('Continue Reading <span class="screen-reader-text">'.get_the_title().'</span>', 'ezpzconsultations');?></a>
  </footer>

</div>
