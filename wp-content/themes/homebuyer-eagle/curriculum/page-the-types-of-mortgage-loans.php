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
      <h3 class="mb-8">The Types of Mortgage Loans</h3>
      <div class="w-full mb-12 md:w-auto md:h-110 rounded-2xl overflow-hidden aspect-video">
        <iframe class="h-full w-full" src="https://www.youtube.com/embed/LeQrgz0ie3o" frameborder="0"></iframe>
      </div>
      <div class="post">
        <p>A variety of mortgage loans are available, all with different down payment and eligibility requirements:</p>
        <ul>
        <li>Conventional mortgages are an industry standard. Some conventional loans are built specifically for first-time homebuyers and require as little as 3% down payment.</li>
        <li>FHA loans are insured by the Federal Housing Administration and require as little as 3.5% down payment.</li>
        <li>VA loans are guaranteed by the Department of Veterans Affairs. These loans are for current and veteran military service members and provide options to purchase a home with no down payment at all.</li>
        <li>USDA loans are guaranteed by the U.S. Department of Agriculture. Most people don’t think about loans when they hear the term “USDA,” but these programs provide options to purchase homes in rural areas with no down payment.</li>
        </ul>
        <p>There are even more options available, but these four are used for the vast majority of home purchases.</p>
        <p>This step is where your trusted mortgage lender will shine. Connect with them early and contact them often. Mortgages can be confusing, so be sure to team up with a lender willing to educate you every step of the way.</p>
      </div>
    </div>
  </div>
</div>
<?php
  $args = [ 'slug' => get_queried_object()->post_name ];
  get_footer(null, $args);
?>
