<?php
$qode_page_id = stockholm_qode_get_page_id();

$menu_dropdown_appearance_class = '';
if ( stockholm_qode_options()->getOptionValue( 'menu_dropdown_appearance' ) ) {
	$menu_dropdown_appearance_class = stockholm_qode_options()->getOptionValue( 'menu_dropdown_appearance' ) ;
}

$menu_position = "";
if ( stockholm_qode_options()->getOptionValue( 'menu_position' ) ) {
	$menu_position = stockholm_qode_options()->getOptionValue( 'menu_position' ) ;
}

$centered_logo = false;
if ( stockholm_qode_options()->getOptionValue( 'center_logo_image' ) == "yes" ) {
	$centered_logo = true;
}

$centered_logo_animate = false;
if ( stockholm_qode_options()->getOptionValue( 'center_logo_image_animate' ) == "yes" ) {
	$centered_logo_animate = true;
}

$enable_border_top_bottom_menu = false;
if ( stockholm_qode_options()->getOptionValue( 'enable_border_top_bottom_menu' ) == "yes" ) {
	$enable_border_top_bottom_menu = true;
}

if ( stockholm_qode_get_header_bottom_appearance() == "fixed_hiding" ) {
	$centered_logo         = true;
	$centered_logo_animate = true;
}

$header_color_transparency_per_page = "";
if ( stockholm_qode_options()->getOptionValue( 'header_background_transparency_initial' ) ) {
	$header_color_transparency_per_page = stockholm_qode_options()->getOptionValue( 'header_background_transparency_initial' ) ;
}
if ( get_post_meta( $qode_page_id, "qode_header_color_transparency_per_page", true ) != "" ) {
	$header_color_transparency_per_page = get_post_meta( $qode_page_id, "qode_header_color_transparency_per_page", true );
}

$header_bottom_styles = array();

if ( get_post_meta( $qode_page_id, "qode_header_color_per_page", true ) != "" ) {
	if ( $header_color_transparency_per_page != "" ) {
		$header_background_color = stockholm_qode_hex2rgb( get_post_meta( $qode_page_id, "qode_header_color_per_page", true ) );
		$header_bottom_styles[]  = "background-color:rgba(" . $header_background_color[0] . ", " . $header_background_color[1] . ", " . $header_background_color[2] . ", " . $header_color_transparency_per_page . ");";
	} else {
		$header_bottom_styles[] = "background-color:" . get_post_meta( $qode_page_id, "qode_header_color_per_page", true );
	}
} else if ( $header_color_transparency_per_page != "" && get_post_meta( $qode_page_id, "qode_header_color_per_page", true ) == "" ) {
	$header_background_color = stockholm_qode_options()->getOptionValue( 'header_background_color' ) ? stockholm_qode_hex2rgb( stockholm_qode_options()->getOptionValue( 'header_background_color' )  ) : stockholm_qode_hex2rgb( "#ffffff" );
	$header_bottom_styles[]  = "background-color:rgba(" . $header_background_color[0] . ", " . $header_background_color[1] . ", " . $header_background_color[2] . ", " . $header_color_transparency_per_page . ");";
}

if ( stockholm_qode_options()->getOptionValue( 'header_botom_border_in_grid' ) != "yes" && get_post_meta( $qode_page_id, "qode_header_bottom_border_color", true ) != "" ) {
	$header_bottom_styles[] = "border-bottom: 1px solid " . get_post_meta( $qode_page_id, "qode_header_bottom_border_color", true );
}

$header_bottom_container_styles = array();
if ( stockholm_qode_options()->getOptionValue( 'header_botom_border_in_grid' ) == "yes" && get_post_meta( $qode_page_id, "qode_header_bottom_border_color", true ) != "" ) {
	$header_bottom_container_styles[] = 'border-bottom: 1px solid ' . esc_attr( get_post_meta( $qode_page_id, "qode_header_bottom_border_color", true ) );
}

