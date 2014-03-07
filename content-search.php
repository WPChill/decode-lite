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
	
	<?php edit_post_link( __( 'Edit', '_s' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer>' ); ?>

</article><!-- #post-<?php the_ID(); ?> -->