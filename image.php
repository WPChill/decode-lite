<?php
/**
 * The template for displaying image attachments.
 *
 * @package Decode
 */

get_header(); ?>

<div id="primary" class="content-area image-attachment">
	<main id="main" class="site-main" role="main">

	<?php while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
				
				<div class="entry-meta">
					<?php
						$metadata = wp_get_attachment_metadata();
						printf( __( 'Published <span class="entry-date"><time class="entry-date" datetime="%1$s">%2$s</time></span> in <a href="%3$s" title="Return to %4$s" rel="gallery">%5$s</a>', 'decode' ),
							esc_attr( get_the_date( 'c' ) ),
							esc_html( get_the_date() ),
							esc_url( get_permalink( $post->post_parent ) ),
							esc_attr( strip_tags( get_the_title( $post->post_parent ) ) ),
							get_the_title( $post->post_parent )
						);
					?>
					<?php edit_post_link( __( 'Edit', 'decode' ), '<div class="edit-link">', '</div>' ); ?>
				</div><!-- .entry-meta -->

				<nav role="navigation" id="image-navigation" class="image-navigation">
					<div class="nav-previous"><?php previous_image_link( false, __( '<span class="meta-nav">&larr;</span> Previous', 'decode' ) ); ?></div>
					<div class="nav-next"><?php next_image_link( false, __( 'Next <span class="meta-nav">&rarr;</span>', 'decode' ) ); ?></div>
				</nav><!-- #image-navigation -->
			</header><!-- .entry-header -->

			<div class="entry-content">

				<div class="entry-attachment">
					<div class="attachment">
						<?php
							/**
							 * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
							 * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
							 */
							$attachments = array_values( get_children( array(
								'post_parent'    => $post->post_parent,
								'post_status'    => 'inherit',
								'post_type'      => 'attachment',
								'post_mime_type' => 'image',
								'order'          => 'ASC',
								'orderby'        => 'menu_order ID',
							) ) );
							foreach ( $attachments as $k => $attachment ) {
								if ( $attachment->ID == $post->ID )
									break;
							}
							$k++;
							// If there is more than 1 attachment in a gallery
							if ( count( $attachments ) > 1 ) {
								if ( isset( $attachments[ $k ] ) )
									// get the URL of the next image attachment
									$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
								else
									// or get the URL of the first image attachment
									$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
							} else {
								// or, if there's only 1 image, get the URL of the image
								$next_attachment_url = wp_get_attachment_url();
							}
						?>

						<a href="<?php echo esc_url( $next_attachment_url ); ?>" title="<?php the_title_attribute(); ?>" rel="attachment"><?php
							$attachment_size = apply_filters( 'decode_attachment_size', array( 1200, 1200 ) ); // Filterable image size.
							echo wp_get_attachment_image( get_the_ID(), $attachment_size );
						?></a>
					</div><!-- .attachment -->

					<?php if ( has_excerpt() ) : ?>
					<div class="entry-caption">
						<?php the_excerpt(); ?>
					</div><!-- .entry-caption -->
					<?php endif; ?>
				</div><!-- .entry-attachment -->

				<?php the_content(); ?>
				<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">' . __( 'Pages:', 'decode' ),
						'after'  => '</div>',
					) );
				?>

			</div><!-- .entry-content -->

		</article><!-- #post-<?php the_ID(); ?> -->

		<?php
			if ( get_theme_mod( 'enable_comments', true ) == true ) :
			
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || '0' != get_comments_number() ) {
					comments_template();
				}
			
			endif;
		?>

	<?php endwhile; // end of the loop. ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>