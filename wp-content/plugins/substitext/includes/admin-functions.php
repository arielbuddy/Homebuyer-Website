<?php
/**
 * Administrative functions for the Homebuyer.com Substitext Plugin.
 */

// Admin Menu
function homebuyer_substitext_menu() {
    add_menu_page('Substitext', 'Substitext', 'manage_options', 'homebuyer-substitext', 'homebuyer_substitext_page');
}

// Admin Notices for User Feedback
function homebuyer_substitext_admin_notices() {
    if (isset($_GET['homebuyer_substitext_message'], $_GET['homebuyer_substitext_message_type'])) {
        $message = sanitize_text_field(wp_unslash($_GET['homebuyer_substitext_message']));
        $message_type = sanitize_text_field(wp_unslash($_GET['homebuyer_substitext_message_type']));

        if ('success' === $message_type) {
            echo '<div class="notice notice-success is-dismissible"><p>' . esc_html($message) . '</p></div>';
        } else {
            echo '<div class="notice notice-error is-dismissible"><p>' . esc_html($message) . '</p></div>';
        }
    }
}

// Admin Page Handler
function homebuyer_substitext_page() {
    if (!current_user_can('manage_options')) {
        return;
    }

    homebuyer_substitext_handle_actions();
    homebuyer_substitext_page_html();
}

function homebuyer_substitext_handle_actions() {
    // Check if the form has been submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && check_admin_referer('homebuyer_substitext_actions', 'homebuyer_substitext_nonce')) {
        // Handle Add/Update action
        if (isset($_POST['submit_add'])) {
            $variable_name = sanitize_text_field($_POST['variable_name']);
            $variable_value = sanitize_textarea_field($_POST['variable_value']);
            update_option('homebuyer_substitext_' . $variable_name, $variable_value);
            echo '<div class="notice notice-success is-dismissible"><p>Variable "' . esc_html($variable_name) . '" added/updated successfully.</p></div>';
        }

        // Handle Delete action
        if (isset($_POST['submit_delete'])) {
            $variable_name = sanitize_text_field($_POST['variable_name']);
            delete_option('homebuyer_substitext_' . $variable_name);
            echo '<div class="notice notice-success is-dismissible"><p>Variable "' . esc_html($variable_name) . '" deleted successfully.</p></div>';
        }

        // Handle Bulk Delete action
        if (isset($_POST['submit_bulk_delete']) && !empty($_POST['variable_names'])) {
            foreach ($_POST['variable_names'] as $variable_name) {
                delete_option('homebuyer_substitext_' . sanitize_text_field($variable_name));
            }
            echo '<div class="notice notice-success is-dismissible"><p>Bulk delete performed successfully.</p></div>';
        }
    }
}

function homebuyer_substitext_page_html() {
    ?>
    <style>
        /* Your existing styles here */
    </style>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <div class="homebuyer-substitext-wrapper">
            <?php homebuyer_substitext_display_form(); ?>
        </div>
        <div class="homebuyer-substitext-wrapper homebuyer-substitext-list-table">
            <?php homebuyer_substitext_display_variable_list(); ?>
        </div>
    </div>
    <?php
 }

function homebuyer_substitext_display_form() {
    ?>
    <form method="post" action="">
        <?php wp_nonce_field('homebuyer_substitext_actions', 'homebuyer_substitext_nonce'); ?>
        <table class="form-table">
            <tr>
                <th><label for="variable_name">Variable Name</label></th>
                <td><input type="text" name="variable_name" id="variable_name" class="regular-text" required></td>
            </tr>
            <tr>
                <th><label for="variable_value">Variable Value</label></th>
                <td><textarea name="variable_value" id="variable_value" class="regular-text" required></textarea></td>
            </tr>
        </table>
        <p class="submit">
            <input type="submit" name="submit_add" class="button button-primary" value="Add/Update Variable">
            <input type="submit" name="submit_delete" class="button button-secondary" value="Delete Variable">
        </p>
    </form>
    <?php
}

function homebuyer_substitext_display_variable_list() {
    global $wpdb;
    $option_name_prefix = 'homebuyer_substitext_';
    $sql = $wpdb->prepare(
        "SELECT option_name, option_value FROM $wpdb->options WHERE option_name LIKE %s ORDER BY option_name ASC",
        $wpdb->esc_like($option_name_prefix) . '%'
    );
    $options = $wpdb->get_results($sql, OBJECT);

    // Check if bulk delete action is submitted
    if (isset($_POST['submit_bulk_delete']) && !empty($_POST['variable_names']) && check_admin_referer('homebuyer_substitext_actions', 'homebuyer_substitext_nonce')) {
        foreach ($_POST['variable_names'] as $variable_name) {
            delete_option($option_name_prefix . sanitize_text_field($variable_name));
        }
        echo '<div class="notice notice-success is-dismissible"><p>Selected variables deleted successfully.</p></div>';
    }

    ?>
    <h2>Variable List</h2>
    <form method="post" action="">
        <?php wp_nonce_field('homebuyer_substitext_actions', 'homebuyer_substitext_nonce'); ?>
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th class="check-column"><input type="checkbox" id="select_all_vars" /></th>
                    <th>Variable Name</th>
                    <th>Value</th>
                    <th>Copy Shortcode</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($options as $option) {
                    $display_name = substr($option->option_name, strlen($option_name_prefix));
                    $shortcode = '[substitext name="' . esc_attr($display_name) . '"]'; // Corrected shortcode format

                    echo '<tr>';
                    echo '<th class="check-column"><input type="checkbox" name="variable_names[]" value="' . esc_attr($display_name) . '" /></th>';
                    echo '<td>' . esc_html($display_name) . '</td>';
                    echo '<td>' . esc_html($option->option_value) . '</td>';
                    echo '<td><button class="copy-button" data-shortcode="' . esc_attr($shortcode) . '">Click to Copy</button></td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
        <p class="submit">
            <input type="submit" name="submit_bulk_delete" class="button button-secondary" value="Delete Selected">
        </p>
    </form>
    <?php
}
