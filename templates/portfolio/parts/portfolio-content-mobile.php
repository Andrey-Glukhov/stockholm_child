<?php if ( stockholm_qode_get_portfolio_template() !== 'fullscreen-slider' ) { ?>
	<h3 class="info_section_title"><?php the_title(); ?></h3>
<?php } ?>
<div class="info portfolio_single_excerpt_mob">
	<?php the_excerpt(); ?>
</div>
<div class="info portfolio_single_content_mob" style="display:none;">
	<?php the_content(); ?>
</div> <!-- close div.portfolio_content -->