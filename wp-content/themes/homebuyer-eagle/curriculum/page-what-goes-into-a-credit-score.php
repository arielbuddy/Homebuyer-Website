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
      <h3 class="mb-8">What Goes Into a Credit Score?</h3>
      <div class="w-full mb-12 md:w-auto md:h-110 rounded-2xl overflow-hidden aspect-video">
        <iframe class="h-full w-full" src="https://www.youtube.com/embed/-_lGYYWY_Tk" frameborder="0"></iframe>
      </div>
      <div class="post">
        <p>Your credit score is one of the most important factors a lender considers. Your credit score is based on existing data about your accounts, and it’s helpful to understand what information is considered to ensure your credit score is at its maximum.</p>
        <p>Your lender accesses your credit score through a credit bureau. There are three major credit bureaus in the United States – Equifax, Experian, and Transunion. The bureaus keep tabs on all your accounts including credit cards, car loans, student loans, accounts turned over to collection agencies, plus any reported bankruptcies. Your score reflects how you pay off credit cards or loans and the balances on those accounts.</p>
        <p>When applying for a mortgage, your lender requests a tri-merge. A tri-merge is a combined report from the three credit bureaus, and it includes each bureau’s credit score.</p>
        <p>These scores, called FICO scores, are provided by the Fair Isaac Corporation (FICO), which developed the score in the 1980s to create a more standardized way to determine a prospective home buyer’s credit worthiness.</p>
        <p>Five factors are considered when creating the FICO score, and each is weighted differently:</p>
        <ul>
          <li aria-level="1">Payment History (35%) &#8211; How you pay your bills is especially important. The more on time you pay your bills, the better it is for your credit score.</li>
          <li aria-level="1">Amount You Owe (30%) &#8211; The score takes into account how much debt you have outstanding on a credit card or a loan, plus how that amount relates to an account’s maximum limit. For instance, if your credit limit is $5,000 and you owe $400, that will look better than if you owe $4,000.</li>
          <li aria-level="1">Length of Credit History (15%) &#8211; The longer you have had credit, the better. A more extended history gives the lender a much better picture of your credit experience.</li>
          <li aria-level="1">Variety of Credit (10%) &#8211; If your credit history reflects different kinds of credit accounts, it will look better and boost your credit score.</li>
          <li aria-level="1">New Credit (10%) &#8211; Acquiring too much new credit in the months leading up to your mortgage application may negatively affect score.</li>
        </ul>
        <p>Your credit score matters for your mortgage, and for other large purchases you make throughout life. To help you monitor your creditworthiness, you are entitled to one free copy of your credit report every 12 months from each of the three credit bureaus.</p>
        <p>If you have any questions, feel free to contact the mortgage experts at Homebuyer. We are ready to assist in any way we can.</p>
      </div>
    </div>
  </div>
</div>
<?php
  $args = [ 'slug' => get_queried_object()->post_name ];
  get_footer(null, $args);
?>
