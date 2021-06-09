<?php
/**
 * Flexible layout: Countdown
 * Allows the editor to add a countdown to a specified date/time
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
$complete_text = $block['complete_text'];
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

  <?php if($countdown = $block['countdown_to']):
        $countdown_id = 'countdown-'.$block_id;
        $countdown_tz = $block['time_zone'];
        $countdown = $countdown.' '.$countdown_tz;
        // eg. 'November 4 2020 18:00:00 GMT+0000'
    ?>
    <div class="row justify-center text-<?php echo $title_align;?>">
      <div class="col md-10 lg-8">
        <div id="<?php echo $countdown_id;?>" class="countdown<?php if($complete_text) echo ' has-complete-text';?>">
          <div class="partial">
            <div class="value days">00</div>
            <div class="small"><?php _e('Days', 'ezpzconsultations');?></div>
          </div>
          <div class="partial">
            <div class="value hours">00</div>
            <div class="small"><?php _e('Hours', 'ezpzconsultations');?></div>
          </div>
          <div class="partial">
            <div class="value minutes">00</div>
            <div class="small"><?php _e('Minutes', 'ezpzconsultations');?></div>
          </div>
          <div class="partial">
            <div class="value seconds">00</div>
            <div class="small"><?php _e('Seconds', 'ezpzconsultations');?></div>
          </div>
          <?php if($complete_text) echo '<div class="partial complete-text">'.ezpzconsultations_content($complete_text).'</div>'; ?>
        </div>
      </div>
    </div>
  <?php endif; ?>

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

  </div>
</section>

<?php if($countdown) {
  add_action('wp_footer',
  ezpzconsultations_countdown_init($countdown_id, $countdown),
  30); // 30 priority ensures it is placed below the enqueued scripts (priority 20)
} ?>
