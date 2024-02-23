<?php get_header(); ?>
<div class="relative bg-gradient-to-r from-brand-purple from-20% to-brand-purple-dark">
  <div class="container md:py-30">
    <h1 class="mb-16 md:mb-12 text-white text-center">
      Homebuyer.com Referral Hub
    </h1>
    <div class="text-center">
      <div id='sparkloop-referral-hub' data-campaign-id='MF904180127b29'>
        <div class="skeleton-loader w-140 h-100 rounded-lg"></div>
      </div>
    </div>
  </div>
  <div class="hidden md:block absolute bottom-0 right-0 z-10">
    <img class="object-cover" src="<?php echo get_template_directory_uri(); ?>/images/art/book-as-house.png" alt="Book as house">
  </div>
</div>
<?php
  $args = [ 'slug' => get_queried_object()->post_name ];
  get_footer(null, $args);
?>
