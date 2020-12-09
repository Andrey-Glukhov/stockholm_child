<?php
$qodef_sidebar            = stockholm_qode_get_sidebar_layout( false );
$qodef_portfolio_template = stockholm_qode_get_portfolio_template();
?>
<div class="container" <?php stockholm_qode_inline_page_background_style(); ?>>
	<div class="container_inner default_template_holder clearfix" <?php stockholm_qode_inline_page_padding_style(); ?>>
		<?php if ( ( $qodef_sidebar == "default" ) || ( $qodef_sidebar == "" ) ) : ?>
			<div class="portfolio_single <?php echo esc_attr( $qodef_portfolio_template ); ?>">
				<?php if ( post_password_required() ) {
					echo get_the_password_form();
				} else {
					//load proper portfolio file based on portfolio template
					get_template_part( 'templates/portfolio/portfolio', $qodef_portfolio_template );
					
					// <<< The SEED Team  01.12.2020
					//get_template_part( 'templates/portfolio/parts/portfolio-navigation' );
					// >>>
					
					get_template_part( 'templates/portfolio/parts/portfolio-comments' );
				} ?>
			</div>
		<?php elseif ( $qodef_sidebar == "1" || $qodef_sidebar == "2" ): ?>
			<?php if ( $qodef_sidebar == "1" ) : ?>
				<div class="two_columns_66_33 portfolio_single_sidebar clearfix">
			<?php elseif ( $qodef_sidebar == "2" ) : ?>
				<div class="two_columns_75_25 portfolio_single_sidebar clearfix">
			<?php endif; ?>
					<div class="column1">
						<div class="column_inner">
							<div class="portfolio_single <?php echo esc_attr( $qodef_portfolio_template ); ?>">
								<?php if ( post_password_required() ) {
									echo get_the_password_form();
								} else {
									//load proper portfolio file based on portfolio template
									get_template_part( 'templates/portfolio/portfolio', $qodef_portfolio_template );
									
									get_template_part( 'templates/portfolio/parts/portfolio-navigation' );
									
									get_template_part( 'templates/portfolio/parts/portfolio-comments' );
								} ?>
							</div>
						</div>
					</div>
					<div class="column2">
						<?php get_sidebar(); ?>
					</div>
				</div>
		<?php elseif ( $qodef_sidebar == "3" || $qodef_sidebar == "4" ): ?>
			<?php if ( $qodef_sidebar == "3" ) : ?>
				<div class="two_columns_33_66 portfolio_single_sidebar clearfix">
			<?php elseif ( $qodef_sidebar == "4" ) : ?>
				<div class="two_columns_25_75 portfolio_single_sidebar clearfix">
			<?php endif; ?>
					<div class="column1">
						<?php get_sidebar(); ?>
					</div>
					<div class="column2">
						<div class="column_inner">
							<div class="portfolio_single <?php echo esc_attr( $portfolio_template ); ?>">
								<?php if ( post_password_required() ) {
									echo get_the_password_form();
								} else {
									//load proper portfolio file based on portfolio template
									get_template_part( 'templates/portfolio/portfolio', $portfolio_template );
									
									get_template_part( 'templates/portfolio/parts/portfolio-navigation' );
									
									get_template_part( 'templates/portfolio/parts/portfolio-comments' );
								} ?>
							</div>
						</div>
					</div>
				</div>
		<?php endif; ?>
	</div>
</div>
