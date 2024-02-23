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
      <h3 class="mb-8">Renegotiating after a home appraisal</h3>
      <!--<div class="w-full mb-12 md:w-auto md:h-110 rounded-2xl overflow-hidden aspect-video">
        <iframe class="h-full w-full" src="https://www.youtube.com/embed/Oq7mISJOQuY" frameborder="0"></iframe>
      </div>-->
      <div class="post">
        <p>Once your home appraisal comes in, you’ll have yet another opportunity to renegotiate — at least if the appraisal comes in low. If the appraised value is higher or equal to your purchase price, that’s the ideal situation, and you’ll proceed as usual.</p>
        <p>If the appraised value is lower than your purchase price, you’ll have two negotiation options:</p>
        <ol>
        <li>Ask them to lower the purchase price to meet the appraised value. If you initially offered $200,000, but the appraised value came in at $195,000, you can ask the seller to accept the lower, $195,000 instead.</li>
        <li>Meet somewhere in the middle. You can also ask the seller to split the difference. In the previous example, that might mean the seller accepts $197,500, and you contribute the other $2,500 out of pocket.</li>
        <li>The ability to renegotiate is dependent on the market you’re buying in. If homes are selling quickly, you may not have leverage. If homes are taking a long time to sell, you hold the cards.</li>
        </ol>
        <p>Be sure to work with your real estate agent closely during any re-negotiation. They’ll have a good handle on the market and will ensure your best chance of success.</p>
      </div>
    </div>
  </div>
</div>
<?php
  $args = [ 'slug' => get_queried_object()->post_name ];
  get_footer(null, $args);
?>
