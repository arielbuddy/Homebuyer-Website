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
      <h3 class="mb-8">Closing Costs and Who Pays Them</h3>
      <div class="w-full mb-12 md:w-auto md:h-110 rounded-2xl overflow-hidden aspect-video">
        <iframe class="h-full w-full" src="https://www.youtube.com/embed/mgCr0UMY1_g" frameborder="0"></iframe>
      </div>
      <div class="post">
        <p>When you purchase a home, the price you pay is slightly more than the actual purchase price.</p>
        <p>We’ve mentioned closing costs before, but it’s time to review them in detail.</p>
        <p>The seller must pay a few closing costs, like real estate agent commissions, but most closing costs are paid by the buyer.</p>
        <p>Here at Homebuyer, total closing costs for a first-home purchase average 2 percent of the purchase price. They can vary based on property and loan characteristics, but the 2 percent calculation gives you a reasonable estimate.</p>
        <p>These closing costs include:</p>
        <ul>
        <li>Property-related fees, like the appraisal fee and cost of home inspection.</li>
        <li>Loan-related fees for credit checks, underwriting and document preparation, and notary fees. Discount points, which give you the option of paying a little extra out of pocket in exchange for a lower interest rate, are also included here.</li>
        <li>Property taxes, homeowner’s insurance premiums, and homeowner’s association dues are fees that come along with home-owning more than home-buying, but you’ll typically need to pay a couple of months of these up-front, so they’re also part of the transaction.</li>
        <li>Fees for title searches, title insurance, and transfer stamps will also be included.</li>
        </ul>
        <p>Closing costs can be challenging to keep track of, which is why we make it as simple as possible.</p>
        <p>Three days after your initial loan application, you’ll receive a Loan Estimate from your lender. And three days before you close on your new home, you’ll receive a Closing Disclosure.</p>
        <p>The loan estimate and the closing disclosure both include a detailed breakdown of all fees, your interest rate, and any other costs required to close your loan. Please review them carefully and reach out to your mortgage expert early and often with any questions.</p>
        <p>Also, don’t forget that you can ask for a seller concession when submitting your offer. This results in the seller paying some, or all, of your closing costs. The odds of getting a seller concession are market-dependent, so it’s best to consult with your real estate agent about it.</p>
      </div>
    </div>
  </div>
</div>
<?php
  $args = [ 'slug' => get_queried_object()->post_name ];
  get_footer(null, $args);
?>
