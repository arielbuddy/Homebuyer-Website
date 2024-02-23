<?php
  add_action('wp_enqueue_scripts', function () {
    wp_enqueue_script('utils-js', get_template_directory_uri() . '/js/utils.js', array(), rand(111, 9999), true);
    wp_enqueue_script('single-js', get_template_directory_uri() . '/js/single.js', array(), rand(111, 9999), true);
  });

  get_header();
?>
<?php while (have_posts()) { ?>
  <?php
    the_post();
    $thumbnail = get_the_post_thumbnail(get_the_ID(), 'large', array('class' => 'relative rounded-lg w-full aspect-2/1 object-cover'));
    $title = get_the_title();
    $author_id = get_the_author_meta('ID');
    $author_gravatar = get_cupp_meta($author_id, 'thumbnail');
    $author_name = get_the_author_meta('display_name');
    $author_url = get_author_posts_url($author_id);
    $categories = get_the_category();
    $is_research = is_array($categories) && count($categories) && $categories[0]->slug === 'research';
    $show_toc = !get_post_meta(get_the_ID(), 'hide_toc', true);
  ?>
  <div <?php post_class('lg:flex pt-5 md:pt-10 bg-brand-purple-lighter overflow-clip'); ?>>
    <!-- Left -->
    <div class="flex-1 bg-white">
      <div class="z-10 relative h-full">
        <!-- Floating TOC -->
        <?php
          if ($show_toc) {
            get_template_part(
              'partials/post-floating-toc',
              'desktop',
              [ 'content' => do_shortcode(get_the_content()) ],
            );
          }
        ?>
      </div>
    </div>
    <div class="z-0">
      <!-- Article Header -->
      <div class="max-w-3xl mx-auto relative bg-white px-6 pt-6 md:px-10 md:pt-10 rounded-tl-2xl rounded-tr-2xl">
        <div class="bg-brand-purple-lighter w-[200vw] h-full absolute top-0 -left-full -z-10"></div>
        <!-- Image -->
        <div class="relative mb-4">
          <!-- Author -->
          <div class="relative inline-flex mb-3 md:absolute top-0 left-0 z-10 md:m-3 md:p-2 md:bg-white/[0.80] rounded-lg backdrop-blur-sm flex items-center">
            <img class="h-8 aspect-square rounded-full overflow-hidden align-middle mr-2" src="<?php echo $author_gravatar; ?>" alt="<?php echo $author_name; ?>" />
            <label>Written by <a class="cursor-pointer" id="author-link"><?php echo $author_name; ?></a></label>
            <div v-scope="Modal({ id: 'author-dialog' })" @vue:mounted="mounted($el)">
              <slot>
                <p class="h4 !mb-4 !text-brand-purple"><?php echo $author_name; ?></p>
                <p class="!text-base">
                  Since 2003, Dan Green has been a leading mortgage lender and respected industry
                  authority. His unwavering commitment to first-time home buyers and home buyer
                  education has established him as a trusted voice among his colleagues, his peers,
                  and the media. Dan founded Homebuyer.com to expand the American Dream of
                  Homeownership to all who want it.
                  <a href="<?php echo $author_url; ?>" target="_blank" rel="author" title="Posts by <?php echo $author_name; ?>">Read more about <?php echo $author_name;?></a>.
                </p>
              </slot>
            </div>
          </div>
          <?php echo $thumbnail; ?>
        </div>
        <!-- Notice Block -->
        <div class="mb-2 py-5 px-7 bg-brand-purple-lightest rounded-lg">
          <label>
            Homebuyer.com is dedicated to helping you achieve your homeownership dreams. We follow
            editorial guidelines including truthfulness and transparency, and may present you with
            offers from other companies. Read about <a class="cursor-pointer" id="make-money-link">how
            we make money</a>.
          </label>
          <div v-scope="Modal({ id: 'make-money-dialog' })" @vue:mounted="mounted($el)">
            <slot>
              <p class="h4 !mb-4 !text-brand-purple">How We Make Money</p>
              <p class="!text-base">
                Homebuyer.com is your trusted guide to homeownership. Since 2003, our team has offered
                real-world expertise and advice to tens of millions of U.S. home buyers. Our content
                stands on its integrity: it's factual, unbiased, and free from outside influences.
                Read more about our governing
                <a href="<?php echo home_url(); ?>/editorial-guidelines">editorial guidelines</a>.
              </p>
              <p class="!text-base">
                We also exist for profit and want our readers to understand how we make money. 
              </p>
              <p class="!text-base">
                Homebuyer.com is a mortgage-company-affiliated publisher. We earn compensation when
                you click specific links on the website, or apply for a mortgage with Homebuyer.com or
                partner listed in our comparison tables. Our partners compensate us differently, so we
                randomize our tables to protect our readers from steering. We may also earn
                compensation for advertisements on the site, which are indicated clearly.  Note that
                limitations in our software, whether we originate mortgages in your area, and credit
                factors may affect the offers and comparison tables you see on various parts of this
                site. We do not include offers for every mortgage product available.  Someday, we hope
                we will.
              </p>
            </slot>
          </div>
        </div>
        <!-- Certified Accurate Block -->
        <div class="flex items-start md:items-center mb-8">
          <div class="relative">
            <a class="inline-flex -mt-1 md:-mt-px items-center cursor-pointer mr-2 text-brand-purple" id="certified-link">
              <span class="relative mr-1 text-xl mdi mdi-check-circle"></span>
              <span class="text-sm">Certified Accurate</span>
            </a>
            <div v-scope="Modal({ id: 'certified-dialog' })" @vue:mounted="mounted($el)">
              <slot>
                <p class="h4 !mb-4 !text-brand-purple">Certified Accurate</p>
                <p class="!text-base">
                  Your trust matters to us. This article was thoroughly checked for accuracy as of
                  <?php echo get_the_modified_date(); ?>. Homebuyer.com ensures every piece of
                  information we share reflects the latest in mortgage standards. Learn more about our
                  commitments to our reader in our
                  <a href="<?php echo home_url(); ?>/editorial-guidelines">editorial guidelines</a>.
                </p>
              </slot>
            </div>
          </div>
          <div class="flex-1 block text-right md:flex justify-end">
            <label><?php echo hb_get_publish_or_updated_date(); ?></label>
          </div>
        </div>
        <!-- Title -->
        <h1><?php echo $title; ?></h1>
      </div>
      <!-- Content -->
      <div <?php post_class('pt-8 pb-14 bg-white'); ?>>
        <div data-content class="px-6 md:px-0 max-w-2xl mx-auto">
          <?php the_content(); ?>
		  <hr class="mt-8">
          <?php echo do_shortcode("[show_citation]"); ?>
          <?php echo do_shortcode("[show_changelog]"); ?>
        </div>
        <!-- Article Footer -->
        <div class="px-6 md:px-0 max-w-2xl mx-auto">
          <?php
            if ($categories) {
              $category_ids = array();
              foreach ($categories as $individual_category) {
                $category_ids[] = $individual_category->term_id;
              }
              $args = array(
                'category__in' => $category_ids,
                'post__not_in' => array($post->ID),
                'posts_per_page'=> 3, // Number of related posts to display.
                'caller_get_posts'=> 1,
              );

              $my_query = new wp_query($args);

              $related = [];
              while ($my_query->have_posts()) {
                $my_query->the_post();
                $url = get_the_permalink();
                $thumbnail = get_the_post_thumbnail(get_the_ID(), 'medium', array('class' => 'w-full mb-6 md:mb-0 md:mr-6 md:w-50 object-cover aspect-[200/120] rounded-lg'));
                $title = get_the_title();

                $related[] = [
                  'url' => $url,
                  'thumbnail' => $thumbnail,
                  'title' => $title,
                ];
              }
              wp_reset_postdata();
            }
          ?>
          <?php if ($is_research) { ?>
            <div class="my-14">
              <p class="h2">More Homebuyer.com Research</p>
              <div class="grid gap-8 grid-cols-1 md:grid-cols-3">
                <?php
                  foreach ($related as $args) {
                    get_template_part('partials/post-related', 'research', $args);
                  }
                ?>
              </div>
            </div>
          <?php } ?>
          <div data-bottom-cta>
            <?php echo do_shortcode("[show_cta]"); ?>
          </div>
          <?php if (!$is_research) { ?>
            <div class="mb-14">
              <p class="h2">Related Posts</p>
              <?php
                foreach ($related as $args) {
                  get_template_part('partials/post-related', 'learn', $args);
                }
              ?>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
    <!-- Right -->
    <div class="flex-1 bg-white">
      <div class="z-10 relative h-full">
        <!-- Floating CTA -->
        <?php get_template_part('partials/post-floating-cta', 'desktop'); ?>
      </div>
    </div>
  </div>
  <!-- The Quiz Modal -->
  <div v-scope="Modal({ id: 'quiz-dialog' })" @vue:mounted="mounted($el)">
    <slot>
      <p id="modal-text" class="h4 !mb-4 !text-brand-purple"><?php echo $title; ?></p>
      <p class="!text-base">
        <?php echo get_the_excerpt(); ?>
      </p>
    </slot>
  </div>
<?php } ?>
<?php
  get_template_part('partials/footer-newsletter');
  $args = [ 'slug' => get_queried_object()->post_name ];
  get_footer(null, $args);
?>
