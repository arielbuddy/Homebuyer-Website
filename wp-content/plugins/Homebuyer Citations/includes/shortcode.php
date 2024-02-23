<?php
// Prevent direct access to the file.
defined('ABSPATH') || die('No script kiddies please!');

function homebuyer_citation_shortcode($atts) {
    global $post, $wpdb;
    $table_name = $wpdb->prefix . 'citation';

    // Set up default attributes and overwrite them with user-provided attributes.
    // Attributes:
    // - limit: The maximum number of citation entries to display.
    // - order: Determines the order of citation entries ('asc' or 'desc').
    // - class: CSS class to apply to the citation container.
    // - header: The text to display as the header of the citation section.
    $atts = shortcode_atts(array(
        'limit' => 10,
        'order' => 'desc',
        'class' => 'mt-4 mb-12',
        'header' => 'Citations'
    ), $atts, 'show_citation');

    $order = strtoupper($atts['order']) === 'ASC' ? 'ASC' : 'DESC';
    $limit = intval($atts['limit']);

    // Prepare and execute a database query to fetch citation entries.
    $query = $wpdb->prepare(
        "SELECT citation_source, citation_url FROM $table_name WHERE post_id = %d ORDER BY change_date $order LIMIT %d",
        $post->ID, $limit
    );
    $citation_entries = $wpdb->get_results($query);

    // Return empty string if there are no citation entries
    if (empty($citation_entries)) {
        return '';
    }

    // Start building the output as an ordered list
    // Uncomment if classes are needed
    $output = '<div class="' . esc_attr($atts['class']) . '">';
    $output .= '<h3 class="mt-8 mb-8">' . esc_html($atts['header']) . '</h3>';
    $output .= '<p>This article, "' . get_the_title() . '" draws on the author\'s professional mortgage experiences and references information found at these authoritative websites:</p>';
    $output .= '<ul>';

    foreach ($citation_entries as $entry) {
        $output .= '<li>';
        if (!empty($entry->citation_url)) {
            $output .= '<a href="' . esc_url($entry->citation_url) . '" target="_blank">' . esc_html($entry->citation_source) . '</a>';
        } else {
            $output .= esc_html($entry->citation_source);
        }
        $output .= '</li>';
    }
    $output .= '</ul>';
    $output .= '</div>';

    return $output;
}
add_shortcode('show_citation', 'homebuyer_citation_shortcode');?>