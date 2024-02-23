/*******************************************************************************
 * TABLES
 */

function initTables (id) {
  const top = document.getElementById(id);
  const leftTab = top.querySelector('[data-left-table-tab]');
  const rightTab = top.querySelector('[data-right-table-tab]');
  const leftTable = top.querySelector('[data-left-table]');
  const rightTable = top.querySelector('[data-right-table]');

  const active = ['text-brand-purple', 'font-sans-medium', 'border-b-2', 'border-brand-purple'];

  leftTab.addEventListener('click', function () {
    leftTab.classList.add(...active);
    rightTab.classList.remove(...active);
    if (rightTable.style.display !== 'none') {
      window.animateCSS(rightTable, 'fadeOut').then(() => {
        window.animateCSS(leftTable, 'fadeIn');
        leftTable.style.display = 'block';
        rightTable.style.display = 'none';
      });
    }
  });

  rightTab.addEventListener('click', function () {
    rightTab.classList.add(...active);
    leftTab.classList.remove(...active);
    if (leftTable.style.display !== 'none') {
      window.animateCSS(leftTable, 'fadeOut').then(() => {
        window.animateCSS(rightTable, 'fadeIn');
        rightTable.style.display = 'block';
        leftTable.style.display = 'none';
      });
    }
  });
}

/*******************************************************************************
 * CHARTS
 */

function initCharts (id) {
  const top = document.getElementById(id);
  const leftTab = top.querySelector('[data-left-chart-tab]');
  const rightTab = top.querySelector('[data-right-chart-tab]');
  const leftChart = top.querySelector('[data-left-chart]');
  const rightChart = top.querySelector('[data-right-chart]');

  const active = ['text-brand-purple', 'font-sans-medium', 'border-b-2', 'border-brand-purple'];

  leftTab.addEventListener('click', function () {
    leftTab.classList.add(...active);
    rightTab.classList.remove(...active);
    if (rightChart.style.display !== 'none') {
      window.animateCSS(rightChart, 'fadeOut').then(() => {
        window.animateCSS(leftChart, 'fadeIn');
        leftChart.style.display = 'block';
        rightChart.style.display = 'none';
      });
    }
  });

  rightTab.addEventListener('click', function () {
    rightTab.classList.add(...active);
    leftTab.classList.remove(...active);
    if (leftChart.style.display !== 'none') {
      window.animateCSS(leftChart, 'fadeOut').then(() => {
        window.animateCSS(rightChart, 'fadeIn');
        rightChart.style.display = 'block';
        leftChart.style.display = 'none';
      });
    }
  });
}

/*******************************************************************************
 * SEARCH INPUT
 */

async function initSearch (homeUrl, inputId, buttonId) {
  let autocomplete;
  let target;

  const input = document.getElementById(inputId);
  const button = document.getElementById(buttonId);

  function removeDiacritics (str) {
    const characterMap = {
      ñ: 'n',
      ó: 'o',
      í: 'i',
      á: 'a',
      // Add more special characters and their replacements as needed
    };

    return str.normalize('NFKD').replace(/[^\w\s]|_/g, (char) => {
      return characterMap[char] || char;
    });
  }

  function kebabCase (str) {
    return removeDiacritics(str)
      .toLowerCase()                      // Convert the whole string to lowercase
      .replace(/([a-z])([A-Z])/g, '$1-$2')  // Convert camelCase to kebab-case
      .replace(/\s+|_+/g, '-')              // Replace spaces and underscores with dashes
      .replace(/[^a-zA-Z0-9-]+/g, '');       // Remove non-word characters
  }

  async function lookupAddress () {
    const place = autocomplete.getPlace();
    if (!place.address_components) return;
    // console.log({ place });

    const city = place.address_components.find(o => {
      return !!o.types.find(t => t === 'locality');
    });
    const county = place.address_components.find(o => {
      return !!o.types.find(t => t === 'administrative_area_level_2');
    });
    const state = place.address_components.find(o => {
      return !!o.types.find(t => t === 'administrative_area_level_1');
    });

    if (state.long_name === 'District of Columbia') {
      target = 'district-of-columbia';
    } else if (county && state) {
      target = kebabCase(county.long_name) + '-' + kebabCase(state.long_name);
    } else if (city && state) {
      target = kebabCase(city.long_name) + '-city-' + kebabCase(state.long_name);
      if (city.long_name === 'New York') {
        target = 'new-york-county-new-york';
      }
    } else if (state) {
      target = kebabCase(state.long_name);
    } else {
      return;
    }
    // console.log({ target });

    button.disabled = false;
  }

  const { Autocomplete } = await window.google.maps.importLibrary("places");
  autocomplete = new Autocomplete(input, {
    fields: ["address_components"],
    types: ["geocode"],
    componentRestrictions: { country: "us" },
  });
  autocomplete.addListener("place_changed", lookupAddress);

  input.addEventListener('focus', () => {
    button.disabled = true;
  });

  button.addEventListener('click', () => {
    window.location = homeUrl + '/mortgage-loan-limits/' + target;
  });
}

