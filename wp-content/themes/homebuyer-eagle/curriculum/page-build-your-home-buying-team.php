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
      <h3 class="mb-8">Build Your Home Buying Team</h3>
      <div class="w-full mb-12 md:w-auto md:h-110 rounded-2xl overflow-hidden aspect-video">
        <iframe class="h-full w-full" src="https://www.youtube.com/embed/QPRWbjA3K0g" frameborder="0"></iframe>
      </div>
      <div class="post">
        <p>From today until the day you move in, remember this: you are not alone.</p>
        <p>Purchasing a home requires a team, and your team represents you and stands by your side.</p>
        <p>Your homebuying team consists of:</p>
        <ul>
          <li>Your mortgage expert</li>
          <li>Your real estate expert</li>
          <li>A home appraiser</li>
          <li>A home inspector</li>
          <li>A closing agent</li>
        </ul>
        <p>It’s okay if you don’t know who these people are, or what they’ll do for you yet. Soon, you will! These teammates support you, and they each have the same goal: To help you be happy, confident, and informed as you purchase your first home.</p>
        <p>When you have questions, call, text, or email the members of your team. Or, if you don’t have your team yet, call us. Our mortgage experts are no-pressure and are here to provide all of the information you need, on whatever timetable you prefer.</p>
      </div>
    </div>
  </div>
</div>
<?php
  $args = [ 'slug' => get_queried_object()->post_name ];
  get_footer(null, $args);
?>
