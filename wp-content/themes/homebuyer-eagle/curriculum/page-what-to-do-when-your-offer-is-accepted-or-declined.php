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
      <h3 class="mb-8">What to Do When Your Offer is Accepted or Declined</h3>
      <div class="w-full mb-12 md:w-auto md:h-110 rounded-2xl overflow-hidden aspect-video">
        <iframe class="h-full w-full" src="https://www.youtube.com/embed/rGPuZ9MN3tM" frameborder="0"></iframe>
      </div>
      <div class="post">
        <p>After submitting an offer on a home, it’s easy to find yourself on pins and needles waiting to see if the seller accepts or declines.</p>
        <p>Either way, here’s what to do after you get that answer.</p>
        <p>If your offer isn’t accepted, there could be multiple reasons why. If possible, figure out what those reasons are.</p>
        <p>Your offered price may have been too low, your preferred closing timeframe didn’t work for the seller, or maybe your contingencies seemed unreasonable.</p>
        <p>If you’ve been following the curriculum, you submitted your mortgage pre-approval with your offer, so that couldn’t be it.</p>
        <p>If a seller sends a counteroffer with revisions, this is easy. And that’s a good thing.</p>
        <p>A counteroffer means they like the majority of your offer, and there are only a few details to negotiate before you reach an agreement.</p>
        <p>If the seller rejects your offer or doesn’t respond by the offer expiration date, it may be worth having your real estate agent reach out and ask what they didn’t like. It may be something you’re willing to do, like bump the price a bit or push the closing date out further.</p>
        <p>However, if the seller is expecting you to toss in a truckload of gold bars, or they just become unresponsive, it’s safe to say that it’s time to work with your real estate agent on drawing up an offer for the next home on your list.</p>
        <p>If your offer is accepted, that’s a win… Celebrate!</p>
        <p>A little bit.</p>
        <p>You still have a lot of work to do.</p>
        <p>Your next step is to contact your lender to choose the best loan program for you and work on turning that pre-approval into a full approval.</p>
      </div>
    </div>
  </div>
</div>
<?php
  $args = [ 'slug' => get_queried_object()->post_name ];
  get_footer(null, $args);
?>
