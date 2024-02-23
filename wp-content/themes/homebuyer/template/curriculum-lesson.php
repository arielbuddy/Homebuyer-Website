<?php /* Template Name: Curriculum Lesson */ ?>

<?php
add_action( 'wp_enqueue_scripts', 'add_page_style' );

function add_page_style() {
	wp_enqueue_style( 'educations-page', get_template_directory_uri() . '/css/pages/educations.css', array('style'), rand(111,9999), 'all' );
}

get_header();
?>

<?php if( have_rows('flexible_content') ): ?>
<?php while( have_rows('flexible_content') ): the_row(); ?>

<?php if( get_row_layout() == 'curriculum_article_content' ): ?>

<div class="curriculum_lesson_page_heading">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-lg-8 col--centered text-center">
				<div class="heading_content_section">
					<h1><?php the_sub_field('main_top_heading'); ?></h1>
					<p><?php the_sub_field('main_top_pragraph'); ?></p>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="curriculum_lesson_page_two_col">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-lg-3">
				<div class="left_detail">
					<div class="curriculum_lesson_summary_heading">
						<h4><?php the_sub_field('left_side_bar_title'); ?></h4>
					</div>
					<div class="curriculum_lesson_subheading">
						<a href="<?php the_sub_field('overview_link'); ?>"><?php the_sub_field('overview_title'); ?></a>
					</div>

					<?php if( have_rows('links_fields') ): ?>
					<?php while( have_rows('links_fields') ): the_row(); ?>

					<div class="curriculum_lesson_summary">
						<h5><?php $title = the_sub_field('title'); ?></h5>
						<ul>
							<?php if( have_rows('list_page') ): ?>
							<?php while( have_rows('list_page') ): the_row(); ?>

			<?php $active_page_choice = get_sub_field('active_page_choice');
							if( $active_page_choice == "no" ):
							?>   
								<li class="link-text">
								<a href="<?php $list_text = the_sub_field('link'); ?>">
									<?php $list_text = the_sub_field('list_text'); ?>
								</a>
							</li>	
							
							<?php $active_page_choice = get_sub_field('active_page_choice');
							elseif( $active_page_choice == "active" ):
							?>
							
							<li class="link-text active">
								<a href="<?php $list_text = the_sub_field('link'); ?>">
									<?php $list_text = the_sub_field('list_text'); ?>
								</a>
							</li>
							<?php endif; ?>
							<?php endwhile; ?>
							<?php endif; ?>
						</ul>
					</div>

					<?php endwhile; ?>
					<?php endif; ?>
				</div>				
			</div>	
			<div class="col-md-8 col-lg-9">
				<div class="right_detail">
					<div class="curriculum_lesson_video_heading">
						<h2><strong><?php the_sub_field('right_sidebar_title'); ?></strong></h2>
					</div>

					<?php $video_choice = get_sub_field('video_choice');
						if( $video_choice == "yes" ):
					?>

					<div class="curriculum_lesson_video">
						<iframe src="<?php the_sub_field('video_link'); ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					</div>

					<?php $video_choice = get_sub_field('video_choice');
						elseif( $video_choice == "no" ):
					?>
					<?php endif; ?>

					<div class="curriculum_lesson_right_content">
						<?php the_sub_field('content'); ?>
						<div class="curriculum_lesson_right_detail_link">
							<h4><?php the_sub_field('lesson_title'); ?></h4>
							<ul>
								<li><a href="<?php the_sub_field('link_bottom'); ?>"><?php the_sub_field('bottom_menu'); ?></a></li>
							</ul>
						</div>  
					</div>
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
