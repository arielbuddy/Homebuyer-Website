// TABLES

document.getElementById('ll-conforming-table-tab').addEventListener('click', function (e) {
  document.getElementById('ll-conforming-table-tab').classList.add('active');
  document.getElementById('ll-fha-table').classList.remove('active');
  document.getElementById('ll-fha-table-tab').classList.remove('active');
  // Duration should match CSS transition
  setTimeout(() => {
    document.getElementById('ll-conforming-table').classList.add('active');
    document.getElementById('ll-conforming-table').style.display = 'block';
    document.getElementById('ll-fha-table').style.display = 'none';
  }, 250);
});

document.getElementById('ll-fha-table-tab').addEventListener('click', function (e) {
  document.getElementById('ll-fha-table-tab').classList.add('active');
  document.getElementById('ll-conforming-table').classList.remove('active');
  document.getElementById('ll-conforming-table-tab').classList.remove('active');
  // Duration should match CSS transition
  setTimeout(() => {
    document.getElementById('ll-fha-table').classList.add('active');
    document.getElementById('ll-fha-table').style.display = 'block';
    document.getElementById('ll-conforming-table').style.display = 'none';
  }, 250);
});

// CHARTS

document.getElementById('ll-conforming-chart-tab').addEventListener('click', function (e) {
  document.getElementById('ll-conforming-chart-tab').classList.add('active');
  document.getElementById('ll-fha-chart').classList.remove('active');
  document.getElementById('ll-fha-chart-tab').classList.remove('active');
  // Duration should match CSS transition
  setTimeout(() => {
    document.getElementById('ll-conforming-chart').classList.add('active');
    document.getElementById('ll-conforming-chart').style.display = 'block';
    document.getElementById('ll-fha-chart').style.display = 'none';
  }, 250);
});

document.getElementById('ll-fha-chart-tab').addEventListener('click', function (e) {
  document.getElementById('ll-fha-chart-tab').classList.add('active');
  document.getElementById('ll-conforming-chart').classList.remove('active');
  document.getElementById('ll-conforming-chart-tab').classList.remove('active');
  // Duration should match CSS transition
  setTimeout(() => {
    document.getElementById('ll-fha-chart').classList.add('active');
    document.getElementById('ll-fha-chart').style.display = 'block';
    document.getElementById('ll-conforming-chart').style.display = 'none';
  }, 250);
});

// SEARCH INPUT

async function initSearch (homeUrl) {
  let autocomplete;
  let place;
  let target;

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

    const county = place.address_components.find(o => {
      return !!o.types.find(t => t === 'administrative_area_level_2');
    });
    const state = place.address_components.find(o => {
      return !!o.types.find(t => t === 'administrative_area_level_1');
    });
    if (!county || !state) return;

    target = kebabCase(county.long_name) + '-' + kebabCase(state.long_name);
    // console.log({ target });

    document.getElementById("county-lookup-button").classList.remove("disabled");
    document.getElementById("county-lookup-button").disabled = false;
  }

  const { Autocomplete } = await google.maps.importLibrary("places");
  autocomplete = new Autocomplete(document.getElementById("county-lookup"), {
    fields: ["address_components"],
    types: ["geocode"],
    componentRestrictions: { country: "us" },
  });
  autocomplete.addListener("place_changed", lookupAddress);

  document.getElementById("county-lookup").addEventListener('focus', () => {
    document.getElementById("county-lookup-button").classList.add("disabled");
    document.getElementById("county-lookup-button").disabled = true;
  });

  document.getElementById("county-lookup-button").addEventListener('click', () => {
    window.location = homeUrl + '/mortgage-loan-limits/' + target;
  });
}

// MAP

async function renderMap (county) {
  let map;
  let featureLayer;
  let center;

  async function findBoundary(Place) {
    const request = {
      query: county,
      fields: ["id", "location"],
      includedType: "administrative_area_level_2",
      locationBias: center,
    };
    const { places } = await Place.searchByText(request);

    if (places.length) {
      const place = places[0];

      styleBoundary(place.id);
      map.setZoom(9);
      map.panTo(place.location);
    } else {
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
 
  const { Map } = await google.maps.importLibrary("maps");
  const { Place } = await google.maps.importLibrary("places");

  map = new Map(document.getElementById("ll-map"), {
    // zoom: 9,
    // center: { lat: 39.103119, lng: -84.512016 },
    zoom: 4,
    center: { lat: 38.698448, lng: -96.656159 },
    streetViewControl: false,
    mapId: '235da963595a119d',
  });
  featureLayer = map.getFeatureLayer("ADMINISTRATIVE_AREA_LEVEL_2");
  findBoundary(Place);
}

// CHARTS.JS

function renderCharts (conforming, fha) {
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
        family: 'circular'
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
        callback: function(value, index, ticks) {
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

  new Chart(document.getElementById('ll-conforming-canvas'), {
    type: 'line',
    data: {
      datasets: [
        {
          label: '1-Unit Property',
          data: conforming.oneUnit,
          ...getLineOpts('#009BFF', 'origin'),
        },
        {
          label: '2-Unit Property',
          data: conforming.twoUnit,
          ...getLineOpts('#C6C600', '0'),
        },
        {
          label: '3-Unit Property',
          data: conforming.threeUnit,
          ...getLineOpts('#E76A5B', '1'),
        },
        {
          label: '4-Unit Property',
          data: conforming.fourUnit,
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

  new Chart(document.getElementById('ll-fha-canvas'), {
    type: 'line',
    data: {
      datasets: [
        {
          label: '1-Unit Property',
          data: fha.oneUnit,
          ...getLineOpts('#009BFF', 'origin'),
        },
        {
          label: '2-Unit Property',
          data: fha.twoUnit,
          ...getLineOpts('#C6C600', '0'),
        },
        {
          label: '3-Unit Property',
          data: fha.threeUnit,
          ...getLineOpts('#E76A5B', '1'),
        },
        {
          label: '4-Unit Property',
          data: fha.fourUnit,
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
