<?php
/**
 * Genesass.
 *
 * These functions change the WooCommerce output.
 *
 * @package Genesass
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://github.com/gillespieza/genesass-and-genuflex/
 */



/**
 * Edit how the price is displayed re tax status
 *
 * @return void
 */
function gearys_edit_price_display() {
	global $product;

	if ( $product ) {

		print_r_hidden( '$product' );
		print_r_hidden( $product );

		$product_type   = $product->get_type();
		$tax_status     = $product->get_tax_status();
		$tax_class      = $product->get_tax_class();
		$price          = $product->get_price();
		$product_id     = $product->get_id();
		$tax_class_text = '';

		$tax_rate = WC_Tax::get_rates( $tax_class );
		if ( ! empty( $tax_rate ) ) {
			$tax_rate = reset( $tax_rate );
			$tax_rate = $tax_rate['rate'];
		}

		if ( 'simple' === $product_type ) {

			// if it has a price.
			if ( $price ) {
				// print_r_pre( '$price' );
				// print_r_pre( $price );

				// print_r_pre( '$product_type' );
				// print_r_pre( $product_type );

				// print_r_pre( '$tax_status' );
				// print_r_pre( $tax_status );

				// print_r_pre( '$tax_class' );
				// print_r_pre( $tax_class );

				// print_r_pre( '$tax_rate' );
				// print_r_pre( $tax_rate );

				if ( 'taxable' === $tax_status ) {
					if ( 'margin-scheme' === $tax_class ) {
						$display_price = "
								<span class='price'>
									<span class='amount excl'>" . wc_price( $price ) . "
										<small class='woocommerce-price-suffix'>(Margin Scheme)</small>
									</span>
								</span>
								";
					} elseif ( 'zero-rate' === $tax_class ) {
						$display_price = "
								<span class='price'>
									<span class='amount excl'>" . wc_price( $price ) . "
										<small class='woocommerce-price-suffix'>(incl VAT, zero-rated)</small>
									</span>
								</span>
								";
					} elseif ( '' === $tax_class ) {
						if ( is_int( $tax_rate ) || is_float( $tax_rate ) ) {
							$tax_rate_percent = 1 + ( $tax_rate / 100 );
							$price_ex_vat     = $price / $tax_rate_percent;
							$display_price    = "
								<span class='price'>
									<span class='amount excl'>" . wc_price( $price_ex_vat ) . "
										<small class='woocommerce-price-suffix'>(excl VAT)</small>
									</span><br />
									<span class='amount incl'>" . wc_price( $price ) . "
										<small class='woocommerce-price-suffix'>(incl VAT)</small>
									</span>
								</span>
								";
						} // 23% tax
					} // tax type
				} else {
					// Not taxable.
						$display_price = "
								<span class='price'>
									<span class='amount'>" . wc_price( $price ) . "
										<small class='woocommerce-price-suffix'>(non-taxable)</small>
									</span>
								</span>
								";
				} // if taxable.
			} else {

				// if there is no price.
				$display_price = "
				<span class='price'>
					<span class='amount'>Call us for a quote</span>
				</span>
				";
			} // if price.}

			echo $display_price;
		} // if simple.
	} // if product.
}
add_filter( 'woocommerce_get_price_html', 'gearys_edit_price_display' );



/** Replace Add To Cart button on archive/shop pages */
function gearys_replaced_add_to_cart_button( $button, $product ) {
	$button_text = __( 'Read More', 'woocommerce' );
	$button      = '<a class="button gb-button-size-small sidebar-display-none" href="' . $product->get_permalink() . '">' . $button_text . '</a>';

	return $button;
}
add_filter( 'woocommerce_loop_add_to_cart_link', 'gearys_replaced_add_to_cart_button', 10, 2 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
// // remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart');


// function gearys_remove_add_to_cart_buttons( $button ) {
// global $product;

// if( $product->is_type( 'external' ) ) {
// return '';
// }

// return $button;
// }


/**
 * @snippet       Change No. of Thumbnails per Row @ Product Gallery
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @testedwith    WooCommerce 5.0
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */
function bbloomer_5_columns_product_gallery( $wrapper_classes ) {
	$columns            = 3; // change this to 2, 3, 5, etc. Default is 4.
	$wrapper_classes[2] = 'woocommerce-product-gallery--columns-' . absint( $columns );
	return $wrapper_classes;
}
add_filter( 'woocommerce_single_product_image_gallery_classes', 'bbloomer_5_columns_product_gallery' );




function gearys_auction_ribbon() {
	global $product;
	$type = $product->get_type();

	if ( 'auction_simple' !== $type ) {
		return;
	}
	echo '<div class="ribbon ribbon-top-left"><span>Auction</span></div>';
}
add_filter( 'woocommerce_before_shop_loop_item_title', 'gearys_auction_ribbon', 9 );
