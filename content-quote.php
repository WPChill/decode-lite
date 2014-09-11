<?php
/**
 *
 * The template for displaying quote post formats.	
 *
 * @package Decode
 */
?>

	<?php tha_entry_before(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php tha_entry_top(); ?>
	
	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'decode' ) ); ?>
	</div><!-- .entry-content -->
	
	<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'decode' ), 'after' => '</div>' ) ); ?>
	
	<footer class="entry-footer">
		<?php if ( get_theme_mod( 'enable_comments', true ) == true && ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
			<div class="comments-link <?php echo get_theme_mod( 'enable_comments', '' ); ?>"><?php comments_popup_link( __( 'Leave a comment', 'decode' ), __( '1 Comment', 'decode' ), __( '% Comments', 'decode' ) ); ?></div>
		<?php endif; ?>
		
		<?php edit_post_link( __( 'Edit', 'decode' ), '<span class="edit-link">', '</span>' ); ?>
		
		<div class="entry-meta">
			<?php if ( get_theme_mod( 'show_tags', false ) == true ) : ?>
				<p class="tags"><?php the_tags( __( 'Tagged as: ', 'decode' ),', ' ); ?></p>
			<?php endif; ?>
			<?php if ( get_theme_mod( 'show_categories', false ) == true ) : ?>
				<p class="categories"><?php _e( 'Categorized in&#58; ', 'decode' )  . the_category( ', ' ); ?></p>
			<?php endif; ?>
			<p class="date"><?php decode_posted_on(); ?></p>
		</div>
	</footer><!-- .entry-footer -->
	
	<?php tha_entry_bottom(); ?>
</article><!-- #post-<?php the_ID(); ?> -->
	<?php tha_entry_after(); ?>