<?php
date_default_timezone_set('America/New_York');
$currentTime = strtotime('now');
$targetTimeToday = strtotime('today 10:00 AM');
$targetTimeYesterday = strtotime('yesterday 10:00 AM');
if ($currentTime >= $targetTimeToday) {
  $dateTime = date('F j, Y', $targetTimeToday) . ' at ' . date('h:i A T', $targetTimeToday);
} else {
  $dateTime = date('F j, Y', $targetTimeYesterday) . ' at ' . date('h:i A T', $targetTimeYesterday);
}

get_header();
?>

<!-- Hero image
================================================== -->

<img class="w-full h-80 object-cover md:object-contain" src="<?php echo get_template_directory_uri(); ?>/images/art/family-full.png" alt="Happy homebuying family">

<!-- Main heading and CTAs
================================================== -->

<div class="container md:py-12">
  <div class="flex flex-col md:flex-row gap-12">
    <div class="flex-1 text-center md:text-left">
      <h1 class="mb-4">Mortgages for first-time home buyers.</h1>
      <h4 class="text-brand-gray-dark mb-8">Your American Dream starts here. Happy Homebuying!</h4>
      <div class="flex flex-col gap-4 md:gap-6 md:flex-row">
        <a data-category="Pre-approval" data-action="Click" data-label="home-banner-button" href="https://app.homebuyer.com" class="btn-primary md:btn-primary-large">Apply Now</a>
        <button id="scroll-trigger" class="btn-outline md:btn-outline-large">Compare Rates</button>
      </div>
    </div>
    <div class="bg-brand-purple-lighter rounded-3xl h-full p-5 md:p-12 flex flex-col gap-4 md:gap-12">
      <h4 class="text-brand-gray-dark text-base md:text-xl flex items-center">
        <span class="text-brand-purple-dark text-xl md:text-3xl mr-2 mdi mdi-check-circle"></span> Competitive low mortgage rates
      </h4>
      <h4 class="text-brand-gray-dark text-base md:text-xl flex items-center">
        <span class="text-brand-purple-dark text-xl md:text-3xl mr-2 mdi mdi-check-circle"></span> Expert advice for first-time buyers
      </h4>
      <h4 class="text-brand-gray-dark text-base md:text-xl flex items-center">
        <span class="text-brand-purple-dark text-xl md:text-3xl mr-2 mdi mdi-check-circle"></span> No hidden fees or surprises—ever!
      </h4>
    </div>
  </div>
</div>

<!-- "As seen on" logos
================================================== -->

<div class="w-full bg-white">
  <div class="container md:py-12">
    <div class="flex flex-col items-center gap-4">
      <p class="text-brand-purple"><strong>As seen on:</strong></p>
      <div class="w-full grid justify-items-center grid-cols-2 md:grid-cols-6">
        <img src="<?php echo get_template_directory_uri(); ?>/images/companies/yahoo-finance.svg" title="Yahoo! Finance" alt="Yahoo! Finance logo">
        <img src="<?php echo get_template_directory_uri(); ?>/images/companies/cnbc.svg" title="CNBC" alt="CNBC logo">
        <img src="<?php echo get_template_directory_uri(); ?>/images/companies/wsj.svg" title="WSJ" alt="WSJ logo">
        <img src="<?php echo get_template_directory_uri(); ?>/images/companies/inc.svg" title="Inc." alt="Inc. logo">
        <img src="<?php echo get_template_directory_uri(); ?>/images/companies/time.svg" title="Time" alt="Time logo">
        <img src="<?php echo get_template_directory_uri(); ?>/images/companies/bloomberg.svg" title="Bloomberg" alt="Bloomberg logo">
      </div>
    </div>
  </div>
</div>

<!-- Comparison Table
================================================== -->

