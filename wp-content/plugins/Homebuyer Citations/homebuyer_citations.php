<?php
/*
 * Plugin Name: Homebuyer.com Citation
 * Description: The Homebuyer.com Citation plugin maintains and displays a record blog post updates.
 * Plugin URI: https://homebuyer.com
 * Version: 1.1
 * Author: Dan Green
 * Text Domain: homebuyer-citation
 */
 
 /* VERSION HISTORY
  *
  * Version 1.1: Improved directory structure. No functional changes.
  * Version 1.0: First release
 */

// Include other files
require_once(plugin_dir_path(__FILE__) . 'includes/init.php');
require_once(plugin_dir_path(__FILE__) . 'includes/admin.php');
require_once(plugin_dir_path(__FILE__) . 'includes/shortcode.php');

// Activation and Deactivation Hooks
register_activation_hook(__FILE__, 'homebuyer_citation_activation');
register_deactivation_hook(__FILE__, 'homebuyer_citation_deactivation');

// Add actions and filters as needed
// Example: add_action('some_hook', 'function_name_defined_in_one_of_the_included_files');
// Example: add_filter('some_filter', 'function_name_defined_in_one_of_the_included_files');

// Any additional code that needs to be in the main file




?>