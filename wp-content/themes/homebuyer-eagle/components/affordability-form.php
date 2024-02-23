<script>
  const AffordabilityForm = (props) => ({
    $template: '#affordability-form-template',
    input: null,
    error: false,
    props,
    city: null,
    state: null,
    postal: null,
    credit: '660',
    price: '130000',
    purpose: 'purchase',
    percentDown: '3',
    firstTime: true,
    veteran: false,
    timeframe: null,
    disclosureDialog: null,
    advancedDialog: null,
    async mounted(el) {
      this.disclosureDialog = el.querySelector('#disclosure-dialog');
      this.advancedDialog = el.querySelector('#advanced-dialog');
      this.input = document.getElementById('geo-lookup');

      this.input.addEventListener('keyup', () => {
        if (!this.input.value) {
          this.city = this.state = this.postal = null;
        }
        this.error = false;
      });

      let autocomplete;

      const { Autocomplete } = await window.google.maps.importLibrary("places");
      autocomplete = new Autocomplete(this.input, {
        fields: ["address_components"],
        types: ["geocode"],
        componentRestrictions: { country: "us" },
      });
      autocomplete.addListener("place_changed", () => {
        const place = autocomplete.getPlace();
        if (!place.address_components) return;
        // console.log({ place });
        this.city = this.state = this.postal = null;

        const city = place.address_components.find(o => {
          return !!o.types.find(t => t === 'locality');
        });
        const state = place.address_components.find(o => {
          return !!o.types.find(t => t === 'administrative_area_level_1');
        });
        const postal = place.address_components.find(o => {
          return !!o.types.find(t => t === 'postal_code');
        });
        if (!(city && state) && !postal) return;

        if (city && state) {
          this.city = city.short_name;
          this.state = state.short_name;
          this.error = false;
        }
        if (postal) {
          this.postal = postal.short_name;
          this.error = false;
        }
      });
    },
    onOpen(el) {
      el.querySelector('dialog [data-save]').addEventListener('click', this.onSave, { once: true });
      el.querySelector('dialog [data-cancel]').addEventListener('click', this.onCancel, { once: true });
    },
    onClose(e) {
      e.querySelector('dialog [data-purpose] select').value = this.purpose;
      e.querySelector('dialog [data-percent-down] select').value = this.percentDown;
      e.querySelector('dialog [data-first-time] select').value = this.firstTime;
      e.querySelector('dialog [data-veteran] select').value = this.veteran;
      e.querySelector('dialog [data-timeframe] select').value = this.timeframe;
    },
    openDisclosure(e) {
      e.preventDefault();
      this.disclosureDialog.showModal();
    },
    openAdvanced(e) {
      e.preventDefault();
      this.advancedDialog.showModal();
    },
    onCancel(e) {
      e.preventDefault();
      this.advancedDialog.setAttribute('close', true);
    },
    onSave(e) {
      e.preventDefault();
      this.purpose = this.advancedDialog.querySelector('dialog [data-purpose] select').value;
      this.percentDown = this.advancedDialog.querySelector('dialog [data-percent-down] select').value;
      this.firstTime = this.advancedDialog.querySelector('dialog [data-first-time] select').value;
      this.veteran = this.advancedDialog.querySelector('dialog [data-veteran] select').value;
      this.timeframe = this.advancedDialog.querySelector('dialog [data-timeframe] select').value;
      this.advancedDialog.setAttribute('close', true);
    },
    onUpdateCredit(e) {
      this.credit = e.target.value;
    },
    onUpdatePrice(e) {
      this.price = e.target.value;
    },
    isValid() {
      return (this.city && this.state) || this.postal;
    },
    onSubmit() {
      if (!this.isValid()) {
        this.error = true;
        this.input.focus();
        return;
      }

      window.dataLayer = window.dataLayer || [];
      window.dataLayer.push({
        event: 'Click',
        eventCategory: 'Pre-approval',
        eventLabel: 'home-afford-form',
        eventValue: this.credit,
      });

      const data = ({
        city: this.city,
        state: this.state,
        zip_code: this.postal,
        credit: this.credit,
        price: this.price,
        purpose: this.purpose,
        percentDown: this.percentDown,
        firstTime: this.firstTime,
        veteran: this.veteran,
        timeframe: this.timeframe,
      });
      Object.keys(data).forEach(k => data[k] === null && delete data[k]);
      const params = new URLSearchParams(data);
      window.location = 'https://app.homebuyer.com/?' + params;
    },
  });
</script>

