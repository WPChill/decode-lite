<?php
/**
 *
 * The template for displaying link post formats.
 *
 * @package Decode
 */
?>

	<?php tha_entry_before(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php tha_entry_top(); ?>

	<header class="entry-header">
			<?php if ( has_post_thumbnail() ) : ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php the_post_thumbnail(); ?>
			</a>
			<?php endif; ?>
		<h1 class="entry-title"><?php decode_print_post_title() ?><?php if ( get_theme_mod( 'link_post_title_arrow', false ) == true ) echo '<span class="link-title-arrow">&#8594;</span>'; ?></h1>
		<?php if ( get_theme_mod( 'entry_date_position', 'below' ) == 'above' ) : ?>
		<div class="entry-meta">
			<p class="date"><?php decode_posted_on(); ?></p>
		</div>
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'decode' ) ); ?>
	</div><!-- .entry-content -->
	<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'decode' ), 'after' => '</div>' ) ); ?>

	<footer class="entry-footer">
		<?php if ( get_theme_mod( 'enable_comments', true ) == true && ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
			<div class="comments-link <?php echo get_theme_mod( 'enable_comments', '' ); ?>"><?php comments_popup_link( __( 'Leave a comment', 'decode' ), __( '1 Comment', 'decode' ), __( '% Comments', 'decode' ) ); ?></div>
		<?php endif; ?>
		
		<?php edit_post_link( __( 'Edit', 'decode' ), '<div class="edit-link">', '</div>' ); ?>
		
		<div class="entry-meta">
			<?php if ( get_theme_mod( 'show_tags', false ) == true ) : ?>
				<p class="tags"><?php the_tags( __( 'Tagged as: ', 'decode' ),', ' ); ?></p>
			<?php endif; ?>
			<?php if ( get_theme_mod( 'show_categories', false ) == true ) : ?>
				<p class="categories"><?php _e( 'Categorized in&#58; ', 'decode' ) . the_category( ', ' ); ?></p>
			<?php endif; ?>
			<?php if ( get_theme_mod( 'entry_date_position', 'below' ) == 'below' ) : ?>
				<p class="date"><?php decode_posted_on(); ?></p>
			<?php endif; ?>
		</div>
	</footer><!-- .entry-footer -->
		
	<?php tha_entry_bottom(); ?>
</article><!-- #post-<?php the_ID(); ?> -->
	<?php tha_entry_after(); ?>