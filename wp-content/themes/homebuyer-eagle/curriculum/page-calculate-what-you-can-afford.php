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
      <h3 class="mb-8">Calculate What You Can Afford</h3>
      <div class="w-full mb-12 md:w-auto md:h-110 rounded-2xl overflow-hidden aspect-video">
        <iframe class="h-full w-full" src="https://www.youtube.com/embed/rnOhoqpg7aw" frameborder="0"></iframe>
      </div>
      <div class="post">
        <p>As a first-time home buyer, your biggest risk is that you buy outside your budget, which means the important part of shopping for homes is knowing how much home you can afford.</p>
        <p>So, how much home can you afford? Only you can answer that question, so start by asking yourself: How much do I want to pay for housing each month?</p>
        <ul>
        <li>Do you want to pay no more than your current rent?</li>
        <li>Do you want to pay a few hundred dollars more than your current rent?</li>
        <li>Do you want to pay less than your current rent?</li>
        </ul>
        <p>Find your number, and write it down. This answers “how much house can I afford” because you’re not buying the whole home with cash. Instead, you’re getting a loan, and it’s the payments you have to live with.</p>
        <p>Now that you’ve found your maximum housing payment, it’s time to work backwards to find the maximum purchase price to use for your home shopping.</p>
        <p>Here’s how to do it:</p>
        <p>Your monthly housing payment is more than just your mortgage &#8211; it has four parts to it.</p>
        <ol>
        <li>Principal: The money you pay back on your loan each month</li>
        <li>Interest: The money you pay in loan interest each month</li>
        <li>Real Estate Taxes: The money paid to your local government for owning a home</li>
        <li>Homeowners Insurance: The money paid to insure your home from catastrophe</li>
        </ol>
        <p>There’s also a fifth part, Association Dues, if you buy a home in a condominium or neighborhood development. Dues are the money paid for common services such as landscaping and maintenance.</p>
        <p>When you add up those parts, if it’s under your budget, the home is in range. The next step is to determine whether you can get approved for a mortgage for your budgeted payment amount.</p>
        <p>To decide whether you’re approved, your mortgage lender will take your estimate mortgage payment, plus they monthly payments from your credit report, and compare it to your pre-tax income. So long as you’re not spending more than $43 of every $100 dollars you make on your mortgage and other payments, you’re likely to be approved.</p>
        <p>Depending on your credit profile, it&#8217;s possible to be approved for a monthly spend up to $50 of every $100 you make.</p>
      </div>
    </div>
  </div>
</div>
<?php
  $args = [ 'slug' => get_queried_object()->post_name ];
  get_footer(null, $args);
?>
