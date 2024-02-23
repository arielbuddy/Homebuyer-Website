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
      <h3 class="mb-8">Do a Final Walkthrough</h3>
      <div class="w-full mb-12 md:w-auto md:h-110 rounded-2xl overflow-hidden aspect-video">
        <iframe class="h-full w-full" src="https://www.youtube.com/embed/kEHvWMsWEog" frameborder="0"></iframe>
      </div>
      <div class="post">
        <p>When you’re close to the end of your journey to homeownership, it can be tempting to be laser-focused on closing day. But before you close, there’s one more thing you need to do&#8230; A final walkthrough of the home.</p>
        <p>You should do one last walkthrough in your new home before you close, preferably with your real estate agent, even if you’re 100 percent committed to the property.</p>
        <p>This time allows you to see the property empty if you haven’t had a chance to yet.</p>
        <p>If you requested any repairs, this is the time to check and make sure that the seller has made them.</p>
        <p>Tour the home, make sure the seller hasn’t left any belongings, and keep an eye out for pests.</p>
        <p>You may also want to double-check your home’s systems one final time to ensure everything is in working order.</p>
        <p>If everything looks good, it’s time for you to move toward closing day confidently.</p>
      </div>
    </div>
  </div>
</div>
<?php
  $args = [ 'slug' => get_queried_object()->post_name ];
  get_footer(null, $args);
?>
