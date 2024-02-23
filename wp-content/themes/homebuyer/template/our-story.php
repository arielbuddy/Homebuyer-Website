<?php /* Template Name: Our Story */ ?>
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

<?php if( get_row_layout() == 'how_does_it_work' ): ?>  
<div class="heading_subheading_content_section">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-lg-8 col--centered text-center">
				<div class="heading_content_section">
					<h2><?php the_sub_field('heading'); ?></h2>
					<h4><?php the_sub_field('sub_heading'); ?></h4>
					<div><?php the_sub_field('content'); ?></div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>

<?php if( get_row_layout() == 'faq' ): ?>  
<div class="faq_section">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-lg-8 col--centered text-center">
				<div class="heading_content_section">
					<h4><?php the_sub_field('main_heading'); ?>	</h4>
					<p><?php the_sub_field('pragraph'); ?>	</p>
				</div>
				<div class="content">
					<?php if( have_rows('faq') ): ?>
					<?php while( have_rows('faq') ) : the_row(); ?>
					<details>
						<summary><?php $title = the_sub_field('title'); ?></summary>
						<div class="faq__content">
							<?php $content = the_sub_field('content'); ?>
						</div>
					</details>
					<?php endwhile; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php endif; ?>

<?php if( get_row_layout() == 'our_values' ): ?>  

<div class="our_story_three_col">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-lg-8 col--centered text-center">
			<div class="heading_content_section">
				<h2><?php the_sub_field('heading'); ?></h2>
				<h4><?php the_sub_field('sub_heading'); ?></h4>
			</div>
		</div>
		</div>
		<div class="row mt-5">
			
			<?php if( have_rows('columns') ): ?>
			<?php while( have_rows('columns') ) : the_row(); ?>
			
			<div class="col-md-4">
				<div class="content_three">
					<?php echo get_acf_image_with_alt( 'icon', get_the_ID(), '', true); ?>
					<h4>	<?php $title = the_sub_field('title'); ?></h4>
					<p>	<?php $content = the_sub_field('content'); ?></p>
				</div>
			</div>

			<?php endwhile; ?>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php endif; ?>

<?php if( get_row_layout() == 'join_our_team' ): ?>  
<div class="join_our_team">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-lg-8 col--centered text-center">
				<div class="heading_content_section">
					<h2><?php the_sub_field('heading'); ?></h2>
					<p><?php the_sub_field('content'); ?></p>
					<a class="cta_btn2" href="<?php the_sub_field('cta_link'); ?>"><?php the_sub_field('cta_text'); ?></a>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>

<?php get_template_part('global/testimonials'); ?>

<?php endwhile; ?>
<?php endif; ?>

<?php get_template_part('global/subscribe-newslatter'); ?>

<?php get_footer(); ?>
