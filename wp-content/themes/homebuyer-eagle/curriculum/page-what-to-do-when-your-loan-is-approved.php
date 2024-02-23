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
      <h3 class="mb-8">What to do When Your Loan is Approved</h3>
      <div class="w-full mb-12 md:w-auto md:h-110 rounded-2xl overflow-hidden aspect-video">
        <iframe class="h-full w-full" src="https://www.youtube.com/embed/LyUb0uWg-uE" frameborder="0"></iframe>
      </div>
      <div class="post">
        <p>You’ve received word that your loan is approved: Congratulations! Your one big step closer to homeownership.</p>
        <p>You should be proud — and maybe even celebrate a little?</p>
        <p>Just remember: As the adage goes, “It’s not over ‘til it’s over,” and you’re not at closing day yet.</p>
        <p>Not sure what to do until then? Here’s what should be on your agenda:</p>
        <h4><strong>What your lender will do between approval and closing</strong></h4>
        <p>Your lender will be keeping an eye on things until your closing date.</p>
        <p>They’ll work with you to make sure your interest rate lock doesn’t expire, prepare your closing documents and send them to the escrow or title agent, and they’ll wire all the funds necessary to finalize your purchase on the big day.</p>
        <p>If you need anything from them along the way, reach out to your mortgage expert for help. They’re there to make this process simple and painless for you.</p>
        <h4><strong>What you should do between approval and closing</strong></h4>
        <p>On your end, you have a few duties during this time.</p>
        <p>First, make sure you respond to any lender requests quickly. If your mortgage expert asks for a piece of paperwork or additional documentation, get it to them as fast as possible. Otherwise, it could delay your closing.</p>
        <p>Second, you should line up a homeowners insurance policy. Lenders need proof of this before they can wire the funds to complete your transaction.</p>
        <p>Finally, keep a tight rein on your finances during these final days, and try to delay any big-ticket purchases like furniture, home decor, etc., until after closing. It’s hard to stay patient on things like this, but your lender will likely run one last credit check before closing. If they see new loans or credit cards, higher balances, or late payments, it could derail your loan.</p>
      </div>
    </div>
  </div>
</div>
<?php
  $args = [ 'slug' => get_queried_object()->post_name ];
  get_footer(null, $args);
?>
