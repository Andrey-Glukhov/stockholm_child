<?php

//Duplicate function with changed enqueques
if ( ! function_exists( 'stockholm_qode_styles' ) ) {
	function stockholm_qode_styles() {
		global $is_chrome;
		global $is_safari;
		
		wp_enqueue_style( 'wp-mediaelement' );
		
		wp_enqueue_style( "stockholm-default-style", QODE_ROOT . "/style.css" );
		
		do_action( 'stockholm_qode_action_enqueue_before_main_css' );
		
		wp_enqueue_style( "stockholm-stylesheet", QODE_CSS_ROOT . "/stylesheet.min.css" );
		
		if ( $is_chrome || $is_safari ) {
			//include style for webkit browsers only
			wp_enqueue_style( "stockholm-webkit", QODE_ROOT . "/css/webkit_stylesheet.css" );
		}
		
		$responsiveness = "yes";
		if ( stockholm_qode_options()->getOptionValue( 'responsiveness' ) ) {
			$responsiveness = stockholm_qode_options()->getOptionValue( 'responsiveness' );
		}
		
		if ( stockholm_qode_is_woocommerce_installed() ) {
			// <<< The SEED team 27.11.2020  TO_DO
			wp_enqueue_style( "stockholm-woocommerce", QODE_CSS_ROOT . "/woocommerce.min.css" );
			//wp_enqueue_style( "stockholm-woocommerce", get_stylesheet_directory_uri() . "/css/woocommerce.css" );
			//>>>
			if ( $responsiveness != "no" ) {
				wp_enqueue_style( "stockholm-woocommerce_responsive", QODE_CSS_ROOT . "/woocommerce_responsive.min.css" );	
			}
		}
		
		if ( file_exists( QODE_CSS_ROOT_DIR . '/style_dynamic.css' ) && stockholm_qode_is_css_folder_writable() && ! is_multisite() ) {
			wp_enqueue_style( 'stockholm-style-dynamic', QODE_CSS_ROOT . '/style_dynamic.css', array(), filemtime( QODE_CSS_ROOT_DIR . '/style_dynamic.css' ) );
		} else if ( file_exists( QODE_CSS_ROOT_DIR . '/style_dynamic_ms_id_' . stockholm_qode_get_multisite_blog_id() . '.css' ) && stockholm_qode_is_css_folder_writable() && is_multisite() ) {
			wp_enqueue_style( 'stockholm-style-dynamic', QODE_CSS_ROOT . '/style_dynamic_ms_id_' . stockholm_qode_get_multisite_blog_id() . '.css', array(), filemtime( QODE_CSS_ROOT_DIR . '/style_dynamic_ms_id_' . stockholm_qode_get_multisite_blog_id() . '.css' ) );
		} else {
			wp_enqueue_style( 'stockholm-style-dynamic', QODE_CSS_ROOT . '/style_dynamic_callback.php' ); // Temporary case for Major update
		}
		
		if ( $responsiveness != "no" ):
			wp_enqueue_style( "stockholm-responsive", QODE_CSS_ROOT . "/responsive.min.css" );
			
			//include proper styles
			if ( file_exists( QODE_CSS_ROOT_DIR . '/style_dynamic_responsive.css' ) && stockholm_qode_is_css_folder_writable() && ! is_multisite() ) {
				wp_enqueue_style( 'stockholm-style-dynamic-responsive', QODE_CSS_ROOT . '/style_dynamic_responsive.css', array(), filemtime( QODE_CSS_ROOT_DIR . '/style_dynamic_responsive.css' ) );
			} else if ( file_exists( QODE_CSS_ROOT_DIR . '/style_dynamic_responsive_ms_id_' . stockholm_qode_get_multisite_blog_id() . '.css' ) && stockholm_qode_is_css_folder_writable() && is_multisite() ) {
				wp_enqueue_style( 'stockholm-style-dynamic-responsive', QODE_CSS_ROOT . '/style_dynamic_responsive_ms_id_' . stockholm_qode_get_multisite_blog_id() . '.css', array(), filemtime( QODE_CSS_ROOT_DIR . '/style_dynamic_responsive_ms_id_' . stockholm_qode_get_multisite_blog_id() . '.css' ) );
			} else {
				wp_enqueue_style( 'stockholm-style-dynamic-responsive', QODE_CSS_ROOT . '/style_dynamic_responsive_callback.php' ); // Temporary case for Major update
			}
		endif;
		
		//is left menu activated and is responsive turned on?
		if ( stockholm_qode_is_vertical_header_enabled() && $responsiveness != "no" ) {
			wp_enqueue_style( "stockholm-vertical-responsive", QODE_CSS_ROOT . "/vertical_responsive.min.css" );
		}
		
		if( stockholm_qode_return_toolbar_variable() ){
			wp_enqueue_style( "stockholm-toolbar", QODE_CSS_ROOT . "/toolbar.css" );
		}
		
		if ( stockholm_qode_return_landing_variable() ) {
			wp_enqueue_style( "stockholm-landing-fancybox", get_home_url() . "/demo-files/landing/css/jquery.fancybox.css" );
			wp_enqueue_style( "stockholm-landing", get_home_url() . "/demo-files/landing/css/landing_stylesheet_stripped.css" );
		}
		
		if ( stockholm_qode_visual_composer_installed() ) {
			wp_enqueue_style( 'js_composer_front' );
		}
		
		$custom_css = stockholm_qode_options()->getOptionValue( 'custom_css' );
		
		if ( ! empty( $custom_css ) ) {
			if ( $responsiveness != "no" ) {
				wp_add_inline_style( 'stockholm-style-dynamic-responsive', $custom_css );
			} else {
				wp_add_inline_style( 'stockholm-style-dynamic', $custom_css );
			}
		}
		
		$font_weight_str = '100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
		$font_subset_str = 'latin,latin-ext';
		
		//default fonts
		$default_font_family = array(
			'Raleway',
			'Crete Round'
		);
		
		$modified_default_font_family = array();
		foreach ( $default_font_family as $default_font ) {
			$modified_default_font_family[] = $default_font . ':' . str_replace( ' ', '', $font_weight_str );
		}
		
		$default_font_string = implode( '|', $modified_default_font_family );
		
		$available_font_options = array_filter( array(
			stockholm_qode_options()->getOptionValue( 'google_fonts' ),
			stockholm_qode_options()->getOptionValue( 'menu_google_fonts' ),
			stockholm_qode_options()->getOptionValue( 'dropdown_google_fonts' ),
			stockholm_qode_options()->getOptionValue( 'dropdown_wide_google_fonts' ),
			stockholm_qode_options()->getOptionValue( 'dropdown_google_fonts_thirdlvl' ),
			stockholm_qode_options()->getOptionValue( 'fixed_google_fonts' ),
			stockholm_qode_options()->getOptionValue( 'sticky_google_fonts' ),
			stockholm_qode_options()->getOptionValue( 'mobile_google_fonts' ),
			stockholm_qode_options()->getOptionValue( 'h1_google_fonts' ),
			stockholm_qode_options()->getOptionValue( 'h2_google_fonts' ),
			stockholm_qode_options()->getOptionValue( 'h3_google_fonts' ),
			stockholm_qode_options()->getOptionValue( 'h4_google_fonts' ),
			stockholm_qode_options()->getOptionValue( 'h5_google_fonts' ),
			stockholm_qode_options()->getOptionValue( 'h6_google_fonts' ),
			stockholm_qode_options()->getOptionValue( 'text_google_fonts' ),
			stockholm_qode_options()->getOptionValue( 'blockquote_font_family' ),
			stockholm_qode_options()->getOptionValue( 'page_title_google_fonts' ),
			stockholm_qode_options()->getOptionValue( 'page_subtitle_google_fonts' ),
			stockholm_qode_options()->getOptionValue( 'page_breadcrumb_google_fonts' ),
			stockholm_qode_options()->getOptionValue( 'blog_large_image_ql_title_font_family' ),
			stockholm_qode_options()->getOptionValue( 'blog_masonry_title_font_family' ),
			stockholm_qode_options()->getOptionValue( 'blog_masonry_ql_title_font_family' ),
			stockholm_qode_options()->getOptionValue( 'blog_single_title_font_family' ),
			stockholm_qode_options()->getOptionValue( 'blog_single_ql_title_font_family' ),
			stockholm_qode_options()->getOptionValue( 'blog_list_info_font_family' ),
			stockholm_qode_options()->getOptionValue( 'blog_large_image_ql_author_font_family' ),
			stockholm_qode_options()->getOptionValue( 'blog_masonry_author_font_family' ),
			stockholm_qode_options()->getOptionValue( 'contact_form_heading_google_fonts' ),
			stockholm_qode_options()->getOptionValue( 'pricing_tables_active_text_font_family' ),
			stockholm_qode_options()->getOptionValue( 'pricing_tables_title_font_family' ),
			stockholm_qode_options()->getOptionValue( 'pricing_tables_period_font_family' ),
			stockholm_qode_options()->getOptionValue( 'pricing_tables_price_font_family' ),
			stockholm_qode_options()->getOptionValue( 'pricing_tables_currency_font_family' ),
			stockholm_qode_options()->getOptionValue( 'pricing_tables_button_font_family' ),
			stockholm_qode_options()->getOptionValue( 'message_title_google_fonts' ),
			stockholm_qode_options()->getOptionValue( 'pagination_font_family' ),
			stockholm_qode_options()->getOptionValue( 'button_title_google_fonts' ),
			stockholm_qode_options()->getOptionValue( 'testimonials_text_font_family' ),
			stockholm_qode_options()->getOptionValue( 'testimonials_author_font_family' ),
			stockholm_qode_options()->getOptionValue( 'tabs_nav_font_family' ),
			stockholm_qode_options()->getOptionValue( 'footer_top_text_font_family' ),
			stockholm_qode_options()->getOptionValue( 'footer_top_link_font_family' ),
			stockholm_qode_options()->getOptionValue( 'footer_bottom_text_font_family' ),
			stockholm_qode_options()->getOptionValue( 'footer_bottom_link_font_family' ),
			stockholm_qode_options()->getOptionValue( 'footer_title_font_family' ),
			stockholm_qode_options()->getOptionValue( 'sidebar_title_font_family' ),
			stockholm_qode_options()->getOptionValue( 'sidebar_link_font_family' ),
			stockholm_qode_options()->getOptionValue( 'side_area_title_google_fonts' ),
			stockholm_qode_options()->getOptionValue( 'sidearea_link_font_family' ),
			stockholm_qode_options()->getOptionValue( 'vertical_menu_google_fonts' ),
			stockholm_qode_options()->getOptionValue( 'vertical_dropdown_google_fonts' ),
			stockholm_qode_options()->getOptionValue( 'vertical_dropdown_google_fonts_thirdlvl' ),
			stockholm_qode_options()->getOptionValue( 'popup_menu_google_fonts' ),
			stockholm_qode_options()->getOptionValue( 'popup_menu_google_fonts_2nd' ),
			stockholm_qode_options()->getOptionValue( 'portfolio_single_big_title_font_family' ),
			stockholm_qode_options()->getOptionValue( 'portfolio_single_small_title_font_family' ),
			stockholm_qode_options()->getOptionValue( 'portfolio_single_meta_title_font_family' ),
			stockholm_qode_options()->getOptionValue( 'portfolio_single_meta_text_font_family' ),
			stockholm_qode_options()->getOptionValue( 'top_header_text_font_family' ),
			stockholm_qode_options()->getOptionValue( 'portfolio_filter_title_font_family' ),
			stockholm_qode_options()->getOptionValue( 'portfolio_filter_font_family' ),
			stockholm_qode_options()->getOptionValue( 'portfolio_title_standard_list_font_family' ),
			stockholm_qode_options()->getOptionValue( 'portfolio_category_standard_list_font_family' ),
			stockholm_qode_options()->getOptionValue( 'portfolio_title_list_font_family' ),
			stockholm_qode_options()->getOptionValue( 'portfolio_category_list_font_family' ),
			stockholm_qode_options()->getOptionValue( 'expandable_label_font_family' ),
			stockholm_qode_options()->getOptionValue( '404_title_font_family' ),
			stockholm_qode_options()->getOptionValue( '404_text_font_family' ),
			stockholm_qode_options()->getOptionValue( 'woo_products_category_font_family' ),
			stockholm_qode_options()->getOptionValue( 'woo_products_title_font_family' ),
			stockholm_qode_options()->getOptionValue( 'woo_products_price_font_family' ),
			stockholm_qode_options()->getOptionValue( 'woo_products_sale_font_family' ),
			stockholm_qode_options()->getOptionValue( 'woo_products_out_of_stock_font_family' ),
			stockholm_qode_options()->getOptionValue( 'woo_products_sorting_result_font_family' ),
			stockholm_qode_options()->getOptionValue( 'woo_products_list_add_to_cart_font_family' ),
			stockholm_qode_options()->getOptionValue( 'woo_product_single_meta_title_font_family' ),
			stockholm_qode_options()->getOptionValue( 'woo_product_single_meta_info_font_family' ),
			stockholm_qode_options()->getOptionValue( 'woo_product_single_title_font_family' ),
			stockholm_qode_options()->getOptionValue( 'woo_products_single_add_to_cart_font_family' ),
			stockholm_qode_options()->getOptionValue( 'woo_product_single_price_font_family' ),
			stockholm_qode_options()->getOptionValue( 'woo_product_single_related_font_family' ),
			stockholm_qode_options()->getOptionValue( 'vc_grid_portfolio_filter_font_family' ),
			stockholm_qode_options()->getOptionValue( 'vc_grid_button_title_google_fonts' ),
			stockholm_qode_options()->getOptionValue( 'vc_grid_load_more_button_title_google_fonts' ),
			stockholm_qode_options()->getOptionValue( 'blog_chequered_with_image_title_font_family' ),
			stockholm_qode_options()->getOptionValue( 'blog_chequered_with_bgcolor_title_font_family' ),
			stockholm_qode_options()->getOptionValue( 'blog_animated_title_font_family' ),
			stockholm_qode_options()->getOptionValue( 'blog_centered_title_font_family' ),
			stockholm_qode_options()->getOptionValue( 'blog_centered_info_font_family' ),
			stockholm_qode_options()->getOptionValue( 'testimonials_title_font_family' ),
			stockholm_qode_options()->getOptionValue( 'testimonials_author_job_font_family' ),
			stockholm_qode_options()->getOptionValue( 'woo_products_standard_category_font_family' ),
			stockholm_qode_options()->getOptionValue( 'woo_products_standard_title_font_family' ),
			stockholm_qode_options()->getOptionValue( 'woo_products_standard_price_font_family' ),
			stockholm_qode_options()->getOptionValue( 'woo_products_standard_list_add_to_cart_font_family' ),
			stockholm_qode_options()->getOptionValue( 'gf_title_font_family' ),
			stockholm_qode_options()->getOptionValue( 'gf_label_font_family' ),
			stockholm_qode_options()->getOptionValue( 'gf_description_font_family' )
		) );
		
		$additional_fonts_args  = array( 'post_status' => 'publish', 'post_type' => 'slides', 'posts_per_page' => - 1 );
		$additional_fonts_query = new WP_Query( $additional_fonts_args );
		
		if ( $additional_fonts_query->have_posts() ):
			while ( $additional_fonts_query->have_posts() ) : $additional_fonts_query->the_post();
				$post_id = get_the_ID();
				
				if ( get_post_meta( $post_id, "qode_slide-title-font-family", true ) != "" ) {
					array_push( $available_font_options, get_post_meta( $post_id, "qode_slide-title-font-family", true ) );
				}
				if ( get_post_meta( $post_id, "qode_slide-text-font-family", true ) != "" ) {
					array_push( $available_font_options, get_post_meta( $post_id, "qode_slide-text-font-family", true ) );
				}
				if ( get_post_meta( $post_id, "qode_slide-subtitle-font-family", true ) != "" ) {
					array_push( $available_font_options, get_post_meta( $post_id, "qode_slide-subtitle-font-family", true ) );
				}
			endwhile;
		endif;
		
		wp_reset_postdata();
		
		//define available font options array
		$fonts_array = array();
		if ( ! empty( $available_font_options ) ) {
			foreach ( $available_font_options as $font_option_value ) {
				$font_option_string = $font_option_value . ':' . $font_weight_str;
				
				if ( ! in_array( str_replace( '+', ' ', $font_option_value ), $default_font_family ) && ! in_array( $font_option_string, $fonts_array ) ) {
					$fonts_array[] = $font_option_string;
				}
			}
			
			$fonts_array = array_diff( $fonts_array, array( '-1:' . $font_weight_str ) );
		}
		
		$google_fonts_string = implode( '|', $fonts_array );
		
		$protocol = is_ssl() ? 'https:' : 'http:';
		
		//is google font option checked anywhere in theme?
		if ( is_array( $fonts_array ) && count( $fonts_array ) > 0 ) {
			
			//include all checked fonts
			$fonts_full_list      = $default_font_string . '|' . str_replace( '+', ' ', $google_fonts_string );
			$fonts_full_list_args = array(
				'family' => urlencode( $fonts_full_list ),
				'subset' => urlencode( $font_subset_str ),
			);
			
			$stockholm_global_fonts = add_query_arg( $fonts_full_list_args, $protocol . '//fonts.googleapis.com/css' );
			wp_enqueue_style( 'stockholm-google-fonts', esc_url_raw( $stockholm_global_fonts ), array(), '1.0.0' );
			
		} else {
			//include default google font that theme is using
			$default_fonts_args          = array(
				'family' => urlencode( $default_font_string ),
				'subset' => urlencode( $font_subset_str ),
			);
			$stockholm_global_fonts = add_query_arg( $default_fonts_args, $protocol . '//fonts.googleapis.com/css' );
			wp_enqueue_style( 'stockholm-google-fonts', esc_url_raw( $stockholm_global_fonts ), array(), '1.0.0' );
		}
		// <<< The SEED Team  01.12.2020
		wp_enqueue_style( 'stockholm-child-styles', get_stylesheet_directory_uri() . '/css/stockholm_child.css', array(), '1.0.0' );
		// >>>
	}
	
	add_action( 'wp_enqueue_scripts', 'stockholm_qode_styles' );
}
//Duplicate function with changed enqueques
if ( ! function_exists( 'stockholm_qode_scripts' ) ) {
	function stockholm_qode_scripts() {
		global $is_IE;
		global $is_chrome;
		global $is_opera;
		
		//init theme core scripts
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-widget' );
		wp_enqueue_script( 'jquery-ui-accordion' );
		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_script( 'jquery-effects-core' );
		wp_enqueue_script( 'jquery-effects-fade' );
		wp_enqueue_script( 'jquery-effects-scale' );
		wp_enqueue_script( 'jquery-effects-slide' );
		wp_enqueue_script( 'jquery-ui-position' );
		wp_enqueue_script( 'jquery-ui-slider' );
		wp_enqueue_script( 'jquery-ui-tabs' );
		wp_enqueue_script( 'jquery-form' );
		wp_enqueue_script( 'wp-mediaelement' );
		
		// 3rd party JavaScripts that we used in our theme
		wp_enqueue_script( 'doubletaptogo', QODE_JS_ROOT . '/plugins/doubletaptogo.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'modernizr', QODE_JS_ROOT . '/plugins/modernizr.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'appear', QODE_JS_ROOT . '/plugins/jquery.appear.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'hoverIntent' );
		wp_enqueue_script( 'absoluteCounter', QODE_JS_ROOT . '/plugins/absoluteCounter.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'easypiechart', QODE_JS_ROOT . '/plugins/easypiechart.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'mixitup', QODE_JS_ROOT . '/plugins/jquery.mixitup.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'nicescroll', QODE_JS_ROOT . '/plugins/jquery.nicescroll.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'prettyphoto', QODE_JS_ROOT . '/plugins/jquery.prettyPhoto.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'fitvids', QODE_JS_ROOT . '/plugins/jquery.fitvids.js', array( 'jquery' ), false, true );
		// <<< The SEED team 27.11.2020
		//wp_enqueue_script( 'flexslider', QODE_JS_ROOT . '/plugins/jquery.flexslider-min.js', array( 'jquery' ), false, true );
		wp_deregister_script('flexslider');
		wp_register_script( 'flexslider', get_stylesheet_directory_uri() . '/js/plugins/jquery.flexslider.js', array( 'jquery' ), false, true );
		wp_enqueue_script('flexslider');
		//>>>
		wp_enqueue_script( 'infinitescroll', QODE_JS_ROOT . '/plugins/infinitescroll.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'waitforimages', QODE_JS_ROOT . '/plugins/jquery.waitforimages.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'waypoints', QODE_JS_ROOT . '/plugins/waypoints.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'jplayer', QODE_JS_ROOT . '/plugins/jplayer.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'bootstrap-carousel', QODE_JS_ROOT . '/plugins/bootstrap.carousel.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'skrollr', QODE_JS_ROOT . '/plugins/skrollr.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'Chart', QODE_JS_ROOT . '/plugins/Chart.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'jquery-easing-1.3', QODE_JS_ROOT . '/plugins/jquery.easing.1.3.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'jquery-plugin', QODE_JS_ROOT . '/plugins/jquery.plugin.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'countdown', QODE_JS_ROOT . '/plugins/jquery.countdown.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'justifiedGallery', QODE_JS_ROOT . '/plugins/jquery.justifiedGallery.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'owl-carousel', QODE_JS_ROOT . '/plugins/owl.carousel.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( "carouFredSel", QODE_JS_ROOT . "/plugins/jquery.carouFredSel-6.2.1.js", array( 'jquery' ), false, true );
		wp_enqueue_script( "fullPage", QODE_JS_ROOT . "/plugins/jquery.fullPage.min.js", array( 'jquery' ), false, true );
		wp_enqueue_script( "lemmonSlider", QODE_JS_ROOT . "/plugins/lemmon-slider.js", array( 'jquery' ), false, true );
		wp_enqueue_script( "mousewheel", QODE_JS_ROOT . "/plugins/jquery.mousewheel.min.js", array( 'jquery' ), false, true );
		wp_enqueue_script( "touchSwipe", QODE_JS_ROOT . "/plugins/jquery.touchSwipe.min.js", array( 'jquery' ), false, true );
		wp_enqueue_script( "isotope", QODE_JS_ROOT . "/plugins/jquery.isotope.min.js", array( 'jquery' ), false, true );
		wp_enqueue_script( "parallax-scroll", QODE_JS_ROOT . "/plugins/jquery.parallax-scroll.js", array( 'jquery' ), false, true );
		
		do_action( 'stockholm_qode_action_enqueue_additional_scripts' );
		
		if ( ( $is_chrome || $is_opera ) && stockholm_qode_options()->getOptionValue( 'smooth_scroll' ) == "yes" ) {
			wp_enqueue_script( "smooth-scroll", QODE_JS_ROOT . "/plugins/SmoothScroll.js", array( 'jquery' ), false, true );
		}
	
		if ( $is_IE ) {
			wp_enqueue_script( "html5", QODE_JS_ROOT . "/plugins/html5.js", array( 'jquery' ), false, false );
		}
		if ( stockholm_qode_options()->getOptionValue( 'enable_google_map' ) == "yes" || stockholm_qode_has_google_map_shortcode() ) :
			$google_maps_api_key = stockholm_qode_options()->getOptionValue( 'google_maps_api_key' );
		
			if ( ! empty( $google_maps_api_key ) ) {
				wp_enqueue_script( "stockholm-google-map-api", "https://maps.googleapis.com/maps/api/js?key=" . esc_attr( $google_maps_api_key ), array( 'jquery' ), false, true );
			}
		endif;
		
		if ( file_exists( QODE_JS_ROOT_DIR . '/default_dynamic.js' ) && stockholm_qode_is_js_folder_writable() && ! is_multisite() ) {
			wp_enqueue_script( 'stockholm-default-dynamic', QODE_JS_ROOT . '/default_dynamic.js', array( 'jquery' ), filemtime( QODE_JS_ROOT_DIR . '/default_dynamic.js' ), true );
		} else if ( file_exists( QODE_JS_ROOT_DIR . '/default_dynamic_ms_id_' . stockholm_qode_get_multisite_blog_id() . '.js' ) && stockholm_qode_is_js_folder_writable() && is_multisite() ) {
			wp_enqueue_script( 'stockholm-default-dynamic', QODE_JS_ROOT . '/default_dynamic_ms_id_' . stockholm_qode_get_multisite_blog_id() . '.js', array( 'jquery' ), filemtime( QODE_JS_ROOT_DIR . '/default_dynamic_ms_id_' . stockholm_qode_get_multisite_blog_id() . '.js' ), true );
		} else {
			wp_enqueue_script( 'stockholm-default-dynamic', QODE_JS_ROOT . '/default_dynamic_callback.php', array( 'jquery' ), false, true ); // Temporary case for Major update 4.0
		}
		// <<< The SEED team 27.11.2020
		//wp_enqueue_script( "stockholm-default", QODE_JS_ROOT . "/default.min.js", array( 'jquery' ), false, true );
		wp_enqueue_script( "stockholm-default", get_stylesheet_directory_uri() . "/js/default.js", array( 'jquery' ), false, true );
		// >>>
		
		$custom_js = stockholm_qode_options()->getOptionValue( 'custom_js' );
		if ( ! empty( $custom_js ) ) {
			wp_add_inline_script( 'stockholm-default', $custom_js );
		}
		
		global $wp_scripts;
		$wp_scripts->add_data( 'comment-reply', 'group', 1 );
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( "comment-reply" );
		}
		

		
		if ( stockholm_qode_is_woocommerce_installed() ) {
			wp_enqueue_script( "stockholm-woocommerce", QODE_JS_ROOT . "/woocommerce.min.js", array( 'jquery' ), false, true );
			wp_enqueue_script( "select2" );
		}
		
		$has_ajax       = false;
		$qode_animation = "";
		if ( isset( $_SESSION['qode_stockholm_page_transitions'] ) ) {
			$qode_animation = $_SESSION['qode_stockholm_page_transitions'];
		}
		if ( stockholm_qode_is_page_transition_enabled() && ( empty( $qode_animation ) || ( $qode_animation != "no" ) ) ) {
			$has_ajax = true;
		} elseif ( ! empty( $qode_animation ) && ( $qode_animation != "no" ) ) {
			$has_ajax = true;
		}
		
		if ( $has_ajax ) :
			wp_enqueue_script( "stockholm-ajax", QODE_JS_ROOT . "/ajax.min.js", array( 'jquery' ), false, true );
		endif;
		
		if ( stockholm_qode_visual_composer_installed() ) {
			wp_enqueue_script( 'wpb_composer_front_js' );
		}

		if ( stockholm_qode_options()->getOptionValue( 'use_recaptcha' ) == "yes" ) :
			$url = 'https://www.google.com/recaptcha/api.js';
			$url = add_query_arg( array(
				'onload' => 'stockholmdQodeRecaptchaCallback',
				'render' => 'explicit' ), $url );
			wp_enqueue_script("recaptcha", $url, array('jquery'),false,true);
		endif;

		
		if( stockholm_qode_return_toolbar_variable() ){
			wp_enqueue_script("stockholm-toolbar", QODE_JS_ROOT. "/toolbar.js",array( 'jquery' ),false,true);
		}
		
		if ( stockholm_qode_return_landing_variable() ) {
			wp_enqueue_script( "stockholm-landing-fancybox", get_home_url() . "/demo-files/landing/js/jquery.fancybox.js", array( 'jquery' ), false, true );
			wp_enqueue_script( "stockholm-landing", get_home_url() . "/demo-files/landing/js/landing_default.js", array( 'jquery' ), false, true );
		}
	}
	
	add_action('wp_enqueue_scripts', 'stockholm_qode_scripts');
}


// New widget 
class PostsNotCurrentWidget extends WP_Widget {
 
	
	function __construct() {
		parent::__construct(
			'posts_not_current', 
			'Posts Not Current', 
			array( 'description' => 'Displays Posts Not Current' ) 
		);
	}
 
	
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] ); 
		$posts_per_page = $instance['posts_per_page'];
 
		echo $args['before_widget'];
 
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];
 		$current_ID = get_the_ID();
		$q = new WP_Query(array('post_type'=>'portfolio_page',
						'post__not_in'=> array($current_ID),
								'posts_per_page'=> -1,
							   'orderby'=>'rand'));
		if( $q->have_posts() ):
			while( $q->have_posts() ): $q->the_post();
			get_template_part( 'templates/portfolio/portfolio-structure' );
			endwhile;
			?><?php
		endif;
		wp_reset_postdata();
 
		echo $args['after_widget'];
	}
 
	
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		if ( isset( $instance[ 'posts_per_page' ] ) ) {
			$posts_per_page = $instance[ 'posts_per_page' ];
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Heading</label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'posts_per_page' ); ?>">number of posts :</label> 
			<input id="<?php echo $this->get_field_id( 'posts_per_page' ); ?>" name="<?php echo $this->get_field_name( 'posts_per_page' ); ?>" type="text" value="<?php echo ($posts_per_page) ? esc_attr( $posts_per_page ) : '5'; ?>" size="3" />
		</p>
		<?php 
	}
 
	
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['posts_per_page'] = ( is_numeric( $new_instance['posts_per_page'] ) ) ? $new_instance['posts_per_page'] : '5'; // по умолчанию выводятся 5 постов
		return $instance;
	}
}
 

