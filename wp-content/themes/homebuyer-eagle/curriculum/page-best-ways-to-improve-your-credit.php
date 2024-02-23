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
      <h3 class="mb-8">Best Ways to Improve Your Credit</h3>
      <div class="w-full mb-12 md:w-auto md:h-110 rounded-2xl overflow-hidden aspect-video">
        <iframe class="h-full w-full" src="https://www.youtube.com/embed/5M4FQOpLwUI" frameborder="0"></iframe>
      </div>
      <div class="post">
        <p>First-time home buyers can give their credit scores a boost before completing a mortgage application.</p>
        <p>Here are the best short-term and long-term strategies to improve your credit score.</p>
        <h2><span lang="EN">Short-Term</span></h2>
        <h4><strong>Check Your Credit Report for Errors</strong></h4>
        <p>Check your credit report for errors.</p>
        <p>Go to AnnualCreditReport.com and order one free copy of your credit report from each of the three credit bureaus: Experian, Equifax, and TransUnion.</p>
        <p>Check each report for errors. If you see an erroneous late or missed payment appear within all three bureaus, and you made that payment on time, contact the creditor and ask for a correction. If an erroneous late or missed payment appears with only one credit bureau, contact that bureau and ask them to correct it.</p>
        <p>Mistakes aren’t common, but they happen. Catching them and correcting can give your score an immeasurable boost.</p>
        <h4><strong>Settle Outstanding Debts in Collection</strong></h4>
        <p>Debts in collection hurt your credit score. If you have items in collection prior to your mortgage application, contact the collector and tell them you want to pay to delete the debt. Pay to delete means you pay what you owe to the collector, and the collector deletes the negative item from your credit report.</p>
        <p>Debts in collection can be negotiated. Ask for discounts for making a prompt payment.</p>
        <p>Also, keep all information from your call, including any agreed-upon negotiations. Request proof of payment and a “Pay for Delete” letter, if available. The letter is your evidence that the debt is paid off should the collector neglect to notify the bureaus.</p>
        <h4><strong>Don’t Acquire New Debt</strong></h4>
        <p>The simplest way to protect your credit score leading up to your mortgage application is to avoid taking on new credit. Postpone large purchases until after you buy, and don’t apply for new credit cards.</p>
        <h4><strong>Don’t Close Credit Accounts</strong></h4>
        <p>Another simple one!</p>
        <p>Your credit score is a formula based on your credit mix, your credit history length, and how much credit you have available to you. Time is your friend so don’t close your credit cards and accounts &#8211; even if they’re not in use.  Just by having them open, you give your scores a boost.</p>
        <h2>Long-Term Strategies<strong> </strong></h2>
        <h4><strong>Become an Authorized User</strong></h4>
        <p>Ask a family member with a good credit rating to add you as an authorized user on their credit card. You’ll get your own credit card to use, linked to their account, and when on-time payments get made, your credit score benefits.</p>
        <p>Don’t use this card to run up debt, though. That’ll hurt you both.</p>
        <h4><strong>Open a Credit Builder Account</strong></h4>
        <p>Credit Builder accounts are like credit cards, only you borrow from yourself.</p>
        <p>When you open a Credit Builder account, the creditor helps you move an amount of money into it &#8211; usually between $250-$500 &#8211; and issues you a credit card. Then, you use your Credit Builder credit card as you would an ordinary credit card &#8211; making purchases and paying it back each month, up to $500 in purchases. The company reports your payments to the credit bureaus each month, and your credit rating builds.</p>
        <h4><strong>Pay Your Bills On-Time</strong></h4>
        <p>It’s the obvious option, but it’s also the most important. How you pay your bills accounts for 35% of your credit score.</p>
        <p>Paying all of your bills, and paying them on time, is the best way to guarantee long term credit health.</p>
        <h4><strong>Pay Down Credit Card Debt</strong></h4>
        <p>Your credit utilization accounts for 30% of your credit score.</p>
        <p>Utilization looks at how much debt you have outstanding on a credit card or a loan, plus how that amount relates to an account’s maximum limit. For instance, if your credit limit is $5,000 and you owe $400, that will look better than if you owe $4,000. The less you owe, the better.</p>
        <p>Reducing your credit utilization can make your score skyrocket.</p>
      </div>
    </div>
  </div>
</div>
<?php
  $args = [ 'slug' => get_queried_object()->post_name ];
  get_footer(null, $args);
?>
