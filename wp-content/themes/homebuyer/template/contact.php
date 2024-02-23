<?php /* Template Name: Contact */ ?>

<?php
add_action( 'wp_enqueue_scripts', 'add_page_style' );

function add_page_style() {
	wp_enqueue_style( 'about-us-page', get_template_directory_uri() . '/css/pages/about-us.css', array('style'), rand(111,9999), 'all' );
}

get_header();
?>

<?php if( have_rows('flexible_content') ): ?>
<?php while( have_rows('flexible_content') ): the_row(); ?>

<?php if( get_row_layout() == 'contact_us' ): ?>  

<div class="contact_section_three_col">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-8 col--centered text-center ">
				<div class="contact_section_three_col_heading">
					<h1><?php the_sub_field('heading'); ?></h1>
				</div>
			</div>
		</div>

		<div class="row mt-5 d-flex justify-content-center">
			<?php if( have_rows('contact_us_boxes') ): ?>
			<?php while( have_rows('contact_us_boxes') ): the_row(); ?>
			<div class="col-md-4 contact_three_col">
				<div class="contact_flex_card">
					<a href="<?php $link = the_sub_field('link'); ?>">
						<div class="contact_card_image">
							<?php echo get_acf_image_with_alt( 'icon', get_the_ID(), '', true); ?>
						</div>
						<div class="contact_card_flex_detail">
							<h4><?php $title = the_sub_field('title'); ?></h4>
							<p><?php $content = the_sub_field('content'); ?></p>
						</div>
					</a>	
				</div>
			</div>
			<?php endwhile; ?>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php endif; ?>

<?php get_template_part('global/contact-form'); ?>
<?php get_template_part('global/testimonials'); ?>

<?php endwhile; ?>
<?php endif; ?>

<?php echo get_footer(); ?>
