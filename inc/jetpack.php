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
if ( ! function_exists( 'decode_jetpack_setup' ) ) {

function decode_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
}
add_action( 'after_setup_theme', 'decode_jetpack_setup' );