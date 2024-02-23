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
      <h3 class="mb-8">How Much Down Payment Do You Need?</h3>
      <div class="w-full mb-12 md:w-auto md:h-110 rounded-2xl overflow-hidden aspect-video">
        <iframe class="h-full w-full" src="https://www.youtube.com/embed/dmkhb-W2IXY" frameborder="0"></iframe>
      </div>
      <div class="post">
        <p>One of the biggest hurdles for first-time homebuyers is coming up with a down payment. But exactly how big of a down payment will your lender require?</p>
        <p>The minimum required down payment for a loan depends on the type of loan program you choose. There are two basic types of loans: conventional loans and government loans.</p>
        <h4><strong>Conventional Loans</strong></h4>
        <p>Conventional mortgages are made available by Fannie Mae (FNMA) or Freddie Mac (FHLMC). These loans are available from almost all mortgage lenders and are the most common choice among home buyers.</p>
        <p>You may have heard that you need a 20% down payment for a conventional loan, but lenders often have loan programs that allow you to put down as little as 3% or 5%.</p>
        <p>To qualify for the 3% down payment option, you’ll have to meet specific guidelines and income limitations, but the 5% down payment option is available to everyone.</p>
        <h4><strong>Government-Backed Loans</strong></h4>
        <p>There are three types of government-backed loans you can qualify for: FHA, VA, and USDA.</p>
        <p>FHA loans are available to everyone. These loans are popular with first-time homebuyers because of more lenient qualification guidelines than conventional loans, and they still only require a 3.5% down payment.</p>
        <p>VA loans are available to active and veteran service members. VA loans are pretty similar to FHA loans, only they allow 100% financing, so there is no down payment required.</p>
        <p>USDA loans are available for properties located in rural areas. This covers 91% of the country, and these loans also allow you to purchase a home with no down payment.</p>
        <p>The vast majority of mortgage lenders offer all government loans.</p>
        <h4><strong>The 20% Down Payment Myth</strong></h4>
        <p>You may have heard that it takes a 20% down payment to buy a home, but it’s simply not true. Buying your first home with minimal down payment became a reality when FHA loans were introduced to make homeownership more accessible back in 1934. And today, it’s easier than ever.</p>
      </div>
    </div>
  </div>
</div>
<?php
  $args = [ 'slug' => get_queried_object()->post_name ];
  get_footer(null, $args);
?>
