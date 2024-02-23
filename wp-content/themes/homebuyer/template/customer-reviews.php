<?php /* Template Name: Customer Reviews */ ?>

<?php
add_action( 'wp_enqueue_scripts', 'add_page_style' );

function add_page_style() {
	wp_enqueue_style( 'about-us-page', get_template_directory_uri() . '/css/pages/about-us.css', array('style'), rand(111,9999), 'all' );
}

get_header();
?>

<?php if( have_rows('flexible_content') ): ?>
<?php while( have_rows('flexible_content') ): the_row(); ?>

<?php if( get_row_layout() == 'customer_reviews' ): ?>  
<div class="customer_review_section">
  <div class="container">
		<div class="row"> 
			<div class="col-xs-12 col-lg-8 col--centered text-center">
				<div class="customer_review_section_title">
					<h1><?php the_sub_field('main_heading'); ?></h1>
					<p><?php the_sub_field('sub_content'); ?></p>
				</div>
			</div>
		</div>
  </div>
</div>

<div class="testimonial_three_col">
	<div class="container">
		<div class="row">
			
			<?php if( have_rows('all_reviews') ): ?>
			<?php while( have_rows('all_reviews') ): the_row(); ?>

			<div class="col-md-6 col-lg-4 review_section">
				<div class="content_three">
					<div class="row">
						<div class="testimonial_name_card_image">
							<?php echo get_acf_image_with_alt( 'icon', get_the_ID(), 'testimonial_name_card_img', true); ?>
						</div>
						<div class="testimonial_name_card_detail">
							<p class="testimonial_name_card-name"><?php $client_name = the_sub_field('client_name'); ?></p>
							<p class="testimonial_name_card-location"> <?php $location = the_sub_field('location'); ?></p>
						</div>
					</div>
					<div class="testimonial_card_ratings">
						<span class="mdi mdi-star"></span>
						<span class="mdi mdi-star"></span>
						<span class="mdi mdi-star"></span>
						<span class="mdi mdi-star"></span>
						<span class="mdi mdi-star"></span>
					</div>
					<div Class="testimonial_quotes">
						<p class="testimonial_card_highlight_quote"><?php $title = the_sub_field('title'); ?></p>
						<p class="testimonial_card_base_quote"><?php $pragraph = the_sub_field('pragraph'); ?></p>
					</div>
					<div class="logo-testimonial">
						 <?php echo get_acf_image_with_alt( 'logo_bottom', get_the_ID(), 'testimonial_name_card_img', true); ?>
					</div>
				</div>
			</div>
			<?php endwhile; ?>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php endif; ?>

<?php if( get_row_layout() == 'counter' ): ?>

<div class="customer_review_anchor_tag">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-8 col--centered text-center">
				<div class="customer_review">
					<div> <?php the_sub_field('top_content'); ?></div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="achievement_section">
  <div class="container">
    <div class="row" id="counter">
		<?php if( have_rows('all_counter') ): ?>
		<?php while( have_rows('all_counter') ): the_row(); ?>
      <div class="col-md-4">
        <div class="content_three">  
          <div class="row content_detail">
						<div class="achievement_icon_image">
							<?php echo get_acf_image_with_alt( 'icon', get_the_ID(), 'icon counter__icon', true); ?>
						</div>
            <div class="achievement_content">
              <h3 class="counter-value" data-count="<?php $counter_value = the_sub_field('counter_value'); ?>">0</h3>
              <p><?php $discription = the_sub_field('discription'); ?></p>
            </div>
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

<?php endwhile; ?>
<?php endif; ?>

<?php get_template_part('global/subscribe-newslatter'); ?>
<?php get_footer(); ?>
