<?php
/**
 * @package Decode
 */
?>

<?php if ( has_post_format( 'quote' ) ) : ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="entry-content"><?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'decode' ) ); ?></div>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'decode' ), 'after' => '</div>' ) ); ?>
		<footer class="entry-meta">
			<?php edit_post_link( __( 'Edit', 'decode' ), '<div class="edit-link">', '</div>' ); ?>
			<p class="tags"><?php the_tags('Tagged in: ',', '); ?></p>
			<p class="categories">Categorized in: <?php the_category(', '); ?></p>
			<p class="date"><a href="<?php the_permalink(); ?>">Posted on <?php decode_posted_on(); ?></a></p>
		</footer><!-- .entry-meta -->
	</article><!-- #post-<?php the_ID(); ?> -->
		
<?php elseif ( has_post_format( 'link' )): ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<div class="entry-title"><h2><?php decode_print_post_title() ?></h2></div>
		</header>
		<div class="entry-content"><?php the_content( __( 'continue reading &raquo;', 'decode' ) ); ?></div>
		<footer class="entry-meta">
			<?php edit_post_link( __( 'Edit', 'decode' ), '<div class="edit-link">', '</div>' ); ?>
			<p class="tags"><?php the_tags('Tagged in: ',', '); ?></p>
			<p class="categories">Categorized in: <?php the_category(', '); ?></p>
			<p class="date"><a href="<?php the_permalink(); ?>">Posted on <?php decode_posted_on(); ?></a></p>
		</footer><!-- .entry-meta -->
	</article>
	
<?php else : ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<div class="entry-title"><h2><?php the_title(); ?></h2></div>
		</header><!-- .entry-header -->
		<div class="entry-content"><?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'decode' ) ); ?></div>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'decode' ), 'after' => '</div>' ) ); ?>
		<footer class="entry-meta">
			<?php edit_post_link( __( 'Edit', 'decode' ), '<div class="edit-link">', '</div>' ); ?>
			<p class="tags"><?php the_tags('Tagged in: ',', '); ?></p>
			<p class="categories">Categorized in: <?php the_category(', '); ?></p>
			<p class="date"><a href="<?php the_permalink(); ?>">Posted on <?php decode_posted_on(); ?></a></p>
		</footer><!-- .entry-meta -->
	</article><!-- #post-<?php the_ID(); ?> -->

<?php endif; ?>