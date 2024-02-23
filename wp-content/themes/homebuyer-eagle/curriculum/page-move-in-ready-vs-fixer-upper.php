
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
      <h3 class="mb-8">Move-In-Ready vs. Fixer-Upper</h3>
      <div class="w-full mb-12 md:w-auto md:h-110 rounded-2xl overflow-hidden aspect-video">
        <iframe class="h-full w-full" src="https://www.youtube.com/embed/u_NRBiPwJ9o" frameborder="0"></iframe>
      </div>
      <div class="post">
        <p>While it’s a big decision, there’s no right or wrong answer here. However, there are definite advantages and disadvantages you will want to consider before embarking on either pathway.</p>
        <h4><strong>Move-In-Ready</strong></h4>
        <p>Move-in-ready homes are great!</p>
        <p>From modern appliances to newer window and roof systems, your move-in ready home often means lower utility bills.</p>
        <p>You can also find updated features, such as security and smart-home systems, pre-wired cable and internet, and up-to-date design features like open floor plans and walk-in closets.</p>
        <p>Plus, you can move in and start living right away.</p>
        <p>But this doesn’t mean move-in ready homes are always the right choice.</p>
        <h4><strong>Fixer-Upper</strong></h4>
        <p>Your typical fixer-upper is priced a good deal cheaper than a comparable move-in ready home, which means your property taxes and insurance will be lower, as well.</p>
        <p>One of the most significant advantages of a fixer-upper is the equity building potential. If you’re fixing it up in the right places, your home should be worth more than you paid for it pretty quickly.</p>
        <p>Plus, if you’re a fan of unique architectural and design details, a vintage feel, taking on projects, or customizing things to be precisely what you want, a fixer-upper could be a clear winner for you.</p>
        <p>The choice is yours, and it’s hard to go wrong with either option.</p>
      </div>
    </div>
  </div>
</div>
<?php
  $args = [ 'slug' => get_queried_object()->post_name ];
  get_footer(null, $args);
?>
