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
      <h3 class="mb-8">“Hidden Costs” of Homeownership</h3>
      <div class="w-full mb-12 md:w-auto md:h-110 rounded-2xl overflow-hidden aspect-video">
        <iframe class="h-full w-full" src="https://www.youtube.com/embed/aRrv4P2u_Fw" frameborder="0"></iframe>
      </div>
      <div class="post">
        <p>When first-time home buyers think about the costs of owning a home, they tend to think of their mortgage and its monthly cost. However, owning a home costs more than just your monthly mortgage.</p>
        <p>As a homeowner, here are the other monthly costs you’ll want to build into your budget.</p>
        <p>Taxes, Insurance, and HOA Fees</p>
        <p>When you own a home, your monthly housing payment consists of four parts:</p>
        <ol>
        <li>The principal payback on your home loan</li>
        <li>The interest payment on your home loan</li>
        <li>The real estate taxes due to your local government</li>
        <li>The insurance payments for your home</li>
        </ol>
        <p>The principal + interest portion is your mortgage payment. It’s based on the size of your loan and your mortgage rate. However, the taxes and insurance portion is calculated separately.</p>
        <p>Your real estate taxes are property-specific. Every home has its own tax bill, which varies from 0.5% to 2.5% of the home’s value, depending on local ordinance. Most homeowners will pay their real estate taxes as part of their monthly payment.</p>
        <p>Same for insurance bills.</p>
        <p>Homeowners insurance is required when you own a home with a mortgage, and insurance premiums are often added to your payment monthly. You may also pay flood insurance, or earthquake insurance, or mortgage insurance as a homeowner. These costs are included within your monthly insurance payments, too.</p>
        <p>Lastly, homeowners who live in planned communities or condominium buildings should budget for annual dues. Homeowners association (HOA) dues vary by community and are paid to the association management monthly, quarterly, or annually.<strong> </strong></p>
        <h4><strong>Utilities</strong></h4>
        <p>When you own your own home, you’re responsible for utility costs. This may include monthly bills for:</p>
        <ul>
        <li>Electricity</li>
        <li>Gas</li>
        <li>Water and sewage</li>
        <li>Trash collection</li>
        <li>Internet services</li>
        </ul>
        <p>Utility bills vary by household. For example, homeowners with energy-efficient homes pay less for gas and electricity as compared to homeowners in non-efficient homes; and water and sewage bills vary based on consumption.</p>
        <p>Trash collection services are generally a fixed fee.</p>
        <p>As you shop for a new home, research what’s common for where you want to live. Many home sellers can provide this information, as well.</p>
        <h4><strong>Minor and Major Home Renovation</strong></h4>
        <p>As a homeowner, you manage your own property. So, when you want to make improvements or when something in your new home breaks, you are responsible for the work.</p>
        <p>Renovations and repairs add costs to your home ownership.</p>
        <p>Updating paint and lighting is typically inexpensive. Repairing a major appliance is not. Heating, ventilation, and air conditioning (HVAC) systems and water heaters can cost a thousand dollars or more, and replacing stoves, dishwashers, and refrigerators can be similarly expensive. Before you buy, use a home inspection to get a feel for the remaining life in your home’s major and minor appliances.</p>
        <h4><strong>Landscaping and Curb Appeal</strong></h4>
        <p>With the exception of condo owners, when you own a home, you own its grounds and exterior, too. This means that your responsibilities as a homeowner extend to lawn care, snow removal, and tree maintenance. You may have occasional painting and gutter repair costs. Some of these costs are recurring and can be built into a budget. Plan ahead, where possible.</p>
      </div>
    </div>
  </div>
</div>
<?php
  $args = [ 'slug' => get_queried_object()->post_name ];
  get_footer(null, $args);
?>