<div class="w-full bg-brand-blue-light">
  <div class="container md:py-24">
    <h2 class="mb-1 text-center text-brand-blue" id="scroll-target">
      Compare Our Mortgage Rates
    </h2>
    <div data-is-vue v-scope="ComparisonTable()" @vue:mounted="mounted($el)">
      <label class="block text-center mb-12">Last updated: <span class="skeleton-loader ml-2 align-middle h-4 w-70 rounded"></span></label>
      <div class="mb-8">
        <div class="flex flex-col gap-8">
          <div class="skeleton-loader h-30 rounded-lg"></div>
          <div class="skeleton-loader h-30 rounded-lg"></div>
          <div class="skeleton-loader h-30 rounded-lg"></div>
          <div class="skeleton-loader h-30 rounded-lg"></div>
        </div>
      </div>
      <div class="mb-2">
        <p class="text-base text-center mb-2">
          <strong>Mortgage Rate Assumptions</strong>
        </p>
        <p class="text-base mb-2 line-clamp-2 text-ellipsis">
          The Homebuyer.com mortgage rates shown on this page are based on assumptions about you, your home, and the state where you plan to purchase. The rate shown is accurate as of October 25, 2023 at 10:45 AM ET, but please remember that mortgage rates change without notice based on mortgage bond market activity.
        </p>
      </div>
      <p class="text-base text-center">
        <span class="text-brand-purple cursor-pointer underline hover:no-runderline">
          View Full Disclosure <span class="mdi mdi-arrow-down align-middle"></span>
        </span>
      </p>
    </div>
    <div class="flex justify-center mt-20">
      <a data-category="Pre-approval" data-action="Click" data-label="home-banner-button" class="btn-primary md:btn-primary-large shadow" href="https://app.homebuyer.com">Get Pre-approved</a>
    </div>
  </div>
</div>

<!-- Affordability Form
================================================== -->

<div class="container md:py-24">
  <h2 class="text-center px-6 md:mb-12">
    Find out what you could afford today!
  </h2>
  <script>
    (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
    key: "AIzaSyBd5pVhrnRgAKK6gn-XxVEBX8NlqXEHOpo",
    v: "beta",
    });
  </script>
  <div class="mb-8" data-is-vue v-scope="AffordabilityForm()" @vue:mounted="mounted($el)">
    <div class="w-full px-6 py-12 md:p-0">
      <div class="skeleton-loader h-44 rounded-lg"></div>
    </div>
  </div>
</div>

<!-- Reasons-To-Believe
================================================== -->

<div class="w-full bg-brand-purple-lighter">
  <div class="container md:py-24">
    <h2 class="text-center mb-16">The Best Mortgage Company For First-Time Buyers</h2>
    <div class="grid gap-4 md:gap-12 grid-cols-1 md:grid-cols-2">

      <!-- Low Mortgage Rates -->
      <div class="md:aspect-[480/178] bg-white rounded-3xl flex p-8 pr-4 shadow">
        <div class="self-center p-4 w-16 h-16 rounded-full bg-brand-purple-lighter flex justify-center items-center mr-4">
          <span class="text-brand-purple text-4xl mdi mdi-trending-down"></span>
        </div>
        <div class="flex flex-col justify-evenly">
          <h4 class="text-brand-purple-dark">Low Mortgage Rates</h4>
          <p>We are a direct mortgage lender which means there’s no middleman involved to push up your rate. Because every penny counts in your dream home journey.</p>
        </div>
      </div>

      <!-- Lightning Speed -->
      <div class="md:aspect-[480/178] bg-white rounded-3xl flex p-8 pr-4 shadow">
        <div class="self-center p-4 w-16 h-16 rounded-full bg-brand-yellow-light flex justify-center items-center mr-4">
          <span class="text-brand-yellow-dark text-4xl mdi mdi-lightning-bolt-outline"></span>
        </div>
        <div class="flex flex-col justify-evenly">
          <h4 class="text-brand-purple-dark">Lightning Speed</h4>
          <p>Get a mortgage pre-approval in as few as 3 minutes, every day of the week. Start your home-buying journey on the fast track. Give yourself the edge.</p>
        </div>
      </div>

      <!-- Serious Security -->
      <div class="md:aspect-[480/178] bg-white rounded-3xl flex p-8 pr-4 shadow">
        <div class="self-center p-4 w-16 h-16 rounded-full bg-brand-red-light flex justify-center items-center mr-4">
          <span class="text-brand-red-dark text-4xl mdi mdi-shield-check-outline"></span>
        </div>
        <div class="flex flex-col justify-evenly">
          <h4 class="text-brand-purple-dark">Always Available</h4>
          <p>Wherever you are on your journey, embrace the advantage of 24/7 access to your lender because, in the race to your dream home, every moment counts.</p>
        </div>
      </div>

      <!-- Excellent Reviews -->
      <div class="md:aspect-[480/178] bg-white rounded-3xl flex p-8 pr-4 shadow">
        <div class="self-center p-4 w-16 h-16 rounded-full bg-brand-blue-light flex justify-center items-center mr-4">
          <span class="text-brand-blue text-4xl mdi mdi-star-outline"></span>
        </div>
        <div class="flex flex-col justify-evenly">
          <h4 class="text-brand-purple-dark">Strong Communication</h4>
          <p>Our mortgage approvals include real-time loan tracking, milestone alerts, and a team of more than 200 mortgage pros working for your home. </p>
        </div>
      </div>
    </div>
    <div class="flex justify-center mt-20">
      <a data-category="Pre-approval" data-action="Click" data-label="home-banner-button" class="btn-primary md:btn-primary-large shadow" href="https://app.homebuyer.com">Get Pre-approved</a>
    </div>
  </div>
