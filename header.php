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
	
		<?php if (get_theme_mod( 'show_sidebar', true ) == true ) : ?>
		<img id="sidebar_link" class="SidebarLink <?php echo get_theme_mod( 'sidebar_button_position', 'left' );?>" src="<?php echo get_template_directory_uri(); ?>/images/menu.svg">
		<?php endif; ?>
		
		<div class="site-branding">
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			
			<?php if (get_theme_mod( 'html_description', '' ) !== '' ) : ?>
			<h2 class="site-description"><?php echo get_theme_mod( 'html_description' ); ?></h2>
			<?php elseif (get_theme_mod( 'html_description', '' ) == '' ) : ?>
			<h2 class="site-description"><?php echo get_bloginfo ( 'description' );?></h2>
			<?php endif; ?>
			
		</div>
		<?php if (get_theme_mod( 'show_social_icons', false ) == true ) : ?>
		<div class="sociallinks <?php echo get_theme_mod( 'show_social_icons', 'hidden' );?>">
			<ul>
				<?php if (get_theme_mod( 'adn_username', '' ) !== '' ) : ?>
				<a class="sociallink TwitterLink" href="https://alpha.app.net/<?php get_theme_mod( 'twitter_username' );?>">
				<img src="<?php echo get_template_directory_uri(); ?>/images/Twitter.svg" alt="Link to Twitter profile">
				</a>
				<?php endif; ?>

				<?php if (get_theme_mod( 'adn_username', '' ) !== '' ) : ?>
				<a class="sociallink ADNLink" href="https://alpha.app.net/<?php get_theme_mod( 'adn_username' );?>">
				<img src="<?php echo get_template_directory_uri(); ?>/images/ADN.svg" alt="Link to App dot net profile">
				</a>
				<?php endif; ?>

				<?php if (get_theme_mod( 'facebook_username', '' ) !== '' ) : ?>
				<a class="sociallink FacebookLink" href="https://facebook.com/<?php get_theme_mod( 'facebook_username' );?>">
				<img src="<?php echo get_template_directory_uri(); ?>/images/Facebook.svg" alt="Link to Facebook profile">
				</a>
				<?php endif; ?>

				<?php if (get_theme_mod( 'google_plus_username', '' ) !== '' ) : ?>
				<a class="sociallink GooglePlusLink" href="https://plus.google.com/u/0/<?php get_theme_mod( 'google_plus_username' );?>">
				<img src="<?php echo get_template_directory_uri(); ?>/images/GooglePlus.svg" alt="Link to Google Plus profile">
				</a>
				<?php endif; ?>
			</ul>
		</div>
		<?php endif; ?>

		<nav id="site-navigation" class="navigation-main" role="navigation">
			<div class="screen-reader-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'decode' ); ?>"><?php _e( 'Skip to content', 'decode' ); ?></a></div>

			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<?php if (get_theme_mod( 'show_sidebar', true ) == true ) : ?>
	<div id="sidebar" class="sidebar <?php echo get_theme_mod( 'sidebar_position', 'left' );?>">
		<div id="sidebar_top" class="SidebarTop"><img id="sidebar_close" class="SidebarClose" src="<?php echo get_template_directory_uri(); ?>/images/cross.svg"></div>
		<div class="SidebarContent">
			<?php get_sidebar(); ?>
		</div>
	</div>
	<?php endif; ?>

	<div id="main" class="site-main">
