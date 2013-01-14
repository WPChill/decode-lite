<?php
/**
 * @package Decode
 * @since Decode 1.0
 */
?>

<?php if ( has_post_format( 'quote' ) ) : ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="entry-content"><?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'decode' ) ); ?></div>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'decode' ), 'after' => '</div>' ) ); ?>
			<div class="entry-title">
			<div class="reply"><a href="https://twitter.com/intent/tweet?screen_name=ScottSmith95&text=(about%3A%20<?php the_permalink(); ?>) " class="twitterreply replylink" target="_blank" data-related="ScottSmith95">With Twitter</a><span class="replytrigger">Reply</span><a href="https://alpha.app.net/intent/post?text=@ScottSmith (about%3A%20<?php the_permalink(); ?>) " class="adnreply replylink" target="_blank">With ADN</a></div></div>
		<footer class="entry-meta">
			<p class="date"><a href="<?php the_permalink(); ?>">Committed on <?php decode_posted_on(); ?></a></p>
		</footer><!-- .entry-meta -->
	</article><!-- #post-<?php the_ID(); ?> -->
		
	<?php elseif ( has_post_format( 'link' )): ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-title"><h2><?php print_post_title() ?></h2>
					<div class="reply"><a href="https://twitter.com/intent/tweet?screen_name=ScottSmith95&text=(about%3A%20<?php the_permalink(); ?>) " class="twitterreply replylink" target="_blank" data-related="ScottSmith95">With Twitter</a><span class="replytrigger">Reply</span><a href="https://alpha.app.net/intent/post?text=@ScottSmith (about%3A%20<?php the_permalink(); ?>) " class="adnreply replylink" target="_blank">With ADN</a></div></div>
					<div class="entry-content"><?php the_content( __( 'continue reading &raquo;', 'twentyten' ) ); ?></div>
					<footer class="entry-meta">
						<p class="date"><a href="<?php the_permalink(); ?>">Committed on <?php decode_posted_on(); ?></a></p>
					</footer><!-- .entry-meta -->
				</article>
	
	<?php else : ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="entry-title"><h2><?php the_title(); ?></h2>
			<div class="reply"><a href="https://twitter.com/intent/tweet?screen_name=ScottSmith95&text=(about%3A%20<?php the_permalink(); ?>) " class="twitterreply replylink" target="_blank" data-related="ScottSmith95">With Twitter</a><span class="replytrigger">Reply</span><a href="https://alpha.app.net/intent/post?text=@ScottSmith (about%3A%20<?php the_permalink(); ?>) " class="adnreply replylink" target="_blank">With ADN</a></div></div>
	</header><!-- .entry-header -->

		<div class="entry-content"><?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'decode' ) ); ?></div>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'decode' ), 'after' => '</div>' ) ); ?>
		<footer class="entry-meta">
			<p class="date"><a href="<?php the_permalink(); ?>">Committed on <?php decode_posted_on(); ?></a></p>
		</footer><!-- .entry-meta -->
	</article><!-- #post-<?php the_ID(); ?> -->

	<?php endif; ?>