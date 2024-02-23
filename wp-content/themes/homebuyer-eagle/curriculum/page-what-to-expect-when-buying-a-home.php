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
      <h3 class="mb-8">What To Expect When Buying A Home</h3>
      <div class="w-full mb-12 md:w-auto md:h-110 rounded-2xl overflow-hidden aspect-video">
        <iframe class="h-full w-full" src="https://www.youtube.com/embed/yvA_tdzJpE8" frameborder="0"></iframe>
      </div>
      <div class="post">
        <p>Buying your first home is an undertaking, but having a clear path forward will simplify the process and help keep all the moving pieces in order.</p>
        <p>Here at Homebuyer, we like to break the home buying process into nine easy-to-follow steps. Each one brings you a little bit closer to owning that dream home and sets you up for a successful, low-stress first-home purchase.</p>
        <p>Let’s walk through the steps.</p>
        <h4>Step 1: Pre-House Hunting Education</h4>
        <p>This is where you learn a bit about credit and how to improve yours, if necessary. You’ll also do some budgeting and learn about the members of your home buying team.</p>
        <h4>Step 2: Calculating What You Can Afford</h4>
        <p>Here you’ll determine how much home you can qualify for, as well as what down payment you’ll need to buy your house.</p>
        <p>You’ll learn about the other costs of homeownership &#8211; things like maintenance, property taxes, HOA dues, and more &#8211; and finish by calculating what you want to afford. In many cases, this number is different from the maximum amount you can qualify for.</p>
        <h4>Step 3: Get Pre-Approved</h4>
        <p>You won’t just get pre-approved but will also learn what to do with your pre-approval letter and why you’ll need to refresh your pre-approval every 90 days.</p>
        <h4>Step 4: Shopping for Your New Home</h4>
        <p>This is the fun part.</p>
        <p>You’ll work with your agent to browse listings, tour properties, and zero in on homes and neighborhoods that work for your needs. You’ll also learn a bit about homeowner’s insurance.</p>
        <h4>Step 5: Making an Offer</h4>
        <p>You’ll learn about what a purchase offer entails and also about closing costs.</p>
        <p>Once you fall in love with a home, you’ll submit an offer (with the help of your agent) and include your pre-approval letter. You’ll also learn what to do whether your offer is accepted or declined.</p>
        <h4>Step 6: Shop for Your Mortgage Loan</h4>
        <p>Conventional, FHA, VA, USDA, fixed-rate, adjustable-rate, 15-year, 30-year… there are many options!</p>
        <p>Your mortgage expert will help you navigate the waters, decide which option is best for you, and jump-start the mortgage process.</p>
        <h4>Step 7: Get a Professional Home Inspection</h4>
        <p>That’s it. A home inspection is so important that we gave it its own step in the process.</p>
        <h4>Step 8: The Mortgage Process</h4>
        <p>You already jump-started this back in step six, but now it’s time for your home appraisal, completing your mortgage checklist, possibly re-negotiating your purchase agreement based on the inspection and appraisal, and moving everything toward final loan approval.</p>
        <h4>Step 9: Closing</h4>
        <p>The last step is the most exciting one.</p>
        <p>You’ll do a final walkthrough of the house, attend your closing and settlement, sign the paperwork, and get your keys.</p>
        <p>We understand… it sounds like a lot, but you’re not alone. We’re here for you every step of the way.</p>
        <p>You’ve got this!</p>
      </div>
    </div>
  </div>
</div>
<?php
  $args = [ 'slug' => get_queried_object()->post_name ];
  get_footer(null, $args);
?>
