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
			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link <?php echo get_theme_mod( 'enable_comments' ); ?>"><?php comments_popup_link( __( 'Leave a comment', 'decode' ), __( '1 Comment', 'decode' ), __( '% Comments', 'decode' ) ); ?></span>
		<?php endif; ?>
			<p class="date"><a href="<?php the_permalink(); ?>">Posted on <?php decode_posted_on(); ?></a></p>
		</footer><!-- .entry-meta -->
	</article><!-- #post-<?php the_ID(); ?> -->
		
	<?php elseif ( has_post_format( 'link' )): ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<div class="entry-title"><h2><?php print_post_title() ?></h2>
					<div class="social-reply <?php echo get_theme_mod( 'show_reply_tool' ); ?>"><a href="https://twitter.com/intent/tweet?screen_name=<?php echo get_theme_mod( 'twitter_reply_username' ); ?>&text=(about%3A%20<?php the_permalink(); ?>) " class="twitterreply replylink left" target="_blank" data-related="<?php echo get_theme_mod( 'twitter_reply_username' ); ?>">With Twitter</a><div class="replytrigger">Reply</div><a href="https://alpha.app.net/intent/post?text=@<?php echo get_theme_mod( 'adn_reply_username' ); ?> (about%3A%20<?php the_permalink(); ?>) " class="adnreply replylink right" target="_blank">With ADN</a></div></div>
				</header>
				
					<div class="entry-content"><?php the_content( __( 'continue reading &raquo;', 'twentyten' ) ); ?></div>
					<footer class="entry-meta">
						<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link <?php echo get_theme_mod( 'enable_comments' ); ?>"><?php comments_popup_link( __( 'Leave a comment', '_s' ), __( '1 Comment', '_s' ), __( '% Comments', '_s' ) ); ?></span>
		<?php endif; ?>
						<p class="date"><a href="<?php the_permalink(); ?>">Posted on <?php decode_posted_on(); ?></a></p>
					</footer><!-- .entry-meta -->
				</article>
	
	<?php elseif ( is_search() ) : // Only display Excerpts for Search ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<div class="entry-content">
		</div>
	
	<?php else : ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="entry-title"><h2><?php the_title(); ?></h2>
			<div class="social-reply <?php echo get_theme_mod( 'show_reply_tool' ); ?>"><a href="https://twitter.com/intent/tweet?screen_name=<?php echo get_theme_mod( 'twitter_reply_username' ); ?>&text=(about%3A%20<?php the_permalink(); ?>) " class="twitterreply replylink left" target="_blank" data-related="<?php echo get_theme_mod( 'twitter_reply_username' ); ?>">With Twitter</a><div class="replytrigger">Reply</div><a href="https://alpha.app.net/intent/post?text=@<?php echo get_theme_mod( 'adn_reply_username' ); ?> (about%3A%20<?php the_permalink(); ?>) " class="adnreply replylink right" target="_blank">With ADN</a></div></div>
	</header><!-- .entry-header -->

		<div class="entry-content"><?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'decode' ) ); ?></div>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'decode' ), 'after' => '</div>' ) ); ?>
		<footer class="entry-meta">
			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link <?php echo get_theme_mod( 'enable_comments' ); ?>"><?php comments_popup_link( __( 'Leave a comment', 'decode' ), __( '1 Comment', 'decode' ), __( '% Comments', 'decode' ) ); ?></span>
		<?php endif; ?>
			<p class="date"><a href="<?php the_permalink(); ?>">Posted on <?php decode_posted_on(); ?></a></p>
		</footer><!-- .entry-meta -->
	</article><!-- #post-<?php the_ID(); ?> -->

	<?php endif; ?>