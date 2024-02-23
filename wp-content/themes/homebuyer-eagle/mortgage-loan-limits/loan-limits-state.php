<?php

$state = $data['state'];

define('PUBLISHED_AT', '2023-07-20T09:00:00.000000-04:00');
define('YEAR', '2024');

$date = new DateTime($data['updatedAt']);
$updatedAt = $date->format('F j, Y');

$title = "Mortgage Loan Limits for $state";
$description = YEAR . " $state, Loan Limits — 1-Unit Conforming $" . number_format($data['oneUnitConforming'][YEAR]) . ", 1-Unit FHA " . number_format($data['oneUnitFha'][YEAR]) . ". Charts included. Updated regularly.";

$pluginOptions = get_option('hb_loan_limits', array() );
$youtubeId = $pluginOptions['youtube_id'] ?? '3AI2_FdIMts';
$youtubeDuration = $pluginOptions['youtube_duration_seconds'] ?? '505';

add_action( 'wp_head', function () {
  global $wp, $data, $title, $description, $youtubeId, $youtubeDuration;

  echo '<meta name="description" content="'. $description . '"/>' . "\n";
  echo '<meta name="robots" content="follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large"/>' . "\n";
  echo '<link rel="canonical" href="' . home_url( $wp->request ) . '" />' . "\n";
  echo '<meta property="og:locale" content="en_US" />' . "\n";
  echo '<meta property="og:type" content="article" />' . "\n";
  echo '<meta property="og:title" content="' . $title . '" />' . "\n";
  echo '<meta property="og:url" content="' . home_url ($wp->request ) . '" />' . "\n";
  echo '<meta property="og:description" content="'. $description . '" />' . "\n";
  echo '<meta property="og:site_name" content="Homebuyer.com" />' . "\n";
  echo '<meta property="article:publisher" content="https://facebook.com/homebuyercom" />' . "\n";
  echo '<meta property="article:tag" content="' . $title . '" />' . "\n";
  echo '<meta property="article:section" content="' . $title . '" />' . "\n";
  echo '<meta property="og:updated_time" content="' . $data['updatedAt'] . '" />' . "\n";
  echo '<meta property="og:image" content="' . home_url() . '/wp-content/uploads/2022/04/homebuyer-illustation-1200px.jpeg" />' . "\n";
  echo '<meta property="og:image:secure_url" content="' . home_url() . '/wp-content/uploads/2022/04/homebuyer-illustation-1200px.jpeg" />' . "\n";
  echo '<meta property="og:image:width" content="1200" />' . "\n";
  echo '<meta property="og:image:height" content="234" />' . "\n";
  echo '<meta property="og:image:alt" content="Homebuyer.com" />' . "\n";
  echo '<meta property="og:image:type" content="image/jpeg" />' . "\n";
  echo '<meta property="article:published_time" content="' . PUBLISHED_AT . '" />' . "\n";
  echo '<meta property="article:modified_time" content="' . $data['updatedAt'] . '" />' . "\n";
  echo '<meta property="og:video" content="https://www.youtube.com/embed/' . $youtubeId . '" />' . "\n";
  echo '<meta property="video:duration" content="' . $youtubeDuration . '" />' . "\n";
  echo '<meta name="twitter:card" content="summary_large_image" />' . "\n";
  echo '<meta name="twitter:title" content="' . $title . '" />' . "\n";
  echo '<meta name="twitter:description" content="' . $description . '" />' . "\n";
  echo '<meta name="twitter:site" content="@homebuyer" />' . "\n";
  echo '<meta name="twitter:creator" content="@homebuyer" />' . "\n";
  echo '<meta name="twitter:image" content="' . home_url() . '/wp-content/uploads/2022/04/homebuyer-illustation-1200px.jpeg" />' . "\n";
  echo '<meta name="twitter:label1" content="Written by" />' . "\n";
  echo '<meta name="twitter:data1" content="Dan Green" />' . "\n";
  echo '<meta name="twitter:label2" content="Time to read" />' . "\n";
  echo '<meta name="twitter:data2" content="5 minutes" />' . "\n";
}, 1);

add_filter( 'wp_title', function($title, $sep) {
  global $title;
  return $title;
}, 9999, 2 );

