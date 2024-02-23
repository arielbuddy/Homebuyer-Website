<?php

/*******************************************************************************
 * Add user profile fields in admin
 */

function add_new_contactmethods( $contactmethods ) {
    $contactmethods['linkedin'] = __('LinkedIn');
    $contactmethods['position'] = __('Position');
    return $contactmethods;
}
add_filter('user_contactmethods','add_new_contactmethods',10,1);

/*******************************************************************************
 * ADDED 2023-05-17 #CHATGPT
 * Add sortable column in Dashbaord for Last Updated
 * Add the custom column to the post type page
 */

function add_last_updated_column($columns) {
    $columns['last_updated'] = 'Last Updated';
    return $columns;
}
add_filter('manage_posts_columns' , 'add_last_updated_column');

/*******************************************************************************
 * ADDED 2023-12-18
 * Add sortable column in Dashbaord for Excerpt
 * Add the custom column to the post type page
 */

function add_excerpt_column($columns) {
    $columns['excerpt'] = 'Excerpt';
    return $columns;
}
add_filter('manage_posts_columns', 'add_excerpt_column');

function custom_excerpt_column($column, $post_id) {
    if ($column == 'excerpt') {
        echo get_the_excerpt($post_id);
    }
}
add_action('manage_posts_custom_column', 'custom_excerpt_column', 10, 2);

/*******************************************************************************
 * Render the column values
 */

function custom_last_updated_column( $column, $post_id ) {
    switch ( $column ) {
        case 'last_updated':
            echo get_the_modified_date('F j, Y', $post_id);
            break;
    }
}
add_action( 'manage_posts_custom_column' , 'custom_last_updated_column', 10, 2 );

/*******************************************************************************
 * Make the "Last Updated" column sortable
 */

function sortable_last_updated_column( $columns ) {
    $columns['last_updated'] = 'last_updated';
    return $columns;
}
add_filter( 'manage_edit-post_sortable_columns', 'sortable_last_updated_column' );

/*******************************************************************************
 * Set the query to sort the posts by last updated date
 */

function last_updated_orderby( $query ) {
    if( ! is_admin() || ! $query->is_main_query() ) {
        return;
    }

    if ( 'last_updated' === $query->get( 'orderby') ) {
        $query->set( 'orderby', 'modified' );
    }
}
add_action( 'pre_get_posts', 'last_updated_orderby' );

/*******************************************************************************
 * Add the toggle function for Table of Contents to the WordPress Editor 
 */

function toc_toggle_add_custom_box() {
    add_meta_box(
        'toc_toggle_hide_toc',
        __('Hide Table of Contents', 'homebuyer-toc-toggle'), // Make the string translatable
        'toc_toggle_custom_box_html',
        'post',
        'side'
    );
}
add_action('add_meta_boxes', 'toc_toggle_add_custom_box');

function toc_toggle_custom_box_html($post) {
    wp_nonce_field('toc_toggle_hide_toc_action', 'toc_toggle_hide_toc_nonce');
    
    $value = get_post_meta($post->ID, 'hide_toc', true);

    echo '<label>';
    echo '<input type="checkbox" name="toc_toggle_hide_toc" value="1"' . checked($value, 1, false) . '/>&nbsp;';
    esc_html_e('Hide Table of Contents', 'homebuyer-toc-toggle'); // Make the string translatable
    echo '</label>';
}

function toc_toggle_save_postdata($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!isset($_POST['toc_toggle_hide_toc_nonce']) || !wp_verify_nonce($_POST['toc_toggle_hide_toc_nonce'], 'toc_toggle_hide_toc_action')) {
        return;
    }
    if (isset($_POST['post_type']) && 'page' === $_POST['post_type'] && !current_user_can('edit_page', $post_id)) {
        return;
    } elseif (!current_user_can('edit_post', $post_id)) {
        return;
    }
    $value = isset($_POST['toc_toggle_hide_toc']) ? 1 : 0; // Simplified
    update_post_meta($post_id, 'hide_toc', sanitize_text_field($value));
}
add_action('save_post', 'toc_toggle_save_postdata');
