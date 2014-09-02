<?php
/**
 * @package Decode
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * @uses decode_admin_header_style()
 * @uses decode_admin_header_image()
 */

if ( ! function_exists( 'decode_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 */
function decode_admin_header_style() {
?>
	<style type="text/css">
		.decode-custom-header-preview.site-branding {
			text-align: center;
			font-size: 1rem;
			padding: 1%;
			color: <?php echo get_theme_mod( 'text_color', '#444444' ); ?>;
			background: #<?php echo get_theme_mod( 'background_color', 'E3E5E7' ); ?>;
		}
		
		.decode-custom-header-preview .site-logo {
			transition: opacity 0.5s ease-out;
			margin: 0 auto 2%;
			max-height: 8.5em;
			width: auto;
			opacity: 1;
			-webkit-user-drag: none;
			user-drag: none;
		}
		
		.decode-custom-header-preview .site-title {
			margin: 0 0 0.5%;
			line-height: 1;
			text-align: center;
			word-wrap: break-word;
			overflow-wrap: break-word;
		}
		
		.decode-custom-header-preview .site-title a {
			transition: text-shadow 0.5s;
			font-size: 1.95em;
			font-weight: normal;
			color: <?php echo get_theme_mod( 'text_color', '#444444' ); ?>;
			text-decoration: none;
			-webkit-font-smoothing: subpixel-antialiased;
		}
				
		.decode-custom-header-preview .site-description {
			text-align: center;
			margin-bottom: 0.75%;
		}
	</style>
<?php
}
endif; // decode_admin_header_style

if ( ! function_exists( 'decode_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 */
function decode_admin_header_image() {
?>

<div class="decode-custom-header-preview site-branding">

	<?php if ( get_header_image() != '' ) : ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			<img class="site-logo" src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="100%" alt="" />
		</a>
	<?php endif; ?>
	
	<?php if ( get_theme_mod( 'show_site_title', true ) == true ) : ?>			
		<h1 class="site-title">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
		</h1>
	<?php endif; ?>
	
	<?php if ( get_theme_mod( 'show_site_description', true ) == true ) : ?>
		<?php if ( get_theme_mod( 'html_description', '' ) !== '' ) : ?>
		<h2 class="site-description"><?php echo get_theme_mod( 'html_description' ); ?></h2>
		<?php elseif ( get_theme_mod( 'html_description', '' ) == '' ) : ?>
		<h2 class="site-description"><?php echo get_bloginfo( 'description' );?></h2>
		<?php endif; ?>
	<?php endif; ?>
	
</div>

<?php
}
endif; // decode_admin_header_image