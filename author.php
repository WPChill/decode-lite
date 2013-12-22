<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Decode
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
								
				<?php if ( get_the_author_meta( 'first_name' ) && get_the_author_meta( 'last_name' ) ) : ?>
				
				<section class="author-section">
					<div class="author-image"><?php echo get_avatar( get_the_author_meta( 'ID' ), 300 ); ?></div>
					<div class="author-text">
						<div class="author-name"><?php echo get_the_author_meta( 'display_name' ); ?></a></div>
						<?php if ( get_the_author_meta( 'user_url' ) ) echo '<div class="author-site"><a href="' . get_the_author_meta( 'user_url' ) . '" rel="me">' . __( 'Website', 'decode' ) . '</a></div>'; ?>
						<?php if ( get_the_author_meta( 'google_profile' ) ) echo '<a href="' . esc_url( get_the_author_meta( 'google_profile' ) . '?rel=author' ) . '" class="screen-reader-text"></a>'; ?>
						<div class="author-bio"><?php echo get_the_author_meta( 'description' ); ?></div>
					</div>
				</section>
			
			<?php else : ?>
			
			<h1 class="page-title">
			<?php printf( __( 'Author: %s', 'decode' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?>
			</h1>

			<?php endif; ?>
			
			</header><!-- .page-header -->
			
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to overload this in a child theme then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php decode_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'archive' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_footer(); ?>