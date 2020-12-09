<div class="two_columns_66_33 clearfix portfolio_container">
	<div class="column1">
		<div class="column_inner">
			<div class="flexslider">
				<ul class="slides">
					<?php stockholm_qode_get_template_part( 'templates/portfolio/parts/portfolio-media', '', array( 'portfolio_template' => 'slider', 'image_size' => 'blog_image_in_grid' ) ); ?>
				</ul>
			</div>
		</div>
	</div>
	<div class="column2">
		<div class="column_inner">
			<div class="portfolio_detail <?php echo esc_attr( stockholm_qode_get_portfolio_follow_info_class() ); ?>">
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