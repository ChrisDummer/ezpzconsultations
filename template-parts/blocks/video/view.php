<?php
/**
 * Flexible layout: Video block
 * Renders a video block
 *
 * @package ezpzconsultations
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Get Params from get_template_part:
$block = $args['block'];
$block_id = $args['block_id'];
$block_classes = $args['block_classes'];
$container_class = 'container';
//var_dump($block);

$block_title = $block['title'];

$block_width = $block['content_width'];
if($block_width == 'wide') $container_class .= ' is-wide';
elseif($block_width == 'full') $block_classes .= ' is-full-width';
?>

<section <?php if($block_id_opt = $block['section_id']) echo 'id="'.strtolower($block_id_opt).'"'; ?> class="<?php echo $block_classes;?>">
  <div class="container">

  <?php if ($block_title) : $title_align = $block['title_align']; ?>
    <header class="row block-title">
      <div class="col">
        <h2 class="text-<?php echo $title_align;?>"><?php echo ezpzconsultations_bracket_tag_replace($block_title); ?></h2>
      </div>
    </header>
  <?php endif; ?>
  </div>

  <div class="<?php echo $container_class;?>">
    <div class="row">
      <div class="col">
        <?php
        if ( $block_width === 'full' ){ echo '<div class="vw-100">'; }
          ezpzconsultations_embed_video($block['video'], $block['aspect_ratio']);
        if ( $block_width === 'full' ){ echo '</div>'; }?>
      </div>
    </div>
  </div>

</section>
