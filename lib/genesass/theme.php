<?php
/**
 * Genesass Customisations.
 *
 * @package Genesass
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://github.com/gillespieza/genesass-and-genuflex/
 */

/** Add Google Analytics to top of <body> if user is not admin. */
function genesass_add_google_analytics() {
	if ( ! current_user_can( 'manage_options' ) ) {
		echo "
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src='https://www.googletagmanager.com/gtag/js?id=G-XXXXXX'></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', 'UA-XXXXX-1', {'anonymize_ip':true});
			gtag('config', 'G-XXXX');
		</script>
		";
	} else {
		echo '
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<!-- Disabled: admin user is logged in-->

		';
	}
}
add_action( 'genesis_before', 'genesass_add_google_analytics' );


if ( ! function_exists( 'genesass_mute_jquery_migrator' ) ) {
	/** Set Jquery Migrate on Mute so you don't have such a cluttered console */
	function genesass_mute_jquery_migrator() {
		echo '<script>jQuery.migrateMute = true;</script>';
	}
}
add_action( 'wp_head', 'genesass_mute_jquery_migrator' );
add_action( 'admin_head', 'genesass_mute_jquery_migrator' );


/*
 * Gutenberg Editor CSS
 *
 * Load a stylesheet for customizing the Gutenberg editor
 * including support for Google Fonts and @import rules.
 */
function genesass_gutenberg_editor_css() {
	$css     = '/lib/gutenberg/style-editor.css';
	$version = filemtime( get_stylesheet_directory() . $css );
	wp_enqueue_style( 'editor-css', get_stylesheet_directory_uri() . $css, array(), $version );
}
add_action( 'enqueue_block_editor_assets', 'genesass_gutenberg_editor_css' );


/** Add image size to size picker */
function genesass_add_image_size_to_media( $sizes ) {
	$custom_sizes = array(
		'new-image' => '60 Sidebar Featured',
	);
	return array_merge( $sizes, $custom_sizes );
}
add_filter( 'image_size_names_choose', 'genesass_add_image_size_to_media' );
