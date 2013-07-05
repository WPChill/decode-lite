<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Decode
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, user-scalable = no">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header" role="banner">
		<img id="sidebar_link" class="SidebarLink <?php echo get_theme_mod( 'sidebar_button_position' );?> <?php echo get_theme_mod( 'show_sidebar' );?>" src="<?php echo get_template_directory_uri(); ?>/images/menu.svg">
		<div class="site-branding">
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php echo get_theme_mod( 'use_html_in_description', '' ); ?></h2>
		</div>
		<div class="sociallinks <?php echo get_theme_mod( 'show_social_icons' );?>">
			<ul> 
				<a class="sociallink TwitterLink <?php echo get_theme_mod( 'show_twitter' );?>" <?php echo 'href=https://twitter.com/' .get_theme_mod( 'twitter_username' )."\n";?>>
					<img src="<?php echo get_template_directory_uri(); ?>/images/Twitter.svg" alt="Link to Twitter profile">
				</a>
				<a class="sociallink AppNetLink <?php echo get_theme_mod( 'show_adn' );?>" <?php echo 'href=https://alpha.app.net/' .get_theme_mod( 'adn_username' )."\n";?>>
					<img src="<?php echo get_template_directory_uri(); ?>/images/ADN.svg" alt="Link to App dot net profile">
				</a>
				<a class="sociallink FacebookLink <?php echo get_theme_mod( 'show_facebook' );?>" <?php echo 'href=https://facebook.com/' .get_theme_mod( 'facebook_username' )."\n";?>>
					<img src="<?php echo get_template_directory_uri(); ?>/images/Facebook.svg" alt="Link to Facebook profile">
				</a>
			</ul>
		</div>

		<nav id="site-navigation" class="navigation-main" role="navigation">
			<div class="screen-reader-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'decode' ); ?>"><?php _e( 'Skip to content', 'decode' ); ?></a></div>

			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="sidebar" class="sidebar <?php echo get_theme_mod( 'sidebar_position' );?> <?php echo get_theme_mod( 'show_sidebar' );?>">
		<div id="sidebar_top" class="SidebarTop"><img id="sidebar_close" class="SidebarClose" src="<?php echo get_template_directory_uri(); ?>/images/cross.svg"></div>
		<div class="SidebarContent">
			<?php get_sidebar(); ?>
		</div>
	</div>

	<div id="main" class="site-main">
