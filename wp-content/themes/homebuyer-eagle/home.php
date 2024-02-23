<?php
get_header();

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$category = get_term_by('slug', 'research', 'category');
$research_id = $category->term_id;
$args = array(
  'category__not_in' => array($research_id),
  'paged' => $paged,
);

$current = get_queried_object();
$type = get_class($current);
$current_category = 'All';
if ($type === 'WP_Term') {
  $current_category = $current->slug;
  $args['category__in'] = array($current->term_id);
}

$the_query = new WP_Query($args);
?>
<div class="container md:pt-20 md:pb-24">
  <div class="items-center mb-20 md:mb-10">
    <div>
      <h1 class="h2">Learning Center</h1>
      <h4 class="text-brand-gray-dark mb-8 md:w-2/3">Find first-time home buyer guides, helpful mortgage tips, and easy-to-follow articles on mortgages, real estate, and how to be a better first-time buyer.</h4>
      <div class="flex flex-col md:flex-row">
        <?php echo do_shortcode( '[activecampaign form=9 css=1]' ); ?>
      </div>
    </div>
    <div class="hidden md:block absolute top-0 right-0 z-[-1]">
      <img class="w-150 h-100 object-cover" src="<?php echo get_template_directory_uri(); ?>/images/art/family-use-right.png" alt="Happy homebuying family">
    </div>
  </div>
  <div>
    <h4 class="mb-8">Explore Topics:</h4>
    <ul class="flex flex-wrap md:gap-x-10 items-center gap-x-3 border-b border-b-brand-gray-light mb-12">
      <?php
        get_template_part(
          'partials/learn-tab',
          null,
          [
            'is_active' => $current_category === 'All',
            'url' => home_url() . '/learn',
            'category' => 'All',
          ],
        );
      ?>
      <?php
        $categories = get_categories(array('exclude' => $research_id, 'orderby' => 'ID','order'   => 'ASC'));
        foreach ($categories as $category) {
          $url = get_category_link($category->term_id);
          $is_active = $current_category === $category->slug;

          get_template_part(
            'partials/learn-tab',
            null,
            [
              'is_active' => $is_active,
              'url' => $url,
              'category' => $category->name,
            ],
          );
        }
      ?>
    </ul>
    <?php if ($the_query->have_posts()) { ?>
        <div class="grid gap-11 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
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
  $args = [ 'slug' => get_queried_object()->post_name ];
  get_footer(null, $args);
?>
