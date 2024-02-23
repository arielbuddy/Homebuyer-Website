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
      <h3 class="mb-8">Jump-Start the Mortgage Process</h3>
      <div class="w-full mb-12 md:w-auto md:h-110 rounded-2xl overflow-hidden aspect-video">
        <iframe class="h-full w-full" src="https://www.youtube.com/embed/G94yxhT3yYQ" frameborder="0"></iframe>
      </div>
      <div class="post">
        <p>You’re getting close!</p>
        <p>You’ve found a home that you love, the seller’s accepted your offer, and you’ve picked out the best mortgage loan for your budget and goals.</p>
        <p>Now, it’s time to turn that pre-approval into a full approval and plow forward toward the closing table.</p>
        <p>Your pre-approval covers most things, but your lender still needs to review your updated documents, as well as the property you’re buying.</p>
        <p>And that’s where you come in… You’re in control.</p>
        <p>Once you’re well into the mortgage process, your lender will play a key role. They’ll lock in your interest rate, order an appraisal of your home, and underwrite your loan.</p>
        <p>But remember: You’re in the driver’s seat, and many of your lender’s tasks require your help.</p>
        <p>Much like when you got pre-approved for your mortgage, your lender will need some documentation. Often, they’ll want updated versions of documents you’ve already provided (your latest pay stubs, for example). And, in some cases, there are new items you’ll need to provide.</p>
        <p>Either way, time is of the essence. If your lender requests documentation from you, send it over as quickly as possible. Any delay could push back your closing date.</p>
        <p>In short, your lender can’t do their job until you do, so make sure to answer their calls, emails, or texts and be ready to act fast.</p>
      </div>
    </div>
  </div>
</div>
<?php
  $args = [ 'slug' => get_queried_object()->post_name ];
  get_footer(null, $args);
?>
