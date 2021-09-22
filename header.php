<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ezpzconsultations
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

?>
<!doctype html>
<html <?php language_attributes(); ?>>


<head>
  <?php
  if (function_exists('get_all_custom_field_meta')) :
    $field_group_json = 'group_60c219d0bd368.json'; // Replace with the name of your field group JSON.
    $field_group_array = json_decode(file_get_contents(get_stylesheet_directory() . "/assets/acf-json/{$field_group_json}"), true);
    $theme_options = get_all_custom_field_meta('option', $field_group_array);
  endif;


  ?>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="profile" href="https://gmpg.org/xfn/11">

  <?php
  // TODO: these are better hooking into wp_head. Can you add them to the theme-settings function?
  $custom_css = $theme_options['custom_css'];
  $font_links = $theme_options['font_links'];
  $header_picker = $theme_options['header_picker'];

  if ($custom_css) echo '<style>' . $custom_css . '</style>';
  if ($font_links) echo $font_links;
  wp_head();

  //Changing the look of the header depending on what option they select

  $nav_logo = 'site-logo navbar-item';
  $nav_menu = 'navbar-menu';
  $nav_brand = 'navbar-brand site-branding';

  if ($header_picker == 'Option 2') {
    $nav_logo = $nav_logo . ' center-logo';
    $nav_menu = $nav_menu . ' center-menu';
    $nav_brand = $nav_brand . ' center-brand';
  }
  ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>
  <div id="page" class="site">

    <?php if (!is_page_template('page-simple.php')) : ?>

      <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'ezpzconsultations'); ?></a>

      <header id="masthead" class="site-header">
        <nav id="site-navigation" class="navbar main-navigation">
          <div class="container">
            <div class="<?php echo $nav_brand; ?>">

              <?php if ($logo_image = $theme_options['main_logo']) : ?>
                <a class="<?php echo $nav_logo ?>" href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                  <?php echo wp_get_attachment_image($logo_image, 'site_logo'); ?>
                </a>
              <?php endif; ?>

              <button class="hamburger" type="button" aria-label="Menu" aria-controls="navbar-menu" aria-expanded="false">
                <span class="hamburger-box">
                  <span class="hamburger-inner"></span>
                </span>
              </button>
            </div>

            <div id="navbar-menu" class="<?php echo $nav_menu; ?>">

              <div class="navbar-end">
                <?php
                wp_nav_menu(array(
                  'theme_location' => 'menu-primary',
                  'menu_id'        => 'primary-menu',
                  'container'      => false,
                ));
                ?>
              </div>
            </div>
          </div>
        </nav>
      </header>
    <?php endif; ?>
    <div id="content" class="site-content">
