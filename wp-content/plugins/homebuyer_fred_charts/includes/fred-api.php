<?php 
function fetch_fred_data_and_store_as_xml($api_key, $series_id, $series_label, $frequency, $series_type) {
    $xml_data = fetch_fred_series_data($api_key, $series_id, $series_label, $frequency);

    if (is_wp_error($xml_data)) {
        return new WP_Error('fetch_error', $xml_data->get_error_message());
    }
    $attach_id = homebuyer_fred_charts_store_xml($xml_data, $series_id, $series_label, $series_type);

    if (is_wp_error($attach_id)) {
        return new WP_Error('store_error', 'Failed to store XML file in Media Library: ' . $attach_id->get_error_message());
    }

    return $attach_id;
}
function fetch_fred_series_data($api_key, $series_id, $series_label, $frequency) {
    $url = "https://api.stlouisfed.org/fred/series/observations?api_key=" . urlencode($api_key) . "&series_id=" . urlencode($series_id) . "&frequency=" . urlencode($frequency) . "&file_type=xml";
    $response = wp_remote_get($url);

    if (is_wp_error($response) || wp_remote_retrieve_response_code($response) != 200) {
        return new WP_Error('request_failed', 'The request to the FRED API failed.' . $url);
    }

    // Get the body of the response as XML
    $body = wp_remote_retrieve_body($response);

    // Simple check to confirm it's an XML response
    if (strpos($body, '<?xml') === false) {
        return new WP_Error('invalid_xml', 'Invalid XML returned from the FRED API.');
    }
    return $body;
}
function homebuyer_fred_charts_store_xml($xml_content, $series_id, $series_label, $series_type) {
    // List of series IDs that require appending
    // EXHOSLUSM495S Existing Home Sales
    // HOSSUPUSM673N Existing Home Supply
    // HOSINVUSM495N Existing Home Inventory
     $append_series_ids = ['EXHOSLUSM495S', 'HOSSUPUSM673N', 'HOSINVUSM495N']; // Add your series IDs here

    // Load XML
    $xml = simplexml_load_string($xml_content);
    if ($xml === false) {
        return new WP_Error('xml_parsing_error', 'Failed to parse XML string.');
    }

    // Initialize or load existing data
    $data = [];
    $isAppending = in_array($series_id, $append_series_ids);

    if ($isAppending) {
        // If the series requires appending, load existing data if available
        $data = load_existing_data($series_id);
    } else {
        // If not, initialize new data structure
        $data = [
            'title' => $series_label,
            'type' => $series_type,
            'updatedAt' => current_time('mysql'),
            'values' => []
        ];
    }

    // Parse each observation
    foreach ($xml->observation as $observation) {
        $date = (string)$observation['date'];
        $value = (float)$observation['value'];

        // Convert the date format to 'Y-m-d'
        $formattedDate = DateTime::createFromFormat('Y-m-d', $date)->format('Y-m-d');

        // Append new data or overwrite existing data based on series ID 
        if (!$isAppending || !array_key_exists($formattedDate, $data['values']) || ($value > 0)) {
            $data['values'][$formattedDate] = $value;
        }
    }

    // Get uploads directory
    $upload_dir = wp_upload_dir();
    $upload_base_dir = $upload_dir['basedir'];
    $fred_data_dir = $upload_base_dir . '/FRED_data';

    // Ensure the FRED_data directory exists
    if (!file_exists($fred_data_dir)) {
        wp_mkdir_p($fred_data_dir);
    }

    // Prepare file path in the new directory
    $filename = sanitize_file_name($series_id) . '.txt';
    $file_path = $fred_data_dir . '/' . $filename;
    
    // Serialize the PHP object and save it
    $serializedData = serialize($data);
    $result = file_put_contents($file_path, $serializedData);

    if ($result === false) {
        return new WP_Error('file_write_error', 'Failed to write PHP object to FRED_data directory.');
    }

    return $file_path; // Return the path of the saved file
}

function process_fred_data($api_key, $series_data) {
    $successCount = 0;
    $errors = [];

    foreach ($series_data as $id => $entry) {
        $result = fetch_fred_data_and_store_as_xml($api_key, $entry['id'], $entry['label'], $entry['frequency'], $entry['type']);
        
        if (is_wp_error($result)) {
            // Collect error messages
            $errors[] = 'Error for series ID ' . $entry['id'] . ': ' . $result->get_error_message();
        } else {
            // Count successful operations
            $successCount++;
        }
    }

    // Display grouped success message
    if ($successCount > 0) {
        homebuyer_fred_charts_add_admin_notice($successCount . ' series processed successfully', 'success');
    }

    // Display individual error messages
    foreach ($errors as $error) {
        homebuyer_fred_charts_add_admin_notice($error, 'error');
    }

    wp_redirect(html_entity_decode($_SERVER['REQUEST_URI']));
    exit;
}

function load_existing_data($series_id) {
    // Get uploads directory
    $upload_dir = wp_upload_dir();
    $upload_base_dir = $upload_dir['basedir'];
    $fred_data_dir = $upload_base_dir . '/FRED_data';

    // Prepare file path
    $filename = sanitize_file_name($series_id) . '.txt';
    $file_path = $fred_data_dir . '/' . $filename;

    // Check if the file exists
    if (file_exists($file_path)) {
        // Read the serialized data from the file
        $serialized_data = file_get_contents($file_path);

        // Unserialize the data
        $data = unserialize($serialized_data);

        // Check if the data is in the expected format
        if (is_array($data) && isset($data['values'])) {
            return $data;
        }
    }

    // If the file doesn't exist or data is not in the expected format,
    // return an empty data structure
    return [
        'title' => '',
        'type' => '',
        'updatedAt' => current_time('mysql'),
        'values' => []
    ];
}
?>