</div>

<!-- How It Works
================================================== -->

<div class="w-full bg-white relative">
  <div class="flex flex-col justify-end md:flex-row max-w-screen-2xl mx-auto">
    <div style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/art/mover-guy.png');" class="md:absolute w-full md:w-1/2 lg:w-[45%] left-0 top-0 shadow-[inset_-75px_80px_100px_0px_rgb(255,255,255)] h-[50vh] md:h-[70%] md:my-24 md:mr-24 bg-no-repeat bg-contain bg-left"></div>
    <div class="w-full md:w-1/2 p-12 md:py-24 md:pl-12 xl:pl-0 md:pr-24 bg-white">
      <h2 class="mb-12">Stop Renting And Start Owning</h2>
      <div class="flex items-center">
        <div class="text-3xl text-brand-purple bg-brand-purple-lighter w-16 h-16 rounded-full mr-4 flex justify-center items-center">
          1
        </div>
        <div class="flex-1 flex flex-col">
          <h4 class="text-brand-purple">Get Pre-Approved</h4>
          <p>Dream big and start your homeownership journey. Every great adventure begins with a brave first step.</p>
        </div>
      </div>
      <div class="h-9 my-3 ml-8 border-l-4 border-brand-purple-lighter"></div>
      <div class="flex items-center">
        <div class="text-3xl text-brand-purple bg-brand-purple-lighter w-16 h-16 rounded-full mr-4 flex justify-center items-center">
          2
        </div>
        <div class="flex-1 flex flex-col">
          <h4 class="text-brand-purple">Shop Confidently</h4>
          <p>Navigate the market with precision. We’ll keep you on a good path while you find your perfect home.</p>
        </div>
      </div>
      <div class="h-9 my-3 ml-8 border-l-4 border-brand-purple-lighter"></div>
      <div class="flex items-center">
        <div class="text-3xl text-brand-purple bg-brand-purple-lighter w-16 h-16 rounded-full mr-4 flex justify-center items-center">
          3
        </div>
        <div class="flex-1 flex flex-col">
          <h4 class="text-brand-purple">Buy Your First Home</h4>
          <p>It’s time to relax! With your mortgage already pre-approved, we prepare your mortgage for closing.</p>
        </div>
      </div>
      <div class="h-9 my-3 ml-8 border-l-4 border-brand-purple-lighter"></div>
      <div class="flex items-center">
        <div class="text-3xl text-brand-purple bg-brand-purple-lighter w-16 h-16 rounded-full mr-4 flex justify-center items-center">
          4
        </div>
        <div class="flex-1 flex flex-col">
          <h4 class="text-brand-purple">Move in!</h4>
          <p>Get your new keys and embrace the joys of homeownership. Congratulations, you did it!</p>
        </div>
      </div>
      <div class="flex mt-20">
        <a data-category="Pre-approval" data-action="Click" data-label="home-banner-button" class="btn-primary md:btn-primary-large shadow" href="https://app.homebuyer.com">Get Pre-approved</a>
      </div>
    </div>
  </div>
</div>
<?php
  $args = [ 'slug' => get_queried_object()->post_name ];
  get_footer(null, $args);
?>
