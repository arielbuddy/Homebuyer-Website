<?php
/**
 * Plugin Name: Homebuyer.com FRED Charts
 * Description: Retrieve data from the FRED API and display it in a blog post with shortcode
 * Version: 1.6
 * Author: Dan Green, Homebuyer.com
 * Requires at least: 6.3
 */
 
 /** Changelog
 * Version 1.6 Added "Markets Closed" fix that remove key-value pairs when value is 0; Force load of JS. Usability fixes.
 * Version 1.5 Added shortcode attributes for Start Date and End Date 
 * Version 1.4 Added support for data sets with limited history such as Existing Home Sales 
 * Version 1.3 Moves data storage directory to /uploads/FRED_data from the plugin's /data directory
 * Version 1.2 Updates messaging; Adds labeling options
 *
 */
 
 /**
 * The API call is structured as 
 * https://api.stlouisfed.org/fred/series/observations?api_key=XXX&series_id=XXX&frequency=XXX&file_type=xml";
 * For a complete list of options,  visit https://fred.stlouisfed.org/docs/api/fred/series_observations.html
 */

defined( 'ABSPATH' ) or die( 'Unauthorized access!' );

require_once(plugin_dir_path(__FILE__) . 'includes/admin.php');
require_once(plugin_dir_path(__FILE__) . 'includes/fred-api.php');
require_once(plugin_dir_path(__FILE__) . 'includes/output.php');

add_action('admin_menu', 'homebuyer_fred_charts_menu');
add_action('admin_init', 'homebuyer_fred_charts_admin_settings');
add_shortcode('homebuyer_fred_data', 'homebuyer_fred_charts_shortcode');

// Enqueue script for the client-facing side
add_action('wp_enqueue_scripts', 'homebuyer_fred_charts_client_scripts');
function homebuyer_fred_charts_client_scripts() {
    $client_script_path = 'js/homebuyer_fred_charts.js';
    $client_script_version = file_exists(plugin_dir_path(__FILE__) . $client_script_path) ? filemtime(plugin_dir_path(__FILE__) . $client_script_path) : false;

    wp_enqueue_script(
        'homebuyer-fred-charts-client-js', 
        plugins_url($client_script_path, __FILE__), 
        array('jquery'), 
        $client_script_version, 
        true
    );
}
// Enqueue script for the admin-facing side
function enqueue_admin_js() {
    // Get the file path
    $file = plugin_dir_path(__FILE__) . 'js/admin-script.js';
    // Use filemtime to get the file modification time
    $version = file_exists($file) ? filemtime($file) : '1.0';

    wp_enqueue_script('my-admin-js', plugins_url('/js/admin-script.js', __FILE__), array('jquery'), $version, true);
    
    // Localize the script with new data
    wp_localize_script('my-admin-js', 'adminAjax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
    ));
}
add_action('admin_enqueue_scripts', 'enqueue_admin_js');


function homebuyer_fred_charts_admin_settings() {
    register_setting('homebuyer_fred_charts_api', 'homebuyer_fred_charts_api_key', 'homebuyer_fred_charts_sanitize_text');
    add_settings_section('homebuyer_fred_charts_api_section', 'API Settings', 'homebuyer_fred_charts_api_section_text', 'homebuyer_fred_charts_api');
    add_settings_field('homebuyer_fred_charts_api_key', 'API Key', 'homebuyer_fred_charts_api_key_input', 'homebuyer_fred_charts_api', 'homebuyer_fred_charts_api_section');

    register_setting('homebuyer_fred_charts_series', 'homebuyer_fred_charts_series_data', 'homebuyer_fred_charts_sanitize_series');
    add_settings_section('homebuyer_fred_charts_series_section', 'Series Settings', 'homebuyer_fred_charts_series_section_text', 'homebuyer_fred_charts_series');
}

function homebuyer_fred_charts_menu() {
    add_menu_page(
        'Homebuyer.com FRED Charts',
        'FRED Charts',
        'manage_options',
        'homebuyer-fred-charts',
        'homebuyer_fred_charts_admin_page'
    );
}
?>
