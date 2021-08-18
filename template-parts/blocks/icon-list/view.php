<?php
/**
 * Flexible layout: Image block
 * Renders an image block
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

$icon = $block['icon'];


?>

<section <?php if($block_id_opt = $block['section_id']) echo 'id="'.strtolower($block_id_opt).'"'; ?> class="<?php echo $block_classes;?>">
  <div class="<?php echo $container_class;?>">

    <div class="row">
      <div class="col">
        <ul class="faviconList">
        <?php
          foreach($icon as $icon){

            echo '<li style="font-size: ' . $icon['size'] . 'px"><i class="' . $icon['icon-selector'] . '"></i>  ' . $icon['text'] . '</li>';
          }

        ?>
        </ul>
      </div>
    </div>

  </div>
</section>
