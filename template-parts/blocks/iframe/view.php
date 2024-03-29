<?php
/**
 * Flexible layout: iFrame
 * Renders an iFrame block
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
$website_url = $block['website_url'];
$block_preamble = $block['preamble'];

$block_width = $block['content_width'];
if($block_width == 'wide') $container_class .= ' is-wide';
elseif($block_width == 'full') $block_classes .= ' is-full-width';
?>

<section <?php if($block_id_opt = $block['section_id']) echo 'id="'.strtolower($block_id_opt).'"'; ?> class="<?php echo $block_classes;?>">
  <?php if ($block_title || $block_preamble) echo '<div class="container">'; ?>

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
  <?php if ($block_title || $block_preamble) echo '</div>'; ?>

<?php if ($website_url) : ?>
  <div class="<?php echo $container_class;?>">
    <div class="row">
      <div class="col">
        <?php if ( $block_width === 'full' ){ echo '<div class="vw-100">'; }?>
          <div class="embed-container">
            <iframe class="embedded-iframe" src="<?php echo $website_url; ?>"></iframe>
          </div>
        <?php if ( $block_width === 'full' ){ echo '</div>'; }?>
      </div>
    </div>
  </div>
<?php endif; ?>

</section>
