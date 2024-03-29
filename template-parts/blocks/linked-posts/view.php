<?php
/**
 * Flexible layout: Linked Posts
 * Renders a row of simple equal-height cards
 * with featured image, title, excerpt and button.
 * The user can select whether the posts display are specified,
 * random or latest. If random or latest they can select post type
 * and quantity to display.
 *
 * @package ezpzconsultations
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Get Params from get_template_part:
$block = $args['block'];
$block_id = $args['block_id'];
$block_classes = $args['block_classes'];
//var_dump($block);

$block_title = $block['title'];
$block_preamble = $block['preamble'];
$query_type = $block['query_type'];
$posts_array = array(); // Create an empty array to store posts ready for the loop
?>

<section <?php if($block_id_opt = $block['section_id']) echo 'id="'.strtolower($block_id_opt).'"'; ?> class="<?php echo $block_classes;?>">
  <div class="container">

  <?php if ($block_title) : $title_align = $block['title_align']; ?>
    <header class="row justify-center block-title">
      <div class="col md-10 lg-8">
        <h2 class="text-<?php echo $title_align;?>"><?php echo ezpzconsultations_bracket_tag_replace($block_title); ?></h2>
      </div>
    </header>
  <?php endif; ?>

  <?php if ($block_preamble) : ?>
    <div class="row justify-center block-preamble">
      <div class="col md-10 lg-8">
        <?php echo ezpzconsultations_content($block_preamble); ?>
      </div>
    </div>
  <?php endif; ?>

  <?php
  /**
   * Sets up the $posts_array array with values dependent on whether
   * the user has selected specified, random or latest.
   */

  if($query_type == 'rand' || $query_type == 'date') {
    $query_post_type = $block['query_post_type'];
    $query_quantity = $block['query_quantity'];
  }

  if($query_type == 'specified'):
    $queried_posts = $block['specified_posts'];
      if ( $queried_posts ):
        foreach ( $queried_posts as $post_to_display ):
          array_push($posts_array, $post_to_display);
        endforeach;
      endif;
  elseif($query_type == 'rand' || $query_type == 'date'):
    $query_posts_from_db = new WP_Query( array(
      'post_type' => $query_post_type, // Accepts an array
      'posts_per_page' => $query_quantity,
      'orderby' => $query_type
    ) );

    if ( $query_posts_from_db->have_posts() ) :
      while ( $query_posts_from_db->have_posts() ) :
        // Not sure if this is the most efficient way to do this ... seems like an expensive query
        $query_posts_from_db->the_post();
        array_push($posts_array, get_the_ID());
      endwhile;
      wp_reset_postdata();
    endif;
  endif;

  echo '<div class="row equal-height justify-center">';
    if($posts_array) :
        global $post; // Call global $post variable
        foreach($posts_array as $queried_post):
          $post = $queried_post; // Set $post global variable to the current post object
          setup_postdata( $post ); // Set up "environment" for template tags

          echo '<article class="col xs-12 sm-6 md-4 xl-3">';
            get_template_part( 'template-parts/components/card/card', get_post_type() ); // Display the post information
          echo '</article>';

        endforeach;
        wp_reset_postdata();
    else:
      echo '<div class="col md-10 lg-8"><div class="callout error" role="alert">'.__('No posts matched your criteria.', 'ezpzconsultations').'</div></div>';
    endif;
  echo '</div>';

  ?>

  <?php if ( !empty($block['buttons']) ) : ?>
    <div class="row justify-center">
      <div class="col md-10 lg-8 text-center">
        <?php ezpzconsultations_display_cta_buttons($block['buttons'], 'justify-center'); ?>
      </div>
    </div>
  <?php endif; ?>

  </div>
</section>
