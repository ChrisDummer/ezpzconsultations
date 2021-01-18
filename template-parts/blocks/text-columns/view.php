<?php
/**
 * Flexible layout: Text Columns
 * Renders a block containing between two and four columns of WYSIWIG text
 *
 * @package jellypress
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Get Params from get_template_part:
$block = $args['block'];
$block_id = $args['block_id'];
//var_dump($block);

$block_title = $block['title'];
?>

<?php if ($block_title) : ?>
<header class="row block-title">
  <div class="col">
    <h2><?php echo jellypress_bracket_tag_replace($block_title); ?></h2>
  </div>
</header>
<?php endif; ?>

<?php if ( $text_columns = $block['columns'] ) : ?>
  <div class="row">
    <?php foreach ($text_columns as $text_column): ?>
      <div class="col xs-12 md-0">
        <?php jellypress_content($text_column['editor']); ?>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>

<?php if ( $block['buttons'] ) : ?>
  <div class="row">
    <div class="col text-center">
      <?php jellypress_display_cta_buttons($block['buttons']); //TODO: if heading is centered, center these ?>
    </div>
  </div>
<?php endif; ?>
