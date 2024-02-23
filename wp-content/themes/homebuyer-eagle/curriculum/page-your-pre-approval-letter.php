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
      <h3 class="mb-8">Your Pre-Approval Letter</h3>
      <div class="w-full mb-12 md:w-auto md:h-110 rounded-2xl overflow-hidden aspect-video">
        <iframe class="h-full w-full" src="https://www.youtube.com/embed/2OU8WILH3fQ" frameborder="0"></iframe>
      </div>
      <div class="post">
        <p>To get pre-approved for a mortgage loan, you complete the lender’s questionnaire, provide the necessary documentation, a lender reviews all the details, and determine that you’re pre-approved for a loan of a certain dollar amount.</p>
        <p>This is a huge step in the home buying process. If you have received your pre-approval letter, congratulations!</p>
        <p>Many people think this is their golden ticket to homeownership. However, it’s more of an admission ticket that gets you into the game.</p>
        <p>You are now ready to start house hunting with the intention of buying.</p>
        <h4><strong>But what exactly do you do with that pre-approval letter?</strong></h4>
        <p>Most sellers won’t even look at your offer if you’re not pre-approved for a mortgage. This makes your pre-approval one of the most valuable parts of your entire offer.</p>
        <p>The one thing you need to do is give your pre-approval letter to your real estate agent and make sure they include it when you submit an offer on a home.</p>
      </div>
    </div>
  </div>
</div>
<?php
  $args = [ 'slug' => get_queried_object()->post_name ];
  get_footer(null, $args);
?>