function true_top_posts_widget_load() {
	register_widget( 'PostsNotCurrentWidget' );
}
add_action( 'widgets_init', 'true_top_posts_widget_load' );

// Woocommerce
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering',30);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash',10);

add_filter('woocommerce_price_trim_zeros', 'wc_hide_trailing_zeros', 10, 1);

function wc_hide_trailing_zeros ($trim) {
	return true;
}

remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail',10);
// add_filter('loop_shop_columns', function($col) {
// 	return 3;
// }, 999);

add_filter('woocommerce_post_class', 'add_wc_product_post_class', 999,3);
function add_wc_product_post_class($class_array, $product_obj) {
	$find_key = array_search('product', $class_array, true);
	$class_array[$find_key] = 'vc_grid-item vc_clearfix vc_col-sm-4 vc_visible-item fadeIn animated'; //'product_child';
	//error_log(implode($class_array));
	// $img_str =$product_obj->get_image('1100w');
	// $pos_cut = strpos($img_str, 'src='); 
	// $img_str = substr($img_str,$pos_cut);
	// preg_match('/(["\'])([^"\']*)\1/',$img_str,$matches);
	// error_log($img_str);
	// error_log($matches[2]);
	return $class_array;
}

//  Redefine "stockholm_qode_woocommerce_content"

