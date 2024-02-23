<?php if( get_row_layout() == 'home_banner' ): ?>
<div class="home_banner">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-lg-8 col--centered text-center">
				<h1><?php the_sub_field('main_heading'); ?></h1>
				<p> <?php the_sub_field('sub_content'); ?></p>
				<a class="cta_btn" href="<?php the_sub_field('cta_link'); ?>"> <?php the_sub_field('cta_text'); ?></a>
			</div>
		</div>

		  <?php echo get_acf_image_with_alt( 'image', get_the_ID(), '', true, ); ?>
	</div>
</div>
<?php endif; ?>				
					