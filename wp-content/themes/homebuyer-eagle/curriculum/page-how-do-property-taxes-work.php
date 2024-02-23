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
      <h3 class="mb-8">How Do Property Taxes Work?</h3>
      <div class="w-full mb-12 md:w-auto md:h-110 rounded-2xl overflow-hidden aspect-video">
        <iframe class="h-full w-full" src="https://www.youtube.com/embed/GJhkcXrMrpA" frameborder="0"></iframe>
      </div>
      <div class="post">
        <p>Property taxes are the taxes you pay to your state, county, or local governments based on the value of the property you own.</p>
        <p>Let&#8217;s look at what makes up the tax rate and how you will pay these taxes when you buy a new home.</p>
        <h4><strong>What Services Are Covered by My Property Taxes?</strong></h4>
        <p>A property tax is made up of the total rate approved by voters for a variety of services in your region. It covers such things as the public school system, community colleges, park systems, social services, libraries, and municipal services, such as fire and police protection or road and bridge maintenance.</p>
        <p>Because voters must approve these taxes, there is a great variation in the property tax percentage from county to county across the country, and sometimes, from community to community within each county.</p>
        <h4><strong>How Can I Find Out What My Tax Rate Will Be?</strong></h4>
        <p>The best place to determine a specific tax rate is to check the county&#8217;s property tax website. You can also access a reliable property tax calculator, but it&#8217;s usually best to go straight to the source.</p>
        <p>You want to look for two main things: the assessed value of the property and the tax rate. The tax rate is usually listed as a percentage. When you multiply the percentage by your home&#8217;s assessed value, this gives you how much your yearly taxes will be.</p>
        <p>You will also want to research how often your county reassesses home values. Some counties do this every year. Others conduct reassessments at scheduled intervals, for instance, every five or ten years. It&#8217;s good to know how often your home may be reassessed because this could increase your taxes.</p>
        <h4><strong>How Do I Pay My Property Taxes?</strong></h4>
        <p>Most counties issue a tax bill to homeowners once or twice a year. For new homeowners, the payment of property taxes is typically managed by the lender.</p>
        <p>The lender will establish an escrow account when you acquire your mortgage. Your monthly mortgage payment will include funds to cover principal, interest, taxes, and homeowners&#8217; insurance. The monthly portion for the taxes and homeowners&#8217; insurance is kept in the lender&#8217;s escrow account. When the taxes and insurance come due, the lender receives the bill and makes the payment for you.</p>
        <p>The advantage to you is that you don&#8217;t need to make a large lump-sum payment for your taxes when they come due.</p>
        <p>Later, when your mortgage is paid off, you will pay your taxes and insurance directly.</p>
      </div>
    </div>
  </div>
</div>
<?php
  $args = [ 'slug' => get_queried_object()->post_name ];
  get_footer(null, $args);
?>
