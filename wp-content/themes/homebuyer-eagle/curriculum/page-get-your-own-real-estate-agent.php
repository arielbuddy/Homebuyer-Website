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
      <h3 class="mb-8">Get Your Own Real Estate Agent</h3>
      <div class="w-full mb-12 md:w-auto md:h-110 rounded-2xl overflow-hidden aspect-video">
        <iframe class="h-full w-full" src="https://www.youtube.com/embed/OIsanutPUio" frameborder="0"></iframe>
      </div>
      <div class="post">
        <p>Online house hunting is fun and an excellent way to assess what&#8217;s currently available on the market.</p>
        <p>But when you are ready to start seeing homes in person and thinking about making an offer, it&#8217;s time to find a real estate agent to represent you… Your own, exclusive real estate agent.</p>
        <p>There are essential benefits to having an agent who represents you exclusively.</p>
        <p>Sometimes a situation arises where a seller&#8217;s agent may offer to represent the buyer as well.</p>
        <p>This is called dual agency.</p>
        <h4><strong>Dual Agency</strong></h4>
        <p>Dual agency is when the same real estate agent represents both the buyer and the seller in a home purchase transaction. This can happen in many ways, but there are two primary situations:</p>
        <ol>
        <li>You decide to present an offer to a seller that your agent also represents, or</li>
        <li>An agent hosting an open house offers to represent you when you express an interest in putting an offer on the home.</li>
        </ol>
        <p>Dual agency may seem convenient in these situations, but it comes with significant risks.</p>
        <h4><strong>What are the Risks of Dual Agency?</strong></h4>
        <p>Dual agents are incentivized to favor the seller in the transaction. The higher the sales price, the more commission they make.</p>
        <p>Also, they aren&#8217;t legally allowed to disclose your information to the seller and vice versa. At first glance, the communication would seem more straightforward with a dual agent, but the expertise and advice they can provide to both of you is handcuffed.</p>
        <p>The resulting situation can be so poor that dual agency is illegal in eight states.</p>
        <h4><strong>Single Agency</strong></h4>
        <p>Single agency is when the buyer and seller each have their own real estate agent.</p>
        <p>Having two real estate experts representing the individual interests of each of their clients is almost always the best way to go. Making sure your agent only represents you will ensure they keep your interests paramount when reviewing inspections, negotiating concessions, and making a successful offer.</p>
        <p>Your Real Estate Agent is a crucial member of your home buying team, and making sure that they are only representing you will ensure that every member of that team is keeping you at the top of their priority list.</p>
      </div>
    </div>
  </div>
</div>
<?php
  $args = [ 'slug' => get_queried_object()->post_name ];
  get_footer(null, $args);
?>
