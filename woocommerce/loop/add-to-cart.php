<?php
/**
 * Loop Add to Cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/add-to-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

if ( ! $product->is_in_stock() ) : 
	
	echo sprintf( '<div class="add-to-cart-shadow"></div><div class="add-to-cart-button-outer"><div class="add-to-cart-button-inner"><div class="add-to-card-name-child">%s</div><div class="out-of-stock-button-child">%s</div></div></div>',
		esc_html($product->get_title()),
		apply_filters( 'out_of_stock_add_to_cart_text', esc_html__( 'Soldout', 'stockholm' ) )//,//$product->get_price_html(),
		//esc_url( $product->add_to_cart_url() ),
		//esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
		//esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
		//isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
		//esc_html( $product->add_to_cart_text() ),
		//''
		);
	//echo sprintf('<div class="add-to-card-name-child">%s</div>', esc_html($product->get_title()));
 else :
	echo apply_filters( 'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
		sprintf( '<div class="add-to-cart-shadow"></div><div class="add-to-cart-button-outer"><div class="add-to-cart-button-inner"><div class="add-to-card-name-child">%s</div><div class="add-to-card-price-child">%s</div></div></div><div class="add-to-cart-button-inner2"><a href="%s" data-quantity="%s" class="qbutton add-to-cart-button %s" %s>%s</a></div>',
			esc_html($product->get_title()),
			$product->get_price_html(),
			esc_url( $product->add_to_cart_url() ),
			esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
			esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
			isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
			//esc_html( $product->add_to_cart_text() ),
			''
		),
		$product, $args );

endif;