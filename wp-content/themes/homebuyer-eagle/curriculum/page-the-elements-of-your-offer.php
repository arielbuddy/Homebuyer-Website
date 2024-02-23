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
      <h3 class="mb-8">The Elements of Your Offer</h3>
      <div class="w-full mb-12 md:w-auto md:h-110 rounded-2xl overflow-hidden aspect-video">
        <iframe class="h-full w-full" src="https://www.youtube.com/embed/W0aA5BbrNso" frameborder="0"></iframe>
      </div>
      <div class="post">
        <p>Finding a home you love and being ready to make an offer is an exciting time.</p>
        <p>Your real estate agent will help you through this process, but your offer will include some key elements you’ll want to be familiar with.</p>
        <p>Here are seven elements that are vital to every home purchase offer.</p>
        <h4><strong> 1. Purchase Price</strong></h4>
        <p>While this one is pretty obvious, the purchase price is front and center in your offer. And it’s typically the first thing a seller looks at.</p>
        <h4><strong> 2. Closing Date</strong></h4>
        <p>Your offer includes a timeframe of how long it’s valid for and when you’d like the closing to take place.</p>
        <p>If the seller already has a target date picked out or is motivated to sell quickly, they may prefer an earlier or later closing date.</p>
        <p>Every transaction is different, but the offer will always specify the closing date, and it’s negotiable.</p>
        <h4><strong>3. Earnest Money Deposit</strong></h4>
        <p>Earnest money is a security or “good-faith” deposit that shows you’re interested in the property… interested enough to let your wallet do the talking.</p>
        <p>It’s not extra cash you need to come up with, as buyers typically use part of their down payment funds for this.</p>
        <p>The money is placed into an escrow account managed by an escrow officer or closing agent. This third party holds all documents, instructions, and money necessary to close the transaction.</p>
        <p>Sooner or later, all the money required for the purchase will end up there, but depositing some of it upfront as earnest money strengthens your offer.</p>
        <h4><strong> 4. Closing Cost Stipulations</strong></h4>
        <p>In addition to paying the purchase price of the home, there are also closing costs.</p>
        <p>These fees include things like home appraisal and inspection, title fees, and insurance. We’ll have a detailed piece on these coming up soon.</p>
        <p>Just know these will be part of your offer, and you may be able to ask for a seller concession, which means the seller would be paying a portion, or all, of these costs for you. Getting a concession like this is dependent on the market you’re buying in, so work closely with your real estate agent on this.</p>
        <h4><strong> 5. Home Warranty</strong></h4>
        <p>If you want a home warranty on the property to protect the systems and appliances when they fail from normal wear and tear, you can ask the seller to include one.</p>
        <p>Your offer will also include the home warranty verbiage.</p>
        <h4><strong> 6. Disclosures</strong></h4>
        <p>These will come from the seller. What they are legally required to disclose varies based on location. Still, they’ll typically need to tell you about deaths in the home, neighborhood nuisances, hazards, homeowners association info, repairs they’ve done to the home, water damage, and missing items.</p>
        <p>Consult with your real estate agent on these and make sure everyone is in the loop.</p>
        <h4><strong> 7. Contingencies</strong></h4>
        <p>Most offers include a few contingencies, which are requirements that will allow you to break the offer and walk away from the deal without penalty.</p>
        <p>The three most common contingencies for first-time buyers are:</p>
        <ul>
        <li>A Financing Contingency that specifies the offer is only valid if you are fully approved for a loan on that property.</li>
        <li>A Home Inspection Contingency says that you could walk away from the deal if the home inspection uncovers too many issues that the seller isn’t willing to pay for.</li>
        <li>A Home Appraisal Contingency that specifies you have the option to cancel the deal if the appraised value of the home comes in less than the purchase price. You don’t have to cancel the deal if this happens, but you’d have the option to.</li>
        </ul>
        <p>Carefully consider all of these items included in your offer.</p>
        <p>Craft them for the market you’re purchasing in and give you the best odds of having the terms you’re comfortable with being accepted by the seller.</p>
      </div>
    </div>
  </div>
</div>
<?php
  $args = [ 'slug' => get_queried_object()->post_name ];
  get_footer(null, $args);
?>
