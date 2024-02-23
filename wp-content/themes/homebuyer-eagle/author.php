<?php
if (get_query_var('paged')) {
  // This query has no paginated pages.
  global $wp_query;
  $wp_query->set_404();
  status_header(404);
  include("404.php");
  exit;
}

// Disable link rel="next" on this page
add_filter('rank_math/frontend/disable_adjacent_rel_links', '__return_true');

$the_query = new WP_Query(array(
  // Hard-coded list of featured posts
  'post__in' => array(629, 1740, 642, 1559, 630, 634, 674, 1528, 633),
  'orderby' => 'post__in',
));

$author_id = get_the_author_meta('ID');
$author_gravatar = get_cupp_meta($author_id, 'large');
$author_name = get_the_author_meta('display_name');
$author_link = get_the_author_meta('linkedin');
$author_position = get_the_author_meta('position');
$youtube_link = "https://www.youtube.com/c/homebuyermortgage";
$author_email = get_the_author_meta('user_email');

get_header();
?>
<div class="container md:pt-20 md:pb-24">
	<div class="flex flex-col gap-4 md:flex-row mb-20 md:mb-10">
	<div class="flex flex-col items-center md:w-1/4 pt-4">
		<img class="mb-4 h-50 w-auto aspect-square rounded-2xl overflow-hidden shadow-lg" src="<?php echo $author_gravatar; ?>" alt="<?php echo $author_name; ?>" />
		<h4 class="text-brand-gray-dark text-center">
			<?php echo $author_name; ?>
		</h4>
		<p class="text-brand-gray-dark text-center mb-6">
			<?php echo $author_position; ?><br />
			<?php echo $author_email; ?>
		</p>
		<p class="text-center mb-3">
			<a class="text-brand-white text-xl bg-brand-purple inline-flex w-8 h-8 justify-center items-center rounded-full hover:bg-brand-red-dark transition-all mr-2 p-2" href="<?php echo $author_link; ?>" target="_blank" aria-label="Go to LinkedIn">
				<span class="mdi mdi-linkedin"></span>
			</a>
			<a class="text-brand-white text-xl bg-brand-purple inline-flex w-8 h-8 justify-center items-center rounded-full hover:bg-brand-red-dark transition-all p-2" href="<?php echo $author_link; ?>" target="_blank" aria-label="Go to YouTube">
				<span class="mdi mdi-youtube"></span>
			</a>
		</p>
		<!-- Citations -->
		<p class="text-brand-gray">
			<a href="<?php echo home_url('/about-us#press'); ?>" class="text-center text-brand-purple underline">
			Press citations
			</a>
		</p>

		<!-- Subscribe -->
		<p class="text-brand-gray">
			<a href="<?php echo home_url('/subscribe'); ?>" class="text-center text-brand-purple underline">
			Subscribe to our newsletter
			</a>
		</p>
	</div>
		<div class="flex-1">
			<div class="post">
		<h1><?php echo $author_name; ?></h1>
		<h2 class="text-brand-gray-dark"><?php echo $author_position; ?></h2>
		<h3 class="text-brand-gray-dark mb-2">Mortgage Expert & Author</h3>
		  <h4 class="text-brand-gray-dark mb-4">
			  Current Role and Impact
		  </h4>
		  <p>As the Chief Executive Officer of Homebuyer.com, Dan Green leads the forefront of the mortgage industry, serving first-time home buyers as they achieve their American Dream of homeownership. Under his leadership, Homebuyer.com has become a vital resource for aspiring homeowners, offering expert guidance and innovative mortgage solutions.
		  </p>
		  <h4 class="text-brand-gray-dark mb-4">
			  Expertise in Mortgage and Real Estate
		  </h4>
		  <p>With years of experience as a top-producing mortgage loan originator, Dan's expertise extends beyond corporate leadership. He has earned multiple sales and customer service awards, including <a target="_blank"
          href="https://www.linkedin.com/posts/techstars_givefirst-founders-startup-activity-6999496461629489152-WQze/?utm_source=share&utm_medium=member_desktop">The Techstars Give First Award</a>. His deep understanding of the mortgage market makes him a trusted advisor for those navigating the complexities of homeownership.
		  </p>
		  <h4 class="text-brand-gray-dark mb-4">
			  Authoritative Voice
		  </h4>
		  <p>Dan is renowned for his clear, informative communication style. His ability to distill complex mortgage and real estate concepts into understandable articles has earned him a strong, repeat readership and respect in the industry. Dan is a frequent conference speaker and session moderator.
		  </p>
		  <h4 class="text-brand-gray-dark mb-4">
			  Media Recognition  
		  </h4>
		  <p>Recognized as a featured industry leader, Dan’s insights have been cited by major media outlets including The
          <a target="_blank" href="https://www.wsj.com/articles/BL-DVB-11594">Wall Street Journal</a>,
          <a target="_blank" href="https://www.wbez.org/stories/lending-law-criticized/8debb9e7-3504-4c3c-8282-e83873a88bb8">NPR</a>,
          <a target="_blank" href="https://www.bloomberg.com/news/articles/2012-07-26/roadblock-to-mortgage-refinancing#xj4y7vzkg">Bloomberg</a>. This media presence further solidifies his standing as a respected voice in the mortgage market.
		  </p>
		  <h4 class="text-brand-gray-dark mb-4">
			  Personal and Professional Background
		  </h4>
		  <p>Dan's journey in the mortgage industry began after a successful stint as a software engineer at PriceWaterhouseCoopers in New York City. His transition from tech to finance showcases his adaptability and commitment to helping people achieve the American Dream of homeownership. He also holds a degree with honors from Penn State University, further underscoring his dedication to excellence.</p>
		  <h4 class="text-brand-gray-dark mb-4">
			  Personal Life
		  </h4>
		  <p>Dan and his wife live in Cincinnati, Ohio, with their three children, two dogs, and one rabbit. The house is always lively. 
		  </p>
      </div>
    </div>
  </div>
	<hr style = "hrhouse" class="mb-4"> 
  <div>
    <h3 class="mb-8">Selected Articles by <?php echo get_the_author_meta('display_name'); ?></h3>
    <?php if ($the_query->have_posts()) { ?>
        <div class="grid gap-11 grid-cols-1 md:grid-cols-3">
          <?php while ($the_query->have_posts()) {
            $the_query->the_post();
            $url = get_the_permalink();
            $title = get_the_title();
            $excerpt = hb_get_excerpt(get_the_excerpt());
            $minutes = hb_get_reading_time(get_post_field('post_content'));
            $thumbnail = null;
            $thumbnails = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'large');
            if (is_array($thumbnails) && count($thumbnails)) {
              $thumbnail = $thumbnails[0];
            }
            $category = null;
            $categories = get_the_category();
            if (is_array($categories) && count($categories)) {
              $category = $categories[0]->name;
            }

            get_template_part(
              'partials/learn-card',
              null,
              [
                'url' => $url,
                'thumbnail' => $thumbnail,
                'category' => $category,
                'ttr' => $minutes,
                'title' => $title,
                'excerpt' => $excerpt,
              ],
            );
          } ?>
        </div>
      <?php } else { ?>
        <div class="flex justify-center">No articles found</div>
      <?php } ?>
    </div>
  </div>
</div>
<?php
  $args = [ 'slug' => get_queried_object()->post_name ];
  get_footer(null, $args);
?>
