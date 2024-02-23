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
      <h3 class="mb-8">Refreshing Your Pre-Approval</h3>
      <div class="w-full mb-12 md:w-auto md:h-110 rounded-2xl overflow-hidden aspect-video">
        <iframe class="h-full w-full" src="https://www.youtube.com/embed/-k0SU655ehg" frameborder="0"></iframe>
      </div>
      <div class="post">
        <p>Receiving your mortgage pre-approval is a huge step! Just remember that it’s not good forever.</p>
        <p>To get your pre-approval, you complete a questionnaire and provide documentation, such as income statements, tax forms, assets, and your lender checks your credit. This basic information is used to measure your ability to make mortgage payments and determine the size of the loan you qualify for.</p>
        <p>This information is ever-changing and gets updated month-to-month. This is why mortgage pre-approvals are typically good for 90 days.</p>
        <h4><strong>Financial Changes That Can Affect Your Status</strong></h4>
        <p>There are several changes in information that can affect your mortgage pre-approval status, including the following:</p>
        <ul>
        <li>Interest rates may have gone up or down</li>
        <li>Your credit score is updated monthly and may reflect larger or smaller credit card balances</li>
        <li>You may have added to your savings account</li>
        <li>A major purchase, such as a car, could have affected your credit score</li>
        <li>Your work arrangement may have changed, such as a job change or a promotion</li>
        </ul>
        <p>All these things could affect your maximum purchase price, positively or negatively.</p>
        <h4><strong>Refreshing Your Mortgage Pre-Approval Letter</strong></h4>
        <p>If you haven’t found the perfect home yet, and you’re coming up on that 90-day expiration date, it’s time to contact your lender and request a refresh.</p>
        <p>You will provide updated documentation, and the lender refreshes your credit report. After reviewing the new information, the lender will let you know if there are positive, negative, or possibly no changes at all. They will then reissue a new mortgage pre-approval letter, extending the expiration date another 90 days.</p>
      </div>
    </div>
  </div>
</div>
<?php
  $args = [ 'slug' => get_queried_object()->post_name ];
  get_footer(null, $args);
?>
