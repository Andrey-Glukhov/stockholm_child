<div class="two_columns_66_33 clearfix portfolio_container">
	<div class="column1">
		<div class="column_inner">
			<div class="portfolio_images">
				<?php stockholm_qode_get_template_part( 'templates/portfolio/parts/portfolio-media' ); ?>
			</div>
		</div>
	</div>
	<div class="column2">
		<div class="column_inner">
			<div class="portfolio_detail <?php echo esc_attr( stockholm_qode_get_portfolio_follow_info_class() ); ?> clearfix">
				<?php
				//get portfolio content section
				// <<< The SEED Team  
				//get_template_part( 'templates/portfolio/parts/portfolio-content' );
				get_template_part( 'templates/portfolio/parts/portfolio-content-mobile' );
				//>>>
				
				//get portfolio custom fields section
				get_template_part( 'templates/portfolio/parts/portfolio-custom-fields' );
				
				//get portfolio date section
				get_template_part( 'templates/portfolio/parts/portfolio-date' );
				
				//get portfolio categories section
				get_template_part( 'templates/portfolio/parts/portfolio-categories' );
				
				//get portfolio tags section
				get_template_part( 'templates/portfolio/parts/portfolio-tags' );
				
				//get portfolio share section
				get_template_part( 'templates/portfolio/parts/portfolio-social' );
				?>
			</div>
		</div>
	</div>
</div>