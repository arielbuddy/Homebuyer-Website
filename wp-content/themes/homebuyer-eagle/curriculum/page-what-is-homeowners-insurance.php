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
      <h3 class="mb-8">What is Homeowners Insurance?</h3>
      <div class="w-full mb-12 md:w-auto md:h-110 rounded-2xl overflow-hidden aspect-video">
        <iframe class="h-full w-full" src="https://www.youtube.com/embed/ZVX_XQIPBAw" frameborder="0"></iframe>
      </div>
      <div class="post">
        <p>Homeowner’s insurance is a lot like car insurance.</p>
        <p>When you get a mortgage loan, you’ll need to purchase a homeowner’s insurance policy before closing, much like full-coverage auto insurance is required when you get a car loan.</p>
        <p>It covers you against damage to the home, loss or damage of personal belongings, and even injury on the property.</p>
        <p>Insurance premiums are billed every six or twelve months, but most first-time buyers have an escrow account with their loan. Your lender will collect insurance and tax payments as part of your monthly housing payment with an escrow account, so you don’t have to pay these as a lump-sum.</p>
        <p>Since you need proof of homeowner’s insurance before closing, it’s important to begin shopping for a policy soon after your offer is accepted.</p>
        <h4><strong>What Is Covered by Homeowner’s Insurance?</strong></h4>
        <p>There are three primary coverage areas in a typical homeowner’s insurance policy: dwelling, personal property, and liability.</p>
        <p>Dwelling coverage includes protection for your house, garage, sheds, fences, and other structures.</p>
        <p>Personal property coverage, sometimes called contents coverage, provides insurance for damage to, or theft of, your possessions.</p>
        <p>Liability coverage provides protection for injuries that happens on the property.</p>
        <p>Your insurance policy will have a liability limit or a maximum dollar amount the insurance will pay on a claim. $100,000 is the typical limit, but you can request a higher amount if you feel it is needed.</p>
        <h4><strong>What Is Not Covered?</strong></h4>
        <p>Although a homeowner’s insurance policy typically covers natural disasters, earthquakes and floods usually are not.</p>
        <p>If your home is located in an earthquake-prone area or a flood zone, you may need to add these additional policies. Your mortgage expert can help with determining this.</p>
        <p>Expensive personal items such as jewelry, antiques, or fine art may not be covered either. If you own unique items such as these, make sure you ask the insurance company if they’re included or if you will need to purchase additional coverage.</p>
        <h4><strong>Understanding Your Coverage</strong></h4>
        <p>Not all policies offer the same level of protection. The insurance cost will depend on the amount of coverage and the size of the deductible you choose.</p>
        <p>Make sure you get a few different quotes to compare, so you can get the coverage you need at the best price. And remember to read the fine print.</p>
      </div>
    </div>
  </div>
</div>
<?php
  $args = [ 'slug' => get_queried_object()->post_name ];
  get_footer(null, $args);
?>
