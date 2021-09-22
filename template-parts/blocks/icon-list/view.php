<?php

/**
 * Flexible layout: Icon List
 * Renders a list of icons, styled with Font Awesome
 *
 * @package ezpzconsultations
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

// Get Params from get_template_part:
$block = $args['block'];
$block_id = $args['block_id'];
$block_classes = $args['block_classes'];
$container_class = 'container';
//var_dump($block);

$icons = $block['icon'];

wp_enqueue_style('font-awesome');

?>

<section <?php if ($block_id_opt = $block['section_id']) echo 'id="' . strtolower($block_id_opt) . '"'; ?> class="<?php echo $block_classes; ?>">
  <div class="<?php echo $container_class; ?>">

    <div class="row">
      <div class="col">
        <?php
        $icon_size = 'icon-list-size-' . $block['icon_size'];
        foreach ($icons as $icon) {
          echo '<ul class="icon-list-section-ul ' . $icon_size . '"><li><span class="fa-li"><i class="' . $icon['icon-selector'] . '"></i></span>' . $icon['text'] . '</li></ul>';
        }

        ?>
      </div>
    </div>

  </div>
</section>
