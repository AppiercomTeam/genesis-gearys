<?php
/**
 * Various customisations for the blog archive.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package Genesass
 */


// Move the image thumbnail from the content to the header.
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
add_action( 'genesis_entry_header', 'genesis_do_post_image', 8 );

// Move the title from the header to the content.
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
add_action( 'genesis_entry_content', 'genesis_do_post_title', 9 );

// Add the categories before the title.
add_action( 'genesis_entry_content', 'gearys_post_categories', 8 );

// Add a read more link after the content.
add_action( 'genesis_entry_content', 'gearys_read_more_link', 11 );



// Removes the entry footer.
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );


/**
 * Return a Read More link.
 *
 * @return string
 */
function gearys_read_more_link() {
	if ( is_archive() || is_home() ) {
		echo '<a href="' . get_permalink() . '" class="more-link"><i class="fas fa fa-angle-right"></i> Read More</a>';
	}
	return;
}

/**
 * Return the categories for post archive pages.
 *
 * @return string
 */
function gearys_post_categories() {
	global $post;
	if ( is_archive() || is_home() || is_singular( array( 'post' ) ) ) {
		$output = '<div class="category_meta">';
		$output .= get_the_term_list( $post->ID, 'category', '<i class="fas fa fa-folder-open"></i> ', ', ' );
		$output .= '</div>';
		echo $output;
	}
	return;
}
