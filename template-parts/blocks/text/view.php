<?php
/**
 * Flexible layout: Text block
 * Renders a block containing a column of WYSIWIG text
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

    <div class="row justify-center">
      <div class="col md-10 lg-8">
        <?php echo ezpzconsultations_content($block['text']); ?>
        <?php
          if($title_align == 'center') ezpzconsultations_display_cta_buttons($block['buttons'], 'justify-center');
          elseif($title_align == 'right') ezpzconsultations_display_cta_buttons($block['buttons'], 'justify-end');
          else ezpzconsultations_display_cta_buttons($block['buttons']);
          ?>
      </div>
    </div>

  </div>
</section>
