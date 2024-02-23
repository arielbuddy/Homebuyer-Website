<?php get_header(); ?>
<div class="relative bg-gradient-to-r from-brand-purple from-20% to-brand-purple-dark">
  <div class="container md:pt-30">
    <div class="flex flex-col md:flex-row gap-11 mb-20 md:mb-30 z-0">
      <div class="flex-[1.75_1_0%]">
        <h1 class="text-white mb-2">The Homebuyer.com Education Course</h1>
        <h4 class="text-white mb-8">Be A Better, Smarter Home Buyer</h4>
        <ul>
          <li class="flex text-white text-lg">
            <span class="mdi mdi-chevron-right"></span>Free lessons for first-time home buyers
          </li>
          <li class="flex text-white text-lg">
            <span class="mdi mdi-chevron-right"></span>Online course to learn at your own pace
          </li>
          <li class="flex text-white text-lg">
            <span class="mdi mdi-chevron-right"></span>Accessible video and written lessons
          </li>
          <li class="flex text-white text-lg">
            <span class="mdi mdi-chevron-right"></span>Lessons on everything from budgeting and approval to closing on your home
          </li>
        </ul>
      </div>
      <div class="flex-1 p-5 bg-white rounded-lg z-20">
        <?php echo do_shortcode( '[activecampaign form=5 css=1]' ); ?>
      </div>
    </div>
  </div>
  <div class="hidden md:block absolute bottom-0 right-0 z-10">
    <img class="object-cover" src="<?php echo get_template_directory_uri(); ?>/images/art/book-as-house.png" alt="Book as house">
  </div>
</div>
<div class="w-full post">
  <div class="max-w-screen-xl mx-auto px-6 py-12 md:px-60 md:py-24">
    <h2>What Is Homebuyer Education?</h2>
    <p>
      Our Homebuyer education course provides a home buying timeline with advice for each step of
      the journey so you feel <a href="<?php echo home_url();
      ?>/learn/positive-home-buying-experience">confident buying</a> your first home.
    </p>
    <p>
      Homebuyer.com’s curriculum is designed to help you understand the mortgage and buying process
      so you can make better, smarter home buying decisions.
    </p>
    <h3>Homebuyer Curriculum</h3>
    <p>Here’s every phase covered in our first-time home buyer education class:</p>
    <ul>
      <li>Pre-house Hunting</li>
      <li>Costs of Homeownership</li>
      <li>Getting Pre-approved</li>
      <li>Shopping for Your New Home</li>
      <li>Making an Offer</li>
      <li>Shopping for Your Mortgage</li>
      <li>Getting a Home Inspection</li>
      <li>Getting a Mortgage</li>
      <li>Closing on Your New Home</li>
    </ul>
    <p>Homebuyer experts are here to assist you with every step of your home buying journey.</p>
    <h2>How Much Do Home Buyer Education Classes Cost?</h2>
    <p>
      Homebuyer.com’s online course is free for everyone interested in learning about home buying.
      Our online registration never expires, so you can study on your schedule.
    </p>
    <p>
      Other home buyer education courses may cost between $75-$125. These classes are available
      online and in person, depending on your course provider.
    </p>
    <h2>How Long Is Home Buyer Education?</h2>
    <p>
      HUD-certified courses are eight hours long, and most home buyer education classes last between
      five and eight hours.
    </p>
    <p>
      Homebuyer.com’s online course allows you to learn at your own pace without specified class
      time. If you choose to complete your lesson all at once, you can finish the course in under
      two hours.
    </p>
    <h2>Why Trust Homebuyer.com for Your Home Buyer Education?</h2>
    <p>
      Homebuyer has over 15 years of experience in the mortgage industry, and we exclusively lend to
      <a href="<?php echo home_url(); ?>/learn/first-time-home-buyer">first-time buyers</a>. We’re
      experts at navigating the home buying process from the first-time buyer’s perspective.
    </p>
    <p>
      Our mission is to make homeownership inclusive, accessible, and simple.
    </p>
    <p>
      That’s why we offer personalized advice 24/7 through our online chat box and by phone, plus
      online pre-approval within minutes when you’re ready to buy.
    </p>
    <h2>When Is the Best Time To Enroll in Home Buyer Education Classes?</h2>
    <p>
      The best time to enroll in home buyer education is when you decide you’d like to become a
      homeowner. Whether that’s in six months or six years, Homebuyer.com is here when you’re ready
      to start shopping.
    </p>
    <p>
      Completing your course before pre-approval will help you confidently understand the home
      buying and mortgage processes from start to finish. Some home buyer education programs can
      unlock additional benefits, like down payment assistance, which will require course completion
      before approval.
    </p>
    <p>
      Homebuyer.com is the expert lender for first-time buyers. We’re dedicated to making
      homeownership accessible for everyone, and our Homebuyer education course prioritizes what
      first-time buyers need to know.
    </p>
    <p>
      If you want to own your own home someday, we’re here to help make it happen. Register to learn
      more about home buying, get pre-approved when you’re ready to shop, and chat with us anytime
      you have a question.
    </p>
    <p>Happy Homebuying!</p>
  </div>
</div>
<div class="w-full bg-gradient-to-b from-brand-red-light to-brand-blue-light md:bg-gradient-to-r">
  <div class="max-w-2xl mx-auto h-full px-6 py-12 bg-white shadow rounded-lg flex flex-col items-center md:relative md:top-8">
    <img class="mb-4 w-56" src="<?php echo get_template_directory_uri(); ?>/images/homebuyer-logo.png" alt="Homebuyer.com logo">
    <?php echo do_shortcode( '[activecampaign form=5 css=1]' ); ?>
  </div>
</div>
<?php
  $args = [ 'slug' => get_queried_object()->post_name ];
  get_footer(null, $args);
?>
