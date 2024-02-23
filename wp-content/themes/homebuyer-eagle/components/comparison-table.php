<?php
$hostname = parse_url(get_site_url(), PHP_URL_HOST);
$target = 'https://api.homebuyer.com/v1';

if (preg_match("/local/i", $hostname)) {
  $target = 'http://localhost:4000/dev';
} else if (preg_match("/stage/i", $hostname)) {
  $target = 'https://api-staging.homebuyer.com/v1';
}
?>
<script>
  const ComparisonTable = (props) => ({
    $template: '#comparison-table-template',
    el: null,
    props,
    loading: true,
    rates: [],
    async mounted(el) {
      // Fetch error should send to error reporting and keep the loading state
      const response = await fetch("<?php echo $target; ?>/rates/todays-rates");
      const rates = await response.json();
      // console.log({ rates });
      const us = rates.findIndex(rate => rate.slug === 'homebuyer');
      // Get HB rate and rates after it
      for (let i = 0; i < rates.length; i++) {
        if (i < us || this.rates.length >= 4) continue;
        this.rates.push({
          ...rates[i],
          isHB: rates[i].slug === 'homebuyer',
          logo: `<?php echo get_template_directory_uri(); ?>/images/lenders/${rates[i].slug}.png`,
        });
      }
      // Backfill from start, until we have four
      for (let i = 0; i < rates.length && this.rates.length < 4; i++) {
        if (i === us) break;
        this.rates.push({
          ...rates[i],
          isHB: rates[i].slug === 'homebuyer',
          logo: `<?php echo get_template_directory_uri(); ?>/images/lenders/${rates[i].slug}.png`,
        });
      }
      this.el = el;
      this.loading = false;
    },
    toggle(e) {
      e.preventDefault();
      const disclosure = this.el.querySelector('[data-disclosure]');
      const copy = disclosure.querySelector('div');
      const intro = disclosure.querySelector('p:nth-child(2)');
      const arrow = this.el.querySelector('[data-toggle] span');
      if (intro.style['-webkit-line-clamp'] === 'initial') {
        intro.style['-webkit-line-clamp'] = 2;
        copy.style.display = 'none';
        arrow.classList.remove('mdi-arrow-up');
        arrow.classList.add('mdi-arrow-down');
        window.scroll({
          top: disclosure.offsetTop,
          left: 0,
          behavior: 'instant',
        });
      } else {
        intro.style['-webkit-line-clamp'] = 'initial';
        copy.style.display = 'block';
        arrow.classList.remove('mdi-arrow-down');
        arrow.classList.add('mdi-arrow-up');
      }
    },
    formatRate(value) {
      if (value !== null) return numeral(parseFloat(value) * 100).format('9.000') + '%';
    },
    formatPoints(value) {
      if (value !== null) return numeral(parseFloat(value) * 100).format('9.000');
    },
    formatDollars(value) {
      if (value === 0 || value > 0) return numeral(value).format('$0,0');
      if (!value) return null;
      return '(' + numeral(Math.abs(value)).format('$0,0') + ')';
    },
    formatDate(input) {
      const date = new Date(input);
      return date.toLocaleString('en-US', { timeZone: 'America/New_York', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit', hour12: true, timeZoneName: 'short' });
    },
  });
</script>

<template id="comparison-table-template">
  <label v-if="loading" class="block text-center mb-12">Last updated: <span class="skeleton-loader ml-2 align-middle h-4 w-70 rounded"></span></label>
  <label v-else class="block text-center mb-12">Last updated: {{ formatDate(rates[0].createdAt) }}</label>
  <div class="mb-8">
    <div v-if="loading" class="flex flex-col gap-8">
      <div class="skeleton-loader h-30 rounded-lg"></div>
      <div class="skeleton-loader h-30 rounded-lg"></div>
      <div class="skeleton-loader h-30 rounded-lg"></div>
      <div class="skeleton-loader h-30 rounded-lg"></div>
    </div>
    <div v-else class="flex flex-col gap-8">
      <template v-for="rate in rates" :key="rate.lender">

        <!-- Desktop Rate Row
        ================================================== -->

        <div
          class="hidden md:grid h-30 w-full py-6 px-14 bg-white rounded-xl grid-cols-5 items-center content-center gap-4"
          :class="{ '!bg-brand-purple-lighter': rate.isHB, 'border': rate.isHB, 'border-brand-purple': rate.isHB }"
        >
          <div class="w-40">
            <img :src="rate.logo" alt="{{ rate.lender }} logo">
          </div>
          <div class="flex flex-col">
            <div class="text-brand-gray font-sans-bold">Term</div>
            <div class="text-2xl text-brand-gray-dark font-sans">30 Years</div>
          </div>
          <div class="flex flex-col">
            <div class="text-brand-gray font-sans-bold">APR</div>
            <div class="text-2xl text-brand-gray-dark font-sans">{{ formatRate(rate.apr) }}</div>
          </div>
          <div class="flex flex-col">
            <div class="text-brand-gray font-sans-bold">Points (cost)</div>
            <div class="text-2xl text-brand-gray-dark font-sans">{{ formatPoints(rate.points) }} ({{ formatDollars(rate.cost) }})</div>
          </div>
          <div class="flex flex-col">
            <div class="text-brand-gray-dark font-sans-bold">Rate</div>
            <div class="text-2xl text-brand-red font-sans" :class="{ '!text-brand-purple': rate.isHB }">{{ formatRate(rate.thirtyYearFixed) }}</div>
          </div>
        </div>

        <!-- Mobile Rate Row
        ================================================== -->

        <div
          class="block md:hidden w-full py-6 px-4 bg-white rounded-xl"
          :class="{ '!bg-brand-purple-lighter': rate.isHB, 'border': rate.isHB, 'border-brand-purple': rate.isHB }"
        >
          <div class="flex items-center gap-8 mb-2">
            <div class="w-1/2">
              <img :src="rate.logo" alt="{{ rate.lender }} logo">
            </div>
            <div class="w-1/2 flex flex-col">
              <div class="text-brand-gray-dark font-sans-bold">Rate</div>
              <div class="text-lg text-brand-red font-sans" :class="{ '!text-brand-purple': rate.isHB }">{{ formatRate(rate.thirtyYearFixed) }}</div>
            </div>
          </div>
          <div class="flex items-center gap-4">
            <div class="w-1/4 flex flex-col">
              <div class="text-brand-gray font-sans-bold">Term</div>
              <div class="text-lg text-brand-gray-dark font-sans">30 Years</div>
            </div>
            <div class="w-1/4 flex flex-col">
              <div class="text-brand-gray font-sans-bold">APR</div>
              <div class="text-lg text-brand-gray-dark font-sans">{{ formatRate(rate.apr) }}</div>
            </div>
            <div class="w-2/4 flex flex-col">
              <div class="text-brand-gray font-sans-bold">Points (cost)</div>
              <div class="text-lg text-brand-gray-dark font-sans">{{ formatPoints(rate.points) }} ({{ formatDollars(rate.cost) }})</div>
            </div>
          </div>
        </div>

      </template>
    </div>
  </div>
  <div data-disclosure class="mb-2">
    <p class="text-center mb-2">
      <strong>Mortgage Rate Assumptions</strong>
    </p>
    <p v-if="loading" class="mb-2 line-clamp-2 text-ellipsis">
      The Homebuyer.com mortgage rates shown on this page are based on assumptions about you, your home, and the state where you plan to purchase. The rate shown is accurate as of <span class="skeleton-loader ml-2 align-middle h-4 w-70 rounded"></span>, but please remember that mortgage rates change without notice based on mortgage bond market activity.
    </p>
    <p v-else class="mb-2 line-clamp-2 text-ellipsis">
      The Homebuyer.com mortgage rates shown on this page are based on assumptions about you, your home, and the state where you plan to purchase. The rate shown is accurate as of {{ formatDate(rates[0].createdAt) }}, but please remember that mortgage rates change without notice based on mortgage bond market activity.
    </p>
    <div class="hidden">
      <p class="mb-2">
        Our mortgage rate assumptions may differ from those made by the other mortgage lenders in the comparison table. Your actual mortgage rate, APR, points, and monthly payment are unlikely to match the table above unless you match the description below:
      </p>
      <p class="mb-2">
        You are a first-time buyer purchasing a single-family home to be your primary residence in any state other than New York, Hawaii, and Alaska. You have a credit score of 660 or higher.  You are making a down payment of twenty percent and using a 30-year conventional fixed-rate mortgage. You earn a low-to-moderate household income relative to your area. 
      </p>
      <p class="mb-2">
        The information provided is for informational purposes only and should not be confused for a mortgage rate commitment or a mortgage loan approval.
      </p>
      <div v-if="rates.length">
        <p class="text-center mb-2">
          <strong>Legal Disclosures</strong>
        </p>
        <template v-for="rate in rates" :key="rate.lender">
          <p class="mb-2">
            <strong>{{ rate.lender }}.</strong> The {{ formatRate(rate.thirtyYearFixed) }} mortgage rate ({{ formatRate(rate.apr) }} APR) shown above for {{ rate.lender}} is based on information published on the lender's website and retrieved on {{ formatDate(rate.createdAt) }}.  According to its website, {{ rate.lender }}'s published rate requires home buyers to pay {{ formatPoints(rate.points) }} points at closing, totaling {{ formatDollars(rate.cost) }}, on an example {{ formatDollars(rate.loanAmount) }} 30-year fixed-rate conventional mortgage. Its mortgage rate assumes the home buyer will make a {{ formatDollars(rate.downPayment) }} downpayment or larger and purchase a single-family residence. Its mortgage rate also assumes that the home buyer will have a credit score of {{ rate.fico }} or higher. The monthly payment for the mortgage with the above terms is {{ formatDollars(rate.monthlyPayment) }} for 360 months, plus taxes and insurance premiums. {{ rate.lender }} provides this information for estimation purposes only and does not guarantee accuracy. Your mortgage rate, APR, loan size, and fees may vary. 
          </p>
        </template>
      </div>
    </div>
  </div>
  <p class="text-center">
    <a class="block" data-toggle href="#" @click="toggle" aria-label="View full disclosure">
      View Full Disclosure <span class="mdi mdi-arrow-down align-middle"></span>
    </a>
  </p>
</template>