<template id="affordability-form-template">
  <div class="w-full py-12 md:p-10 md:rounded-2xl md:bg-white md:shadow">
    <div class="flex flex-col md:flex-row md:items-end gap-4 mb-4">
      <div class="flex flex-col w-full">
        <label class="mb-1"><strong>City or ZIP Code</strong></label>
        <input :class="{ 'error': error }" class="text-input w-full" id="geo-lookup" placeholder="Type city or zip here" type="text" autocomplete="off">
      </div>
      <div class="flex flex-col w-full">
        <label class="mb-1"><strong>Credit Rating</strong></label>
        <div
          v-scope="SelectInput({
            options: [
              { title: 'Excellent (740+)', value: 740 },
              { title: 'Above avg (660-739)', value: 660, selected: true },
              { title: 'Average (620-659)', value: 620 },
              { title: 'Below avg (580-619)', value: 580 },
              { title: 'Poor (< 580)', value: 350 },
            ],
          })"
          @update="onUpdateCredit"
        ></div>
      </div>
      <div class="flex flex-col w-full">
        <label class="mb-1"><strong>Purchase Price</strong></label>
        <div
          v-scope="SelectInput({
            options: [
              { title: '$50,000 - $130,000', value: 50000 },
              { title: '$130,000 - $500,000', value: 130000, selected: true },
              { title: '$500,000 or more', value: 500000 },
            ],
          })"
          @update="onUpdatePrice"
        ></div>
      </div>
      <button class="btn-primary" @click="onSubmit">Continue</button>
    </div>
    <div class="flex justify-between">
      <small><a @click="openAdvanced" class="text-brand-purple underline hover:no-underline" href="#">View Advanced Options</a></small>
      <small><a @click="openDisclosure" class="text-brand-gray-dark mr-2 underline hover:no-underline" href="#">Advertising Disclosures</a></small>
    </div>
  </div>
  <div v-scope="Modal({ id: 'disclosure-dialog' })" @vue:mounted="mounted($el)">
    <slot>
      <strong>Advertising disclosure:</strong> Homebuyer.com may receive compensation from the
      companies and data providers that power' this webpage which may impact which products appear
      and in what order. Compensation is' higher for featured placements. This table only includes
      some companies and available' products.
    </slot>
  </div>
  <div v-scope="Modal({ id: 'advanced-dialog' })" @vue:mounted="mounted($el)" @close="onClose($el)" @open="onOpen($el)">
    <slot>
      <h4 class="mb-4">Advanced Options</h4>
      <div class="flex flex-col md:flex-row gap-4 mb-4">
        <div class="flex flex-col w-full">
          <label class="mb-1"><strong>Purpose?</strong></label>
          <div
            v-scope="SelectInput({
              options: [
                { title: 'Purchase', value: 'purchase' },
                { title: 'Refinance', value: 'refinance' },
              ],
            })"
            data-purpose
          ></div>
        </div>
        <div class="flex flex-col w-full">
          <label class="mb-1"><strong>Expected down payment</strong></label>
          <div
            v-scope="SelectInput({
              options: [
                { title: '3%', value: 3 },
                { title: '5%', value: 5 },
                { title: '10%', value: 10 },
                { title: '15%', value: 15 },
                { title: '20% or more', value: 20 },
              ],
            })"
            data-percent-down
          ></div>
        </div>
      </div>
      <div class="flex flex-col md:flex-row gap-4 mb-4">
        <div class="flex flex-col w-full">
          <label class="mb-1"><strong>First-time buyer?</strong></label>
          <div
            v-scope="SelectInput({
              options: [
                { title: 'Yes', value: true },
                { title: 'No', value: false },
              ],
            })"
            data-first-time
          ></div>
        </div>
        <div class="flex flex-col w-full">
          <label class="mb-1"><strong>Veteran?</strong></label>
          <div
            v-scope="SelectInput({
              options: [
                { title: 'No', value: false },
                { title: 'Yes', value: true },
              ],
            })"
            data-veteran
          ></div>
        </div>
      </div>
      <div class="flex flex-col w-full">
        <label class="mb-1"><strong>Timeframe</strong></label>
        <div
          v-scope="SelectInput({
            options: [
            { title: '', value: null },
            { title: 'I\'m under contract', value: 'Under contract' },
            { title: 'I\'m buying soon', value: 'Buying soon' },
            { title: 'I\'m just starting', value: 'Just starting' },
            ],
          })"
          data-timeframe
        ></div>
      </div>
      <div class="w-full mt-12 mb-6 flex gap-2 justify-end">
        <button data-cancel class="btn-secondary">Cancel</button>
        <button data-save class="btn-primary">Save</button>
      </div>
    </slot>
  </div>
</template>
