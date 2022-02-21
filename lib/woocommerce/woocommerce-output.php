<?php
/**
 * Genesass.
 *
 * This file adds the WooCommerce styles and the Customizer additions for WooCommerce to the Genesis Sample Theme.
 *
 * @package Genesass
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://github.com/gillespieza/genesass-and-genuflex/
 */

add_filter( 'woocommerce_enqueue_styles', 'genesass_woocommerce_styles' );
/**
 * Enqueues the theme's custom WooCommerce styles to the WooCommerce plugin.
 *
 * @param array $enqueue_styles The WooCommerce styles to enqueue.
 * @since 2.3.0
 *
 * @return array Modified WooCommerce styles to enqueue.
 */
function genesass_woocommerce_styles( $enqueue_styles ) {

	$enqueue_styles[ genesis_get_theme_handle() . '-woocommerce-styles' ] = [
		'src'     => get_stylesheet_directory_uri() . '/lib/woocommerce/genesass-woocommerce.css',
		'deps'    => '',
		'version' => genesis_get_theme_version(),
		'media'   => 'screen',
	];

	return $enqueue_styles;

}

add_action( 'wp_enqueue_scripts', 'genesass_woocommerce_css' );
/**
 * Adds the themes's custom CSS to the WooCommerce stylesheet.
 *
 * @since 2.3.0
 *
 * @return string CSS to be outputted after the theme's custom WooCommerce stylesheet.
 */
function genesass_woocommerce_css() {

	// If WooCommerce isn't active, exit early.
	if ( ! class_exists( 'WooCommerce' ) ) {
		return;
	}

	$appearance = genesis_get_config( 'appearance' );

	$color_link   = get_theme_mod( 'genesass_link_color', $appearance['default-colors']['link'] );
	$color_accent = get_theme_mod( 'genesass_accent_color', $appearance['default-colors']['accent'] );

	$woo_css = '';

	$woo_css .= ( $appearance['default-colors']['link'] !== $color_link ) ? sprintf(
		'

		.woocommerce div.product p.price,
		.woocommerce div.product span.price,
		.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover,
		.woocommerce div.product .woocommerce-tabs ul.tabs li a:focus,
		.woocommerce ul.products li.product h3:hover,
		.woocommerce ul.products li.product .price,
		.woocommerce .woocommerce-breadcrumb a:hover,
		.woocommerce .woocommerce-breadcrumb a:focus,
		.woocommerce .widget_layered_nav ul li.chosen a::before,
		.woocommerce .widget_layered_nav_filters ul li a::before,
		.woocommerce .widget_rating_filter ul li.chosen a::before {
			color: %s;
		}

	',
		$color_link
	) : '';

	$woo_css .= ( $appearance['default-colors']['accent'] !== $color_accent ) ? sprintf(
		'
		.woocommerce a.button:hover,
		.woocommerce a.button:focus,
		.woocommerce a.button.alt:hover,
		.woocommerce a.button.alt:focus,
		.woocommerce button.button:hover,
		.woocommerce button.button:focus,
		.woocommerce button.button.alt:hover,
		.woocommerce button.button.alt:focus,
		.woocommerce input.button:hover,
		.woocommerce input.button:focus,
		.woocommerce input.button.alt:hover,
		.woocommerce input.button.alt:focus,
		.woocommerce input[type="submit"]:hover,
		.woocommerce input[type="submit"]:focus,
		.woocommerce span.onsale,
		.woocommerce #respond input#submit:hover,
		.woocommerce #respond input#submit:focus,
		.woocommerce #respond input#submit.alt:hover,
		.woocommerce #respond input#submit.alt:focus,
		.woocommerce.widget_price_filter .ui-slider .ui-slider-handle,
		.woocommerce.widget_price_filter .ui-slider .ui-slider-range {
			background-color: %1$s;
			color: %2$s;
		}

		.woocommerce-error,
		.woocommerce-info,
		.woocommerce-message {
			border-top-color: %1$s;
		}

		.woocommerce-error::before,
		.woocommerce-info::before,
		.woocommerce-message::before {
			color: %1$s;
		}

	',
		$color_accent,
		genesass_color_contrast( $color_accent )
	) : '';

	if ( $woo_css ) {
		wp_add_inline_style( genesis_get_theme_handle() . '-woocommerce-styles', $woo_css );
	}

}




function gearys_edit_price_display() {
	global $product;

	if ( $product ) {
		// print_r_hidden( '$product' );
		// print_r_hidden( $product );

		$tax_status = $product->get_tax_status();
		$tax_class  = $product->get_tax_class();
		$price      = $product->get_price();
		$product_id = $product->get_id();
		$tax_class_text = '';

		$tax_rate = WC_Tax::get_rates( $tax_class );
		if ( !empty( $tax_rate ) ) {
			$tax_rate = reset( $tax_rate );
			$tax_rate = $tax_rate['rate'];
		}

		// print_r_hidden( $tax_status );
		// print_r_hidden( $tax_class );
		// print_r_hidden( $tax_rate );

		if ( $price ) {
				if ( 'taxable' === $tax_status ) {
					if ( 'margin-scheme' === $tax_class ) {
						$display_price = "
							<span class='price'>
								<span class='amount excl'>" . wc_price( $price ) ."
									<small class='woocommerce-price-suffix'>(Margin Scheme)</small>
								</span>
							</span>
							";
					} elseif ( 'zero-rate' === $tax_class ) {
							$display_price = "
							<span class='price'>
								<span class='amount excl'>" . wc_price( $price ) ."
									<small class='woocommerce-price-suffix'>(incl VAT, zero-rated)</small>
								</span>
							</span>
							";
					} elseif( '' === $tax_class ) {
						if ( 23 == $tax_rate ) {
							$tax_rate_percent = 1 + ($tax_rate / 100);
							$price_ex_vat = $price/$tax_rate_percent;
							$display_price = "
							<span class='price'>
								<span class='amount excl'>" . wc_price( $price_ex_vat ) ."
									<small class='woocommerce-price-suffix'>(excl VAT)</small>
								</span><br />
								<span class='amount incl'>" . wc_price( $price ) ."
									<small class='woocommerce-price-suffix'>(incl VAT)</small>
								</span>
							</span>
							";
						}
					}


				} else {
					// Not taxable.
							$display_price = "
							<span class='price'>
								<span class='amount'>" . wc_price( $price ) ."
									<small class='woocommerce-price-suffix'>(non-taxable)</small>
								</span>
							</span>
							";
				} // if taxable.
		} else {
						$display_price = "
							<span class='price'>
								<span class='amount'>Call for price</span>
							</span>
							";
		} // if price.

	// $price_incl_tax = $price + round( $price * ( 21 / 100 ), 2 );
	// $price_incl_tax = number_format( $price_incl_tax, 2, ',', '.' );
	// $price          = number_format( $price, 2, ',', '.' );

	echo $display_price;
	} // if product.

}
add_filter( 'woocommerce_get_price_html', 'gearys_edit_price_display' );


