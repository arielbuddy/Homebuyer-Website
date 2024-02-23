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
      <h3 class="mb-8">Course Quiz</h3>
      <!--<div class="w-full mb-12 md:w-auto md:h-110 rounded-2xl overflow-hidden aspect-video">
        <iframe class="h-full w-full" src="https://www.youtube.com/embed/Oq7mISJOQuY" frameborder="0"></iframe>
      </div>-->
      <div class="post">
        <h4><strong>What is the third step on the path to homeownership?</strong></h4>
        <ol>
        <li>Calculating What You Can Afford</li>
        <li>Shopping for Your Mortgage Loan</li>
        <li>Getting Pre-Approved for Your Mortgage</li>
        <li>Shopping for Your New Home</li>
        </ol>
        <h4><strong>Homeownership is the most reliable way to build generational wealth.</strong></h4>
        <ol>
        <li>True</li>
        <li>False</li>
        </ol>
        <h4><strong>What is the most important factor for your credit score?</strong></h4>
        <ol>
        <li>Amount You Owe</li>
        <li>Payment History</li>
        <li>New Credit</li>
        <li>Length of Credit History</li>
        <li>Variety of Credit</li>
        </ol>
        <h4><strong>What are the two types of credit tradelines?</strong></h4>
        <ol>
        <li>Credit Card and Installment</li>
        <li>Revolving and Mortgage Loan</li>
        <li>Personal Loan and Business Loan</li>
        <li>Revolving and Installment</li>
        </ol>
        <h4><strong>What is a short-term way to improve your credit?</strong></h4>
        <ol>
        <li>Pay Your Bills On-Time</li>
        <li>Check Your Credit Report for Errors</li>
        <li>Open a Credit Builder Account</li>
        <li>Become an Authorized User</li>
        </ol>
        <h4><strong>When calculating your budget, what income number should you use?</strong></h4>
        <ol>
        <li>Pre-Tax Income (Gross)</li>
        <li>Post-Tax Income (Net)</li>
        </ol>
        <h4><strong>When approving you for a mortgage, what income number does the lender use?</strong></h4>
        <ol>
        <li>Pre-Tax Income (Gross)</li>
        <li>Post-Tax Income (Net)</li>
        </ol>
        <h4><strong>What is the minimum down payment for a Conventional loan?</strong></h4>
        <ol>
        <li>0%</li>
        <li>3%</li>
        <li>3.5%</li>
        <li>20%</li>
        </ol>
        <h4><strong>Which of the following is a utility payment that homeowners do not need to pay?</strong></h4>
        <ol>
        <li>Gas</li>
        <li>Electricity</li>
        <li>Water</li>
        <li>Trash</li>
        <li>Homeowners pay for all of these</li>
        </ol>
        <h4><strong>Where can you find out what your property taxes will be?</strong></h4>
        <ol>
        <li>County Property Tax Website</li>
        <li>Your Lender Tells You</li>
        <li>Google Search the Zip Code and the Term &#8216;Property Tax&#8217;</li>
        </ol>
        <h4><strong>The maximum monthly payment you&#8217;re approved for will always fit within your budget.</strong></h4>
        <ol>
        <li>True</li>
        <li>False</li>
        </ol>
        <h4><strong>Getting a mortgage pre-approval is necessary prior to submitting an offer on a house.</strong></h4>
        <ol>
        <li>True</li>
        <li>False</li>
        </ol>
        <h4><strong>Home sellers often accept offers from buyers who are not pre-approved for a mortgage.</strong></h4>
        <ol>
        <li>True</li>
        <li>False</li>
        </ol>
        <h4><strong>How long is your mortgage pre-approval good for, before it needs to be refreshed?</strong></h4>
        <ol>
        <li>30 Days</li>
        <li>60 Days</li>
        <li>90 Days</li>
        <li>120 Days</li>
        </ol>
        <h4><strong>What is the most common type of home?</strong></h4>
        <ol>
        <li>Single Family Residence</li>
        <li>Condo</li>
        <li>Townhome</li>
        <li>Multi-Unit Property</li>
        </ol>
        <h4><strong>What should you consider when shopping for a new home?</strong></h4>
        <ol>
        <li>Number of Bedrooms</li>
        <li>Number of Bathrooms</li>
        <li>Traffic and Parking</li>
        <li>Storage</li>
        <li>All of the Above</li>
        </ol>
        <h4><strong>Which of the following is not covered under a Homeowner&#8217;s Insurance policy?</strong></h4>
        <ol>
        <li>Damage to Personal Property</li>
        <li>Theft of Personal Property</li>
        <li>Damage Caused by Floods</li>
        <li>Injuries That Happen on the Property</li>
        </ol>
        <h4><strong>Which type of home offers more equity building potential?</strong></h4>
        <ol>
        <li>Move-In-Ready</li>
        <li>Fixer-Upper</li>
        </ol>
        <h4><strong>Is Dual Agency good for a home buyer?</strong></h4>
        <ol>
        <li>Yes</li>
        <li>No</li>
        </ol>
        <h4><strong>Which of the following is not a common contingency found on a purchase offer?</strong></h4>
        <ol>
        <li>Appraisal Contingency</li>
        <li>Closing Cost Contingency</li>
        <li>Financing Contingency</li>
        <li>Home Inspection Contingency</li>
        </ol>
        <h4><strong>If agreed upon, the seller is allowed to pay the buyers closing costs.</strong></h4>
        <ol>
        <li>True</li>
        <li>False</li>
        </ol>
        <h4><strong>Who is the best person to help you negotiate your purchase agreement?</strong></h4>
        <ol>
        <li>Mortgage Expert</li>
        <li>Trusted Family Members</li>
        <li>Home Inspector</li>
        <li>Real Estate Agent</li>
        </ol>
        <h4><strong>What type of mortgage loan is the industry standard, and most commonly used among first-time buyers?</strong></h4>
        <ol>
        <li>Conventional</li>
        <li>FHA</li>
        <li>VA</li>
        <li>USDA</li>
        </ol>
        <h4><strong>What is the most popular loan term and interest rate type?</strong></h4>
        <ol>
        <li>15 Year Fixed Rate</li>
        <li>15 Year Adjustable Rate</li>
        <li>30 Year Fixed Rate</li>
        <li>30 Year Adjustable Rate</li>
        </ol>
        <h4><strong>Mortgage Insurance protects _______ and is an incredible tool that allows lower down payment requirements.</strong></h4>
        <ol>
        <li>the buyer</li>
        <li>the lender</li>
        </ol>
        <h4><strong>You should get a professional home inspection prior to closing.</strong></h4>
        <ol>
        <li>True</li>
        <li>False</li>
        </ol>
        <h4><strong>A home appraisal and a home inspection are very similar.</strong></h4>
        <ol>
        <li>True</li>
        <li>False</li>
        </ol>
        <h4><strong>What is a good reason to re-negotiate your purchase agreement?</strong></h4>
        <ol>
        <li>You changed your mind about the neighborhood</li>
        <li>You decided the kitchen would need a remodel</li>
        <li>The appraised value came in lower than expected</li>
        </ol>
        <h4><strong>The faster you complete your mortgage checklist, the faster the lender can get your loan to final approval.</strong></h4>
        <ol>
        <li>True</li>
        <li>False</li>
        </ol>
        <h4><strong>What is one important thing you must do after your mortgage is approved?</strong></h4>
        <ol>
        <li>Start buying things for the new house</li>
        <li>Get your homeowner&#8217;s insurance policy</li>
        <li>Make the rest of your moving arrangements</li>
        <li>Get a change of address form from the post office</li>
        </ol>
        <h4><strong>You should always do a final walkthrough with your real estate agent prior to closing.</strong></h4>
        <ol>
        <li>True</li>
        <li>False</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<?php
  $args = [ 'slug' => get_queried_object()->post_name ];
  get_footer(null, $args);
?>
