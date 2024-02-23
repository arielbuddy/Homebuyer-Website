<?php
// Prevent direct access to the file.
defined('ABSPATH') || die('No script kiddies please!');


// Function to create custom table on plugin activation
function homebuyer_changelog_activation() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'changelog';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        post_id mediumint(9) NOT NULL,
        changelog_text text NOT NULL,
        change_date datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
register_activation_hook(__FILE__, 'homebuyer_changelog_activation');

function homebuyer_changelog_deactivation() {
    // Optional: Code to execute on deactivation
}
register_deactivation_hook(__FILE__, 'homebuyer_changelog_deactivation');

// Ensure uninstall.php is used for uninstallation
// Place your uninstallation code in uninstall.php
?>