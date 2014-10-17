<?php
/**
 * The template for displaying all single posts.
 *
 * @package Decode
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', 'single' ); ?>
		
		 <?php
		 		// If comments are open or we have at least one comment, load up the comment template.
		 		if ( comments_open() || get_comments_number() ) {
		 			comments_template();
		 		}
		 ?>

	<?php endwhile; // end of the loop. ?>

	</main><!-- #main -->
	
	<?php decode_post_nav(); ?>

</div><!-- #primary -->

<?php get_footer(); ?>