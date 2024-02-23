<?php

define('PUBLISHED_AT', '2023-07-20T09:00:00.000000-04:00');
define('YEAR', '2024');

$date = new DateTime($data['updatedAt']);
$updatedAt = $date->format('F j, Y');

$title = "U.S. Mortgage Loan Limits";
$description = YEAR . " Mortgage Loan Limits: 1-Unit Conforming $" . number_format($data['oneUnitConforming'][YEAR]) . ", 1-Unit FHA " . number_format($data['oneUnitFha'][YEAR]) . ". Charts included. Updated regularly.";

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
      <h1 class="mb-6">U.S. Mortgage Loan Limits</h1>
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
          <h4>National mortgage loan limits apply in:</h4>
          <div class="border-2 rounded-lg mt-2.5 mb-4 w-full h-100" id="loan-limits-map"></div>
        </div>
        <script>
          let map;
          let featureLayer;
          const NOT_BASE_COUNTIES = [
            'ChIJ7a-UgVuW_lYRjTetzbIWL48',
            'ChIJI9ivbI1Pg1cRg8d4nlGjGVU',
            'ChIJQT-zBHaRyFYR42iEp1q6fSU',
            'ChIJAzKaLtLCIVcR4HXf_qNNZmk',
            'ChIJq3q39fef6FYRobLPUAsGQ0M',
            'ChIJj3x8PXcFt1YRvz112p0TjA8',
            'ChIJNRl_BvShtVYRDC6rbhNVxac',
            'ChIJOTWQqX-pzVYRqwYRa_-9avw',
            'ChIJM-YORS8B3lYRZd4u0HiMW1g',
            'ChIJh1hyQyV_M1ERYrNgULUBLpA',
            'ChIJp6hr9o3pAVQRR7I8MzKIRgQ',
            'ChIJjY64IlEKAVQR07LV-Nz07zE',
            'ChIJjzpqb2zeAFQREfNprlryXgY',
            'ChIJFfW41gNZwVYRamRfTxj0RdY',
            'ChIJBc4nwh-fDlQRwEQtwhZU1CI',
            'ChIJ84Wen1SV61YR2LqkcZiadvc',
            'ChIJW4RSG5ZoJFcR2-oeYuGVuRQ',
            'ChIJI26TK2JC6FYR2uVT9p4NXxo',
            'ChIJxT0fZPkfzFYReC4g704O-_c',
            'ChIJ6ftI2sg4MVcRD6MakZY-GXk',
            'ChIJB9NjWeWd2VARx-Cy8uG2nZc',
            'ChIJM3vtHzeW01ARVYqgadp2wpI',
            'ChIJgy8SV5WrCFQRvJYQwir9fe4',
            'ChIJ4auid4_RDlQR-_YKUHqQ1ow',
            'ChIJuWN1b4NmBFQRdBzIn0jaQSU',
            'ChIJQZHeACWpqlYRalM6MncXJV4',
            'ChIJc2MxnobtNFERV6pifSHbErk',
            'ChIJq8l0wDrKCFQRc9jhlV0bTc0',
            'ChIJAz4GIST0qVYRyXlvZrEutfo',
            'ChIJazQyT-72LFERFWgM8TE0_n8',
            'ChIJWRd5NDfyj4ARc30TGxHHxmg',
            'ChIJ3QQ6ifNuhYAR4fM4Ln-yyVk',
            'ChIJMc1kAdMq3YARKjm9z9YofYM',
            'ChIJ82aOMnyhhYARHLRVUdyH0As',
            'ChIJz_fVVFyS3IARB9bwj2HDpt4',
            'ChIJ_8VcLuc7koARQXmgrXGnQxc',
            'ChIJIQBpAG2ahYAR_6128GcTUEo',
            'ChIJiUYt5gF4j4AR3OQX5ii4s1c',
            'ChIJd_Y0eVIvkIARuQyDN0F1LBA',
            'ChIJfzsx1n8TjoARGbNHDCbAPhU',
            'ChIJW-T2Wt7Gt4kRmKFUAsCO4tY',
            'ChIJV6HcMi_CU3kRyTEx69fyK7A',
            'ChIJbweGsupCe3wRr22F3XdfxHg',
            'ChIJ-cbdeVXGqn4Rohy0nF5gfuc',
            'ChIJG519pu2wB3wR4biEhFb5pg0',
            'ChIJ0Y34pUAqVXkR7ayieeGRlm4',
            'ChIJYQTMBgOiU1MRjYn2mcR_cmM',
            'ChIJN1hNwZZ-t4kRofeKG08N4zc',
            'ChIJH-7gtegPt4kRSuCHc6gCWbE',
            'ChIJswGodJnVyokRGeb1hydgsnc',
            'ChIJh6O4gzUytokRc2ipdwYZC3g',
            'ChIJp_ap_s1LtokR_Lf7mF9L8mg',
            'ChIJ5XjbKEAl5YkR3LgllJt1C08',
            'ChIJa2reu3vc-okRTcifBPmRozM',
            'ChIJi82Epg0Aw4kRBYbf88CH42w',
            'ChIJbeL7NKG8w4kRrh3vCNK0Vck',
            'ChIJ0UrHnkGrw4kRhaap0swA39s',
            'ChIJJ5ltyj6Tw4kRUrGazR0XLgo',
            'ChIJ4blltancw4kR0ZwQkSoA__s',
            'ChIJs-wyjgfPw4kRpyM0wCxA5CQ',
            'ChIJye24g0OWw4kRa6osNwPLVyM',
            'ChIJh7ZJcChswYkRWgFmCdLUJYw',
            'ChIJaRba7DIQw4kR1PxZFBmoKZE',
            'ChIJSU4MpbK_w4kRscwSKQMFq7o',
            'ChIJw9ucntdww4kRYBHfSAlyyNY',
            'ChIJE1ZD4HK6w4kRXelsizO4rG4',
            'ChIJsXxpOlWLwokRd1zxj6dDblU',
            'ChIJCSF8lBZEwokRhngABHRcdoI',
            'ChIJoQxey52xwokRap4G05mKJBs',
            'ChIJYeZuBI9YwokRjMDs_IEyCwo',
            'ChIJgyl7a4q5wokRpasvaS5bGeo',
            'ChIJK1kKR2lDwokRBXtcbIvRCUE',
            'ChIJ59T0ee9FwokReLy6NIUfJ1A',
            'ChIJJ3Ea8crJwokRTmgPSjoWmB8',
            'ChIJ1_mbyICu4IkRU18dDUkMxJU',
            'ChIJr1lrnWrJwokRidu9ImLYDjc',
            'ChIJXQMzOISixIkRNmmWbNFqb2w',
            'ChIJNVzHx-IWUocRZKRflosqhcI',
            'ChIJAzgQtl7mTYcR8r0FH_aWJes',
            'ChIJD6ene522t4kRNL6FM2ADhuA',
            'ChIJ7QtTHOLgtYkR2RSa-W9Lg50',
            'ChIJH_FS1XiCtokRmgRQDbYVQhw',
            'ChIJ0wxG_rFgtokRmRY44U76C30',
            'ChIJkRS43yN8tokRRJJmXKleaws',
            'ChIJNXQSmXQWtokRjBiEklejIxU',
            'ChIJSeDx1KI_tIkRiEd-Vx3Eu3I',
            'ChIJy6miVR0itIkR-4bjMz3EgEg',
            'ChIJ5eWt888ttIkR0Nf1tvqfsBE',
            'ChIJe-TZuru5tokRuSLsz7C7Dbc',
            'ChIJUVC2ZHTvtokRLqph6kOLUzA',
            'ChIJk7pLNp_atYkRBetwmHZzIps',
            'ChIJ8aukkz5NtokRLAHB24Ym9dc',
            'ChIJzZFLOZZOtokRQIZEhecmIwc',
            'ChIJrWNGem5LtokRWZc9l4hmU24',
            'ChIJJeDquuvBtokRoZGmIQpFpn8',
            'ChIJi9Zl1IBbtokRUuf7tl6bUoM',
            'ChIJubEj6XNbtokRHIdv7zwLvKc',
            'ChIJ0fpRcTUHyokRgdS_3GXAWhE',
            'ChIJV3wGpVVrUlMR3m18oGf5rvk',
            'ChIJCzYy5IS16lQRQrfeQ5K5Oxw',
            'ChIJDelmP7YBpkwRRj4WOtMWNIY',
            'ChIJ35OWnPNrPIYRB65ZhX_xV40',
            'ChIJCzYy5IS16lQRQrfeQ5K5Oxw',
            'ChIJVyxbSAS3QYcRWopZf0qZ0ug',
            'ChIJMU8qI_lPhIARfMUQoxvSFP4',
            'ChIJHWD_IzDr24ARKAeA6yv9DTU',
            'ChIJN3gtg4xckFQRPuBki2urgOI',
            'ChIJKW3I8lgDkVQRH8AROLqXyg0',
            'ChIJybF97ueemlQRqURMGYrDDmc',
            'ChIJu4HI4ohcaocRaP8eOJik0GI',
            'ChIJqXcAstJi6YARs7DDR_CQld0',
            'ChIJzSTYCxNxQYcRk_KseUv7X-0',
            'ChIJVyxbSAS3QYcRUtO4yC-Bohw',
            'ChIJUV7XWK6z7IARFNInOyD3gBc',
            'ChIJX3PwOP2E7IAR9ToVLk_oEGY',
            'ChIJlY6uZSRLYYgRxiQlGHwCm2s',
            'ChIJi_YPrUmeZIgRo5ciMDc_CWw',
            'ChIJPZDrEzLsZIgRN4SPG6TwQJU',
            'ChIJkxh84AG0ZIgRPQJPpE_mLqY',
            'ChIJt3YaEbGKZogRjUlGfmuKDnA',
            'ChIJeZACQhhsY4gR3P1rWRwT0ME',
            'ChIJSZoDIMxVZIgRCM0qa83_1KA',
            'ChIJY3uH9qr5Y4gRSc3S3p8qWsk',
            'ChIJYZI-rWaTZogRMfMLUoLtkpo',
            'ChIJ_WmAQCgvZIgRZmf7nHhvxGo',
            'ChIJv_juAUknZIgR9WMpJ3kXSw8',
            'ChIJNUn54OB4Y4gRk0nGyKUQcOU',
            'ChIJc0Wm9NN0ZIgRTPRInI3wKNs',
            'ChIJmxojnNyG2ogRIGAhTf-Tm3I',
            'ChIJkZS2D5W2OIcRnCDJ-x92fYs',
            'ChIJj7atfV0ihIAR_qYnBSATSUk',
            'ChIJxXGuYuzba4cRzUewqXMASX8',
            'ChIJ-dGew1EYQocRZA3rearTJXE',
            'ChIJtTxVCm8B5IkRdQoXNfYjl6Q',
            'ChIJmQwtQe4L5IkRCLDyk1MVcOI',
            'ChIJmQwtQe4L5IkR_XElq-CRdoo',
            'ChIJgZI3cb8O5IkRWOr57wXcX00',
            'ChIJ6TarW9Sc44kR4nUWuotzEyI',
            'ChIJfbhY9-fx4okRG0Ob6F11-Qw',
            'ChIJ6VJRvkKC4okRDLUGGUHWCNE',
            'ChIJ1YMtb8cU6YARSHa612Q60cg',
            'ChIJB6GazydAbIcRWmr4AmHfJ_A',
            'ChIJDYo7vUlebIcRfni-5Dcedpo',
            'ChIJO_iIW8yKa4cRsEK8kOiXBQc',
            'ChIJr3DC7TOla4cRP3Q6xF1Y7wU',
            'ChIJzxcfI6qAa4cR1jaKJ_j0jhE',
            'ChIJxyXdfv2-bIcRWOQrqaUIXjI',
            'ChIJO6_9uyIjbYcRd5v-9MpmWX4',
            'ChIJl3J4eE28a4cRJaznG0rc18k',
            'ChIJyxAXZg2va4cRgQv02X4ue50',
            'ChIJU5Ko564ha4cRi1ywfW51ffg',
            'ChIJhQd-sopHmoARt9CBUcuaJB4',
            'ChIJk-ZOZm4Sm4AR8eQ1nDcJNKA',
            'ChIJ2YAlNVPHmoARfxR2QbW1CPI',
            'ChIJ69wnuncnhYAR4jxmM3iXoXE',
            'ChIJYweZp3CrrIARaGNmCBxZ7lo',
            'ChIJeT4Ip-XiUocRN1n25stD_W4',
            'ChIJ4b7c93BLUocRewgzCfsFIdU',
            'ChIJl4p9NQsMU4cR9JTLDJTyBWM',
            'ChIJuYu0yYhKqlQR-N15TSEoSRU',
            'ChIJOYAJvNzmq1QRvdGkrGK8hco',
            'ChIJgXGMHTpq3YkRLcG0JidTOfc',
            'ChIJC1B7Fc3S3IkRu6ik0rYBvT4',
          ];
          async function initMap() {
            const { Map } = await google.maps.importLibrary("maps");

            map = new Map(document.getElementById("loan-limits-map"), {
              // zoom: 9,
              // center: { lat: 39.103119, lng: -84.512016 },
              zoom: 4,
              center: { lat: 38.698448, lng: -96.656159 },
              streetViewControl: false,
              mapId: '235da963595a119d',
            });
            featureLayer = map.getFeatureLayer("ADMINISTRATIVE_AREA_LEVEL_2");
            styleBoundary();
          }
          function styleBoundary() {
            // Define a style of transparent purple with opaque stroke.
            const styleFill = /** @type {!google.maps.FeatureStyleOptions} */ ({
              strokeColor: "#009BFF",
              strokeOpacity: 1.0,
              strokeWeight: 3.0,
              fillColor: "#009BFF",
              fillOpacity: 0.2,
            });

            // Define the feature style function.
            featureLayer.style = (params) => {
              if (!NOT_BASE_COUNTIES.includes(params.feature.placeId)) {
                return styleFill;
              }
            };
          }
          initMap();
        </script>
        <h2>What Is A Mortgage Loan Limit?</h2>
        <p>Mortgage loan limits are the upper boundaries for how much a home buyer can borrow on a mortgage. Loan limits vary by home type and county, with some counties receiving the <a href="<?php echo home_url(); ?>/learn/high-cost-area">high-cost areas</a> designation.</p>
        <p>The Federal Housing Finance Agency (FHFA) sets mortgage loan limits for conforming mortgages and the Federal Housing Administration (FHA) sets loan limits for <a href="<?php echo home_url(); ?>/learn/fha-loans">FHA mortgages</a>.  In the U.S., the <?php echo YEAR; ?> conforming mortgage loan limit for a 1-unit home is $<?php echo number_format($data['oneUnitConforming'][YEAR]); ?>. The <?php echo YEAR; ?> FHA mortgage loan limit for a 1-unit home is $<?php echo number_format($data['oneUnitFha'][YEAR]); ?>.</p>
        <p>Conforming and FHA mortgage loan limits change annually to reflect changes in local and national home values. Loans that exceed conforming loan limit sizes are commonly called jumbo mortgages. In <?php echo YEAR; ?>, there are no mortgage loan limits for <a href="<?php echo home_url(); ?>/learn/va-loans">VA loans</a> or <a href="<?php echo home_url(); ?>/learn/usda-mortgage">USDA loans</a>.</p>
        <div class="mb-14">
          <div class="rounded-2xl overflow-hidden w-full aspect-video mb-4">
            <?php echo do_shortcode("[lyte id='$youtubeId']"); ?>
          </div>
          <small>Video Length: <?php echo gmdate("i:s", $youtubeDuration); ?></small>
        </div>
        <h2>Mortgage Loan Limits in the 10 Largest U.S. Counties</h2>
        <p>Get <?php echo YEAR; ?> conforming and FHA mortgage loan limits for the 10 largest U.S. counties. Local loan limits and county-level mortgage data updated regularly.</p>
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
          ?>
        </div>
        <h2>Historical Charts: Mortgage Loan Limits in the U.S.</h2>
        <p>Mortgage loan limits adjust annually to match changes in U.S. home values. Changes in mortgage loan limits promote affordable homeownership, fair lending, and a balanced housing market.</p>
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
        <h2 id="mortgage-stats">National Mortgage Statistics</h2>
        <p>National mortgage statistics for the most recently-available five-year period as sourced from the Home Mortgage Disclosure Act (HMDA) database and maintained by the Federal Financial Institutions Examination Council (<a href="https://ffiec.cfpb.gov">FFIEC</a>). The HMDA database stores detailed, anonymous loan data on a national basis and provides insight into home buyer traits, mortgage borrowing patterns, and mortgage approval rates. Percentages may not total 100% due to rounding.</p>
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
          <small>U.S. data represents closed-end, first-lien purchase mortgages for residential properties, 1-4 units, for the 5-year period 2018-2022. Source: FFEIC Home Mortgage Disclosure Act</small>
        </div>
        <h2>Mortgage Statistics in the 10 Largest U.S. Counties</h2>
        <p>Get mortgage statistics for the 10 largest U.S. counties. County-level mortgage statistics updated regularly.</p>
        <div class="grid gap-4 md:gap-8 grid-cols-2 md:grid-cols-3 mb-14">
          <?php
            foreach ($data['nearby'] as $key => $value) {
            get_template_part(
              'partials/loan-limits-card',
              null,
              [
                'url' => home_url() . '/mortgage-loan-limits/' . $key . '#mortgage-stats',
                'title' => 'Mortgage Statistics',
                'link_text' => $value,
              ],
            );
            }
          ?>
        </div>
        <!-- Article Footer -->
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
        <h2>See Today’s U.S. Mortgage Rates</h2>
        <p>Homebuyer.com is the mortgage company for first-time home buyers. Check your eligibility for <a href="https://homebuyer.com/learn/first-time-home-buyer-grants-programs">first-time home buyer programs</a> and look at today's low down-payment mortgages. Get pre-approved online in just three minutes.</p>
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

