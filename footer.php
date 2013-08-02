<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Decode
 */
?>

	 </div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php if (get_theme_mod( 'show_theme_info', true ) == true ) : ?>
		<div class="theme-info">
			<p><a href="http://ScottHSmith.com/projects/decode/">Decode</a> by Scott Smith</p>
		</div><!-- .theme-info -->
		<?php endif; ?>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>