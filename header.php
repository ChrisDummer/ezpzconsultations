<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package jellypress
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'jellypress' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-branding">
      <!-- Website logo here. See underscores @ https://github.com/Automattic/_s for how to allow customisation -->
    </div><!-- .site-branding -->

    <button id="nav-hamburger" class="hamburger" type="button" aria-label="Menu" aria-expanded="false" aria-controls="primary-menu">
        <span class="hamburger-wrapper">
          <span class="hamburger-label">Menu</span>
          <span class="hamburger-box">
          <span class="hamburger-inner"></span>
        </span>
    </button>
		<nav id="site-navigation" class="main-navigation nav-bar" aria-label="Navigation" >
			<?php
			wp_nav_menu( array(
				'theme_location' => 'menu-primary',
        'menu_id'        => 'primary-menu',
        'menu_class' => 'container nav-bar-inner',
			) );
			?>
    </nav><!-- #site-navigation -->

	</header><!-- #masthead -->

	<div id="content" class="site-content">
