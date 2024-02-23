<?php
/**
 * Plugin Name: Homebuyer.com Mortgage Compare
 * Plugin URI: https://homebuyer.com
 * Description: Compare key features of mortgage programs in an easy-to-read format
 * Version: 1.0
 * Author: Dan Green
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: homebuyer-mortgage-compare
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

// Define the plugin version.
define('HOMEBUYER_MORTGAGE_COMPARE_VERSION', '1.0');

// Plugin activation hook.
function homebuyer_mortgage_compare_activate() {
    // Activation code here.
}
register_activation_hook(__FILE__, 'homebuyer_mortgage_compare_activate');

// Plugin deactivation hook.
function homebuyer_mortgage_compare_deactivate() {
    // Deactivation code here.
}
register_deactivation_hook(__FILE__, 'homebuyer_mortgage_compare_deactivate');

// Include the dependencies needed to instantiate the plugin.
foreach (glob(plugin_dir_path(__FILE__) . 'admin/*.php') as $file) {
    include_once $file;
}

foreach (glob(plugin_dir_path(__FILE__) . 'includes/*.php') as $file) {
    include_once $file;
}

add_shortcode('mortgage_compare_table', 'homebuyer_mortgage_compare_shortcode');