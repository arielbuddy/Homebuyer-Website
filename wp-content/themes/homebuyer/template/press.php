<?php /* Template Name: Press */ ?>

<?php
add_action( 'wp_enqueue_scripts', 'add_page_style' );

function add_page_style() {
	wp_enqueue_style( 'about-us-page', get_template_directory_uri() . '/css/pages/about-us.css', array('style'), rand(111,9999), 'all' );
}

get_header();
?>

<?php if( have_rows('flexible_content') ): ?>
<?php while( have_rows('flexible_content') ): the_row(); ?>

<?php if( get_row_layout() == 'press_newsroom' ): ?>  

<div class="press_heading_section">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-lg-8 col--centered text-center">
				<div class="heading_content_section">
					<h1><?php the_sub_field('heading'); ?></h1>
					<p><?php the_sub_field('content'); ?></p>
				</div>	 
			</div>
		</div>
	</div>
</div>

<div class="press_sections">
	<div class="container">
		<div class="col-xs-12 col-lg-8 col--centered text-center">
			<div class="row content_head col--centered text-center">
				<h3><?php the_sub_field('sections_title'); ?></h3>
				<h4><a href="#news"><?php the_sub_field('press_coverage'); ?></a></h4>
				<h4><a href="#mediaKit"><?php the_sub_field('media_kit'); ?></a></h4>
				<h4><a href="#contact"><?php the_sub_field('contact'); ?></a></h4>
			</div>
		</div>
	</div>
</div>

<div class="press_three_col" id="news">
	<div class="container">
		<div class="row mt-5">
			<?php if( have_rows('press_boxes') ): ?>
			<?php while( have_rows('press_boxes') ): the_row(); ?>
		
			<div class="col-md-6 col-lg-4 ">
				<a class="news-card" target="_blank" href="<?php $press_link = the_sub_field('press_link'); ?>">
					<div class="content_three">
						<div class="blog_post_image">
							<?php echo get_acf_image_with_alt( 'image', get_the_ID(), '', true); ?>
						</div>
						<div class="press_three_col_detail">
							<h4><?php $news_category = the_sub_field('news_category'); ?></h4>
							<h3><?php $title = the_sub_field('title'); ?></h3>
							<p><?php $content = the_sub_field('content'); ?></p>
							<div class="company_logo">
								<?php echo get_acf_image_with_alt( 'logo', get_the_ID(), '', true); ?>
							</div>
						</div>
					</div>
				</a>
			</div>

			<?php endwhile; ?>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php endif; ?>

<?php if( get_row_layout() == 'media_kit' ): ?>  
<div class="media_kit_section" id="mediaKit">
	<div class="container">
		<div class="row">	
			<div class="col-xs-12 col-md-10 col--centered text-center">
				<div class="heading_content_section">
					<h5><?php the_sub_field('sub_heading'); ?></h5>
					<h2><?php the_sub_field('heading'); ?></h2>
					<a class="cta_btn2"  data-aos="fade-up" data-aos-delay="200" href="<?php the_sub_field('cta_link'); ?>" download>
					<?php the_sub_field('cta_text'); ?></a>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>


<?php get_template_part('global/contact-form'); ?>
<?php get_template_part('global/testimonials'); ?>

<?php endwhile; ?>
<?php endif; ?>

<?php get_template_part('global/subscribe-newslatter'); ?>

<?php get_footer(); ?>
