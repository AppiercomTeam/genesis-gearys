<?php
/**
 * Genesass child theme.
 *
 * Theme supports.
 *
 * @package Genesass
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/genesass/
 */

return array(
	'genesis-custom-logo'             => array(
		'height'      => 120,
		'width'       => 700,
		'flex-height' => true,
		'flex-width'  => true,
	),
	'html5'                           => array(
		'caption',
		'comment-form',
		'comment-list',
		'gallery',
		'navigation-widgets',
		'search-form',
		'script',
		'style',
	),
	'genesis-accessibility'           => array(
		'404-page',
		'drop-down-menu', // adds SuperFish.js.
		'headings', // semantic headings.
		'rems',
		'search-form', // input labels.
		'skip-links',
	),
	'genesis-after-entry-widget-area' => '',
	'genesis-footer-widgets'          => 3,
	'genesis-menus'                   => array(
		'primary'   => __( 'Header Menu', 'genesass' ),
		'secondary' => __( 'Footer Menu', 'genesass' ),
	),
	'genesis-structural-wraps'        => array(
		'header',
		// 'nav',
		// 'subnav',
		// 'site-inner',
		// 'footer-widgets',
		// 'footer',
		// 'nav-footer',
	),
);

