<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
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

$classes = '';
$product_list_type = stockholm_qode_options()->getOptionValue( 'woo_products_list_type' );

if ( ! empty( $product_list_type ) ) {
	$classes .= $product_list_type;
	
	if ( $product_list_type == 'standard' ) {
		do_action( 'stockholm_qode_action_shop_standard_initial_setup' );
	}
	
	if ( $product_list_type == 'simple' ) {
		do_action( 'stockholm_qode_action_shop_simple_initial_setup' );
	}
}
?>
<ul class="products vc_grid-container vc_basic_grid columns-<?php echo esc_attr( wc_get_loop_prop( 'columns' ) ); ?> clearfix <?php echo esc_attr( $classes ); ?>">