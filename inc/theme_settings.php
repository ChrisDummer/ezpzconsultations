<?php
/**
 * Functions which add features to the WYSIWIG editor
 *
 * @package ezpzconsultations
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

function getContrastColor($hexColor, $blackColor = "#000000")
{

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
        if ($contrastRatio > 5) {
            return $blackColor;
        } else { 
            // if not, return white color.
            return '#FFFFFF';
        }
}

// Will return '#FFFFFF'



if (! function_exists('ezpzconsultations_get_theme_colours') ) :
  
  function ezpzconsultations_get_theme_colours()
  {

  $field_group_json = 'group_60c219d0bd368.json'; // Replace with the name of your field group JSON.
  $field_group_array = json_decode( file_get_contents( get_stylesheet_directory() . "/assets/acf-json/{$field_group_json}" ), true );
  $colour_options_data = get_all_custom_field_meta( 'option', $field_group_array );
   
    ?>
    <style>
    :root {
  --primary_colour: <?php echo $colour_options_data['primary_colour']; ?>;
  --primary_colour_dark: <?php echo $colour_options_data['primary_colour_dark']; ?>;
  --primary_colour_light: <?php echo $colour_options_data['primary_colour_light']; ?>;
  --secondary_colour: <?php echo $colour_options_data['secondary_colour']; ?>;
  --secondary_colour_dark: <?php echo $colour_options_data['secondary_colour_dark']; ?>;
  --secondary_colour_light: <?php echo $colour_options_data['secondary_colour_light']; ?>;
  --text_colour: <?php echo $colour_options_data['text_colour']; ?>;
  
  --light: #ffffff;
  --dark: #000000;
  }

  .bg-primary-colour{
    color: <?php echo getContrastColor($colour_options_data['primary_colour'], '#eded97'); ?>;
    
  }

  .bg-primary-colour h1, h2, h3, h4, h5,h6, p, span{
    color: <?php echo getContrastColor($colour_options_data['primary_colour'], '#eded97'); ?>;
  }

  .bg-primary-dark{
    color: <?php echo getContrastColor($colour_options_data['primary_colour_dark'], '#eded97'); ?>;
    
  }

  .bg-primary-dark h1, h2, h3, h4, h5,h6, span{
    color: <?php echo getContrastColor($colour_options_data['primary_colour_dark'], '#eded97'); ?>;
  }

  .bg-primary-light{

    color: <?php echo getContrastColor($colour_options_data['primary_colour_light']); ?>;
  } 

  .bg-primary-light h1, h2, h3, h4, h5,h6, p, span{
    color: <?php echo getContrastColor($colour_options_data['primary_colour_light']); ?>;
  }

  .bg-secondary-colour{
    color: <?php echo getContrastColor($colour_options_data['secondary_colour_dark'], '#eded97'); ?>;
    
  }

  .bg-secondary-colour h1, h2, h3, h4, h5,h6, p, span{
    color: <?php echo getContrastColor($colour_options_data['secondary_colour_dark'], '#eded97'); ?>;
  }

  .bg-secondary-dark{
    color: <?php echo getContrastColor($colour_options_data['secondary_colour_dark'], '#eded97'); ?>;
    
  }

  .bg-secondary-dark h1, h2, h3, h4, h5,h6, p, span{
    color: <?php echo getContrastColor($colour_options_data['secondary_colour_dark'], '#eded97'); ?>;
  }

  .bg-secondary-light{
    color: <?php echo getContrastColor($colour_options_data['secondary_colour_light'], '#eded97'); ?>;
    
  }

  .bg-secondary-light h1, h2, h3, h4, h5,h6, p, span{
    color: <?php echo getContrastColor($colour_options_data['secondary_colour_light'], '#eded97'); ?>;
  }

  .bg-white{
    color: black;
    
  } 

  .bg-white h1, h2, h3, h4, h5,h6, p, span{
    color: black;
  }

  .bg-black{
    color: white;
    
  } 

  .bg-black h1, h2, h3, h4, h5,h6, p, span{
    color: white;
  }
  
  </style>
  <?php
  }
endif;


  

add_action( 'admin_head', 'ezpzconsultations_get_theme_colours' );
add_action( 'wp_head', 'ezpzconsultations_get_theme_colours' );
