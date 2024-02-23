<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

add_action( 'wp_enqueue_scripts', 'add_page_script_style' );

function add_page_script_style() {
	wp_enqueue_style( 'learn-page', get_template_directory_uri() . '/css/pages/learn.css', array('style'), rand(111,9999), 'all' );
	wp_enqueue_script( 'blog-post', get_template_directory_uri() . '/js/blog-post.js', array(), rand(111,9999), true );
}

$hostname = parse_url(get_site_url(), PHP_URL_HOST);
$target = 'https://app.homebuyer.com';

if (preg_match("/local/i", $hostname)) {
    $target = 'http://localhost:3000';
} else if (preg_match("/stage/i", $hostname)) {
    $target = 'https://app-staging.homebuyer.com';
}

get_header(); ?>
<div class="blog_post_page">
	<?php
	while ( have_posts() ) : the_post(); ?>
	<div class="container">	
		<div class="blog_details_post">
			<ul class="breadcrum_top">
				<li> <a href="<?php echo home_url(); ?>"> Home </a> / </li>
				<li> <a href="<?php echo home_url(); ?>/learn"> Learn</a> / </li>
				<li> <strong><?php the_title(); ?> </strong> </li>
			</ul>
			<div class="main_featured_img">	
				<?php the_post_thumbnail('full'); ?>
			</div>
		</div>
		<div class="entry-content-page">
			<div class="blog_post__heading position-relative">
			<?php
				$display_fact_checked = get_field('display_fact_checked', 'option');
				$fact_checked_content = get_field('fact_checked_content', 'option');

				if ($display_fact_checked && $fact_checked_content): ?>
					<div class="fact-checked-wrapper">
						<button class="fact-checked d-inline-block p-0" id="fact-checked" aria-labelledby="fact-checked-notice">
							<div class="fact-checked__item d-flex align-items-center m-0">
                                <span class="mdi mdi-checkbox-marked"></span>
								<span class="fact-checked__title">Fact Checked</span>
							</div>
						</button>
						<div class="fact-checked-content" id="fact-checked-notice" role="tooltip">
							<?= $fact_checked_content; ?>
						</div>
					</div>
				<?php endif; ?>

				<h1><?php the_title(); ?></h1>
				<div class="blog-post__info">
                    <?php
                        $get_author_id = get_the_author_meta('ID');
                        $get_author_gravatar = get_cupp_meta($get_author_id, 'thumbnail');
                        echo '<img src="'.$get_author_gravatar.'" alt="'.get_the_author_meta('display_name').'" />';
                    ?>
                    <div>
                        <div>Author: <?php the_author_posts_link(); ?></div>
                        <?php echo get_publish_or_updated_date(get_the_date()); ?>
                    </div>
				</div>

				<!-- Notice Block -->
				<?php
				$display_notice = get_field('display_notice', 'option');
				$notice_content = get_field('blog_post_notice_content', 'option');

				if ($display_notice && $notice_content): ?>
					<div class="blog_post_notice_wrapper">
						<div class="blog_post_notice">
							<?= $notice_content; ?>
						</div>
					</div>
				<?php endif; ?>
				<!-- Notice Block -->
			</div>
			<div class="blog_post_content pt-0">
				<?php the_content(); ?> 
				<!-- Mortgage Pre-Approval Button -->
                <a class="cta" data-category="Pre-approval" data-action="Click" data-label="article-afterpost-image" href="<?php echo $target; ?>">
                    <div>
                        <img alt="Get my pre-approval illustration" src="<?php echo get_template_directory_uri(); ?>/images/cta-button-hero.png">
                    </div>
                    <div class="text-center">
                        <p class="text">Mortgage<br>Pre-Approval<br>in Minutes</p>
                        <button class="hb-button">Get Pre-approved</button>
                    </div>
                </a>
				<!-- Mortgage Pre-Approval Button -->
			</div>
		</div>
	</div>
	<div class="post_re">
	<div class="container">
		<div class="blog_post_content related_posts">
			<h3>Related posts</h3>
			<?php
			$orig_post = $post;
			global $post;
			$tags = wp_get_post_tags($post->ID);

			if ($tags) {
				$tag_ids = array();
				foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
				$args=array(
					'tag__in' => $tag_ids,
					'post__not_in' => array($post->ID),
					'posts_per_page'=>4, // Number of related posts to display.
					'caller_get_posts'=>1
				);

				$my_query = new wp_query( $args );

				while( $my_query->have_posts() ) {
					$my_query->the_post();
			?>
	<a rel="follow" target="_blank" href="<? the_permalink()?>">
			<div class="relatedthumb">
					<div class="related-post__img">
						<?php the_post_thumbnail(); ?>
					</div>
					<div class="related-post__body">
						<h4 class="related-post__title">
							<?php the_title(); ?></h4>
							<?php
					/* COMMENTING OUT THE EXCEPT ON RELATED POSTS
						// <p> <?php $excerpt = get_the_excerpt(); 
						// 
						// $excerpt = substr( $excerpt, 0, 120 ); // Only display first 150 characters of excerpt
						// $result = substr( $excerpt, 0, strrpos( $excerpt, ' ' ) );
						// echo $result; ?>...	  </p>
					*/ ?>
						<button class="btn btn--green btn--sm related-post__btn"> Read more</button>
					</div>
			</div>
			</a>
			<? }
			}
			$post = $orig_post;
			wp_reset_query();
			?>
		</div>
	</div></div>
	<?php
	endwhile; //resetting the page loop
	wp_reset_query(); //resetting the page query
	?>
</div>
<?php get_template_part('global/subscribe-newslatter'); ?>
<?php get_footer(); ?>
