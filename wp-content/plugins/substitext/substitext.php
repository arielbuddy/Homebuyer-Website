<?php
/**
 * Plugin Name: Homebuyer.com Substitext
 * Description: Use shortcodes to make inline text substitutions
 * Version: 1.1
 * Author: Dan Green
 * Author URI: https://homebuyer.com
 * Requires at least: 6.0
 * Requires PHP: 7.4
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

/* Versions 
 * Version 1.1 Separate logic into multiple files; Add "Click to Copy"
 * Version 1.0 First version
 *
 *
 */
 
// Include the admin and shortcode functionality files
require_once plugin_dir_path(__FILE__) . 'includes/admin-functions.php';
require_once plugin_dir_path(__FILE__) . 'includes/shortcode-functions.php';

// Enqueue admin scripts
function homebuyer_substitext_enqueue_scripts($hook) {
    // Only add to the Homebuyer Substitext admin page
    if ($hook != 'toplevel_page_homebuyer-substitext') {
        return;
    }

    wp_enqueue_script(
        'homebuyer-substitext-admin',
        plugin_dir_url(__FILE__) . 'js/admin-scripts.js',
        array('jquery'),
        '1.0.0',
        true
    );
}
add_action('admin_enqueue_scripts', 'homebuyer_substitext_enqueue_scripts');

// Hooks for admin menu and notices
add_action('admin_menu', 'homebuyer_substitext_menu');
add_action('admin_notices', 'homebuyer_substitext_admin_notices');

// Register the shortcode
add_shortcode('substitext', 'hb_subst_shortcode_handler');
