<?php
/**
 * The header for the theme.
 *
 * Displays all of the <head> section and everything up till <div id="content" class="site-content">
 *
 * @package Decode
 */
?>
<!DOCTYPE html>
<?php tha_html_before(); ?>
<html <?php language_attributes(); ?>>
<head>
<?php tha_head_top(); ?>

<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php if ( get_background_image() ) { echo '<link rel="prefetch" href="' . get_background_image() . '">'; } ?>

<?php tha_head_bottom(); ?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php tha_body_top(); ?>

<div id="page" class="hfeed site">
	
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'decode' ); ?></a>
	
		<?php function decode_create_sidebar_link() {
			if ( get_theme_mod( 'show_sidebar', true ) == true ) : ?>
			<button id="sidebar-link" class="sidebar-link SidebarLink <?php echo get_theme_mod( 'sidebar_button_position', 'left' );?>" title="<?php esc_attr_e( 'Show sidebar', 'decode' )?>">
				<svg width="100%" height="100%" viewBox="0 0 240 200" version="1.1" xmlns="http://www.w3.org/2000/svg">
					<g class="menu-icon" fill-rule="evenodd">
						<path d="M0,160 L0,200 L240,200 L240,160 L0,160 Z M0,160"></path>
						<path d="M0,80 L0,120 L240,120 L240,80 L0,80 Z M0,80"></path>
						<path d="M0,0 L0,40 L240,40 L240,0 L0,0 Z M0,0"></path>
					</g>
				</svg>
			</button>
			<?php endif;
		}?>
	<?php add_action( 'tha_header_before', 'decode_create_sidebar_link' ); ?>
	
	<?php tha_header_before(); ?>
	<?php if ( get_theme_mod( 'constant_sidebar', 'closing' ) == 'constant' && get_theme_mod( 'show_sidebar', true ) == true ) { echo '<div class="site-scroll">'; } ?>
	<header id="masthead" class="site-header" role="banner" style="<?php if( get_theme_mod( 'decode_pro_header_image_background', '' ) ): ?>background-image: url(<?php echo esc_url( get_theme_mod( 'decode_pro_header_image_background', '' ) ); ?>); border-bottom: 0;<?php endif; ?><?php if( get_theme_mod( 'decode_pro_enable_parallax', true ) == true ): ?>background-position: center center; background-attachment: fixed; -webkit-background-size: cover; -moz-background-size: cover; -ms-background-size: cover; background-size: cover;<?php endif; ?>">
		<?php tha_header_top(); ?>

		<?php do_action( 'header_menu_top' ); ?>
		
		<div class="site-branding">
				
				<?php function decode_create_header_image() {
					// If Jetpack's site logo exists, give it preference over Decode's.
					if ( function_exists( 'jetpack_the_site_logo' ) ) :
						jetpack_the_site_logo();
					// If no Jetpack site logo exists, use Decode's logo, if avaliable.
					elseif ( get_header_image() != '' ) : ?>
						<a class="site-logo-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
							<img class="site-logo" src="<?php header_image(); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" alt="">
						</a>
					<?php endif;
				}
				add_action( 'decode_header_image', 'decode_create_header_image' ); ?>
			<?php decode_header_image(); ?>
				
			<?php if ( get_theme_mod( 'show_site_title', true ) == true ) : ?>			
				<h1 class="site-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				</h1>
			<?php endif; ?>
			
			<?php if ( get_theme_mod( 'show_site_description', true ) == true ) : ?>
				<?php if ( get_theme_mod( 'html_description', '' ) !== '' ) : ?>
				<h2 class="site-description"><?php echo decode_sanitize_html( get_theme_mod( 'html_description' ) ); ?></h2>
				<?php elseif ( get_theme_mod( 'html_description', '' ) == '' ) : ?>
				<h2 class="site-description"><?php echo esc_html( get_bloginfo( 'description' ) );?></h2>
				<?php endif; ?>
			<?php endif; ?>
			
		</div><!-- .site-branding -->
		
		<?php if ( get_theme_mod( 'show_header_social_icons', false ) == true ) {
			get_template_part( 'social-links' );
		} ?>

		<?php do_action( 'header_menu_bottom' ); ?>
		
		<?php tha_header_bottom(); ?>
		
	</header><!-- #masthead -->
	
		<?php tha_header_after(); ?>
	
		<?php if ( (function_exists( 'bcn_display' ) || function_exists( 'breadcrumb_trail' )) && ! is_front_page() ) : ?>
		
			<nav class="site-breadcrumbs" role="navigation">
				
				<div class="site-breadcrumbs-container">
				
				<?php if ( function_exists( 'bcn_display' ) ) {
					bcn_display();
				}
		
				if ( function_exists( 'breadcrumb_trail' ) ) {
					breadcrumb_trail();
				} ?>
				
				</div>
				
			</nav><!-- .breadcrumbs -->
			
		<?php endif; ?>

	<div id="content" class="site-content <?php if( get_theme_mod( 'center_content_mobile', false ) ): echo 'center-content-mobile'; endif; ?>">
		<?php tha_content_top(); ?>
