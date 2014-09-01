<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Decode
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
if ( ! function_exists( 'decode_render_infinte_scroll' ) ) {
	
function decode_render_infinte_scroll() {
	while ( have_posts() ) : the_post();
		if ( get_theme_mod( 'use_excerpts', false ) == true && ! is_sticky() ) :
			get_template_part( 'content', 'excerpt' );
		else :
			get_template_part( 'content', get_post_format() );
		endif;
	endwhile;
}
}

if ( ! function_exists( 'decode_jetpack_setup' ) ) {

function decode_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'colophon',
		'render'    => 'decode_render_infinte_scroll',
	) );
}
}
add_action( 'after_setup_theme', 'decode_jetpack_setup' );