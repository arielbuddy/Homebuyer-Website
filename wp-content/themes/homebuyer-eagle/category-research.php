<?php
get_header();

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = array(
  'category_name' => 'research',
  'paged' => $paged,
);
$the_query = new WP_Query($args);
?>
<div class="container md:pt-30 md:pb-24">
  <div class="flex items-center mb-20 md:mb-30">
    <div>
      <h1 class="h2">Mortgage &amp; Real Estate Data</h1>
      <h4 class="text-brand-gray-dark mb-8">Original Homebuyer.com research, charts, and reports.</h4>
      <div class="flex flex-col md:flex-row">
        <?php echo do_shortcode( '[activecampaign form=9 css=1]' ); ?>
      </div>
    </div>
    <div class="hidden md:block absolute top-0 right-0 z-[-1]">
      <img class="w-150 h-100 object-cover" src="<?php echo get_template_directory_uri(); ?>/images/art/family-use-right.png" alt="Happy homebuying family">
    </div>
  </div>
  <div>
    <?php if ($the_query->have_posts()) { ?>
        <div class="grid gap-11 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
          <?php while($the_query->have_posts()) {
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
  <ul class="flex flex-wrap gap-4 justify-center mb-24">
    <?php
      $links = hb_get_paginated_links($the_query);
      foreach ($links as $link) {
        echo "<li>\n";
        echo "  <h4 class=\"inline text-brand-gray-dark\">\n";
        if ($link->url) {
          echo "    <a class=\"px-5 py-4 rounded-xl hover:text-brand-purple hover:bg-brand-purple-light transition-all\" href=\"{$link->url}\">{$link->text}</a>\n";
        } else {
          echo "    <span class=\"px-5 py-4 rounded-xl " . ($link->is_current ? 'text-brand-purple bg-brand-purple-light' : '') . "\">{$link->text}</span>\n";
        }
        echo "  </h4>\n";
        echo "</li>\n";
      }
    ?>
  </ul>
</div>
<?php
  $obj = get_queried_object();
  $args = [ 'slug' => $obj->slug ? $obj->slug : $obj->post_name ];
  get_footer(null, $args);
?>
