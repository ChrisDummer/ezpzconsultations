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



/**
 * TODO:
 * - Icons are not showing for me. Could be an issue with the plugin not enqueuing the css?
 * - Don't use px sizing here. Instead create some utility classes, based on the font sizes defined in font-size() map and use these
 * - Tidy up the ACF settings, they are in lower case. Need descriptions -- "Belts and Braces"
 * - Add in Block Title and Preamble (clone)
 * - Once this is working add to magic columns
 *
 */
wp_enqueue_script('favicon');

?>

<section <?php if ($block_id_opt = $block['section_id']) echo 'id="' . strtolower($block_id_opt) . '"'; ?> class="<?php echo $block_classes; ?>">
  <div class="<?php echo $container_class; ?>">

    <div class="row">
      <div class="col">
        <ul class="icon-list fa-ul">
          <?php
          foreach ($icons as $icon) {
            //var_dump($icon);
            echo '<li style="font-size: ' . $icon['size'] . 'px"><span class="fa-li"><i class="' . $icon['icon-selector'] . '"></i></span>' . $icon['text'] . '</li>';
          }

          ?>
        </ul>
      </div>
    </div>

  </div>
</section>
