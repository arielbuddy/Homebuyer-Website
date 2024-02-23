<?php
// Prevent direct access to the file.
defined('ABSPATH') || die('No script kiddies please!');

/**
 * Gets the path to the mortgage-compare.json file in the WordPress uploads directory.
 *
 * @return string The file path.
 */
function homebuyer_mortgage_compare_get_json_file_path() {
    $upload_dir = wp_upload_dir();
    $sub_dir = trailingslashit($upload_dir['basedir']) . 'mortgage-compare';
    return $sub_dir . '/mortgage-compare.json';
}


/**
 * Saves data to a JSON file within a specific sub-directory in the WordPress uploads directory.
 *
 * @param mixed $data The data to be saved.
 * @return bool True on success, false on failure.
 */
function homebuyer_mortgage_compare_save_json_to_upload_dir($data) {
    $upload_dir = wp_upload_dir();
    $base_dir = trailingslashit($upload_dir['basedir']);
    $sub_dir = $base_dir . 'mortgage-compare';

    // Check if the directory exists, if not, create it.
    if (!file_exists($sub_dir)) {
        wp_mkdir_p($sub_dir);
    }

    $file_path = $sub_dir . '/mortgage-compare.json';

    return homebuyer_mortgage_compare_write_json($data, $file_path);
}


/**
 * Reads JSON data from a specified file.
 *
 * @param string $file_path Path to the JSON file.
 * @return mixed The data decoded from JSON, or null on error.
 */
function homebuyer_mortgage_compare_read_json($file_path) {
    // Check if the file exists.
    if (!file_exists($file_path)) {
        return null;
    }

    // Get file contents.
    $json_content = file_get_contents($file_path);
    if ($json_content === false) {
        return null;
    }

    // Decode the JSON data.
    $data = json_decode($json_content, true);

    return $data;
}

/**
 * Writes data to a JSON file.
 *
 * @param mixed  $data      The data to encode to JSON.
 * @param string $file_path Path to the JSON file to write.
 * @return bool True on success, false on failure.
 */
function homebuyer_mortgage_compare_write_json($data, $file_path) {
    // Encode data to JSON.
    $json_content = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    if ($json_content === false) {
        return false;
    }

    // Write to file.
    $result = file_put_contents($file_path, $json_content);

    return $result !== false;
}


/**
 * Retrieves data for the comparison table.
 *
 * @return array The structured data decoded from JSON, or an empty array if not found or on error.
 */
function homebuyer_mortgage_compare_get_data() {
    $file_path = homebuyer_mortgage_compare_get_json_file_path();
    $data = homebuyer_mortgage_compare_read_json($file_path);

    // If data is not an array, return an empty array.
    if (!is_array($data)) {
        return [];
    }

    // Return the data as is, without restructuring.
    return $data;
}
