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
      <h3 class="mb-8">Why Home Inspections are Important</h3>
      <div class="w-full mb-12 md:w-auto md:h-110 rounded-2xl overflow-hidden aspect-video">
        <iframe class="h-full w-full" src="https://www.youtube.com/embed/3ARE_c8_6dI" frameborder="0"></iframe>
      </div>
      <div class="post">
        <p>After having your offer accepted and signing a purchase contract, you’ll want to hire a professional home inspector to examine the property for any issues or damage that aren’t visible at first glance. Good home inspectors will look at the roof, walls, electrical, HVAC, plumbing, foundation, and anything else that could warrant a repair.</p>
        <p>If nothing significant is found, that’s the ideal situation. Then you can move forward with your purchase with confidence in the home you are buying.</p>
        <p>If issues are uncovered, that’s still okay. Now is your chance to revisit step five with your real estate agent and re-negotiate your purchase contract.</p>
        <p>Regardless of the outcome, it’s always better to spend a couple hundred dollars on a quality home inspection than to find out about expensive problems after taking ownership of the home.</p>
      </div>
    </div>
  </div>
</div>
<?php
  $args = [ 'slug' => get_queried_object()->post_name ];
  get_footer(null, $args);
?>
