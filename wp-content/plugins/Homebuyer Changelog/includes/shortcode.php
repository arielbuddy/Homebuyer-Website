<?php
// Prevent direct access to the file.
defined('ABSPATH') || die('No script kiddies please!');

function blog_changelog_shortcode($atts) {
    global $post, $wpdb;
    $table_name = $wpdb->prefix . 'changelog';

    // Set up default attributes and overwrite them with user-provided attributes.
    // Attributes:
    // - limit: The maximum number of changelog entries to display.
    // - order: Determines the order of changelog entries ('asc' or 'desc').
    // - date_format: Format of the date to display with each entry.
    // - include_title: Whether to include the post title with each changelog entry.
    // - class: CSS class to apply to the changelog container.
    // - show_date: Whether to show the date of each changelog entry.
    // - header: The text to display as the header of the changelog section.
    $atts = shortcode_atts(array(
        'limit' => 10,
        'order' => 'desc',
        'date_format' => 'F j, Y',
        'include_title' => false,
        'class' => 'mt-4 mb-12',
        'show_date' => true,
        'header' => 'Changelog'
    ), $atts, 'show_changelog');

    $order = strtoupper($atts['order']) === 'ASC' ? 'ASC' : 'DESC';
    $limit = intval($atts['limit']);

    // Prepare and execute a database query to fetch changelog entries.
    $query = $wpdb->prepare(
        "SELECT changelog_text, change_date FROM $table_name WHERE post_id = %d ORDER BY change_date $order LIMIT %d",
        $post->ID, $limit
    );
    $changelog_entries = $wpdb->get_results($query);

    // Return empty string if there are no changelog entries
    if (empty($changelog_entries)) {
        return '';
    }

    // Start building the output
    $output = '<div class="' . esc_attr($atts['class']) . '">';
    $output .= '<h3>' . esc_html($atts['header']) . '</h3>';
    $output .= '<ul>';

    foreach ($changelog_entries as $entry) {
        // Unescape the changelog text for display
        $unescaped_text = stripslashes($entry->changelog_text);
    
        $output .= '<li>';
        if ($atts['show_date']) {
            // Format and display the date
            $output .= esc_html(date_i18n($atts['date_format'], strtotime($entry->change_date))) . ': ';
        }
        if ($atts['include_title']) {
            // Display the post title
            $output .= '<strong>' . get_the_title($post->ID) . '</strong> - ';
        }
        // Display the unescaped changelog text
        $output .= wp_kses_post($unescaped_text) . '</li>';
    }
    $output .= '</ul>';
	$output .= '</div>';   // Uncomment if classes are needed

    return $output;
}
add_shortcode('show_changelog', 'blog_changelog_shortcode');
?>