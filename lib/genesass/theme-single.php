<?php
/**
 * Various customisations for single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package Genesass
 */

/*
	The layout/structure we want is:
	header
		- image
		- post date
	content
		- categories
		- title
		- content
	footer
		- tags
*/

/** Hook Featured Image to Entry Header on Single Posts */
function gearys_featured_post_image() {
	if ( ! is_singular( array( 'post' ) ) ) {
		return;
	}
	the_post_thumbnail(
		'genesis-singular-images',
		array( 'class' => 'featured-image' )
	);
}
add_action( 'genesis_entry_header', 'gearys_featured_post_image', 5 );

