<?php /* Template Name: Subscribe Thank You */ ?>
<?php
add_action( 'wp_enqueue_scripts', 'add_page_style' );

function add_page_style() {
	wp_enqueue_style( 'about-us-page', get_template_directory_uri() . '/css/pages/about-us.css', array('style'), rand(111,9999), 'all' );
}

get_header();
?>

<?php if( have_rows('flexible_content') ): ?>
<?php while( have_rows('flexible_content') ): the_row(); ?>

<?php if( get_row_layout() == 'our_vision_module' ): ?>    
<div class="story_vision_section">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-lg-8 col--centered text-center">
				<div class="heading_content_section">
					<h1><?php the_sub_field('main_heading'); ?>	</h1>
					<h4><?php the_sub_field('sub_heading'); ?>	</h4>
					<p><?php the_sub_field('content'); ?>	</p>
				</div>
				<div class="our_story_video">
					<iframe src="<?php the_sub_field('iframe_video_url'); ?>	" frameborder="0"></iframe>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
<?php endwhile; ?>
<?php endif; ?>



<?php get_footer(); ?>
