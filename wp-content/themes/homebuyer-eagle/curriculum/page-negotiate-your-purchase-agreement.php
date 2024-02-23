<?php get_header(); ?>
<div class="container md:pt-30 md:pb-24">
  <h1 class="mb-16 md:mb-12 text-center">
    Welcome to Homebuyer.com
  </h1>
  <div class="mb-20 md:mb-30 flex justify-center">
    <h4 class="text-brand-gray-dark">Everything you need to know when buying your first home, from start to finish.</h4>
  </div>
  <div class="flex flex-col md:flex-row gap-11 mb-20 md:mb-30">
    <div class="w-full md:w-1/4">
      <?php
        get_template_part(
          'partials/curriculum-toc',
          null,
          [ 'slug' => get_queried_object()->post_name ],
        );
      ?>
    </div>
    <div class="flex-1">
      <h3 class="mb-8">Negotiate Your Purchase Agreement</h3>
      <div class="w-full mb-12 md:w-auto md:h-110 rounded-2xl overflow-hidden aspect-video">
        <iframe class="h-full w-full" src="https://www.youtube.com/embed/JVmdeTkraZc" frameborder="0"></iframe>
      </div>
      <div class="post">
        <p>There are many ways to save some money on the purchase of your home.</p>
        <p>Home prices are not set in stone. You’re welcome to offer the seller less than the listing price. You can also ask the seller to pay some of your closing costs. If repairs need to be done, you may be able to ask the seller to pay for them in advance or lower the purchase price to cover the costs.</p>
        <p>Your ability to negotiate will always be dependent upon the local market, so it’s good to work closely with your real estate agent on this. They will know the market well and help you build an effective strategy.</p>
      </div>
    </div>
  </div>
</div>
<?php
  $args = [ 'slug' => get_queried_object()->post_name ];
  get_footer(null, $args);
?>
