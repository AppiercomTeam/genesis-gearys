<?php
/**
 * Various image functions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package Genesass
 */

/** Add image size to size picker */
function genesass_add_image_size_to_media( $sizes ) {
	$custom_sizes = array(
		'sidebar-featured' => 'Sidebar Featured (60x60)',
		'genesis-singular-images' => 'Genesis Singular Image (750x375)',
	);
	return array_merge( $sizes, $custom_sizes );
}
add_filter( 'image_size_names_choose', 'genesass_add_image_size_to_media' );


/**
 * Updates various image dimensions.
 *
 * @since 2.3.0
 */
function gearys_override_blocks_image_size() {
	add_image_size( 'sidebar-featured', 60, 60, true );
	add_image_size( 'genesis-singular-images', 750, 375, true );
	add_image_size( 'genesis-custom-block-large', 450, 573, true );
	add_image_size( 'genesis-custom-block-small', 370, 276, true );
	add_image_size( 'medium_small', 300, 300, true );
	add_image_size( 'gb-block-post-grid-square', 500, 500, true );
}
add_action( 'after_setup_theme', 'gearys_override_blocks_image_size', 11 );


/**
 * Modifies size of the Gravatar in the author box.
 *
 * @since 2.2.3
 *
 * @param int $size Original icon size.
 * @return int Modified icon size.
 */
function genesass_author_box_gravatar( $size ) {
	return 90;
}
add_filter( 'genesis_author_box_gravatar_size', 'genesass_author_box_gravatar' );


/**
 * Modifies size of the Gravatar in the entry comments.
 *
 * @since 2.2.3
 *
 * @param array $args Gravatar settings.
 * @return array Gravatar settings with modified size.
 */
function genesass_comments_gravatar( $args ) {
	$args['avatar_size'] = 60;
	return $args;
}
add_filter( 'genesis_comment_list_args', 'genesass_comments_gravatar' );
