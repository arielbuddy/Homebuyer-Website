<?php get_header(); ?>
<div class="flex flex-col items-center flex-1 px-4">
  <img class="w-90" src="<?php echo get_template_directory_uri(); ?>/images/art/quirky-wrench-and-screwdriver.svg" alt="illustration">
  <h3 class="text-center text-brand-black font-sans-medium mb-4">
    404 Page Not Found
  </h3>
  <p class="text-center mb-4">
    Unfortunately we can't find the page you are looking for. Please check your URL or return to the home page.
  </p>
  <a class="btn-primary m-14 px-10" href="<?php echo home_url(); ?>">
    Return to Homepage
  </a>
</div>
<?php
  $args = [ 'slug' => get_queried_object()->post_name ];
  get_footer(null, $args);
?>
