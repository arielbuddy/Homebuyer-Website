<?php
  $units = [
    'Pre-House Hunting' => [
      'what-to-expect-when-buying-a-home' => 'What To Expect When Buying A Home',
      'home-ownership-vs-renting' => 'Home Ownership vs. Renting',
      'what-goes-into-a-credit-score' => 'What Goes Into A Credit Score?',
      'what-is-a-tradeline' => 'What is a Tradeline?',
      'best-ways-to-improve-your-credit' => 'Best Ways to Improve Your Credit',
      'budgeting-for-your-new-home' => 'Budgeting for Your New Home',
      'build-your-home-buying-team' => 'Build Your Home Buying Team',
    ],
    'Costs of Homeownership' => [
      'calculate-what-you-can-afford' => 'Calculate What You Can Afford',
      'how-much-down-payment-do-you-need' => 'How Much Down Payment Do You Need?',
      'hidden-costs-of-homeownership' => '“Hidden Costs” of Homeownership',
      'how-do-property-taxes-work' => 'How Do Property Taxes Work?',
      'calculate-what-you-want-to-afford' => 'Calculate What You Want to Afford',
    ],
    'Getting Pre-Approved' => [
      'get-pre-approved-to-buy-a-home' => 'Get Pre-Approved to Buy a Home',
      'your-pre-approval-letter' => 'Your Pre-Approval Letter',
      'refreshing-your-pre-approval' => 'Refreshing Your Pre-Approval',
    ],
    'Shop for Your New Home' => [
      'the-different-types-of-homes' => 'The Different Types of Homes',
      'different-styles-of-homes' => 'Different Styles of Homes',
      'what-to-look-for-in-your-new-home' => 'What to Look for in Your New Home',
      'what-is-homeowners-insurance' => 'What is Homeowners Insurance?',
      'move-in-ready-vs-fixer-upper' => 'Move-In-Ready vs. Fixer-Upper',
      'get-your-own-real-estate-agent' => 'Get Your Own Real Estate Agent',
    ],
    'Making an Offer' => [
      'the-elements-of-your-offer' => 'The Elements of Your Offer',
      'closing-costs-and-who-pays-them' => 'Closing Costs and Who Pays Them',
      'negotiate-your-purchase-agreement' => 'Negotiate Your Purchase Agreement',
      'what-to-do-when-your-offer-is-accepted-or-declined' => 'What to Do When Your Offer is Accepted or Declined',
      'moving-to-a-new-home' => 'Moving to a New Home',
    ],
    'Shop for Your Mortgage' => [
      'the-types-of-mortgage-loans' => 'The Types of Mortgage Loans',
      'fixed-rate-vs-adjustable-rate-mortgages' => 'Fixed Rate vs. Adjustable Rate Mortgages',
      'what-is-mortgage-insurance' => 'What is Mortgage Insurance?',
      'jump-start-the-mortgage-process' => 'Jump-Start the Mortgage Process',
    ],
    'Professional Home Inspection' => [
      'why-home-inspections-are-important' => 'Why Home Inspections are Important',
    ],
    'The Mortgage Process' => [
      'home-appraisal' => 'Home Appraisal',
      'renegotiating-after-a-home-appraisal' => 'Renegotiating after a home appraisal',
      'complete-your-mortgage-checklist' => 'Complete Your Mortgage Checklist',
      'what-to-do-when-your-loan-is-approved' => 'What to do When Your Loan is Approved',
    ],
    'Closing on Your New Home' => [
      'do-a-final-walkthrough' => 'Do a Final Walkthrough',
      'attend-your-loan-closing-and-settlement' => 'Attend Your Loan Closing and Settlement',
      'course-quiz' => 'Course Quiz',
    ],
  ];

  [ 'slug' => $current ] = $args;
?>
<div>
  <h4 class="mb-4">Curriculum Outline</h4>
  <p class="mb-4">
    <a class="no-underline" href="<?php echo home_url(); ?>/curriculum">Overview</a>
  </p>
  <?php
    foreach ($units as $unit => $lessons) {
      echo "<p class=\"my-4\">\n";
      echo "  <strong class=\"mb-4 text-brand-gray-dark\">$unit</strong>\n";
      echo "</p>\n";
      echo "<ul>\n";

      foreach ($lessons as $slug => $title) {
        $isActive = $slug === $current ? 'bg-brand-gray-light' : 'hover:text-brand-purple-dark';
        echo "<li class=\"border-l-2 border-brand-red border-solid\">\n";
        echo "  <a class=\"block px-4 leading-snug py-1.5 text-brand-purple $isActive\" href=\"" . home_url() . "/curriculum/$slug\">\n";
        echo "    $title\n";
        echo "  </a>\n";
        echo "</li>\n";
      }

      echo "</ul>\n";
    }
  ?>
</div>
