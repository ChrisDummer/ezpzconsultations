<?php
/**
 * Template part for displaying a timeline item
 *
 * @package ezpzconsultations
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$time_title =  $args['time_title'];
$time_text =  $args['time_text'];
$count =  $args['count'];
$date_unixtime =   strtotime($args['date']);
$date_now = time();
$magic = $args['magic_columns'];

$date_formatted = date_i18n(get_option( 'date_format' ), $date_unixtime); // Format for WP
$time_class = 'time-container';

//Creating the week diffrence
// TODO: See if you can make this a bit neater and avoid repetition

$one_week = 604800;
$two_week = $one_week * 2;
$four_week = $one_week * 4;
$six_week = $one_week * 6;
$eight_week = $one_week * 8;
$ten_week = $one_week * 10;
$twelve_week = $one_week * 12;

$two_week_date = $date_now - $two_week;
$four_week_date = $date_now - $four_week;
$six_week_date = $date_now - $six_week;
$eight_week_date = $date_now - $eight_week;
$ten_week_date = $date_now - $ten_week;
$twelve_week_date = $date_now - $twelve_week;


if ($twelve_week_date >= $date_unixtime)
  $time_class = $time_class . ' opacityThree';

elseif ($ten_week_date >= $date_unixtime)
  $time_class = $time_class . ' opacityFour';

elseif ($eight_week_date >= $date_unixtime)
  $time_class = $time_class . ' opacityFive';

elseif ($six_week_date >= $date_unixtime)
  $time_class = $time_class . ' opacitySix';

elseif ($four_week_date >= $date_unixtime)
  $time_class = $time_class . ' opacitySeven';

elseif ($two_week_date >= $date_unixtime)
  $time_class = $time_class . ' opacityEight';

elseif ($date_now >= $date_unixtime)
  $time_class = $time_class . ' opacityNine';

if($magic):
  // TODO: Remove this please - avoid inline styles wherever possible

  echo '<style>
    .block__magic-columns .time-container{
      width: 100%;
    }

    .block__magic-columns .timeline:after{
      left: 0;
    }

    .block__magic-columns .right{
      left: 0;
    }
  </style>

  <div class="' . $time_class . ' right">';


endif;

if(!$magic):

  if($count % 2 == 0  ){
    echo'   <div class="' . $time_class . ' left">';
  }
  else{
  echo'   <div class="' . $time_class . ' right">';
  }

endif;

?>

  <div class="content">
    <h3><?php echo $date_formatted ?></h3>
    <strong><?php echo $time_title ?></strong>
    <p><?php echo $time_text ?></p>
  </div>
</div>
