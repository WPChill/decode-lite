<?php
/**
 * 
 * The template for displaying excerpts of content.
 *
 * @package Decode
 */
?>

	<?php tha_entry_before(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php tha_entry_top(); ?>

	<header class="entry-header">
			<?php if ( has_post_thumbnail() && get_theme_mod( 'show_featured_images_on_excerpts', false ) == true ) : ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
				<?php the_post_thumbnail(); ?>
			</a>
			<?php endif; ?>
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
		<?php if ( get_theme_mod( 'entry_date_position', 'below' ) == 'above' && get_theme_mod( 'show_entry_date_on_excerpts', false ) == true ) : ?>
		<div class="entry-meta">
			<p class="date"><?php decode_posted_on(); ?></p>
		</div>
		<?php endif; ?>
	</header><!-- .entry-header -->
	
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	
	<footer class="entry-footer">
		<a class="read-more-link" href="<?php echo get_permalink(); ?>"><?php _e( 'Read More&hellip;', 'decode' ); ?></a>
		
		<?php edit_post_link( __( 'Edit', 'decode' ), '<div class="edit-link">', '</div>' ); ?>
		
		<div class="entry-meta">
			<?php if ( get_theme_mod( 'entry_date_position', 'below' ) == 'below' && get_theme_mod( 'show_entry_date_on_excerpts', false ) == true ) : ?>
				<p class="date"><?php decode_posted_on(); ?></p>
			<?php endif; ?>
		</div>
	</footer><!-- .entry-footer -->
		
	<?php tha_entry_bottom(); ?>
</article><!-- #post-<?php the_ID(); ?> -->
	<?php tha_entry_after(); ?>