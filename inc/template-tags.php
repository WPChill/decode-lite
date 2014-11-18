<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Decode
 */
 
if ( ! function_exists( 'decode_srcset_post_thumbnail' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function decode_srcset_post_thumbnail( $html, $post_id, $post_thumbnail_id, $size, $attr ) {
	$full_image_url  = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' );
	$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'large' );
	
	$attr = 'srcset=' . $large_image_url[0] . ' 1x, ' . $full_image_url[0] . ' 2x';
	
	$html = wp_get_attachment_image( $post_thumbnail_id, $size, false, $attr );
	
	return $html;
}
endif;
add_filter( 'post_thumbnail_html', 'decode_srcset_post_thumbnail', 10, 5 );

if ( ! function_exists( 'decode_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @return void
 */
function decode_paging_nav() {
        // Don't print empty markup if there's only one page.
        if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
                return;
        }
        ?>
        <nav class="navigation paging-navigation" role="navigation">
                <h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'decode' ); ?></h1>
                <div class="nav-links">

                        <?php if ( get_next_posts_link() ) : ?>
                        <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span>&nbsp;Older posts', 'decode' ) ); ?></div>
                        <?php endif; ?>

                        <?php if ( get_previous_posts_link() ) : ?>
                        <div class="nav-next"><?php previous_posts_link( __( 'Newer posts&nbsp;<span class="meta-nav">&rarr;</span>', 'decode' ) ); ?></div>
                        <?php endif; ?>

                </div><!-- .nav-links -->
        </nav><!-- .navigation -->
        <?php
}
endif;

if ( ! function_exists( 'decode_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @return void
 */
function decode_post_nav() {
        // Don't print empty markup if there's nowhere to navigate.
        $previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
        $next     = get_adjacent_post( false, '', false );

        if ( ! $next && ! $previous ) {
                return;
        }
        ?>
        <nav class="navigation post-navigation" role="navigation">
                <h1 class="screen-reader-text"><?php _e( 'Post navigation', 'decode' ); ?></h1>
                <div class="nav-links">
                	<?php
						previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span>&nbsp;%title', 'Previous post link', 'decode' ) );
						next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title&nbsp;<span class="meta-nav">&rarr;</span>', 'Next post link',     'decode' ) );
					?>
                </div><!-- .nav-links -->
        </nav><!-- .navigation -->
        <?php
}
endif;


if ( ! function_exists( 'decode_author_section' ) ) :
/**
 * Displays the author's card.
 */
function decode_author_section() {
	if ( get_theme_mod( 'show_author_section', false ) == true ) : ?>
	
		<section class="author-section cf vcard">
			
			<div class="author-image photo"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )?>" rel="author"><?php echo get_avatar( get_the_author_meta( 'ID' ), 250 ); ?></a></div>
			
			<div class="author-text">
				<div class="author-name fn n"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )?>" rel="author"><?php echo get_the_author_meta( 'display_name' ); ?></a></div>
				<?php
				if ( get_the_author_meta( 'user_url' ) ) {
					echo '<div class="author-site url"><a href="' . get_the_author_meta( 'user_url' ) . '" rel="me">' . __( 'Website', 'decode' ) . '</a></div>';
				}
				if ( get_the_author_meta( 'google_profile' ) ) { 
					echo '<a href="' . esc_url( get_the_author_meta( 'google_profile' ) . '?rel=author' ) . '" class="screen-reader-text"></a>';
				}
				?>
				<div class="author-bio note"><?php echo get_the_author_meta( 'description' ); ?></div>
			</div>
			
		</section>
	
	<?php endif;
}
endif;


if ( ! function_exists( 'decode_the_attached_image' ) ) :
/**
 * Prints the attached image with a link to the next attached image.
 */
function decode_the_attached_image() {
	$post                = get_post();
	$attachment_size     = apply_filters( 'decode_attachment_size', array( 1200, 1200 ) );
	$next_attachment_url = wp_get_attachment_url();

	/**
	 * Grab the IDs of all the image attachments in a gallery so we can get the
	 * URL of the next adjacent image in a gallery, or the first image (if
	 * we're looking at the last image in a gallery), or, in a gallery of one,
	 * just the link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID',
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id )
			$next_attachment_url = get_attachment_link( $next_id );

		// or get the URL of the first image attachment.
		else
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
	}

	printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
		esc_url( $next_attachment_url ),
		the_title_attribute( array( 'echo' => false ) ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;


if ( ! function_exists( 'decode_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function decode_posted_on() {
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		$time_string .= '<time class="updated screen-reader-text" datetime="%3$s">%4$s</time>';
	} else {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		_x( 'Posted on %s', 'post date', 'decode' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		_x( 'by %s', 'post author', 'decode' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>';

}
endif;

if ( ! function_exists( 'the_archive_title' ) ) :
/**
 * Shim for `the_archive_title()`.
 *
 * Display the archive title based on the queried object.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
function the_archive_title( $before = '', $after = '' ) {
	if ( is_category() ) {
		$title = sprintf( __( 'Category: %s', '_s' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		$title = sprintf( __( 'Tag: %s', '_s' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		$title = sprintf( __( 'Author: %s', '_s' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		$title = sprintf( __( 'Year: %s', '_s' ), get_the_date( _x( 'Y', 'yearly archives date format', '_s' ) ) );
	} elseif ( is_month() ) {
		$title = sprintf( __( 'Month: %s', '_s' ), get_the_date( _x( 'F Y', 'monthly archives date format', '_s' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( __( 'Day: %s', '_s' ), get_the_date( _x( 'F j, Y', 'daily archives date format', '_s' ) ) );
	} elseif ( is_tax( 'post_format', 'post-format-aside' ) ) {
		$title = _x( 'Asides', 'post format archive title', '_s' );
	} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
		$title = _x( 'Galleries', 'post format archive title', '_s' );
	} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
		$title = _x( 'Images', 'post format archive title', '_s' );
	} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
		$title = _x( 'Videos', 'post format archive title', '_s' );
	} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
		$title = _x( 'Quotes', 'post format archive title', '_s' );
	} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
		$title = _x( 'Links', 'post format archive title', '_s' );
	} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
		$title = _x( 'Statuses', 'post format archive title', '_s' );
	} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
		$title = _x( 'Audio', 'post format archive title', '_s' );
	} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
		$title = _x( 'Chats', 'post format archive title', '_s' );
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( __( 'Archives: %s', '_s' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( __( '%1$s: %2$s', '_s' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = __( 'Archives', '_s' );
	}
	/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters( 'get_the_archive_title', $title );
	if ( ! empty( $title ) ) {
		echo $before . $title . $after;
	}
}
endif;
if ( ! function_exists( 'the_archive_description' ) ) :
/**
 * Shim for `the_archive_description()`.
 *
 * Display category, tag, or term description.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the description. Default empty.
 * @param string $after  Optional. Content to append to the description. Default empty.
 */
function the_archive_description( $before = '', $after = '' ) {
	$description = apply_filters( 'get_the_archive_description', term_description() );
	if ( ! empty( $description ) ) {
		/**
		 * Filter the archive description.
		 *
		 * @see term_description()
		 *
		 * @param string $description Archive description to be displayed.
		 */
		echo $before . $description . $after;
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category
 */
function decode_categorized_blog() {
	if ( false === ( $categories = get_transient( 'decode_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$categories = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts.
		$categories = count( $categories );

		set_transient( 'decode_categories', $categories );
	}

	if ( '1' != $categories ) {
		// This blog has more than 1 category so decode_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so decode_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in decode_categorized_blog.
 */
function decode_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'decode_categories' );
}
add_action( 'edit_category', 'decode_category_transient_flusher' );
add_action( 'save_post',     'decode_category_transient_flusher' );