<?php
/**
 * Genesass appearance settings.
 *
 * @package Genesass
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://github.com/gillespieza/genesass-and-genuflex/
 */

$genesis_sample_default_colors = [
	'link'   => '#367c2b', // green.
	'accent' => '#fdda01', // yellow.
];

$genesass_link_color = get_theme_mod(
	'genesass_link_color',
	$genesass_default_colors['link']
);

$genesass_accent_color = get_theme_mod(
	'genesass_accent_color',
	$genesass_default_colors['accent']
);

$genesass_link_color_contrast   = genesass_color_contrast( $genesass_link_color );
$genesass_link_color_brightness = genesass_color_brightness( $genesass_link_color, 35 );

return array(
	'fonts-url'            => 'https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,700&display=swap',
	'content-width'        => 1062,
	'button-bg'            => $genesass_link_color,
	'button-color'         => $genesass_link_color_contrast,
	'button-outline-hover' => $genesass_link_color_brightness,
	'link-color'           => $genesass_link_color,
	'default-colors'       => $genesass_default_colors,
	'editor-color-palette' => array(
		array(
			'name'  => __( 'John Deere Green', 'genesis-sample' ), // Called “Link Color” in the Customizer options. Renamed because “Link Color” implies it can only be used for links.
			'slug'  => 'theme-primary',
			'color' => $genesis_sample_link_color,
		),
		array(
			'name'  => __( 'John Deere Yellow', 'genesis-sample' ),
			'slug'  => 'theme-secondary',
			'color' => $genesis_sample_accent_color,
		),
		array(
			'name'  => __( 'Black Chocolate', 'genesis-sample' ),
			'slug'  => 'jd-black',
			'color' => '#27251F',
		),
		array(
			'name'  => __( 'Forest Green', 'genesis-sample' ),
			'slug'  => 'jd-forest-green',
			'color' => '#22491d',
		),
		array(
			'name'  => __( 'Morning Blue', 'genesis-sample' ),
			'slug'  => 'jd-morning-blue',
			'color' => '#909992',
		),
		array(
			'name'  => __( 'Rifle Green', 'genesis-sample' ),
			'slug'  => 'jd-rifle-green',
			'color' => '#484E41',
		),
		array(
			'name'  => __( 'Olive Green', 'genesis-sample' ),
			'slug'  => 'jd-olive-green',
			'color' => '#A59B55',
		),
		array(
			'name'  => __( 'Black', 'genesis-sample' ),
			'slug'  => 'black',
			'color' => '#000000',
		),
		array(
			'name'  => __( 'Medium Grey', 'genesis-sample' ),
			'slug'  => 'jd-medium-grey',
			'color' => '#333333',
		),
		array(
			'name'  => __( 'Light Grey', 'genesis-sample' ),
			'slug'  => 'jd-light-grey',
			'color' => '#666666',
		),
		array(
			'name'  => __( 'White', 'genesis-sample' ),
			'slug'  => 'white',
			'color' => '#ffffff',
		),
	),
	'editor-font-sizes'    => array(
		array(
			'name' => __( 'Small', 'genesass' ),
			'size' => 14,
			'slug' => 'small',
		),
		array(
			'name' => __( 'Normal', 'genesass' ),
			'size' => 16,
			'slug' => 'normal',
		),
		array(
			'name' => __( 'Lead', 'genesass' ),
			'size' => 18,
			'slug' => 'lead',
		),
		array(
			'name' => __( 'Large', 'genesass' ),
			'size' => 20,
			'slug' => 'large',
		),
		array(
			'name' => __( 'Larger', 'genesass' ),
			'size' => 24,
			'slug' => 'larger',
		),
	),
);


