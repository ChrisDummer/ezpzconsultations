<?php
/**
 * Functions which add features to the WYSIWIG editor
 *
 * @package ezpzconsultations
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;




if (! function_exists('ezpz_get_contrast_color') ) :

  function ezpz_get_contrast_color($hexColor, $blackColor = "#000000", $lightColor = "#ffffff") { //get-thed_field(text-color)

    // hexColor RGB
    $R1 = hexdec(substr($hexColor, 1, 2));
    $G1 = hexdec(substr($hexColor, 3, 2));
    $B1 = hexdec(substr($hexColor, 5, 2));

    // Black RGB
    $R2BlackColor = hexdec(substr($blackColor, 1, 2));
    $G2BlackColor = hexdec(substr($blackColor, 3, 2));
    $B2BlackColor = hexdec(substr($blackColor, 5, 2));

    // Calc contrast ratio
    $L1 = 0.2126 * pow($R1 / 255, 2.2) +
          0.7152 * pow($G1 / 255, 2.2) +
          0.0722 * pow($B1 / 255, 2.2);

    $L2 = 0.2126 * pow($R2BlackColor / 255, 2.2) +
          0.7152 * pow($G2BlackColor / 255, 2.2) +
          0.0722 * pow($B2BlackColor / 255, 2.2);

    $contrastRatio = 0;
    if ($L1 > $L2) {
        $contrastRatio = (int)(($L1 + 0.05) / ($L2 + 0.05));
    } else {
        $contrastRatio = (int)(($L2 + 0.05) / ($L1 + 0.05));
    }

    // If contrast is more than 5, return black color
    if ($contrastRatio > 2) {
        return $blackColor;
    } else {
        // if not, return white color.
        return $lightColor;
    }
  }
endif;

add_action( 'admin_head', 'ezpzconsultations_get_theme_colours' );
add_action( 'wp_head', 'ezpzconsultations_get_theme_colours' );


function getContrast50($hexcolor){
  return (hexdec($hexcolor) > 0xffffff/2) ? 'green':'green';
}




if (! function_exists('ezpzconsultations_get_theme_colours') ) :

  function ezpzconsultations_get_theme_colours() {

    if(function_exists('get_all_custom_field_meta')):
      $field_group_json = 'group_60c219d0bd368.json'; // Replace with the name of your field group JSON.
      $field_group_array = json_decode( file_get_contents( get_stylesheet_directory() . "/assets/acf-json/{$field_group_json}" ), true );
      $colour_options_data = get_all_custom_field_meta( 'option', $field_group_array );
    endif;

    // Main colours
    $theme_primary_colour = $colour_options_data['primary_colour'] ? $colour_options_data['primary_colour'] : '#ffffff';
    $theme_primary_dark = $colour_options_data['primary_colour_dark'] ? $colour_options_data['primary_colour_dark'] : '#fffffe';
    $theme_primary_light = $colour_options_data['primary_colour_light'] ? $colour_options_data['primary_colour_light'] : '#fffffd';
    $theme_secondary_colour = $colour_options_data['secondary_colour'] ? $colour_options_data['secondary_colour'] : '#fffffc';
    $theme_secondary_dark = $colour_options_data['secondary_colour_dark'] ? $colour_options_data['secondary_colour_dark'] : '#fffffb';
    $theme_secondary_light = $colour_options_data['secondary_colour_light'] ? $colour_options_data['secondary_colour_light'] : '#fffffa';
    $theme_text_colour = $colour_options_data['text_colour'] ? $colour_options_data['text_colour'] : '#fffffa';

    //Text Colours
    $theme_h1_colour = $colour_options_data['h1'] ? $colour_options_data['h1'] : '#fffffa';
    $theme_h2_colour = $colour_options_data['h2'] ? $colour_options_data['h2'] : '#fffffa';
    $theme_h3_colour = $colour_options_data['h3'] ? $colour_options_data['h3'] : '#fffffa';
    $theme_h4_colour = $colour_options_data['h4'] ? $colour_options_data['h4'] : '#fffffa';
    $theme_h5_colour = $colour_options_data['h5'] ? $colour_options_data['h5'] : '#fffffa';
    $theme_h6_colour = $colour_options_data['h6'] ? $colour_options_data['h6'] : '#fffffa';
    $theme_link_colour = $colour_options_data['link_colour'] ? $colour_options_data['link_colour'] : '#fffffa';
    $theme_link_active_colour = $colour_options_data['link_active_colour'] ? $colour_options_data['link_active_colour'] : '#fffffa';
    $theme_link_visited_colour = $colour_options_data['link_visited_colour'] ? $colour_options_data['link_visited_colour'] : '#fffffa';


    //Fonts
    $theme_body_font = $colour_options_data['body_font'] ? $colour_options_data['body_font'] : 'arial';
    $theme_h1_font = $colour_options_data['h1_font'] ? $colour_options_data['h1_font'] : 'arial';
    $theme_h2_font = $colour_options_data['h2_font'] ? $colour_options_data['h2_font'] : 'arial';
    $theme_h3_font = $colour_options_data['h3_font'] ? $colour_options_data['h3_font'] : 'arial';
    $theme_h4_font = $colour_options_data['h4_font'] ? $colour_options_data['h4_font'] : 'arial';
    $theme_h5_font = $colour_options_data['h5_font'] ? $colour_options_data['h5_font'] : 'arial';
    $theme_h6_font = $colour_options_data['h6_font'] ? $colour_options_data['h6_font'] : 'arial';

    // Navigation Elements
    $theme_nav_background_colour = $colour_options_data['nav_background_colour'] ? $colour_options_data['nav_background_colour'] : '#fffffa';
    $theme_nav_font = $colour_options_data['nav_font'] ? $colour_options_data['nav_font'] : 'arial';
    $theme_nav_link_colour = $colour_options_data['nav_link_colour'] ? $colour_options_data['nav_link_colour'] : '#fffffa';
    $theme_nav_link_hover_colour = $colour_options_data['nav_link_hover_colour'] ? $colour_options_data['nav_link_hover_colour'] : '#fffffa';
    $theme_nav_link_hover_background_color = $colour_options_data['nav_link_hover_background_color'] ? $colour_options_data['nav_link_hover_background_color'] : '#fffffa';
    $theme_nav_sublink_colour = $colour_options_data['nav_sublink_colour'] ? $colour_options_data['nav_sublink_colour'] : '#fffffa';
    $theme_nav_sublink_hover_colour = $colour_options_data['nav_sublink_hover_colour'] ? $colour_options_data['nav_sublink_hover_colour'] : '#fffffa';
    $theme_nav_sublink_background_colour = $colour_options_data['nav_sublink_background_colour'] ? $colour_options_data['nav_sublink_background_colour'] : '#fffffa';
    $theme_nav_sublink_hover_background_colour = $colour_options_data['nav_sublink_hover_background_colour'] ? $colour_options_data['nav_sublink_hover_background_colour'] : '#fffffa';
    $theme_navbar_break_point = $colour_options_data['navbar_break_point'] ? $colour_options_data['navbar_break_point'] : '900';

    //Button Elements
    $theme_button_border_width = $colour_options_data['button_border_width'] ? $colour_options_data['button_border_width'] : '2';
    $theme_button_border_radius = $colour_options_data['button_border_radius'] ? $colour_options_data['button_border_width'] : '10';
    $theme_button_font_family = $colour_options_data['button_font_family'] ? $colour_options_data['button_font_family'] : 'arial';


    //Card Elements
    $theme_card_border_radius = $colour_options_data['card_border_radius'] ? $colour_options_data['card_border_radius'] : '10';
    $theme_card_border_width = $colour_options_data['card_border_width'] ? $colour_options_data['card_border_width'] : '2';

    //Using the functions to convert to em or rem
    ?>
    <script>
      var navBarBreakPoint = <?php echo $theme_navbar_break_point ; ?>;
    </script>
    <?php
    //ezpzconsultations_px_convert($theme_navbar_break_point, 'em');
    ezpzconsultations_px_convert($theme_button_border_width);
    ezpzconsultations_px_convert($theme_button_border_radius);
    ezpzconsultations_px_convert($theme_card_border_radius);
    ezpzconsultations_px_convert($theme_card_border_width);



    $theme_bg_colors = array(
      '.bg-primary-colour' => $theme_primary_colour,
      '.bg-primary-dark' => $theme_primary_dark,
      '.bg-primary-light' => $theme_primary_light,
      '.bg-secondary-colour' => $theme_secondary_colour,
      '.bg-secondary-dark' => $theme_secondary_dark,
      '.bg-secondary-light' => $theme_secondary_light,
    );

    echo '<style>'; ?>

    :root {
      --primary_colour: <?php echo $theme_primary_colour; ?>;
      --primary_colour_dark: <?php echo $theme_primary_dark; ?>;
      --primary_colour_light: <?php echo $theme_primary_light; ?>;
      --secondary_colour: <?php echo $theme_secondary_colour; ?>;
      --secondary_colour_dark: <?php echo $theme_secondary_dark; ?>;
      --secondary_colour_light: <?php echo $theme_secondary_light; ?>;

      --text_colour: <?php echo $theme_text_colour; ?>;
      --h1_colour: <?php echo $theme_h1_colour; ?>;
      --h2_colour: <?php echo $theme_h2_colour; ?>;
      --h3_colour: <?php echo $theme_h3_colour; ?>;
      --h4_colour: <?php echo $theme_h4_colour; ?>;
      --h5_colour: <?php echo $theme_h5_colour; ?>;
      --h6_colour: <?php echo $theme_h6_colour; ?>;

      --link_colour: <?php echo $theme_link_colour; ?>;
      --link_active_colour: <?php echo $theme_link_active_colour; ?>;
      --link_visited_colour: <?php echo $theme_link_visited_colour; ?>;

      --body_font: <?php echo $theme_body_font; ?>;
      --h1_font: <?php echo $theme_h1_font; ?>;
      --h2_font: <?php echo $theme_h2_font; ?>;
      --h3_font: <?php echo $theme_h3_font; ?>;
      --h4_font: <?php echo $theme_h4_font; ?>;
      --h5_font: <?php echo $theme_h5_font; ?>;
      --h6_font: <?php echo $theme_h6_font; ?>;

      --nav_background_colour: <?php echo $theme_nav_background_colour; ?>;
      --nav_font: <?php echo $theme_nav_font; ?>;
      --nav_link_colour: <?php echo $theme_nav_link_colour; ?>;
      --nav_link_hover_colour: <?php echo $theme_nav_link_hover_colour; ?>;
      --nav_link_hover_background_color: <?php echo $theme_nav_link_hover_background_color; ?>;
      --nav_sublink_colour: <?php echo $theme_nav_sublink_colour; ?>;
      --nav_sublink_hover_colour: <?php echo $theme_nav_sublink_hover_colour; ?>;
      --nav_sublink_background_colour: <?php echo $theme_nav_sublink_background_colour; ?>;
      --nav_sublink_hover_background_colour: <?php echo $theme_nav_sublink_hover_background_colour; ?>;
      --nav_navbar_break_point: <?php echo $theme_navbar_break_point; ?>;

      --button_border_width: <?php echo $theme_button_border_width; ?>;
      --button_border_radius: <?php echo $theme_button_border_radius; ?>;
      --button_font_family: <?php echo $theme_button_font_family; ?>;

      --card_border_radius: <?php echo $theme_card_border_radius; ?>;
      --card_border_width: <?php echo $theme_card_border_width; ?>;



      --light: #ffffff;
      --dark: #000000;
      }

      <?php
      foreach($theme_bg_colors as $css_class => $bg_color ){

          if($theme_h1_colour) { ?>
            <?php echo $css_class; ?> h1 {
              color: <?php echo ezpz_get_contrast_color($bg_color, $theme_h1_colour); ?>
            }

          <?php if($theme_h2_colour) { ?>
            <?php echo $css_class; ?> h2 {
              color: <?php echo ezpz_get_contrast_color($bg_color, $theme_h2_colour); ?>
            }
          <?php }

          if($theme_h3_colour) { ?>
            <?php echo $css_class; ?> h3 {
              color: <?php echo ezpz_get_contrast_color($bg_color, $theme_h3_colour); ?>
            }
          <?php }

        if($theme_h4_colour) { ?>
          <?php echo $css_class; ?> h4 {
            color: <?php echo ezpz_get_contrast_color($bg_color, $theme_h4_colour); ?>
          }
        <?php }

        if($theme_h5_colour) { ?>
          <?php echo $css_class; ?> h5 {
            color: <?php echo ezpz_get_contrast_color($bg_color, $theme_h5_colour); ?>
          }
        <?php }

        if($theme_h6_colour) { ?>
          <?php echo $css_class; ?> h6 {
            color: <?php echo ezpz_get_contrast_color($bg_color, $theme_h6_colour); ?>
          }
        <?php }

        if($theme_link_colour) { ?>
          <?php echo $css_class; ?> a {
            color: <?php echo ezpz_get_contrast_color($bg_color, $theme_link_colour); ?>
          }
        <?php }

        if($theme_link_active_colour) { ?>
          <?php echo $css_class; ?> a:active {
            color: <?php echo ezpz_get_contrast_color($bg_color, $theme_link_active_colour); ?>
          }
        <?php }

        if($theme_link_visited_colour) { ?>
          <?php echo $css_class; ?> a:visited {
            color: <?php echo ezpz_get_contrast_color($bg_color, $theme_link_visited_colour); ?>
          }
        <?php }

        }
      }

    echo '</style>';

    ?>

  <?php
  }
endif;
