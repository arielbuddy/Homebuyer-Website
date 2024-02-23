<?php
add_action( 'wp_enqueue_scripts', 'add_page_style' );

function add_page_style() {
	wp_enqueue_style( 'front-page', get_template_directory_uri() . '/css/pages/front.css', array('style'), rand(111,9999), 'all' );
}

get_header();
?>

<?php if( have_rows('flexible_content') ): ?>
<?php while( have_rows('flexible_content') ): the_row(); ?>

<?php include('blocks/home-banner.php'); ?>

<?php if( get_row_layout() == 'logo_home' ): ?>      
<div class="company_logo_testimonials">
	<div class="container">
		<div class="homebuyer_heading">
			<h5><?php the_sub_field('title'); ?></h5>
		</div>
		<div class="row justify-content-between justify-content-lg-center align-items-center">

			<?php if( have_rows('logos') ): ?>
			<?php while( have_rows('logos') ) : the_row(); ?>
			<div class="logo_images_home">
			
				  <?php echo get_acf_image_with_alt( 'logo_images', get_the_ID(), '', true); ?>
			</div>
			<?php endwhile; ?>
			<?php endif; ?> 


		</div>

	</div>
</div>
<?php endif; ?>	

<?php if( get_row_layout() == 'home_two_column' ): ?>    
<div class="home_two_col">
	<div class="container">
		<div class="home_two_col_heading">
			<?php the_sub_field('main_heading'); ?>	
		</div>
		<div class="row mt-5 align-items-center">
			<div class="col-md-6">
				<div class="left_two_col">
					<h3><?php the_sub_field('column_sub_title'); ?>	</h3>
					<h4><?php the_sub_field('column_main_title'); ?></h4>
					<div><?php the_sub_field('pragraph'); ?></div>
				</div></div>
			<div class="col-md-6">
					
								  <?php echo get_acf_image_with_alt( 'right_image', get_the_ID(), '', true); ?>

			</div>
		</div>
	</div>
</div>
<?php endif; ?>	

<?php if( get_row_layout() == 'home_three_column' ): ?>     
<div class="home_three_col">
	<div class="container">
		<div class="main_headings">
			<h3><?php the_sub_field('sub_title'); ?>	</h3>
			<h2><?php the_sub_field('main_heading'); ?></h2> 
		</div>
		<div class="row">

			<?php if( have_rows('column_repeater') ): ?>
			<?php while( have_rows('column_repeater') ) : the_row(); ?>
			<div class="col-md-4">
				<div class="col_content_three">
					
					  <?php echo get_acf_image_with_alt( 'icon', get_the_ID(), '', true); ?>
					<p><?php $title = the_sub_field('title'); ?></p>
				</div>
			</div>
			<?php endwhile; ?>
			<?php endif; ?>

		</div>
	</div>
</div>
<?php endif; ?>
<?php get_template_part('global/testimonials'); ?>
<?php endwhile; ?>
<?php endif; ?>

<?php get_template_part('global/subscribe-newslatter'); ?>
<?php get_footer(); ?>
