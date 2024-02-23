<?php /* Template Name: Curriculum */ ?>

<?php
add_action( 'wp_enqueue_scripts', 'add_page_style' );

function add_page_style() {
	wp_enqueue_style( 'educations-page', get_template_directory_uri() . '/css/pages/educations.css', array('style'), rand(111,9999), 'all' );
}

get_header();

$hostname = parse_url(get_site_url(), PHP_URL_HOST);
$target = 'https://app.homebuyer.com';

if (preg_match("/local/i", $hostname)) {
    $target = 'http://localhost:3000';
} else if (preg_match("/stage/i", $hostname)) {
    $target = 'https://app-staging.homebuyer.com';
}
?>

<?php if( have_rows('flexible_content') ): ?>
<?php while( have_rows('flexible_content') ): the_row(); ?>

<?php if( get_row_layout() == 'two_col_content_with_video' ): ?>

<div class="curriculum_heading_section">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-lg-8 col--centered text-center">
				<div class="heading_content_section">
					<h1> <?php the_sub_field('main_heading'); ?></h1>
					<p><?php the_sub_field('sub_content'); ?></p>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="curriculum_two_col">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-md-6">
				<div class="left_detail">
					<h2><?php the_sub_field('left_column_title'); ?></h2>
					<h3><?php the_sub_field('left_column_sub_title'); ?></h3>
					<div><?php the_sub_field('left_pragraph'); ?></div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="right_video_section">
					<iframe width="100%" height="315" src="<?php the_sub_field('video_iframe_link'); ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay;clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>

<?php if( get_row_layout() == 'available_units' ): ?>

<div class="curriculum_avilable_units_two_col">
	<div class="container">
		<div class="heading_content_section">
			<h2> <?php the_sub_field('main_heading'); ?></h2>
			<p> <?php the_sub_field('main_pragraph'); ?></p>
		</div>
		<div class="col-xs-12 col-lg-10 col--centered text-center">
			<div class="row">

				<?php if( have_rows('boxs') ): ?>
				<?php while( have_rows('boxs') ): the_row(); ?>

				<div class="col-md-6">
					<div class="curriculum_card_detail">
						<div class="card_upper_section">
							<a href="<?php $cta_link = the_sub_field('cta_link'); ?>">
								<?php echo get_acf_image_with_alt( 'image', get_the_ID(), '', true); ?>
							</a>
						</div>
						<div class="card_btn">
							<a href="<?php $cta_link = the_sub_field('cta_link'); ?>"><?php $cta_title = the_sub_field('cta_title'); ?> </a>
						</div>
					</div>
				</div>

				<?php endwhile; ?>
				<?php endif; ?>

				<?php if( have_rows('no_link_boxes') ): ?>
				<?php while( have_rows('no_link_boxes') ): the_row(); ?>
				<div class="col-md-6 ">
					<div class="curriculum_card_detail no-access">
						<div class="card_upper_section">
							<a>
								<?php echo get_acf_image_with_alt( 'image', get_the_ID(), '', true); ?>
							</a>
						</div>
						<div class="card_btn">
							<a><?php $cta_title = the_sub_field('cta_title'); ?></a>
						</div>
					</div>
				</div>
				<?php endwhile; ?>
				<?php endif; ?>
			</div>
            <!-- Mortgage Pre-Approval Button -->
            <section class="cta">
                <div>
                    <img alt="Get my pre-approval illustration" src="<?php echo get_template_directory_uri(); ?>/images/cta-button-hero.png">
                </div>
                <div class="text-center">
                    <p class="text">Mortgage<br>Pre-Approval<br>in Minutes</p>
                    <button class="hb-button" onClick ="window.location.href='<?php echo $target; ?>'";>Get Pre-approved</button>
                </div>
            </section>
            <!-- Mortgage Pre-Approval Button -->
		</div>
	</div>
</div>

<?php endif; ?>

<?php get_template_part('global/testimonials'); ?>

<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
