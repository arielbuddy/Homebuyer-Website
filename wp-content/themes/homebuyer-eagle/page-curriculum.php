<?php

$links = [
  ['title' => 'Pre-House Hunting', 'url' => home_url() . '/curriculum/what-to-expect-when-buying-a-home'],
  ['title' => 'Cost of Homeownership', 'url' => home_url() . '/curriculum/calculate-what-you-can-afford'],
  ['title' => 'Getting Pre-Approved', 'url' => home_url() . '/curriculum/get-pre-approved-to-buy-a-home'],
  ['title' => 'Shop for Your New Home', 'url' => home_url() . '/curriculum/the-different-types-of-homes'],
  ['title' => 'Making an Offer', 'url' => home_url() . '/curriculum/the-elements-of-your-offer'],
  ['title' => 'Shop for Your Mortgage', 'url' => home_url() . '/curriculum/the-types-of-mortgage-loans'],
  ['title' => 'Professional Home Inspection', 'url' => home_url() . '/curriculum/why-home-inspections-are-important'],
  ['title' => 'The Mortgage Process', 'url' => home_url() . '/curriculum/home-appraisal'],
  ['title' => 'Closing on Your New Home', 'url' => home_url() . '/curriculum/do-a-final-walkthrough'],
  ['title' => 'Take the Quiz', 'url' => home_url() . '/curriculum/course-quiz'],
];

get_header();
?>
<div class="container md:pt-30 md:pb-24">
  <h1 class="mb-16 md:mb-12 text-center">
    Welcome to Homebuyer.com
  </h1>
  <div class="mb-20 md:mb-44 flex justify-center">
    <h4 class="text-brand-gray-dark">Everything you need to know when buying your first home, from start to finish.</h4>
  </div>
  <div class="flex flex-col md:flex-row gap-20 mb-20 md:mb-30">
    <div>
      <h3>The Homebuyer Curriculum</h3>
      <h4 class="mb-4">Becoming a better, smarter buyer</h4>
      <p>
        This is everything you need to know when buying your first home. We’ll cover the early
        steps of credit and pre-approval, all the way through closing and getting your keys. Start
        at the beginning and follow along our path to happy homebuying.
      </p>
    </div>
    <div>
      <div class="w-full md:w-140 mx-auto rounded-2xl overflow-hidden aspect-video">
        <iframe class="h-full w-full" src="https://www.youtube.com/embed/H4HtM5QwVDI" frameborder="0"></iframe>
      </div>
    </div>
  </div>
  <h3 class="mb-4 text-center">Available Units</h3>
  <p class="text-center">Start at the beginning and follow along to the end. Binge them all or spread them out. It's up to you!</p>
  <div class="mt-24 grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-12 md:gap-y-24">

    <?php foreach ($links as $link) { ?>

      <!-- Card
      ================================================== -->

      <div class="w-full h-90 bg-brand-white rounded-lg shadow overflow-hidden">
        <a href="<?php echo $link['url']; ?>" class="block h-2/3 px-6 bg-gradient-to-tr from-brand-purple from-40% to-brand-red flex justify-center items-center">
          <h3 class="text-center text-white"><?php echo $link['title']; ?></h3>
        </a>
        <div class="h-1/3 px-6 flex justify-center items-center">
          <a href="<?php echo $link['url']; ?>" class="btn-primary">
            <?php echo $link['title']; ?>
          </a>
        </div>
      </div>
    <?php } ?>

  </div>
  <div class="max-w-4xl md:mt-30 mx-auto shadow">
    <?php echo do_shortcode("[show_cta]"); ?>
  </div>
</div>
<?php
  $args = [ 'slug' => get_queried_object()->post_name ];
  get_footer(null, $args);
?>
