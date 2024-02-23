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
      <h3 class="mb-8">Get Pre-Approved to Buy a Home</h3>
      <div class="w-full mb-12 md:w-auto md:h-110 rounded-2xl overflow-hidden aspect-video">
        <iframe class="h-full w-full" src="https://www.youtube.com/embed/R8hJzzr9Aa4" frameborder="0"></iframe>
      </div>
      <div class="post">
        <p>After you’ve settled on your monthly budget for housing, the next step is to get your mortgage pre-approved.</p>
        <p>A mortgage pre-approval is a test run for your actual mortgage. It uses your actual income, your actual debts, and your actual credit score to show that you can get mortgage-approved for a home that’s within your budget.</p>
        <p>When you’re pre-approved to buy a home, you have peace of mind to know that you’re qualified. You also get issued a pre-approval letter, which home sellers use to prove your qualifications.</p>
        <p>Sellers almost never accept offers from non-approved buyers. Getting pre-approved is fast and simple, and can be handled online through a secure questionnaire.</p>
        <p>As soon as you know your budget, it’s the right time to pre-approve your loan. It’s hard to move forward without it.</p>
        <p><a href="https://app.homebuyer.com">Get Pre-Approved in 3 Minutes</a></p>
      </div>
    </div>
  </div>
</div>
<?php
  $args = [ 'slug' => get_queried_object()->post_name ];
  get_footer(null, $args);
?>
