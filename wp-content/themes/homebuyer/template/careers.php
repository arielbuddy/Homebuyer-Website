<?php /* Template Name: Careers */ ?>
<?php
add_action( 'wp_enqueue_scripts', 'add_page_style' );

function add_page_style() {
	wp_enqueue_style( 'about-us-page', get_template_directory_uri() . '/css/pages/about-us.css', array('style'), rand(111,9999), 'all' );
}

get_header();
?>

<?php if( have_rows('flexible_content') ): ?>
<?php while( have_rows('flexible_content') ): the_row(); ?>

<?php if( get_row_layout() == 'careers_about' ): ?>  

<div class="careers_section">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-lg-8 col--centered text-center "> 
				<div class="heading_content_section">
					<h5><?php the_sub_field('sub_heading'); ?></h5>
					<h1><?php the_sub_field('heading'); ?></h1>
					<a href="#openings" class="cta_btn2"> <?php the_sub_field('cta_text'); ?> </a>
				</div>
			</div>
			<div class="col-xs-12 col-lg-6 col--centered text-center ">
				<div class="career_image_section">
					<?php echo get_acf_image_with_alt( 'image', get_the_ID(), 'center center content__image', true); ?>
				</div>  
			</div>
		</div>
	</div>
</div>

<?php endif; ?>

<?php if( get_row_layout() == 'perks_and_benefits' ): ?>  

<div class="careers_intro_section">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-lg-8 col--centered text-center ">
				<div class="heading_content_section">
					<h5><?php the_sub_field('sub_heading'); ?></h5>
					<h4><?php the_sub_field('heading'); ?></h4>
					<p><?php the_sub_field('pragraph'); ?></p>
				</div>
			</div>
		</div>

		<div class="row">
			<?php if( have_rows('boxs') ): ?>
			<?php while( have_rows('boxs') ) : the_row(); ?>
			<div class="col-md-6 col-lg-4 career_three_col">
				<div class="career_flex_card">
					<div class="card_image">
						<?php echo get_acf_image_with_alt( 'icon', get_the_ID(), '', true); ?>
					</div>
					<div class="card_detail">
						<h4><?php $title = the_sub_field('title'); ?></h4>
						<p><?php $box_pragraph = the_sub_field('box_pragraph'); ?></p>
					</div>
				</div>
			</div>
			<?php endwhile; ?>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php endif; ?>

<?php get_template_part('global/testimonials'); ?>
	
<?php if( get_row_layout() == 'job_openings' ): ?>  

<div class="job_opening_form" id="openings">
	<div class="container">
		<div class="job_opening_form_detail">
			<div class="row job_search_detail">
				<div class="col-md-12 d-flex align-items-center justify-content-between">
					<h4><?php the_sub_field('heading'); ?></h4>
					<p><?php the_sub_field('open_positions'); ?> positions available</p>
				</div></div>
			<div class="job_opening_input">
			
			<?php 
				//echo do_shortcode( '[jobs]' ); 
				?>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>

<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
