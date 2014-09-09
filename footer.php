<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Decode
 */
?>

	<?php tha_content_bottom(); ?>
</div><!-- #content -->
	<?php tha_content_after(); ?>

	<?php tha_footer_before(); ?>
<footer id="colophon" class="site-footer" role="contentinfo">
	<?php tha_footer_top(); ?>

	<?php
	if ( get_theme_mod( 'show_footer_social_icons', false ) == true ) {
		get_template_part( 'social-links' );
	}

	if ( has_nav_menu( 'footer-menu' ) ) {
		wp_nav_menu( array(
			'theme_location' => 'footer-menu',
			'container'      => false,
			'menu_class'     => 'menu horizontal-menu footer-menu',
			'menu_id'        => 'footer-menu',
			'fallback_cb'     => false,
			'items_wrap'     => '<nav id="%1$s" class="%2$s" role="navigation"><ul>%3$s</ul></nav><!-- #footer-menu -->',
		) ); 
	}
	?>

	<?php if ( get_theme_mod( 'site_colophon', '' ) !== '' ) : ?>
	<div class="site-colophon">
		<p><?php echo get_theme_mod( 'site_colophon' ); ?></p>
	</div><!-- .site-colophon -->
	<?php endif; ?>
	
	<?php if ( get_theme_mod( 'show_theme_info', true ) == true ) : ?>
	<div class="theme-info">
		<p><?php printf( __( '%1$s by %2$s', 'decode' ), '<a href="' . esc_url( 'http://ScottHSmith.com/projects/decode/' ) . '" rel="designer">Decode</a>', 'Scott Smith' ) ?></p>
	</div><!-- .theme-info -->
	<?php endif; ?>
	
	<?php tha_footer_bottom(); ?>
</footer><!-- #colophon -->
<?php if ( get_theme_mod( 'constant_sidebar', 'closing' ) == 'constant' && get_theme_mod( 'show_sidebar', true ) == true ) { echo '</div><!-- .site-scroll -->'; } ?>
	<?php tha_footer_after(); ?>
</div><!-- #page -->


<?php if ( get_theme_mod( 'show_sidebar', true ) == true ) : ?>
	<?php get_sidebar(); ?>
<?php endif; ?>
<!-- #sidebar -->

<?php tha_body_bottom(); ?>
<?php wp_footer(); ?>

</body>
</html>