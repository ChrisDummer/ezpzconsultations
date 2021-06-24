<?php
/**
 * Flexible layout: Slider
 * Allows the editor to add a slider to the post with slides containing
 * an image, text, optional heading and link.
 *
 * @package ezpzconsultations
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Get Params from get_template_part:

$block = $args['block'];
$block_id = $args['block_id'];
$block_classes = $args['block_classes'];
$time_lines = $block['time_lines'];

$i = 0;
?>

<section <?php if($block_id_opt = $block['section_id']) echo 'id="'.strtolower($block_id_opt).'"'; ?> class="<?php echo $block_classes;?>">
  <div class="container">
      <div class="row">
        <div class="col">
          <div class="timeline">
          <?php
            foreach ($time_lines as $time_line):

              $date = $time_line['date'];
              $time_title = $time_line['time_title'];
              $time_text = $time_line['time_text'];

              $time_params = array(
                'slide' => $slide,
                'block_id' => $block_id,
                'count' => $i,
                'slide_class' => $slide_class,
                'time_title' => $time_title,
                'time_text' => $time_text,
                'date' => $date,

              );
              get_template_part( 'template-parts/components/time-line/time', 'basic', $time_params );
              $i++;
            endforeach;
          ?>
          </div>
        </div>
      </div>
  </div>
</section>
