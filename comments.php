<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package Decode
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
	<?php if ( get_theme_mod( 'enable_comments', true ) == true ) : ?>

	<?php tha_comments_before(); ?>
<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'decode' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="comment-navigation cf" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'decode' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'decode' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'decode' ) ); ?></div>
		</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation ?>

		<ol class="comment-list">
			<?php
				$args = array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 64,
				);
				$args = apply_filters( 'decode_wp_list_comments_args', $args );
				wp_list_comments( $args );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="comment-navigation cf" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'decode' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'decode' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'decode' ) ); ?></div>
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'decode' ); ?></p>
	<?php endif; ?>
	
	<?php
	$comments_args = array(
		'title_reply'       => __( 'Leave a Reply', 'decode' ),
		'title_reply_to'    => __( 'Leave a Reply to %s', 'decode' ),
		'cancel_reply_link' => __( 'Cancel reply', 'decode' ),
		'label_submit'      => __( 'Post Comment', 'decode' ),
	);
	if ( get_theme_mod( 'show_allowed_tags', false ) == false ) {
		$comments_args = array(
			'comment_notes_after'  => '',
		);
	}
	?>
	
	<?php 
		// Add a class to the comment form if Jetpack Comments are enabled.
		ob_start();
		comment_form( $comments_args );
		if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'comments' ) ) {
			echo str_replace( 'class="comment-form"','class="comment-form jetpack-comments-active"', ob_get_clean() );
		}
	?>
	
	<?php
		_x( 'Comment', 'noun', 'decode' );
		__( 'You must be <a href="%s">logged in</a> to post a comment.', 'decode' );
		__( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'decode' );
		__( 'Your email address will not be published.', 'decode' );
		__( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'decode' );
	?>
	
	<?php if ( get_theme_mod( 'show_allowed_tags', false ) == true ) : ?>
		<script>
			function hasClass( el, cls ) {
				return ( ' ' + el.className + ' ' ).indexOf( ' ' + cls + ' ' ) > -1;
			}
			
			var target = document.querySelector( '.form-allowed-tags' );
			
			document.querySelector( 'textarea#comment' ).addEventListener( 'click', function() {
				if ( ! hasClass( target, 'visible' ) ) {
					target.className += ' ' + 'visible';
				}
			}, false );
		</script>
	<?php endif; ?>

</div><!-- #comments -->
	<?php tha_comments_after(); ?>

<?php endif; ?>