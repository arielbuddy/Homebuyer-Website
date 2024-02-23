<?php

function homebuyer_fred_charts_shortcode($atts) {
    // Extract shortcode attributes
    $atts = shortcode_atts(array(
        'series_id' => '', // Default value if no series_id is provided
        'series_label' => '', // Default label if none is provided
        'series_source' => '', // Default source if none is provided
        'series_start' => '', // Start date for filtering data, default is blank
        'series_end' => '', // End date for filtering data, default is blank
    ), $atts);

    $filename = sanitize_file_name($atts['series_id']) . '.txt';
    
    // Get the WordPress uploads directory
    $upload_dir = wp_upload_dir();
    $upload_base_dir = $upload_dir['basedir'];
    
    // Specify the FRED_data subdirectory
    $fred_data_dir = $upload_base_dir . '/FRED_data';
    
    // Construct the full file path
    $file_path = $fred_data_dir . '/' . $filename;
    
    // Check if the file exists
    if (!file_exists($file_path)) {
        return "This chart is temporarily available (Code: " . $atts['series_id']. ").";
    }

    // Read the serialized data from the file
    $serialized_data = file_get_contents($file_path);

    // Unserialize the data
    $data = unserialize($serialized_data);
    if ($data === false) {
        return "This chart is temporarily available (Data Code: " . $atts['series_id']. ").";
    }

	// Initialize an empty array to hold filtered values
	$filteredValues = [];

	// Iterate through each element in $data['values']
	foreach ($data['values'] as $date => $value) {
		// Convert the value to a number and check if it is not equal to 0
		if (floatval($value) !== 0.0) {
			// If the value is not 0, add it to the filteredValues array
			$filteredValues[$date] = $value;
		}
	}

	// Replace the original values with the filtered values
	$data['values'] = $filteredValues;


    // Filter the data based on series_start and series_end
    if (!empty($atts['series_start']) && !empty($atts['series_end'])) {
        $seriesStart = strtotime($atts['series_start']);
        $seriesEnd = strtotime($atts['series_end']);
        $filteredData = array_filter($data['values'], function($key) use ($seriesStart, $seriesEnd) {
            $currentDate = strtotime($key);
            return ($currentDate >= $seriesStart && $currentDate <= $seriesEnd);
        }, ARRAY_FILTER_USE_KEY);
        $data['values'] = $filteredData;
    }
    
    $series_type = $data['type'];
    $series_label = $data['title']; 

    // Output structure
    $output = "<div class='mt-8 mb-4' id='fred-charts'>";
    $output .= "<div data-fred-chart><canvas id='" . esc_attr($atts['series_id']) . "-canvas'></canvas></div>";
    $output .= "</div>";
    $output .= "<script src='https://cdn.jsdelivr.net/npm/chart.js'></script>";
    $output .= "<script>
        window.addEventListener('load', function () {
            initFREDCharts('fred-charts');
            const " . esc_js($atts['series_id']) . " = {
                value: {
                    label: '" . esc_js($atts['series_label']) . "',
                    data: " . json_encode($data['values']) . ",
                },
            };
            renderFREDChart('" . esc_attr($atts['series_id']) . "-canvas', " . esc_js($atts['series_id']) . ", '" . esc_js($series_type) ."');
        });
    </script>";

    // Check if 'series_source' is set and not empty
    if (!empty($atts['series_source'])) {
        $output .= "<small>Homebuyer.com uses the FRED® API but is not endorsed or certified by the Federal Reserve Bank of St. Louis.<br />Data: " . esc_html($atts['series_source']) . ". Do not reprint without permission.</small>";
    }
    return $output;
}


?>