add_action( 'wp_enqueue_scripts', function () {
  wp_enqueue_script('utils-js', get_template_directory_uri() . '/js/utils.js', array(), rand(111, 9999), true);
  wp_enqueue_script('single-js', get_template_directory_uri() . '/js/single.js', array(), rand(111, 9999), true);
  wp_enqueue_script('loan-limits-js', get_template_directory_uri() . '/js/loan-limits.js', array(), rand(111,9999), true);
});

get_header();
?>
<div class="post lg:flex pt-5 md:pt-10 bg-brand-purple-lightest overflow-clip">
  <!-- Left -->
  <div class="flex-1 bg-white">
    <div class="z-10 relative h-full">
    </div>
  </div>
  <div class="z-0">
    <!-- Article Header -->
    <div class="max-w-2xl mx-auto relative px-6 md:px-0">
      <div class="bg-brand-purple-lightest w-[200vw] h-full absolute top-0 -left-full -z-10"></div>
      <!-- Author -->
      <div class="mb-3 w-fit py-2 px-4 bg-white rounded-lg flex items-center">
        <img class="h-8 aspect-square rounded-full overflow-hidden align-middle mr-2" src="<?php echo home_url(); ?>/wp-content/uploads/2023/01/Dan_Green_-_Headshot_-_2022-150x150.jpg" alt="Dan Green" />
        <label>Written by <a class="cursor-pointer" id="author-link">Dan Green</a></label>
        <div v-scope="Modal({ id: 'author-dialog' })" @vue:mounted="mounted($el)">
          <slot>
            <h4 class="!mb-4 !text-brand-purple">Dan Green</h4>
            <p class="!text-base">
              Since 2003, Dan Green has been a leading mortgage lender and respected industry
              authority. His unwavering commitment to first-time home buyers and home buyer
              education has established him as a trusted voice among his colleagues, his peers,
              and the media. Dan founded Homebuyer.com to expand the American Dream of
              Homeownership to all who want it.
              <a href="<?php echo home_url(); ?>/author/dan-green" target="_blank" rel="author" title="Posts by Dan Green">Read more about Dan Green</a>.
            </p>
          </slot>
        </div>
      </div>
      <!-- Title -->
      <h1 class="mb-6">Mortgage Loan Limits: <?php echo $state; ?></h1>
      <!-- Notice Block -->
      <div class="mb-2 py-5 px-7 bg-[#e7e9f2] rounded-lg">
        <label>
          Homebuyer.com is dedicated to helping you achieve your homeownership dreams. We follow
          editorial guidelines including truthfulness and transparency, and may present you with
          offers from other companies. Read about <a class="cursor-pointer" id="make-money-link">how
          we make money</a>.
        </label>
        <div v-scope="Modal({ id: 'make-money-dialog' })" @vue:mounted="mounted($el)">
          <slot>
            <h4 class="!mb-4 !text-brand-purple">How We Make Money</h4>
            <p class="!text-base">
              Homebuyer.com is your trusted guide to homeownership. Since 2003, our team has offered
              real-world expertise and advice to tens of millions of U.S. home buyers. Our content
              stands on its integrity: it's factual, unbiased, and free from outside influences.
              Read more about our governing
              <a href="<?php echo home_url(); ?>/editorial-guidelines">editorial guidelines</a>.
            </p>
            <p class="!text-base">
              We also exist for profit and want our readers to understand how we make money. 
            </p>
            <p class="!text-base">
              Homebuyer.com is a mortgage-company-affiliated publisher. We earn compensation when
              you click specific links on the website, or apply for a mortgage with Homebuyer.com or
              partner listed in our comparison tables. Our partners compensate us differently, so we
              randomize our tables to protect our readers from steering. We may also earn
              compensation for advertisements on the site, which are indicated clearly.  Note that
              limitations in our software, whether we originate mortgages in your area, and credit
              factors may affect the offers and comparison tables you see on various parts of this
              site. We do not include offers for every mortgage product available.  Someday, we hope
              we will.
            </p>
          </slot>
        </div>
      </div>
      <!-- Certified Accurate Block -->
      <div class="mb-6 flex items-start md:items-center">
        <div class="relative">
          <a class="inline-flex -mt-1 md:-mt-px items-center cursor-pointer mr-2 text-brand-purple" id="certified-link">
            <span class="relative mr-1 text-xl mdi mdi-check-circle"></span>
            <span class="text-sm">Certified Accurate</span>
          </a>
          <div v-scope="Modal({ id: 'certified-dialog' })" @vue:mounted="mounted($el)">
            <slot>
              <h4 class="!mb-4 !text-brand-purple">Certified Accurate</h4>
              <p class="!text-base">
                Your trust matters to us. This article was thoroughly checked for accuracy as of
                <?php echo $updatedAt; ?>. Homebuyer.com ensures every piece of
                information we share reflects the latest in mortgage standards. Learn more about our
                commitments to our reader in our
                <a href="<?php echo home_url(); ?>/editorial-guidelines">editorial guidelines</a>.
              </p>
            </slot>
          </div>
        </div>
        <div class="flex-1 block text-right md:flex justify-end">
          <label class="">Published: <?php echo $updatedAt; ?></label>
        </div>
      </div>
      <!-- Search -->
      <div class="-mx-5 md:-mx-10 md:bg-white px-6 md:pt-10 md:px-10 rounded-t-2xl bg-gradient-to-b from-brand-purple-lightest md:from-white from-40% to-40% to-white">
        <label class="mb-1">Find the mortgage loan limits for any U.S. address</label>
        <div class="md:flex items-center relative">
          <span class="absolute left-4 top-2 md:top-auto mt-px text-xl mdi mdi-magnify"></span>
          <input class="text-input pl-10 w-full md:mr-8" id="county-lookup" placeholder="Search by county, city, or address…" type="text" autocomplete="off">
          <button id="county-lookup-button" disabled class="btn-primary disabled:opacity-40 disabled:cursor-default">Search</button>
          <script>
            (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
            key: "AIzaSyALXddRh9W1cKulloc4OGdlhgiEoU9cr1k",
            v: "beta",
            });
          </script>
          <script>
            window.addEventListener('load', function () {
               initSearch('<?php echo home_url(); ?>', 'county-lookup', 'county-lookup-button'); 
            });
          </script>
        </div>
      </div>
    </div>
    <div class="post py-14 bg-white">
      <!-- Content -->
      <div class="px-6 md:px-0 max-w-2xl mx-auto">
        <h2><?php echo $title; ?></h2>
        <?php
          get_template_part(
            'partials/loan-limits-table',
            null,
            [
              'id' => 'loan-limits-table',
              'left_tab' => 'Conforming Loans',
              'right_tab' => 'FHA Loans',
              'left_row' => [
                'Property Type' => YEAR . " Loan Limit",
                '1-Unit Homes' => '$' . number_format($data['oneUnitConforming'][YEAR]),
                '2-Unit Homes' => '$' . number_format($data['twoUnitConforming'][YEAR]),
                '3-Unit Homes' => '$' . number_format($data['threeUnitConforming'][YEAR]),
                '4-Unit Homes' => '$' . number_format($data['fourUnitConforming'][YEAR]),
              ],
              'right_row' => [
                'Property Type' => YEAR . " Loan Limit",
                '1-Unit Homes' => '$' . number_format($data['oneUnitFha'][YEAR]),
                '2-Unit Homes' => '$' . number_format($data['twoUnitFha'][YEAR]),
                '3-Unit Homes' => '$' . number_format($data['threeUnitFha'][YEAR]),
                '4-Unit Homes' => '$' . number_format($data['fourUnitFha'][YEAR]),
              ],
            ],
          );
        ?>
        <script>
          window.addEventListener('load', function () {
            initTables('loan-limits-table');
          });
        </script>
        <div class="mb-12">
          <small>Source: Federal Housing Finance Agency; Federal Housing Administration</small>
        </div>
        <h2>What’s On This Page</h2>
        <p>This interactive home buyer tool shows current conforming and FHA mortgage loan limits in the U.S., alongside charts that detail historical local loan limit changes from 1970 to present.</p>
        <p>The mortgage loan limits information on this page is sourced from the Federal Housing Finance Agency (FHFA) and the Federal Housing Administration (FHA), and is verified for changes regularly.</p>
        <p>As a helpful added resource, this page also contains local home buyer demographic data, provided by the <a href="<?php home_url(); ?>/research/hmda-mortgage-statistics">Home Mortgage Disclosure Act</a>.</p>
        <div class="my-12">
          <h4><?php echo $state; ?> mortgage loan limits apply in:</h4>
          <div class="border-2 rounded-lg mt-2.5 mb-4 w-full h-100" id="loan-limits-map"></div>
        </div>
        <script>
          window.addEventListener('load', function () {
            renderMap("<?php echo $state; ?>, USA", "state", "loan-limits-map");
          });
        </script>
        <h2>What Is A Mortgage Loan Limit?</h2>
        <p><a href="<?php echo home_url(); ?>/mortgage-loan-limits">Mortgage loan limits</a> are the upper boundaries for how much a home buyer can borrow on a mortgage. Loan limits vary by home type and state, with some counties receiving the <a href="<?php echo home_url(); ?>/learn/high-cost-area">high-cost areas</a> designation.</p>
        <p>The Federal Housing Finance Agency (FHFA) sets mortgage loan limits for conforming mortgages and the Federal Housing Administration (FHA) sets loan limits for <a href="<?php echo home_url(); ?>/learn/fha-loans">FHA mortgages</a>.  In <?php echo $state; ?>, the <?php echo YEAR; ?> conforming mortgage loan limit for a 1-unit home is $<?php echo number_format($data['oneUnitConforming'][YEAR]); ?>. The <?php echo YEAR; ?> FHA mortgage loan limit for a 1-unit home is $<?php echo number_format($data['oneUnitFha'][YEAR]); ?>.</p>
        <p>Conforming and FHA mortgage loan limits change annually to reflect changes in local and national home values. Loans that exceed conforming loan limit sizes are commonly called jumbo mortgages. In <?php echo YEAR; ?>, there are no mortgage loan limits for <a href="<?php echo home_url(); ?>/learn/va-loans">VA loans</a> or <a href="<?php echo home_url(); ?>/learn/usda-mortgage">USDA loans</a>.</p>
        <div class="mb-14">
          <div class="rounded-2xl overflow-hidden w-full aspect-video mb-4">
            <?php echo do_shortcode("[lyte id='$youtubeId']"); ?>
          </div>
          <small>Video Length: <?php echo gmdate("i:s", $youtubeDuration); ?></small>
        </div>
        <h2>Mortgage Loan Limits in All <?php echo $state; ?> Counties</h2>
        <p>Get <?php echo YEAR; ?> conforming and FHA mortgage loan limits for all <?php echo $state; ?> counties. Local loan limits and county-level mortgage data updated regularly.</p>
        <h3><?php echo $state; ?> Counties</h3>
        <div class="grid gap-4 md:gap-8 grid-cols-2 md:grid-cols-3 mb-14">
          <?php
            foreach ($data['nearby'] as $key => $value) {
              get_template_part(
                'partials/loan-limits-card',
                null,
                [
                  'url' => home_url() . '/mortgage-loan-limits/' . $key,
                  'title' => 'Mortgage Loan Limits',
                  'link_text' => $value,
                ],
              );
            }
            get_template_part(
              'partials/loan-limits-card',
              null,
              [
                'url' => home_url() . '/mortgage-loan-limits',
                'title' => 'Mortgage Loan Limits',
                'link_text' => 'National Data',
              ],
            );
          ?>
        </div>
        <h2>Historical Charts: Mortgage Loan Limits in <?php echo $state; ?></h2>
        <p>Mortgage loan limits adjust annually to match changes in U.S. home values. As home values go up or down in <?php echo $state; ?>, so do the local loan limits. Changes in mortgage loan limits promote affordable homeownership, fair lending, and a balanced housing market.</p>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>
        <div class="mt-8 mb-14" id="loan-limits-charts">
          <div class="flex gap-4 mb-3">
            <div data-left-chart-tab class="border-b border-brand-gray-light cursor-pointer text-brand-purple font-sans-medium border-b-2 border-brand-purple">Conforming Loans</div>
            <div data-right-chart-tab class="border-b border-brand-gray-light cursor-pointer">FHA Loans</div>
          </div>
          <div data-left-chart class="relative">
            <canvas id="ll-conforming-canvas"></canvas>
          </div>
          <div data-right-chart class="relative hidden">
            <canvas id="ll-fha-canvas"></canvas>
          </div>
        </div>
        <script>
          window.addEventListener('load', function () {
            initCharts('loan-limits-charts');
            const conforming = {
              oneUnit: {
                label: '1-Unit Property',
                data: <?php echo json_encode($data['oneUnitConforming']); ?>,
              },
              twoUnit: {
                label: '2-Unit Property',
                data: <?php echo json_encode($data['twoUnitConforming']); ?>,
              },
              threeUnit: {
                label: '3-Unit Property',
                data: <?php echo json_encode($data['threeUnitConforming']); ?>,
              },
              fourUnit: {
                label: '4-Unit Property',
                data: <?php echo json_encode($data['fourUnitConforming']); ?>,
              },
            };
            renderChart('ll-conforming-canvas', conforming);
            const fha = {
              oneUnit: {
                label: '1-Unit Property',
                data: <?php echo json_encode($data['oneUnitFha']); ?>,
              },
              twoUnit: {
                label: '2-Unit Property',
                data: <?php echo json_encode($data['twoUnitFha']); ?>,
              },
              threeUnit: {
                label: '3-Unit Property',
                data: <?php echo json_encode($data['threeUnitFha']); ?>,
              },
              fourUnit: {
                label: '4-Unit Property',
                data: <?php echo json_encode($data['fourUnitFha']); ?>,
              },
            };
            renderChart('ll-fha-canvas', fha);
          });
        </script>
        <?php if (count($data['loanTypes'])) { ?>
        <h2 id="mortgage-stats">Mortgage Statistics from <?php echo $state; ?></h2>
        <p>Mortgage statistics for <?php echo $state; ?> for the most recently-available five-year period as sourced from the Home Mortgage Disclosure Act (HMDA) database and maintained by the Federal Financial Institutions Examination Council (<a href="https://ffiec.cfpb.gov">FFIEC</a>). The HMDA database stores detailed, anonymous loan data on a national basis and provides insight into home buyer traits, mortgage borrowing patterns, and mortgage approval rates. Percentages may not total 100% due to rounding.</p>
        <div class="mt-6 mb-2">
          <?php
            get_template_part(
              'partials/post-table',
              null,
              [
                'row' => [
                  'Loan Type' => 'Relative Share',
                  'Conventional' => number_format($data['loanTypes']['Conventional'], 2) . '%',
                  'FHA' => number_format($data['loanTypes']['FHA'], 2) . '%',
                  'VA' => number_format($data['loanTypes']['VA'], 2) . '%',
                  'USDA' => number_format($data['loanTypes']['USDA'], 2) . '%',
                ],
              ],
            );
            get_template_part(
              'partials/post-table',
              null,
              [
                'row' => [
                  'Property Type' => 'Relative Share',
                  '1-Unit Homes' => number_format($data['propertyTypes']['1-Unit'], 2) . '%',
                  '2-Unit Homes' => number_format($data['propertyTypes']['2-Unit'], 2) . '%',
                  '3-Unit Homes' => number_format($data['propertyTypes']['3-Unit'], 2) . '%',
                  '4-Unit Homes' => number_format($data['propertyTypes']['4-Unit'], 2) . '%',
                ],
              ],
            );
            get_template_part(
              'partials/post-table',
              null,
              [
                'row' => [
                  'Borrower Status' => 'Relative Share',
                  'One Borrower' => number_format($data['borrowerStatus']['One Borrower'], 2) . '%',
                  'Two or More Borrowers' => number_format($data['borrowerStatus']['Two or More Borrowers'], 2) . '%',
                ],
              ],
            );
            get_template_part(
              'partials/post-table',
              null,
              [
                'row' => [
                  'Gender' => 'Relative Share',
                  'Male' => number_format($data['gender']['Male'], 2) . '%',
                  'Female' => number_format($data['gender']['Female'], 2) . '%',
                  'Not Specified' => number_format($data['gender']['Other'], 2) . '%',
                ],
              ],
            );
            get_template_part(
              'partials/post-table',
              null,
              [
                'row' => [
                  'Race' => 'Relative Share',
                  'American Indian / Alaska Native' => number_format($data['race']['American Indian or Alaska Native'], 2) . '%',
                  'Asian' => number_format($data['race']['Asian'], 2) . '%',
                  'Black / African American' => number_format($data['race']['Black or African American'], 2) . '%',
                  'Native Hawaiian / Other Pacific Islander' => number_format($data['race']['Native Hawaiian or Other Pacific Islander'], 2) . '%',
                  'White' => number_format($data['race']['White'], 2) . '%',
                  'Other' => number_format($data['race']['Joint'], 2) . '%',
                ],
              ],
            );
            get_template_part(
              'partials/post-table',
              null,
              [
                'row' => [
                  'Ethnicity' => 'Relative Share',
                  'Hispanic or Latino' => number_format($data['ethnicity']['Hispanic or Latino'], 2) . '%',
                  'Not Hispanic or Latino' => number_format($data['ethnicity']['Not Hispanic or Latino'], 2) . '%',
                ],
              ],
            );
          ?>
        </div>
        <div class="mb-14">
          <small><?php echo $state; ?> data represents closed-end, first-lien purchase mortgages for residential properties, 1-4 units, for the 5-year period 2018-2022. Source: FFEIC Home Mortgage Disclosure Act</small>
        </div>
        <?php } ?>
        <a class="bg-brand-purple-lightest !no-underline flex flex-col-reverse md:flex-row items-center mb-14 rounded-lg" href="<?php echo home_url(); ?>/research/hmda-mortgage-statistics">
          <div class="flex-1 text-center md:text-left pb-12 md:p-12">
            <p class="!text-3xl !leading-normal text-brand-black font-sans-medium mb-10">See National <?php echo YEAR; ?> U.S.  Mortgage Statistics </p>
            <button class="btn-outline">
              Read the Report
            </button>
          </div>
          <div class="flex-1">
            <img alt="Pie chart illustration" src="<?php echo get_template_directory_uri(); ?>/images/art/quirky-pie-chart-with-annotations.svg">
          </div>
        </a>
        <h2>See Today’s Mortgage Rates in <?php echo $state; ?></h2>
        <p>Homebuyer.com is the mortgage company for first-time home buyers. Check your eligibility for <a href="<?php echo home_url(); ?>/learn/first-time-home-buyer-grants-programs">first-time home buyer programs</a> and look at today's low down-payment mortgages. Get pre-approved online in just three minutes.</p>
        <div class="mt-2 mb-14">
          <a data-category="Pre-approval" data-action="Click" data-label="article-bottom-button" class="btn-primary" href="https://app.homebuyer.com">
            Get Pre-approved
          </a>
        </div>
        <h2>Mortgage Limits By State</h2>
        <div class="grid gap-x-2 grid-cols-1 md:grid-cols-3 mb-14">
          <?php
            $keys = array_keys($data['states']);
            $columns = 3;
            $perColumn = ceil(count($keys) / $columns);

            $i = 0;
            $j = 0;
            while ($i < $columns) {
              $column = array_slice($keys, $j, $perColumn);
              echo "<div>\n";
              foreach ($column as $key) {
                $value = $data['states'][$key];
                echo "<div><a href=\"" . home_url() . "/mortgage-loan-limits/$key" . "\">" . $value . " Loan Limits</a></div>\n";
              }
              echo "</div>\n";
              $i++;
              $j += $perColumn;
            }
          ?>
        </div>
      </div>
    </div>
  </div>
  <!-- Right -->
  <div class="flex-1 bg-white">
    <div class="z-10 relative h-full px-10 lg:pt-75">
      <!-- Floating CTA -->
      <?php get_template_part('partials/post-floating-cta', 'desktop'); ?>
    </div>
  </div>
</div>
<?php
  get_template_part('partials/footer-newsletter');
  $args = [ 'slug' => get_queried_object()->post_name ];
  get_footer(null, $args);
?>
