<?php
/**
 *
 * The template for displaying content in search results.
 *
 * @package Decode
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<a class="search-entry" href="<?php the_permalink(); ?>">
		<?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
		
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
	</a>
	
	<?php edit_post_link( __( 'Edit', 'decode' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer>' ); ?>

</article><!-- #post-<?php the_ID(); ?> -->