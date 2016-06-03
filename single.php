<?php

/**

 * The template for displaying all single posts.

 *

 * @package Decode

 */

?>

<?php get_header(); ?>

<div id="primary" class="content-area">

	<main id="main" class="site-main" role="main">

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', 'single' ); ?>

		<?php do_action( 'related_posts' ); ?>

		

	<?php endwhile; // end of the loop. ?>

	<?php the_post_navigation(); ?>

	<?php
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
	?>
	
	</main><!-- #main -->

</div><!-- #primary -->

<?php get_footer(); ?>