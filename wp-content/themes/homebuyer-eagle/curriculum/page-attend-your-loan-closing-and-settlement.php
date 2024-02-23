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
      <h3 class="mb-8">Attend Your Loan Closing and Settlement</h3>
      <div class="w-full mb-12 md:w-auto md:h-110 rounded-2xl overflow-hidden aspect-video">
        <iframe class="h-full w-full" src="https://www.youtube.com/embed/52E1jhvNKy8" frameborder="0"></iframe>
      </div>
      <div class="post">
        <p>At this point, your closing agent (also referred to as an escrow officer or settlement agent) has reviewed your contract and made sure that both parties have fulfilled all promises. They have also provided real estate agents with escrow instructions and have made sure that all money will go where it needs to go.</p>
        <p>At your closing and settlement, you will sign all the necessary paperwork. When the paperwork is complete, your mortgage lender will send funds to your closing agent. Your closing agent will then distribute the funds to all necessary parties and facilitate the property’s legal transfer of ownership.</p>
        <p>Once everything is in order, you have officially crossed the finish line. You are now a homeowner!</p>
      </div>
    </div>
  </div>
</div>
<?php
  $args = [ 'slug' => get_queried_object()->post_name ];
  get_footer(null, $args);
?>
