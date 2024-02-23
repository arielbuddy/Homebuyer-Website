
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
      <h3 class="mb-8">What is a Tradeline?</h3>
      <div class="w-full mb-12 md:w-auto md:h-110 rounded-2xl overflow-hidden aspect-video">
        <iframe class="h-full w-full" src="https://www.youtube.com/embed/Rtzu234QMsE" frameborder="0"></iframe>
      </div>
      <div class="post">
        <p>After your actual credit score, tradelines are the second biggest reason lenders pull your credit report. You could even make the argument that tradelines are more important because your credit score could not be calculated without them.</p>
        <p>A tradeline is the recorded activity of a credit account, as reported to the credit bureaus by the company that holds the account. If you have three credit cards and a car loan, that’s four tradelines.</p>
        <p>Remember when our parents wanted to know who we were hanging out with? They used some mysterious measurement to determine if we were on the road to ruin or the road to success.</p>
        <p>Tradelines provide a similar roadmap for lenders to determine if you are on the brink of drowning in debt or consistently keeping your head above water.</p>
        <p>There are two types of tradelines – revolving and installment.</p>
        <p>A revolving tradeline would be like your credit card, which does not have an end date. You charge $1,000, and when it is paid off, the account stays open. In other words, the account does not get closed. You continue to charge and pay down or pay off the account again and again.</p>
        <p>An installment tradeline would be like a car loan, which does have an end date. You borrow a certain amount of money for a specific period of time and, when you have completed all of your payments, the account is closed, and the car is yours.</p>
        <p>The lender looks at the activity associated with each account to see how consistently you’re meeting these obligations. They can see timely payments, paid down (or paid off) debt, or if you have missed payments. The lender may also consider how often late payments occur or how late you made the payments (typically measured in 30, 60, or 90-day increments).</p>
        <p>To be approved for a mortgage, lenders usually want to see at least two to three different tradelines, open for at least one to two years, and in good standing.</p>
        <p>If you have any questions, feel free to contact the mortgage experts at Homebuyer. We are ready to assist in any way we can.</p>
      </div>
    </div>
  </div>
</div>
<?php
  $args = [ 'slug' => get_queried_object()->post_name ];
  get_footer(null, $args);
?>