/*******************************************************************************
 * MAP
 */

async function renderMap (query, type, id) {
  let map;
  let featureLayer;
  const includedType = type === "state" ? "administrative_area_level_1" : "administrative_area_level_2";
  const featureType = includedType.toUpperCase();
  const baseUrl = "https://api.homebuyer.com/v1/geo/search";

  async function findBoundary(LatLngBounds) {
    let params = new URLSearchParams({ query, type: includedType });
    let response = await fetch(baseUrl + "?" + params);
    let result = await response.json();

    if (!result.place_id && type === "county") {
      params = new URLSearchParams({ query, type: 'locality' });
      response = await fetch(baseUrl + "?" + params);
      result = await response.json();
    }

    if (result.place_id) {
      styleBoundary(result.place_id);
      map.fitBounds(new LatLngBounds(result.viewport.southwest, result.viewport.northeast));
      if (type === "county") {
        map.setZoom(map.getZoom() - 1);
      }
    } else{
      console.log("No results");
    }
  }

  function styleBoundary(placeid) {
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
      if (params.feature.placeId == placeid) {
        return styleFill;
      }
    };
  }
 
  const { Map } = await window.google.maps.importLibrary("maps");
  const { LatLngBounds } = await window.google.maps.importLibrary("core")

  map = new Map(document.getElementById(id), {
    // zoom: 9,
    // center: { lat: 39.103119, lng: -84.512016 },
    zoom: 4,
    center: { lat: 38.698448, lng: -96.656159 },
    streetViewControl: false,
    mapId: '235da963595a119d',
  });
  featureLayer = map.getFeatureLayer(featureType);
  findBoundary(LatLngBounds);
}

/*******************************************************************************
 * CHARTS.JS
 */

function renderChart (id, chart) {
  const formatter = new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: 'USD',
    // minimumFractionDigits: 0, // (will print 2500.10 as $2,500.1)
    maximumFractionDigits: 0, // (causes 2500.99 to be printed as $2,501)
  });

  const hexToRGB = (hex) => {
    hex = hex.replace('#', '');

    const red = parseInt(hex.substr(0, 2), 16);
    const green = parseInt(hex.substr(2, 2), 16);
    const blue = parseInt(hex.substr(4, 2), 16);

    return `rgba(${red}, ${green}, ${blue}, 0.2)`;
  };

  const getLineOpts = (color, target) => {
    return {
      borderWidth: 1,
      borderColor: color,
      backgroundColor: hexToRGB(color),
      pointBackgroundColor: color,
      pointRadius: 2,
      tension: 0.1,
      fill: {
        target,
        above: hexToRGB(color),
      },
    };
  };

  const legend = {
    position: 'bottom',
    fillStyle: 'red',
    labels: {
      font: {
        size: 12,
        family: 'Circular Std'
      },
    },
  };

  const tooltip = {
    callbacks: {
      label: function(context) {
        let label = context.dataset.label || '';
        if (label) {
          label += ': ';
        }
        if (context.parsed.y !== null) {
          label += formatter.format(context.parsed.y);
        }
        return label;
      }
    },
  };

  const scales = {
    y: {
      ticks: {
        callback: function(value) {
          return formatter.format(value);
        },
      },
    },
    x: {
      ticks: {
        maxRotation: 90,
        minRotation: 90,
      },
    },
  };

  new window.Chart(document.getElementById(id), {
    type: 'line',
    data: {
      datasets: [
        {
          label: chart.oneUnit.label,
          data: chart.oneUnit.data,
          ...getLineOpts('#009BFF', 'origin'),
        },
        {
          label: chart.twoUnit.label,
          data: chart.twoUnit.data,
          ...getLineOpts('#C6C600', '0'),
        },
        {
          label: chart.threeUnit.label,
          data: chart.threeUnit.data,
          ...getLineOpts('#E76A5B', '1'),
        },
        {
          label: chart.fourUnit.label,
          data: chart.fourUnit.data,
          ...getLineOpts('#5462D1', '2'),
        },
      ],
    },
    options: {
      plugins: {
        legend,
        tooltip,
      },
      scales,
    },
  });
}
