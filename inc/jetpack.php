<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package looptroop-rockers-v4
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function ltr_v4_infinite_scroll_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'content',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'ltr_v4_infinite_scroll_setup' );
