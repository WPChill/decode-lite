<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Decode
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

	<?php if ( have_posts() ) : ?>

		<header class="page-header">
			<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
+				the_archive_description( '<div class="taxonomy-description">', '</div>' );
			?>
		</header><!-- .page-header -->

		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>
		
			<?php 
				if ( get_theme_mod( 'use_excerpts_on_archives', true ) == true ) : 
					get_template_part( 'content', 'excerpt' );
				
				else :
					/* Include the Post-Format-specific template for the content.
					 * If you want to overload this in a child theme then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
					
				endif;
			?>

		<?php endwhile; else : ?>
	
			<?php get_template_part( 'content-none', 'none' ); ?>
	
		<?php endif; ?>

	</main><!-- #main -->
	
	<?php decode_paging_nav(); ?>
	
</div><!-- #primary -->

<?php get_footer(); ?>