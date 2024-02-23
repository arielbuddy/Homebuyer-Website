<?php
// Prevent direct access to the file.
defined('ABSPATH') || die('No script kiddies please!');


function homebuyer_citation_add_meta_box() {
    add_meta_box('citation_meta', 'citation', 'homebuyer_citation_meta_box_callback', 'post', 'side', 'default');
}

add_action('add_meta_boxes', 'homebuyer_citation_add_meta_box');

function homebuyer_citation_meta_box_callback($post) {
    wp_nonce_field(plugin_basename(__FILE__), 'homebuyer_citation_nonce');

    echo '<style>
        #citation_meta {
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #e5e5e5;
            border-radius: 3px;
        }
        #citation_meta textarea {
            width: 100%;
            padding: 8px;
            font-size: 14px;
            line-height: 1.5;
            border: 1px solid #ddd;
            border-radius: 3px;
            box-shadow: inset 0 1px 2px rgba(0,0,0,.07);
        }
        #citation_meta p {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 6px 8px;
            border-radius: 3px;
            margin-bottom: 8px;
            font-size: 13px;
        }
        #citation_meta p strong {
            color: #21759b;
        }
    </style>';

    global $wpdb;
    $table_name = $wpdb->prefix . 'citation';
    
    // Fields for adding a new citation entry
    echo '<textarea name="homebuyer_citation_source" placeholder="Citation Source" rows="2" style="width:100%; margin-bottom: 10px;"></textarea>';
    echo '<input type="text" name="homebuyer_citation_url" placeholder="Citation URL (optional)" style="width:100%; margin-bottom: 20px;">';

    // Fetch and display existing citation entries
    $citation_entries = $wpdb->get_results($wpdb->prepare(
        "SELECT id, citation_source, citation_url FROM $table_name WHERE post_id = %d ORDER BY change_date DESC",
        $post->ID
    ));

    // Display existing citation entries with edit and delete options
    foreach ($citation_entries as $entry) {
        echo '<div class="citation-entry" style="margin-bottom: 10px;">';
        echo '<input type="text" name="existing_citation_source[' . esc_attr($entry->id) . ']" value="' . esc_attr($entry->citation_source) . '" style="width: 70%;"> ';
        echo '<input type="text" name="existing_citation_url[' . esc_attr($entry->id) . ']" value="' . esc_attr($entry->citation_url) . '" style="width: 70%;"> ';
        echo '<label><input type="checkbox" name="delete_citation_entries[]" value="' . esc_attr($entry->id) . '"> Delete</label>';
        echo '</div>';
    }
}
function homebuyer_citation_save_postdata($post_id) {
    if (!isset($_POST['homebuyer_citation_nonce']) || !wp_verify_nonce($_POST['homebuyer_citation_nonce'], plugin_basename(__FILE__))) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (isset($_POST['bulk_edit'])) return;
    if ('post' !== get_post_type($post_id)) return;
    if (!current_user_can('edit_post', $post_id)) return;

    global $wpdb;
    $table_name = $wpdb->prefix . 'citation';

    // Handle deletion of selected citation entries
    if (isset($_POST['delete_citation_entries'])) {
        foreach ($_POST['delete_citation_entries'] as $entry_id) {
            $wpdb->delete($table_name, ['id' => intval($entry_id)], ['%d']);
        }
    }

    // Check and save new citation entry
    if (isset($_POST['homebuyer_citation_source']) && !empty(trim($_POST['homebuyer_citation_source']))) {
        $citation_source = sanitize_text_field($_POST['homebuyer_citation_source']);
        $citation_url = !empty($_POST['homebuyer_citation_url']) ? esc_url_raw($_POST['homebuyer_citation_url']) : '';

        // Insert new citation entry into the database
        $result = $wpdb->insert($table_name, array(
            'post_id' => $post_id,
            'citation_source' => $citation_source,
            'citation_url' => $citation_url,
            'change_date' => current_time('mysql'),
        ));

        if ($result !== false) {
            add_action('admin_notices', 'homebuyer_citation_admin_notice__success');
        }
    }
}
add_action('save_post', 'homebuyer_citation_save_postdata');

function homebuyer_citation_admin_notice__success() {
    ?>
    <div class="notice notice-success is-dismissible">
        <p><?php _e('citation updated successfully!', 'blog-citation'); ?></p>
    </div>
    <?php
}

?>