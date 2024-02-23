<?php /* Template Name: Policy Template */ ?>

<?php
add_action( 'wp_enqueue_scripts', 'add_page_style' );

function add_page_style() {
	wp_enqueue_style( 'notice-page', get_template_directory_uri() . '/css/pages/notice.css', array('style'), rand(111,9999), 'all' );
}

get_header();
?>

<?php if( have_rows('flexible_content') ): ?>
<?php while( have_rows('flexible_content') ): the_row(); ?>

<?php if( get_row_layout() == 'content' ): ?>    
<div class="policy_section">
	<div class="container">
		<div class="col-xs-12 col-md-11 policy_detail ">
			<div class="policy_center_heading">
				<h1><?php the_sub_field('main_heading'); ?></h1>
			</div>
			<div class="policy_content">
				<?php the_sub_field('rich_text_area'); ?>
			</div>
		</div>
	</div>	
</div>
<?php endif; ?>

<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
