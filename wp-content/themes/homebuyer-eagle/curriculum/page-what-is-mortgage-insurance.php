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
      <h3 class="mb-8">What is Mortgage Insurance?</h3>
      <div class="w-full mb-12 md:w-auto md:h-110 rounded-2xl overflow-hidden aspect-video">
        <iframe class="h-full w-full" src="https://www.youtube.com/embed/yW53cwgtzDA" frameborder="0"></iframe>
      </div>
      <div class="post">
        <p>When you think of paying for insurance in the context of buying a home, you might think of Homeowner&#8217;s Insurance. However, a different kind of insurance is also at play.</p>
        <p>Mortgage Insurance is a tool that protects lenders. It may seem a bit odd at face value, but it&#8217;s a fantastic thing that allows you to maximize your buying power and achieve your goal of homeownership sooner than you may have thought.</p>
        <p>When you get a mortgage loan to purchase a home, there is typically a down payment involved. And when a lender gives a mortgage loan, this down payment is essential to them.</p>
        <p>The chance that someone will stop making mortgage payments presents a level of risk to a mortgage lender. Based on existing mortgage data, the more down payment a homebuyer gives, the less likely they are to stop making their mortgage payment.</p>
        <p>When lenders look at this risk, there&#8217;s something of a magic number they come to. When a homebuyer makes at least a 20 percent down payment, it&#8217;s viewed as an &#8220;acceptable risk.&#8221; At this point, you can get pretty much any loan you want.</p>
        <p>But what about people who can&#8217;t come up with 20 percent down?</p>
        <p>That&#8217;s where Mortgage Insurance saves the day.</p>
        <p>For this reason, Mortgage Insurance is required for all Conventional loans with a down payment of less than 20%. The insurance protects the lender against loss, just in case something unexpected happens. In return, you get a loan with far less money down than would otherwise be required.</p>
        <p>This rule is not specific to Conventional loans, either. Government-backed loans, like FHA and VA mortgages, have this same calculation baked into the package. All FHA loans have mortgage insurance requirements, regardless of LTV. They refer to it as a &#8220;mortgage insurance premium&#8221; (MIP). VA loans do the same thing, but they call it a &#8220;guarantee fee.&#8221;</p>
        <p>It&#8217;s all part of the same risk reduction strategy that gives buyers access to loans with as little money out of pocket as possible.</p>
        <p>Many people can&#8217;t, or don&#8217;t want to, put 20 percent down. That can add up to a lot of money! But just because that means higher risk to a mortgage lender does not mean it should keep you from reaping the benefits of homeownership.</p>
        <p>When you pay Mortgage Insurance, you can buy a home with as little as 3% down &#8211; sometimes even less.</p>
      </div>
    </div>
  </div>
</div>
<?php
  $args = [ 'slug' => get_queried_object()->post_name ];
  get_footer(null, $args);
?>
