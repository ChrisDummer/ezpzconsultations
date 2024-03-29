<?php
/**
 * Flexible layout: Post Archive
 * Allows the editor to select a post type and loading method
 * (scroll/button) and uses the ezpzconsultations_initialize_ajax_posts()
 * and related functions to provide a lazyloaded archive of posts
 * sorted by date.
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
$query_post_type = $block['query_post_type'];
$loading_type = $block['loading_type'];

$block_bg_color = $args['block_bg_color'];

// Determine what button color to use
switch ($block_bg_color) {
  //case 'white':
  //  $button_loadmore_color = ' primary';
  //  break;
  default:
    $button_loadmore_color = '';
}

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
    // Set up a new WP_Query for the specified post_type
    $args_posts_query = array(
      'post_type' => $query_post_type,
      //'order' => 'ASC',
      'orderby' => 'date',
    );
    if($block['post_categories']) $args_posts_query['tax_query'] = array(array('taxonomy' => 'category', 'field' => 'term_id', 'terms' => $block['post_categories']));

    $archive_query = new WP_Query( $args_posts_query );

    echo '<div class="row equal-height archive-feed feed-'.$query_post_type.'" id="feed-'.$query_post_type.'">';
      if ( $archive_query->have_posts() ) {
        while ( $archive_query->have_posts() ) {
          $archive_query->the_post();
          echo '<article class="col xs-12 sm-6 md-4 xl-3">';
            get_template_part( 'template-parts/components/card/card', get_post_type() );
          echo '</article>';
        }
        if ( $loading_type == 'scroll' ) echo '</div><div class="row"><div class="col xs-12"><div id="archive-loading"></div></div>';
        if ( $archive_query->max_num_pages > 1 && $loading_type == 'button' ) {
          echo '</div><div class="row"><div class="col xs-12"><button class="button outline button-loadmore'.$button_loadmore_color.'">' . __( 'Load More...', 'ezpzconsultations' ) . '</button></div>';
        };

      } else {
        echo '<div class="col md-10 lg-8 offset-md-1 offset-lg-2"><div class="callout error" role="alert">'.__('No posts matched your criteria.', 'ezpzconsultations').'</div></div>';
      }
    echo '</div>';
    wp_reset_postdata();
    ?>

  <?php if ( !empty($block['buttons']) ) : ?>
    <div class="row justify-center">
      <div class="col md-10 lg-8 text-center">
      <?php
        if($title_align == 'center') ezpzconsultations_display_cta_buttons($block['buttons'], 'justify-center');
        elseif($title_align == 'right') ezpzconsultations_display_cta_buttons($block['buttons'], 'justify-end');
        else ezpzconsultations_display_cta_buttons($block['buttons']);
        ?>
      </div>
    </div>
  <?php endif; ?>

  <?php ezpzconsultations_initialize_ajax_posts($archive_query, $loading_type); ?>

</div>
</section>
