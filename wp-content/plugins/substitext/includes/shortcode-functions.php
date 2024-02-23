<?php
/**
 * Shortcode Functionality for Homebuyer.com Substitext Plugin
 * Usage Example: [substitext name="example_variable"]
 */

function hb_subst_shortcode_handler($atts) {
    $atts = shortcode_atts(array('name' => ''), $atts);
    $variable_name = sanitize_text_field($atts['name']);
    $variable_value = get_option('homebuyer_substitext_' . $variable_name, '');

    if (empty($variable_value)) {
        // Optionally return a message or nothing if the value is not set
        return '';
    }

    return esc_html($variable_value);
}