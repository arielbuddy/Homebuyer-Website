<?php /* Template Name: Sitemap */ ?>

<?php
add_action( 'wp_enqueue_scripts', 'add_page_style' );

function add_page_style() {
	wp_enqueue_style( 'notice-page', get_template_directory_uri() . '/css/pages/notice.css', array('style'), rand(111,9999), 'all' );
}

get_header();
?>

<?php if( have_rows('flexible_content') ): ?>
<?php while( have_rows('flexible_content') ): the_row(); ?>


<?php if( get_row_layout() == 'sitemap' ): ?>

<div class="sitemap_heading_section">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-10 col--centered text-center">
				<div class="heading_content_section">
					<h1> <?php the_sub_field('heading'); ?></h1>
				</div>
			</div>
			<div class="col-xs-12 col-md-10">
				<?php the_sub_field('content'); ?>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>

<?php get_template_part('global/testimonials'); ?>

<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
