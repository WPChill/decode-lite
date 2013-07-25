<?php
/**
 * @package Decode
 */
?>

<?php if ( has_post_format( 'quote' ) && !is_search() ) : ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-content"><?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'decode' ) ); ?></div>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'decode' ), 'after' => '</div>' ) ); ?>
		<footer class="entry-meta">
			<?php if (get_theme_mod( 'enable_comments', true ) == true ) : ?>
				<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
				<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'decode' ), __( '1 Comment', 'decode' ), __( '% Comments', 'decode' ) ); ?></span>
				<?php endif; ?>
			<?php endif; ?>
			<p class="date"><a href="<?php the_permalink(); ?>">Posted on <?php decode_posted_on(); ?></a></p>
		</footer><!-- .entry-meta -->
	</article><!-- #post-<?php the_ID(); ?> -->

<?php elseif ( has_post_format( 'link' ) && !is_search() ): ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<div class="entry-title"><h2><?php decode_print_post_title() ?></h2></div>
		</header>
		<div class="entry-content"><?php the_content( __( 'continue reading &raquo;', 'decode' ) ); ?></div>
		<footer class="entry-meta">
			<?php if (get_theme_mod( 'enable_comments', true ) == true ) : ?>
				<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
				<span class="comments-link <?php echo get_theme_mod( 'enable_comments', '' ); ?>"><?php comments_popup_link( __( 'Leave a comment', '_s' ), __( '1 Comment', '_s' ), __( '% Comments', '_s' ) ); ?></span>
				<?php endif; ?>
			<?php endif; ?>
			<p class="date"><a href="<?php the_permalink(); ?>">Posted on <?php decode_posted_on(); ?></a></p>
		</footer><!-- .entry-meta -->
	</article><!-- #post-<?php the_ID(); ?> -->
	
<?php elseif ( has_post_thumbnail() && !is_search() ): ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
				<?php the_post_thumbnail(); ?>
			</a>
			<div class="entry-title"><h2><?php the_title(); ?></h2></div>
		</header>
		<div class="entry-content"><?php the_content( __( 'continue reading &raquo;', 'decode' ) ); ?></div>
		<footer class="entry-meta">
			<?php if (get_theme_mod( 'enable_comments', true ) == true ) : ?>
				<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
				<span class="comments-link <?php echo get_theme_mod( 'enable_comments', '' ); ?>"><?php comments_popup_link( __( 'Leave a comment', '_s' ), __( '1 Comment', '_s' ), __( '% Comments', '_s' ) ); ?></span>
				<?php endif; ?>
			<?php endif; ?>
			<p class="date"><a href="<?php the_permalink(); ?>">Posted on <?php decode_posted_on(); ?></a></p>
		</footer><!-- .entry-meta -->
	</article>

<?php elseif ( is_search() ) : // Only display Excerpts for Search ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<a class="search-entry" href="<?php the_permalink(); ?>">
			<div class="entry-title">
				<h3><?php decode_search_title_highlight(); ?></h3>
			</div>
			<div class="entry-summary">
				<?php decode_search_excerpt_highlight(); ?>
			</div><!-- .entry-summary -->
		</a>
	</article>

<?php else : ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<div class="entry-title"><h2><?php the_title(); ?></h2></div>
		</header><!-- .entry-header -->
		<div class="entry-content"><?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'decode' ) ); ?></div>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'decode' ), 'after' => '</div>' ) ); ?>
		<footer class="entry-meta">
			<?php if (get_theme_mod( 'enable_comments', true ) == true ) : ?>
				<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
				<span class="comments-link <?php echo get_theme_mod( 'enable_comments', '' ); ?>"><?php comments_popup_link( __( 'Leave a comment', 'decode' ), __( '1 Comment', 'decode' ), __( '% Comments', 'decode' ) ); ?></span>
				<?php endif; ?>
			<?php endif; ?>
			<p class="date"><a href="<?php the_permalink(); ?>">Posted on <?php decode_posted_on(); ?></a></p>
		</footer><!-- .entry-meta -->
	</article><!-- #post-<?php the_ID(); ?> -->

<?php endif; ?>