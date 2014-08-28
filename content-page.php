<?php
/**
 * The template used for displaying page content in page.php.
 *
 * @package Decode
 */
?>

	<?php tha_entry_before(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php tha_entry_top(); ?>
	
	<header class="entry-header">
		
		<h1 class="entry-title<?php if ( get_theme_mod( 'show_page_headers', true ) == false ) echo ' screen-reader-text' ?>"><?php the_title(); ?></h1>
		
	</header><!-- .entry-header -->

	<div class="entry-content">
	
		<?php the_content(); ?>
		
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'decode' ), 'after' => '</div>' ) ); ?>	
	
	</div><!-- .entry-content -->
	
	<?php edit_post_link( __( 'Edit', '_s' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer>' ); ?>
	
	<?php tha_entry_bottom(); ?>
</article><!-- #post-<?php the_ID(); ?> -->
	<?php tha_entry_after(); ?>