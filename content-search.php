<?php
/**
 * @package Decode
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<a class="search-entry" href="<?php the_permalink(); ?>">
		<div class="entry-title">
			<h3><?php the_title(); ?></h3>
		</div>
		
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
	</a>
	<footer class="entry-meta">
		<?php edit_post_link( __( 'Edit', 'decode' ), '<div class="edit-link">', '</div>' ); ?>
	</footer>

</article><!-- #post-<?php the_ID(); ?> -->