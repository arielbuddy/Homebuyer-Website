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
      <h3 class="mb-8">Home Ownership vs. Renting</h3>
      <div class="w-full mb-12 md:w-auto md:h-110 rounded-2xl overflow-hidden aspect-video">
        <iframe class="h-full w-full" src="https://www.youtube.com/embed/GXTOs5OlJTE" frameborder="0"></iframe>
      </div>
      <div class="post">
        <p>Renters give a lot of reasons why they want to stop renting and start owning. Some dream of future possibilities, and others want stability.</p>
        <p>We&#8217;ve grouped what renters say into categories.</p>
        <h4><strong>Owning a home is stable</strong></h4>
        <p>When you rent, you can move as often as you like, to anywhere in the world you want. By design, you have no roots, which is freeing to some people.</p>
        <p>But you&#8217;re also at the mercy of your landlord and forfeit control. You don&#8217;t control your rent, you don&#8217;t control your lease, and you don&#8217;t control your home. You can&#8217;t make improvements. You can&#8217;t plan ahead.</p>
        <p>Renters extol the virtues of being flexible &#8211; but they&#8217;re also forced to be that way.</p>
        <p>Homeowners experience the opposite.</p>
        <p>When you own a home, your housing and your life get stable. You know what your monthly payment will be, and know it won&#8217;t go up. You know where you&#8217;ll live for the next few years, and know that you won&#8217;t get kicked out with just 30 days&#8217; notice.</p>
        <p>When you own a home, you can paint your walls and hang up art. You can build and improve however you want.</p>
        <p>For some people, the freedom to makes choices is more freeing than renting can ever be. Maybe this describes you.</p>
        <h4><b>Owning a Home Builds Wealth</b></h4>
        <p>Owning a home is a reliable means to build generational wealth.</p>
        <p>Consider this: Over the last 100 hundred years, the value of U.S. real estate is up 3.2 percent per year, on average. Because of compounding interest, then, a homeowner with a 10-year horizon might expect a 37% gain before it&#8217;s time to sell.</p>
        <p>Renters don&#8217;t get that same money.</p>
        <p>Real estate&#8217;s power as a wealth-building tool is undeniable. For many people, owning a home begins a pathway to a secure retirement. Real estate builds net worth that benefits future generations.</p>
        <h4><b>Owning A Home Creates Pride</b></h4>
        <p>There&#8217;s a pride that comes with buying your first home. Buying your first home is an important life milestone, and 90% of homeowners believe homeownership is part of the American Dream.</p>
        <p>Data supports the assertion.</p>
        <p>According to the National Association of REALTORS®, 51% of first-time home buyers said they bought their first home to satisfy a desire to stop renting and start owning. The next most popular reason &#8211; &#8220;a desire for more space&#8221; &#8211; garnered just nine percent of the vote.</p>
        <p>It&#8217;s no surprise that homeownership draws in renters. When you own a home, you live a stable life with independence. You&#8217;re part of a community and get to build roots in a neighborhood. You control your future and your household wealth.</p>
      </div>
    </div>
  </div>
</div>
<?php
  $args = [ 'slug' => get_queried_object()->post_name ];
  get_footer(null, $args);
?>