if ( ! function_exists( 'stockholm_qode_woocommerce_content' ) ) {
	/**
	 * Output WooCommerce content.
	 *
	 * This function is only used in the optional 'woocommerce.php' template
	 * which people can add to their themes to add basic woocommerce support
	 * without hooks or modifying core templates.
	 *
	 * @access public
	 * @return void
	 */
	function stockholm_qode_woocommerce_content() {
		
		if ( is_singular( 'product' ) ) {
			
			while ( have_posts() ) : the_post();
				
				wc_get_template_part( 'content', 'single-product' );
			
			endwhile;
			
		} else {
			
			do_action( 'woocommerce_archive_description' );
			
			if ( have_posts() ) {
				
		
				/**
				 * Hook: woocommerce_before_shop_loop.
				 *
				 * @hooked wc_print_notices - 10
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );
				
				woocommerce_product_loop_start();

				// <<< The SED Team set columns  per row
				$col_count = 3; // columns in a row
				$col_now = 0;
				//>>>
				if ( wc_get_loop_prop( 'total' ) ) {
					echo '<div class = "product_flex vc_grid vc_row vc_grid-gutter-5px ">'; //vc_pageable-wrapper vc_hook_hover">';
					while ( have_posts() ) {
					
						the_post();
						
						/**
						 * Hook: woocommerce_shop_loop.
						 *
						 * @hooked WC_Structured_Data::generate_product_data() - 10
						 */
						do_action( 'woocommerce_shop_loop' );
						
						wc_get_template_part( 'content', 'product' );
						
					}
					echo '</div>';
				}
				
				woocommerce_product_loop_end();
		
				/**
				 * Hook: woocommerce_after_shop_loop.
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			} else {
				/**
				 * Hook: woocommerce_no_products_found.
				 *
				 * @hooked wc_no_products_found - 10
				 */
				do_action( 'woocommerce_no_products_found' );
			}
		}
	}
}

if ( ! function_exists( 'woocommerce_get_product_thumbnail' ) ) {

	/**
	 * Get the product thumbnail, or the placeholder if not set.
	 *
	 * @param string $size (default: 'woocommerce_thumbnail').
	 * @param int    $deprecated1 Deprecated since WooCommerce 2.0 (default: 0).
	 * @param int    $deprecated2 Deprecated since WooCommerce 2.0 (default: 0).
	 * @return string
	 */
	function woocommerce_get_product_thumbnail( $size = 'woocommerce_thumbnail', $deprecated1 = 0, $deprecated2 = 0 ) {
		global $product;

		//$image_size = apply_filters( 'single_product_archive_thumbnail_size', $size );
		$image_size = '1100w';
		return $product ? $product->get_image( $image_size ) : '';
	}
}
