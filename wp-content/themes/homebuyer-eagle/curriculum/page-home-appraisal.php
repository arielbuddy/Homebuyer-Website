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
      <h3 class="mb-8">Home Appraisal</h3>
      <div class="w-full mb-12 md:w-auto md:h-110 rounded-2xl overflow-hidden aspect-video">
        <iframe class="h-full w-full" src="https://www.youtube.com/embed/NxqBHGWVTu4" frameborder="0"></iframe>
      </div>
      <div class="post">
        <p>Once your offer is accepted, and you’ve applied for your mortgage loan, your lender will order what’s called a home appraisal.</p>
        <p>It sounds similar to a home inspection, but the two services aren’t the same.</p>
        <p>With a home inspection, the inspector is looking to find defects and issues with the home itself — its structure, the roof, electrical system, etc. This is for your benefit as a homebuyer (no one wants to spend their hard-earned cash a lemon!).</p>
        <p>A home appraisal, on the other hand, is for the lender’s purposes. It allows them to assess the property’s value accurately, which they’ll then use to calculate your maximum loan amount.</p>
        <p>Lenders won’t let you borrow more than the home’s value, so the appraisal is an essential step in the homebuying process.</p>
        <h4><strong>What can happen after an appraisal?</strong></h4>
        <p>Once the appraised value comes in, you’ll need to evaluate it against the purchase price you agreed on with the seller.</p>
        <p>If the appraised value is higher than or equal to your offer, then all is well. You’ll proceed as expected and finalize the purchase of your first home.</p>
        <p>If the appraised value comes in lower than your offer, though, you’ll have three choices:</p>
        <ol>
        <li>Make up the difference: If you offered $200,000 for the house, but it only appraised for $199,000, you could make up the difference in cash. That would mean paying the $1,000 out of pocket, in this case.</li>
        <li>Renegotiate: With this option, you’ll go back to the seller and ask them to lower the purchase price to match the appraised value. Depending on the market you’re buying in, not all sellers will do this. But if the difference is small, or you’re well into the transaction, they may be willing. Be sure to ask your real estate agent if this is a good option in your specific situation.</li>
        <li>Cancel the deal: As long as you have an appraisal contingency in your sales contract (most do!), you can back out of the transaction without penalty. Again, ask your agent if this is an option for you.</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<?php
  $args = [ 'slug' => get_queried_object()->post_name ];
  get_footer(null, $args);
?>
