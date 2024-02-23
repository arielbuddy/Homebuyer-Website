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
      <h3 class="mb-8">Fixed Rate vs. Adjustable Rate Mortgages</h3>
      <div class="w-full mb-12 md:w-auto md:h-110 rounded-2xl overflow-hidden aspect-video">
        <iframe class="h-full w-full" src="https://www.youtube.com/embed/Jzs1qhM5xlk" frameborder="0"></iframe>
      </div>
      <div class="post">
        <p>When you take out a mortgage, you have two primary choices to make:</p>
        <ul>
        <li>Loan term – How long your payments are stretched out over</li>
        <li>Interest Rate Type – Fixed-rate or Adjustable-rate</li>
        </ul>
        <p>Both factors will impact your monthly payment, as well as the long-term costs of your mortgage.</p>
        <p>Your mortgage expert can help you compare all options’ exact costs, but for now, let’s look at what these options mean.</p>
        <h4><strong>Loan Term</strong></h4>
        <p>Mortgage loans can be anywhere from 10 to 30 years in length, in five-year increments. The longer your term, the longer you have to repay your loan.</p>
        <p>The 15-year and 30-year mortgages are the most popular options, with the 30-year being the overwhelming favorite among first-time buyers. The 30-year term spreads the loan balance across the most extended length of time, resulting in the lowest possible monthly payment.</p>
        <p>The 15-year term is more seldom used because it yields a higher monthly payment. However, it does result in you paying off your home in half the time of a 30-year loan. The 15-year term could be an excellent option for you and is worth looking into.</p>
        <h4><strong>Interest Rate Type</strong></h4>
        <p>Mortgage rates are fixed, meaning they stay the same for the entire loan term, or they’re adjustable, which means the rate can change after a certain period.</p>
        <p>The vast majority of home buyers choose a 30-year fixed-rate mortgage because of the security and consistency it offers, but it’s not the right fit for everyone.</p>
        <p>An adjustable-rate mortgage (ARM) can be a smart move, too. ARMs are 30-year loans, just like the 30-year fixed-rate mentioned above, but this time your interest rate is fixed for a specified period — either three, five, seven, or ten years. After that, the interest rate can adjust up or down with market movement. The rate isn’t constantly changing, either. Rates only adjust every six to twelve months, and they are limited in how much they can move, so there is built-in protection for you.</p>
        <p>An ARM’s benefit is a lower interest rate and lower monthly payment than a comparable fixed-rate mortgage. And the shorter the fixed period is, the lower the rates are, so a five-year ARM will have a lower interest rate than a ten-year ARM.</p>
        <p>If you know this isn’t your forever home, or you can see yourself refinancing within the first five to ten years of homeownership, an adjustable-rate mortgage may be the best loan for you.</p>
        <p>There is no “best” option here, but there is a best option for you.</p>
        <p>Lean on your mortgage expert and ask them to run the numbers for all your loan term and interest rate options. This will help you compare, contrast, and find the right choice for your mortgage loan.</p>
      </div>
    </div>
  </div>
</div>
<?php
  $args = [ 'slug' => get_queried_object()->post_name ];
  get_footer(null, $args);
?>
