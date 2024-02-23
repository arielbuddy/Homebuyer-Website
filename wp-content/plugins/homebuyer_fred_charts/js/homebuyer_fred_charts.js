/*******************************************************************************
 * CHARTS
 */

function initFREDCharts (id) {
  const top = document.getElementById(id);
  const active = ['text-brand-purple', 'font-sans-medium', 'border-b-2', 'border-brand-purple'];
}

/*******************************************************************************
 * CHARTS.JS
 */

function renderFREDChart(id, chart, formatType) {
    let formatter;

    switch (formatType) {
        case 'currency':
            formatter = new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'USD',
                maximumFractionDigits: 0
            });
            break;
        case 'number':  // integers with commas
            formatter = new Intl.NumberFormat('en-US', {
                maximumFractionDigits: 0, // No decimal part
                useGrouping: true  // Use comma as thousands separator
            });
            break;
        case 'percentage':
            formatter = {
                format: function(value) {
                    return (value / 100).toLocaleString('en-US', {
                        style: 'percent',
                        maximumFractionDigits: 2
                    });
                }
            };
            break;
        default:
            formatter = new Intl.NumberFormat('en-US', {
                maximumFractionDigits: 0, // No decimal part
                useGrouping: true  // Use comma as thousands separator
            });
            break;
    }


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
      pointRadius: 0,
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
    display: false,
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
                    if (formatType === 'percentage') {
                        // Convert to decimal format and format with two decimal places
                        return (value / 100).toLocaleString('en-US', {
                            style: 'percent',
                            maximumFractionDigits: 2
                        });
                    }
                    // For other format types, just format the value
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


	new Chart(document.getElementById(id), {
	  type: 'line',
	  data: {
		datasets: [
		  {
			label: chart.value.label,
			data: chart.value.data,
			spanGaps: true, // Add spanGaps here
			...getLineOpts('#009BFF', 'origin'),
		  },
		],
	  },
	  options: {
		plugins: {
		  legend: legend,
		  tooltip: tooltip,
		},
		scales: scales,
		spanGaps: true,
	  },
	});
}
