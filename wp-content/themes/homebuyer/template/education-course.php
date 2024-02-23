<?php /* Template Name: Education Course */ ?>

<?php
add_action( 'wp_enqueue_scripts', 'add_page_style' );

function add_page_style() {
	wp_enqueue_style( 'educations-page', get_template_directory_uri() . '/css/pages/educations.css', array('style'), rand(111,9999), 'all' );
}

get_header();
?>

<?php if( have_rows('flexible_content') ): ?>
<?php while( have_rows('flexible_content') ): the_row(); ?>

<?php if( get_row_layout() == 'banner_with_form' ): ?>

<div class="education_course_banner">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-lg-6 col-sm-12">
				<div class="education_course_cnt">
					<h1> <?php the_sub_field('main_heading'); ?></h1>
					<p> <?php the_sub_field('pragraph'); ?></p>
					<ul>
						
				<?php if( have_rows('list_content') ): ?>
				<?php while( have_rows('list_content') ): the_row(); ?>
						<li><?php $text = the_sub_field('text'); ?></li>
	
				<?php endwhile; ?>
				<?php endif; ?>
					</ul>
				</div>
			</div>
			<div class="col-lg-5 col-md-6 offset-lg-1 col-sm-12">
				<div class="education_course_form">
					 <?php echo do_shortcode( '[activecampaign form=5 css=1]' ); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>

<?php if( get_row_layout() == 'rich_content_area' ): ?>
<div class="education_course_body">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col--centered">
				<div class="education_course_body_cnt">
					<?php the_sub_field('full_content'); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>

<?php if( get_row_layout() == 'register_now_form' ): ?>
<div class="education_bt_form">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2">
				<div class="education_course_form">
					<?php echo get_acf_image_with_alt( 'logo', get_the_ID(), '', true); ?>
					<?php echo do_shortcode( '[activecampaign form=5 css=1]' ); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>

<?php get_template_part('global/testimonials'); ?>

<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
