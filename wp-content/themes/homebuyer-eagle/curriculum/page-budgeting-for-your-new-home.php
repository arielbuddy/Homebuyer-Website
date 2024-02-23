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
      <h3 class="mb-8">Budgeting for Your New Home</h3>
      <div class="w-full mb-12 md:w-auto md:h-110 rounded-2xl overflow-hidden aspect-video">
        <iframe class="h-full w-full" src="https://www.youtube.com/embed/_V2c8-ZjjB4" frameborder="0"></iframe>
      </div>
      <div class="post">
        <p>There are a few things you can do to get ahead of the game when buying your first home, even before you think about house hunting.</p>
        <p>One of those things is fine-tuning your budget.</p>
        <p>Budgeting can help you maximize the cash you have coming in, and it can also make it easier when it comes time to get pre-approved for your mortgage.</p>
        <p>Most importantly, proper budgeting ensures you get a payment you’re comfortable with, so you can enjoy that new home free of stress and worry.</p>
        <p>Here are six tips for budgeting success:</p>
        <h4><strong>1. Figure out your household income – after tax.</strong></h4>
        <p>This isn’t your salary, but instead, the earnings you take home after taxes. Be sure to include both yours and that of any co-buyer you’ll be purchasing the home with.</p>
        <p>You’ll be using your pre-tax income to qualify for your mortgage loan, but your after-tax income represents the money you have to work with.</p>
        <h4><strong>2. Make a list of your monthly household expenses – all of them.</strong></h4>
        <p>Be thorough and list out every expense you pay each month as a household.</p>
        <p>This should include things like:</p>
        <ul>
        <li>Utilities</li>
        <li>Groceries</li>
        <li>Phone, TV, and internet bills</li>
        <li>Monthly subscriptions</li>
        <li>Gas, tolls, and transportation costs</li>
        <li>Childcare</li>
        </ul>
        <p>Once you have these (and their average costs) all listed out, deduct that amount from your after-tax income. That’s how much you have to work with when buying your home.</p>
        <h4><strong>3. Find places to cut back – if necessary.</strong></h4>
        <p>Take a look at your expenses and see if there is anything you can improve on.</p>
        <p>Are you eating out a lot? Maybe you have monthly subscriptions you’re not using as much?</p>
        <p>Reducing your expenses by even a tiny amount can help you boost those savings and build a better foundation for buying a home.</p>
        <h4><strong>4. Pay off your debts.</strong></h4>
        <p>You can certainly buy a home with debt, but it’s much easier without them.</p>
        <p>If you can, whittle down the balances of any credit cards or loans you have, or consider paying one-off entirely with the money from those reduced expenses.</p>
        <p>Doing so will improve your credit score and make it easier to qualify for a mortgage loan when it’s time.</p>
        <h4><strong>5. Save for your down payment.</strong></h4>
        <p>You may have started this process already.</p>
        <p>If you have, good for you! If not, don’t worry too much. You still have time, and it probably doesn’t take as much down payment as you think to buy that first house.</p>
        <p>Still, it doesn’t hurt to start saving early. The more you can save, the simpler and more affordable your home purchase will be.</p>
        <h4><strong>6. Be realistic.</strong></h4>
        <p>When working on your budget, be honest and realistic about your estimations.</p>
        <p>You’ll seldom hear complaints from homeowners that didn’t over-extend themselves.</p>
        <p>This is what budgeting leads up to; maximizing the money you have coming in, figuring out what you have to work with, and deciding how much you’re comfortable with spending on your monthly housing payment.</p>
        <p>Budgeting early and updating often will keep you a step ahead.</p>
      </div>
    </div>
  </div>
</div>
<?php
  $args = [ 'slug' => get_queried_object()->post_name ];
  get_footer(null, $args);
?>
