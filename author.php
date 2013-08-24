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
					<?php
						/* Queue the first post, that way we know
						 * what author we're dealing with.
						*/
						the_post();
						/* Since we called the_post() above, we need to
						 * rewind the loop back to the beginning that way
						 * we can run the loop properly, in full.
						 */
						rewind_posts();
					?>
				<section class="author-section">
					<div class="author-image"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )?>" rel="author"><?php echo get_avatar( get_the_author_meta( 'ID' ), 300 ); ?></a></div>
					<div class="author-text">
						<div class="author-name"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )?>" rel="author"><?php echo get_the_author_meta( 'display_name' ); ?></a></div>
						<?php if ( get_the_author_meta( 'user_url' ) ) echo '<div class="author-site"><a href="' . get_the_author_meta( 'user_url' ) . '" rel="me">Website</a></div>'; ?>
						<?php if ( get_the_author_meta( 'google_profile' ) ) echo '<a href="' . esc_url( get_the_author_meta( 'google_profile' ) . '?rel=author' ) . '" style="display: none;">' . __( 'Website', 'decode' ) . '</a>'; ?>
						<div class="author-bio"><?php echo get_the_author_meta( 'description' ); ?></div>
					</div>
				</section>
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

			<?php decode_content_nav( 'nav-below' ); ?>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'archive' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_footer(); ?>