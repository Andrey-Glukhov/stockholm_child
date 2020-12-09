<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$type = stockholm_qode_options()->getOptionValue( 'woo_products_list_type' ) !== "" ? esc_attr( stockholm_qode_options()->getOptionValue( 'woo_products_list_type' )  ) : '';
?>
<?php switch($type) {
    case 'default': ?>
        <li <?php wc_product_class( '', $product ); ?>>

            <?php do_action('woocommerce_before_shop_loop_item'); ?>
            <div class="top-product-section vc_gitem-zone vc_gitem-zone-a vc-gitem-zone-height-mode-auto vc-gitem-zone-height-mode-auto-1-1 vc_gitem-is-link" 
            <?php
                $img_str =$product->get_image('1100w');
	            $pos_cut = strpos($img_str, 'src='); 
	            $img_str = substr($img_str,$pos_cut);
                preg_match('/(["\'])([^"\']*)\1/',$img_str,$matches);
                echo 'style="background-image: url(\'' . $matches[2] . '\') !important;"' 
            ?>
            >

                <a class="product_list_thumb_link vc-zone-link" href="<?php the_permalink(); ?>">
                    <span class="image-wrapper">
                    <?php
                    /**
                     * woocommerce_before_shop_loop_item_title hook
                     *
                     * @hooked woocommerce_show_product_loop_sale_flash - 10
                     * @hooked woocommerce_template_loop_product_thumbnail - 10
                     */
                    do_action('woocommerce_before_shop_loop_item_title');
                    ?>
                    </span>
                </a>

                <?php do_action('stockholm_qode_action_woocommerce_after_product_image'); ?>

            </div>

            <div class="product_info_box">
	            <?php echo wc_get_product_category_list( $product->get_id(), ', ','<span class="product-categories">','</span>' ); ?>

                <a href="<?php the_permalink(); ?>" class="product-category">
                    <span class="product-title"><?php the_title(); ?></span>

                    <?php
                    /**
                     * woocommerce_after_shop_loop_item_title hook
                     *
                     * @hooked woocommerce_template_loop_rating - 5
                     * @hooked woocommerce_template_loop_price - 10
                     */
                    do_action('woocommerce_after_shop_loop_item_title');
                    ?>
                </a>
            </div>

            <?php do_action('woocommerce_after_shop_loop_item'); ?>
        </li>

        <?php break;
    case 'standard': ?>

        <li <?php  post_class() ?> >
            <div class="qodef-product-standard-image-holder">
                <?php
                /**
                 * woocommerce_before_shop_loop_item hook.
                 * @hooked woocommerce_show_product_loop_sale_flash - 5
                 * @hooked stockholm_qode_get_woocommerce_out_of_stock - 5
                 * @hooked woocommerce_template_loop_product_link_open - 10
                 */
                do_action('stockholm_qode_action_shop_standard_woocommerce_before_shop_loop_item');
                ?>

                <span class="qodef-original-image">
                <?php
                /**
                 * woocommerce_before_shop_loop_item_title hook.
                 *
                 *
                 * @hooked woocommerce_template_loop_product_thumbnail - 10
                 *
                 */
                do_action('stockholm_qode_action_shop_standard_woocommerce_before_shop_loop_item_title');
                ?>

                </span>
                <span class="qodef-hover-image">
                <?php
                /**
                 * woocommerce_before_shop_loop_item_title hook.
                 *
                 * @hooked stockholm_qode_woocommerce_shop_loop_hover_image - 10
                 *
                 */
                do_action('stockholm_qode_action_shop_standard_woocommerce_shop_loop_item_hover_image');
                ?>

                </span>
                <?php

                /**
                 * woocommerce_before_shop_loop_item_title hook.
                 *
                 * @hooked woocommerce_template_loop_product_link_close - 15
                 *
                 */

                do_action('stockholm_qode_action_shop_standard_woocommerce_shop_loop_item_hover_link_close');
                ?>

                <div class="qodef-product-standard-button-holder">
                    <?php
                    /**
                     * woocommerce_before_shop_loop_item_title hook.
                     *
                     * @hooked stockholm_qode_woocommerce_shop_loop_button - 5
                     *
                     */
                    do_action('stockholm_qode_action_shop_standard_woocommerce_shop_loop_product_simple_button');
                    ?>

                </div>
            </div>
            <div class="qodef-product-standard-info-top">
                <?php
                /**
                 * qode_woocommerce_shop_loop_item_categories hook.
                 *
                 * @hooked stockholm_qode_woocommerce_shop_loop_categories - 5
                 *
                 */
                do_action('stockholm_qode_action_shop_standard_woocommerce_shop_loop_item_categories');
                ?>
                <div class="qodef-product-standard-title">
                    <?php
                    /**
                     * woocommerce_shop_loop_item_title hook.
                     *
                     * @hooked woocommerce_template_loop_product_link_open - 5
                     * @hooked woocommerce_template_loop_product_title - 10
                     * @hooked woocommerce_template_loop_product_link_close - 15
                     */
                    do_action( 'stockholm_qode_action_shop_standard_woocommerce_shop_loop_item_title' );
                    ?>
                </div>
                <?php
                /**
                 * woocommerce_after_shop_loop_item_title hook.
                 *
                 * @hooked woocommerce_template_loop_price - 10
                 */
                do_action('stockholm_qode_action_shop_standard_woocommerce_after_shop_loop_item_title');
                ?>
            </div>
        </li>
    <?php break;

    case 'simple': ?>

        <li <?php  post_class() ?> >
            <div class="qodef-product-simple-holder">
                <?php
                /**
                 * woocommerce_before_shop_loop_item hook.
                 * @hooked woocommerce_show_product_loop_sale_flash - 5
                 * @hooked stockholm_qode_get_woocommerce_out_of_stock - 5
                 * @hooked woocommerce_template_loop_product_link_open - 10
                 */
                do_action('stockholm_qode_action_shop_simple_woocommerce_before_shop_loop_item');
                ?>

                <?php
                /**
                 * woocommerce_before_shop_loop_item_title hook.
                 *
                 *
                 * @hooked woocommerce_template_loop_product_thumbnail - 10
                 *
                 */
                do_action('stockholm_qode_action_shop_simple_woocommerce_before_shop_loop_item_title');
                ?>

                <?php

                /**
                 * woocommerce_before_shop_loop_item_title hook.
                 *
                 * @hooked woocommerce_template_loop_product_link_close - 15
                 *
                 */

                do_action('stockholm_qode_action_shop_simple_woocommerce_shop_loop_item_hover_link_close');
                ?>
            </div>
            <div class="qodef-product-simple-overlay">
                <div class="qodef-product-simple-overlay-outer">
                    <div class="qodef-product-simple-overlay-inner">
                        <?php
                        /**
                         *
                         * @hooked woocommerce_template_loop_product_link_open - 5
                         * @hooked woocommerce_template_loop_product_link_close - 1
                         */
                        do_action( 'stockholm_qode_action_shop_simple_woocommerce_shop_loop_item_overlay' );
                        ?>
                        <div class="qodef-product-standard-title">
                            <?php
                            /**
                             * woocommerce_shop_loop_item_title hook.
                             *
                             * @hooked woocommerce_template_loop_product_link_open - 5
                             * @hooked woocommerce_template_loop_product_title - 10
                             * @hooked woocommerce_template_loop_product_link_close - 15
                             */
                            do_action( 'stockholm_qode_action_shop_simple_woocommerce_shop_loop_item_title' );
                            ?>
                        </div>
                        <?php
                        /**
                         * woocommerce_after_shop_loop_item_title hook.
                         *
                         * @hooked woocommerce_template_loop_price - 10
                         */
                        do_action('stockholm_qode_action_shop_simple_woocommerce_after_shop_loop_item_title');
                        ?>
                    </div>
                </div>
            </div>
        </li>
        <?php break;

	case 'elegant': ?>
        <li <?php wc_product_class( '', $product ); ?>>
			<?php
			/**
			 * woocommerce_before_shop_loop_item hook.
			 *
			 * @hooked woocommerce_template_loop_product_link_open - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item' );

			/**
			 * woocommerce_before_shop_loop_item_title hook.
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' );

			/**
			 * action for overriding woocommerce list templates and functions
			 */

            do_action('stockholm_qode_action_shop_elegant_woo_pl_info_below_image');

			/**
			 * woocommerce_shop_loop_item_title hook.
			 *
			 * @hooked woocommerce_template_loop_product_title - 10
			 */
			do_action( 'woocommerce_shop_loop_item_title' );

			/**
			 * woocommerce_after_shop_loop_item_title hook.
			 *
			 * @hooked woocommerce_template_loop_rating - 5
			 * @hooked woocommerce_template_loop_price - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item_title' );

			/**
			 * woocommerce_after_shop_loop_item hook.
			 *
			 * @hooked woocommerce_template_loop_product_link_close - 5
			 * @hooked woocommerce_template_loop_add_to_cart - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item' );
			?>
        </li>
		<?php break;
    default:  ?>
        <li <?php wc_product_class( '', $product ); ?>>

            <?php do_action('woocommerce_before_shop_loop_item'); ?>
            <div class="top-product-section">

                <a class="product_list_thumb_link" href="<?php the_permalink(); ?>">
                    <span class="image-wrapper">
                    <?php
                    /**
                     * woocommerce_before_shop_loop_item_title hook
                     *
                     * @hooked woocommerce_show_product_loop_sale_flash - 10
                     * @hooked woocommerce_template_loop_product_thumbnail - 10
                     */
                    do_action('woocommerce_before_shop_loop_item_title');
                    ?>
                    </span>
                </a>

                <?php do_action('stockholm_qode_action_woocommerce_after_product_image'); ?>

            </div>

            <div class="product_info_box">
	            <?php echo wc_get_product_category_list( $product->get_id(), ', ','<span class="product-categories">','</span>' ); ?>

                <a href="<?php the_permalink(); ?>" class="product-category">
                    <span class="product-title"><?php the_title(); ?></span>

                    <?php
                    /**
                     * woocommerce_after_shop_loop_item_title hook
                     *
                     * @hooked woocommerce_template_loop_rating - 5
                     * @hooked woocommerce_template_loop_price - 10
                     */
                    do_action('woocommerce_after_shop_loop_item_title');
                    ?>
                </a>
            </div>

            <?php do_action('woocommerce_after_shop_loop_item'); ?>

        </li>
    <?php break;
}