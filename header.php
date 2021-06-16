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
defined( 'ABSPATH' ) || exit;

?>
<!doctype html>
<html <?php language_attributes(); ?>>


<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="profile" href="https://gmpg.org/xfn/11">

 <?php

  //For the logo
  $field_group_json = 'group_60c20bdd95608.json'; // Replace with the name of your field group JSON.
  $field_group_array = json_decode( file_get_contents( get_stylesheet_directory() . "/assets/acf-json/{$field_group_json}" ), true );
  $logo_data = get_all_custom_field_meta( 'option', $field_group_array );

  $logo_image = $logo_data['main_logo'];
  ?>

  <?php
   wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>
  <div id="page" class="site">

<?php if ( !is_page_template( 'page-simple.php' ) ) : ?>

  <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'ezpzconsultations' ); ?></a>

    <header id="masthead" class="site-header">
      <nav id="site-navigation" class="navbar main-navigation">
        <div class="container">
          <div class="navbar-brand site-branding">


            <!-- EXAMPLE OF EMBEDDING CLIENT LOGO -->
            <a class="site-logo navbar-item" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
              <?php echo wp_get_attachment_image( $logo_image, 'thumbnail' ); ?>
            </a>

            <button class="hamburger" type="button" aria-label="Menu" aria-controls="navbar-menu" aria-expanded="false">
              <span class="hamburger-label">Menu</span>
              <span class="hamburger-box">
                <span class="hamburger-inner"></span>
              </span>
            </button>

            </div>

            <div id="navbar-menu" class="navbar-menu">

              <div class="navbar-end">
                <?php
                  wp_nav_menu( array(
                    'theme_location' => 'menu-primary',
                    'menu_id'        => 'primary-menu',
                    'container'      => false,
                  ) );
                ?>
              </div>
            </div>
          </div>
      </nav>
    </header>
<?php endif; ?>
    <div id="content" class="site-content">
