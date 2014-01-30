<?php
/**
 * @package Decode
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( has_post_thumbnail() && get_theme_mod( 'show_featured_images_on_excerpts', false ) == true ) : ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
			<?php the_post_thumbnail(); ?>
		</a>
		<?php endif; ?>
		<div class="entry-title"><h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2></div>
		<?php if ( get_theme_mod( 'entry_date_position', 'below' ) == 'above' && get_theme_mod( 'show_entry_date_on_excerpts', false ) == true ) : ?>
		<div class="entry-meta above-content">
			<p class="date"><?php decode_posted_on(); ?></p>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->
	
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	
	<footer class="entry-meta">
	<a class="read-more-link" href="<?php echo get_permalink(); ?>"><?php _e('Read More&hellip;', 'decode'); ?></a>
	<?php edit_post_link( __( 'Edit', 'decode' ), '<div class="edit-link">', '</div>' ); ?>
	<?php if ( get_theme_mod( 'entry_date_position', 'below' ) == 'below' && get_theme_mod( 'show_entry_date_on_excerpts', false ) == true ) : ?>
			<p class="date"><?php decode_posted_on(); ?></p>
		<?php endif; ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->