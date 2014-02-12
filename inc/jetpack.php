<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package semantic-ui-wp-theme
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function semantic_ui_wp_theme_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'semantic_ui_wp_theme_jetpack_setup' );
