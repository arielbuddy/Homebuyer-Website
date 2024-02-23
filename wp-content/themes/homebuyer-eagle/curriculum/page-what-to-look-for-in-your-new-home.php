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
      <h3 class="mb-8">What to Look for in Your New Home</h3>
      <div class="w-full mb-12 md:w-auto md:h-110 rounded-2xl overflow-hidden aspect-video">
        <iframe class="h-full w-full" src="https://www.youtube.com/embed/TQqC3MK6AzU" frameborder="0"></iframe>
      </div>
      <div class="post">
        <p>With your pre-approval in hand, a target area picked out and a good idea of what you’re looking for, you’re ready to shop for a new home.</p>
        <p>However, shopping to buy a home is different from shopping to rent one. There are considerations you’ve never had to make.</p>
        <p>Let’s go over some things you’ll want to look for in your new home.</p>
        <ul>
        <li>How many bedrooms do you want? When you buy a home, envision your life a few years into the future. How many bedrooms might you need?</li>
        <li>How many bathrooms do you want? What is the minimum number of bathrooms you need for your home to feel comfortable to you, your family, and guests?</li>
        <li>How is the parking?If you drive regularly, do you need a garage for your care? Do you need a driveway? Is there street parking? How you park your car affects your auto insurance, so this is a cost question, too.</li>
        <li>Is there enough storage? Is there ample room for your belongings? Homeowners rarely complain about having too much space.</li>
        <li>Is the home energy-efficient:How well does the home retain and recycle energy? Is the home well-insulated? Do its windows leak? Does the home have a south-facing roof for solar panels?</li>
        <li>What’s the traffic like: Is it easy to get in/out of your neighborhood at different times of day? Is the area too sparse or congested for your liking?</li>
        <li>Is it too noisy for you? How much ambient noise can you hear near the home during daylight hours? What about during the evening? Is the home on an ambulance or fire truck route? Do airplanes fly low overhead?</li>
        <li>School District: Does the local school district get good marks?</li>
        </ul>
        <p>Much of this information is available online and you can narrow down your selection to a small series of homes. Then, an experienced real estate agent can help you identify which homes are newer, better equipped, or value-priced.</p>
      </div>
    </div>
  </div>
</div>
<?php
  $args = [ 'slug' => get_queried_object()->post_name ];
  get_footer(null, $args);
?>
