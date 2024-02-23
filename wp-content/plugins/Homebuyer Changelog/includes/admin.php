<?php
// Prevent direct access to the file.
defined('ABSPATH') || die('No script kiddies please!');


function homebuyer_changelog_add_meta_box() {
    add_meta_box('changelog_meta', 'Changelog', 'homebuyer_changelog_meta_box_callback', 'post', 'side', 'default');
}

add_action('add_meta_boxes', 'homebuyer_changelog_add_meta_box');

function homebuyer_changelog_meta_box_callback($post) {
    wp_nonce_field(plugin_basename(__FILE__), 'homebuyer_changelog_nonce');

    echo '<style>
        #changelog_meta {
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #e5e5e5;
            border-radius: 3px;
        }
        #changelog_meta textarea {
            width: 100%;
            padding: 8px;
            font-size: 14px;
            line-height: 1.5;
            border: 1px solid #ddd;
            border-radius: 3px;
            box-shadow: inset 0 1px 2px rgba(0,0,0,.07);
        }
        #changelog_meta p {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 6px 8px;
            border-radius: 3px;
            margin-bottom: 8px;
            font-size: 13px;
        }
        #changelog_meta p strong {
            color: #21759b;
        }
    </style>';

    global $wpdb;
    $table_name = $wpdb->prefix . 'changelog';
    
    // Textarea for adding a new changelog entry at the top
    echo '<textarea name="homebuyer_changelog_new_entry" placeholder="-- Add changelog entry here --" rows="4" style="width:100%; margin-bottom: 20px;"></textarea>';

    // Fetch and display existing changelog entries
    $changelog_entries = $wpdb->get_results($wpdb->prepare(
        "SELECT id, changelog_text, change_date FROM $table_name WHERE post_id = %d ORDER BY change_date DESC",
        $post->ID
    ));

    // Display existing changelog entries below the textarea
    foreach ($changelog_entries as $entry) {
        $formatted_date = date_i18n(get_option('date_format'), strtotime($entry->change_date));
        echo '<div class="changelog-entry" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px;">';
        echo '<p style="margin: 0;"><strong>' . esc_html($formatted_date) . '</strong>: ' . stripslashes($entry->changelog_text) . '</p>';
        echo '<label style="margin-left: 10px;"><input type="checkbox" name="delete_changelog_entries[]" value="' . esc_attr($entry->id) . '"> ' . esc_html__('Delete', 'blog-changelog') . '</label>';
        echo '</div>';
    }
}

function homebuyer_changelog_save_postdata($post_id) {
    if (!isset($_POST['homebuyer_changelog_nonce']) || !wp_verify_nonce($_POST['homebuyer_changelog_nonce'], plugin_basename(__FILE__))) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (isset($_POST['bulk_edit'])) return;
    if ('post' !== get_post_type($post_id)) return;
    if (!current_user_can('edit_post', $post_id)) return;

    global $wpdb;
    $table_name = $wpdb->prefix . 'changelog';

    // Handle deletion of selected changelog entries
    if (isset($_POST['delete_changelog_entries'])) {
        foreach ($_POST['delete_changelog_entries'] as $entry_id) {
            $wpdb->delete($table_name, ['id' => intval($entry_id)], ['%d']);
        }
    }

    // Check and save new changelog entry if not empty
    if (isset($_POST['homebuyer_changelog_new_entry']) && !empty(trim($_POST['homebuyer_changelog_new_entry']))) {
        $changelog_text = sanitize_textarea_field($_POST['homebuyer_changelog_new_entry']);

        // Check for existing entry
        $existing_entry = $wpdb->get_var($wpdb->prepare(
            "SELECT COUNT(*) FROM $table_name WHERE post_id = %d AND changelog_text = %s",
            $post_id, $changelog_text
        ));

        if ($existing_entry == 0) {
            $result = $wpdb->insert($table_name, array(
                'post_id' => $post_id,
                'changelog_text' => $changelog_text,
                'change_date' => current_time('mysql'),
            ));

            if ($result !== false) {
                add_action('admin_notices', 'homebuyer_changelog_admin_notice__success');
            }
        }
    }
}
add_action('save_post', 'homebuyer_changelog_save_postdata');

function homebuyer_changelog_admin_notice__success() {
    ?>
    <div class="notice notice-success is-dismissible">
        <p><?php _e('Changelog updated successfully!', 'blog-changelog'); ?></p>
    </div>
    <?php
}

?>