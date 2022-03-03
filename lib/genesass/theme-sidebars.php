<?php
/**
 * Various sidebar and widget functions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package Genesass
 */

// Removes header right widget area.
// unregister_sidebar( 'header-right' );

// Removes secondary sidebar.
unregister_sidebar( 'sidebar-alt' );

// Removes site layouts.
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
