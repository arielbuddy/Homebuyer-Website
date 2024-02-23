<?php get_header(); ?>
<div class="relative bg-gradient-to-r from-brand-purple from-20% to-brand-purple-dark">
  <div class="container">
    <div class="flex flex-col items-center gap-11 mb-20 md:mb-30 z-0">
      <div class="text-center">
        <h1 class="text-white mb-2">Welcome Back!</h1>
        <h4 class="text-white mb-8">Your subscription is re-confirmed. No further action is needed.</h4>
      </div>
      <div class="z-20">
        <div class="w-full md:w-180 mx-auto rounded-2xl overflow-hidden aspect-video mb-4">
          <iframe class="h-full w-full" src="https://www.youtube.com/embed/PKE2gGIfhGg" frameborder="0"></iframe>
        </div>
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