if ( ! stockholm_qode_is_vertical_header_enabled() ) { ?>
	<header class="page_header <?php stockholm_qode_header_classes(); ?>">
		<div class="cart_link">
			<a href="<?php global  $woocommerce; echo $woocommerce->cart->get_cart_url(); ?>" class="cart_link_span"></a>
			<span class="cart_link_text"><?php echo sprintf($woocommerce->cart->cart_contents_count); ?></span>	
			<div class="card_link_icon"></div>
		</div>
		<?php get_template_part( 'framework/modules/toolbar/toolbar' ); ?>
		
		<div class="header_inner clearfix">
			<?php get_template_part( 'framework/modules/search/templates/search-area', 'from-window-top' ); ?>
			
			<div class="header_top_bottom_holder">
				<?php get_template_part( 'framework/modules/header/top-header/templates/top-header-area' ); ?>
				
				<div class="header_bottom clearfix" <?php stockholm_qode_inline_style( $header_bottom_styles ); ?>>
					<?php if ( stockholm_qode_get_header_in_grid() ){ ?>
					<div class="container">
						<div class="container_inner clearfix" <?php stockholm_qode_inline_style( $header_bottom_container_styles ); ?>>
							<?php } ?>
							<?php if ( stockholm_qode_get_header_bottom_appearance() == "stick_with_left_right_menu" ) { ?>
								<nav class="main_menu drop_down left_side <?php echo esc_attr( $menu_dropdown_appearance_class ); ?>">
									<?php
									wp_nav_menu( array(
										'theme_location'  => 'left-top-navigation',
										'container'       => '',
										'container_class' => '',
										'menu_class'      => '',
										'menu_id'         => '',
										'fallback_cb'     => 'stokcholm_qode_top_navigation_fallback',
										'link_before'     => '<span>',
										'link_after'      => '</span>',
										'walker'          => new stockholm_qode_type1_walker_nav_menu()
									) );
									?>
								</nav>
							<?php } ?>
							<div class="header_inner_left">
								<?php if ( $centered_logo && stockholm_qode_get_header_bottom_appearance() !== "stick menu_bottom" ) {
									dynamic_sidebar( 'header_left_from_logo' );
								} ?>
								<?php get_template_part( 'framework/modules/header/mobile-header/templates/mobile-header-opener' ); ?>
								<div class="logo_wrapper">
									<div class="q_logo">
										<?php get_template_part( 'framework/modules/header/templates/logo' ); ?>
									</div>
									<?php if ( stockholm_qode_get_header_bottom_appearance() == "fixed_hiding" ) {
										if ( stockholm_qode_options()->getOptionValue( 'logo_image_fixed_hidden' ) !== "" ) {
											$logo_image_fixed_hidden = stockholm_qode_options()->getOptionValue( 'logo_image_fixed_hidden' ) ;
										} else {
											$logo_image_fixed_hidden = get_template_directory_uri() . '/img/logo.png';
										}
										?>
										<div class="q_logo_hidden">
											<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
												<img alt="<?php esc_attr_e( 'Logo', 'stockholm' ); ?>" src="<?php echo esc_url( $logo_image_fixed_hidden ); ?>">
											</a>
										</div>
									<?php } ?>
								</div>
								<?php if ( stockholm_qode_get_header_bottom_appearance() == "stick menu_bottom" && is_active_sidebar( 'header_fixed_right' ) ) { ?>
									<div class="header_fixed_right_area">
										<?php dynamic_sidebar( 'header_fixed_right' ); ?>
									</div>
								<?php } ?>
								<?php if ( $centered_logo && stockholm_qode_get_header_bottom_appearance() !== "stick menu_bottom" ) {
									dynamic_sidebar( 'header_right_from_logo' );
								} ?>

                                <?php if ( ! $centered_logo && $menu_position == "left" ) { ?>
									<nav class="main_menu drop_down <?php echo esc_attr( $menu_dropdown_appearance_class ); ?> left">
									<?php
									wp_nav_menu( array(
										'theme_location'  => 'top-navigation',
										'container'       => '',
										'container_class' => '',
										'menu_class'      => '',
										'menu_id'         => '',
										'fallback_cb'     => 'stokcholm_qode_top_navigation_fallback',
										'link_before'     => '<span>',
										'link_after'      => '</span>',
										'walker'          => new stockholm_qode_type1_walker_nav_menu()
									) );
									?>
								</nav>
								<?php } ?>
							</div>
							<?php if ( stockholm_qode_get_header_bottom_appearance() == "stick_with_left_right_menu" ) { ?>
								<nav class="main_menu drop_down right_side <?php echo esc_attr( $menu_dropdown_appearance_class ); ?>">
									<?php
									wp_nav_menu( array(
										'theme_location'  => 'right-top-navigation',
										'container'       => '',
										'container_class' => '',
										'menu_class'      => '',
										'menu_id'         => '',
										'fallback_cb'     => 'stokcholm_qode_top_navigation_fallback',
										'link_before'     => '<span>',
										'link_after'      => '</span>',
										'walker'          => new stockholm_qode_type1_walker_nav_menu()
									) );
									?>
								</nav>
							<?php } ?>
							<?php if ( stockholm_qode_get_header_bottom_appearance() != "stick menu_bottom" && stockholm_qode_get_header_bottom_appearance() != "stick_with_left_right_menu" ){ ?>
								<?php if ( stockholm_qode_get_header_bottom_appearance() == "fixed_hiding" ) { ?>
									<div class="holeder_for_hidden_menu">
								<?php } //only for fixed with hiding menu ?>
								<?php if ( ! $centered_logo ) { ?>
									<div class="header_inner_right">
										<div class="side_menu_button_wrapper right">
											<?php if ( is_active_sidebar( 'header_bottom_right' ) ) { ?>
												<div class="header_bottom_right_widget_holder"><?php dynamic_sidebar( 'header_bottom_right' ); ?></div>
											<?php } ?>
											<?php if ( is_active_sidebar( 'woocommerce_dropdown' ) ) {
												dynamic_sidebar( 'woocommerce_dropdown' );
											} ?>
											<div class="side_menu_button">
												<?php get_template_part( 'framework/modules/search/templates/search-opener' ); ?>
												<?php get_template_part( 'framework/modules/popup/templates/popup-opener' ); ?>
												<?php get_template_part( 'framework/modules/sidearea/templates/sidearea-opener' ); ?>
											</div>
										</div>
									</div>
								<?php } ?>
								<?php if ( $centered_logo == true && $enable_border_top_bottom_menu == true ) { ?>
									<div class="main_menu_and_widget_holder">
								<?php } //only for logo is centered ?>
                                <?php if( $menu_position !== 'left' ) { ?>
                                    <nav class="main_menu drop_down <?php echo esc_attr( $menu_dropdown_appearance_class ); ?> <?php if ( $menu_position == "" && stockholm_qode_get_header_bottom_appearance() != "stick menu_bottom" ) { echo ' right'; } ?>">
                                        <?php
                                        wp_nav_menu( array(
                                            'theme_location'  => 'top-navigation',
                                            'container'       => '',
                                            'container_class' => '',
                                            'menu_class'      => '',
                                            'menu_id'         => '',
                                            'fallback_cb'     => 'stokcholm_qode_top_navigation_fallback',
                                            'link_before'     => '<span>',
                                            'link_after'      => '</span>',
                                            'walker'          => new stockholm_qode_type1_walker_nav_menu()
                                        ) );
                                        ?>
                                    </nav>
                                <?php } ?>
								<?php if ( $centered_logo ) { ?>
									<div class="header_inner_right">
										<div class="side_menu_button_wrapper right">
											<?php if ( is_active_sidebar( 'header_bottom_right' ) ) { ?>
												<div class="header_bottom_right_widget_holder"><?php dynamic_sidebar( 'header_bottom_right' ); ?></div>
											<?php } ?>
											<?php if ( is_active_sidebar( 'woocommerce_dropdown' ) ) {
												dynamic_sidebar( 'woocommerce_dropdown' );
											} ?>
											<div class="side_menu_button">
												<?php get_template_part( 'framework/modules/search/templates/search-opener' ); ?>
												<?php get_template_part( 'framework/modules/popup/templates/popup-opener' ); ?>
												<?php get_template_part( 'framework/modules/sidearea/templates/sidearea-opener' ); ?>
											</div>
										</div>
									</div>
								<?php } ?>
								<?php if ( $centered_logo == true && $enable_border_top_bottom_menu == true ) { ?>
									</div>
								<?php } //only for logo is centered ?>
								<?php if ( stockholm_qode_get_header_bottom_appearance() == "fixed_hiding" ) { ?>
									</div>
								<?php } //only for fixed with hiding menu ?>
							<?php }else if ( stockholm_qode_get_header_bottom_appearance() == "stick menu_bottom" ){ ?>
							<div class="header_menu_bottom">
								<div class="header_menu_bottom_inner">
									<?php if ( $centered_logo ) { ?>
									<div class="main_menu_header_inner_right_holder with_center_logo">
										<?php } else { ?>
										<div class="main_menu_header_inner_right_holder">
											<?php } ?>
											<nav class="main_menu drop_down <?php echo esc_attr( $menu_dropdown_appearance_class ); ?>">
												<?php
												wp_nav_menu( array(
													'theme_location'  => 'top-navigation',
													'container'       => '',
													'container_class' => '',
													'menu_class'      => 'clearfix',
													'menu_id'         => '',
													'fallback_cb'     => 'stokcholm_qode_top_navigation_fallback',
													'link_before'     => '<span>',
													'link_after'      => '</span>',
													'walker'          => new stockholm_qode_type1_walker_nav_menu()
												) );
												?>
											</nav>
											<div class="header_inner_right">
												<div class="side_menu_button_wrapper right">
													<?php if ( is_active_sidebar( 'header_bottom_right' ) ) { ?>
														<div class="header_bottom_right_widget_holder"><?php dynamic_sidebar( 'header_bottom_right' ); ?></div>
													<?php } ?>
													<?php if ( is_active_sidebar( 'woocommerce_dropdown' ) ) {
														dynamic_sidebar( 'woocommerce_dropdown' );
													} ?>
													<div class="side_menu_button">
														<?php get_template_part( 'framework/modules/search/templates/search-opener' ); ?>
														<?php get_template_part( 'framework/modules/popup/templates/popup-opener' ); ?>
														<?php get_template_part( 'framework/modules/sidearea/templates/sidearea-opener' ); ?>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<?php } ?>
								<?php get_template_part( 'framework/modules/header/mobile-header/templates/mobile-header-menu' ); ?>
								
								<?php if ( stockholm_qode_get_header_in_grid() ){ ?>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
	</header>
<?php } else { ?>
	<header class="page_header <?php stockholm_qode_header_classes(); ?>">
		<?php get_template_part( 'framework/modules/toolbar/toolbar' ); ?>
		<div class="header_inner clearfix">
			<div class="header_bottom clearfix" <?php stockholm_qode_inline_style( $header_bottom_styles ); ?>>
			
				<?php if ( stockholm_qode_get_header_in_grid() ){ ?>
				<div class="container">
					<div class="container_inner clearfix" <?php stockholm_qode_inline_style( $header_bottom_container_styles ); ?>>
						<?php } ?>
						<div class="header_inner_left">
							<?php get_template_part( 'framework/modules/header/mobile-header/templates/mobile-header-opener' ); ?>
							<div class="logo_wrapper">
								<div class="q_logo">
									<?php get_template_part( 'framework/modules/header/templates/logo' ); ?>
								</div>
							</div>
						</div>
						<?php if ( stockholm_qode_get_header_in_grid() ){ ?>
					</div>
				</div>
			<?php } ?>
				<?php get_template_part( 'framework/modules/header/mobile-header/templates/mobile-header-menu' ); ?>
			</div>
		</div>
	</header>
<?php } ?>