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
      <h3 class="mb-8">The Different Types of Homes</h3>
      <div class="w-full mb-12 md:w-auto md:h-110 rounded-2xl overflow-hidden aspect-video">
        <iframe class="h-full w-full" src="https://www.youtube.com/embed/jQnTE047S6g" frameborder="0"></iframe>
      </div>
      <div class="post">
        <p>The first decision you’ll make when you start house hunting is what type of home you want to hunt for.</p>
        <p>There are four main types: single-family residence (SFR), condominium, townhome, and multi-unit property.</p>
        <p>Let’s review them.</p>
        <h4><strong>Single Family Residence</strong></h4>
        <p>Single-family homes, also referred to as single-family residences or SFRs, are the most common option among home buyers.</p>
        <p>A single-family residence is a standalone home intended for one family to live in, located on a piece of land. When you buy the home, you also purchase the land the home is built on. This gives you the classic front and back yard situation.</p>
        <p>If you’ve ever seen imagery of that storybook-looking house with the white picket fence, that’s a single-family home.</p>
        <h4><strong>Condominium</strong></h4>
        <p>A condominium, or condo, is a living unit within a larger building or complex. In many ways, it is similar to an apartment, except you own the unit you live in.</p>
        <p>The outside walls, landscaping, and common areas within the building – such as fitness areas, party rooms, hallways, and elevators – are collectively owned by the building’s residents.</p>
        <p>Because the common areas must be maintained, condo ownership comes with a monthly homeowner’s association (HOA) fee. You pay these dues to the HOA, which uses the money to manage and maintain the complex for you.</p>
        <h4><strong>Townhome</strong></h4>
        <p>Townhomes, like condos, are part of a planned community with common areas and a homeowner’s association.</p>
        <p>The big difference is that a townhome is typically only attached to another unit on one or two sides, with no units above or below.</p>
        <p>One bonus of a townhome is that it may include some personal outdoor space, such as a small patio, a front porch, or a yard. Like condos, the HOA will manage the exterior maintenance and landscaping outside of your personal space.</p>
        <h4><strong>Multi-Unit Property</strong></h4>
        <p>Multi-unit, or multi-family, properties have more than one unit built on a piece of land.</p>
        <p>Much like a single-family home, you buy both the land and the home. Only this time you’d buying two, three, or four units to live in one and rent out the others.</p>
        <p>Owning a multi-unit property as a first-time homebuyer is unconventional, and it’s a lot to take on, but it could be a fantastic investment opportunity.</p>
        <p>If you want your first home to make you both a homeowner and a landlord, this is the option for you.</p>
      </div>
    </div>
  </div>
</div>
<?php
  $args = [ 'slug' => get_queried_object()->post_name ];
  get_footer(null, $args);
?>
