<?php

add_action('admin_init', 'remove_textarea');

function remove_textarea() {
	remove_post_type_support( 'page', 'editor' );
}

// Add user profile fields in admin
function add_new_contactmethods( $contactmethods ) {
    $contactmethods['linkedin'] = __('LinkedIn');
    $contactmethods['position'] = __('Position');
    return $contactmethods;
}
add_filter('user_contactmethods','add_new_contactmethods',10,1);

// ADDED 2023-05-17 #CHATGPT
// Add sortable column in Dashbaord for Last Updated
// Add the custom column to the post type page
function add_last_updated_column($columns) {
    $columns['last_updated'] = 'Last Updated';
    return $columns;
}
add_filter('manage_posts_columns' , 'add_last_updated_column');

// Render the column values
function custom_last_updated_column( $column, $post_id ) {
    switch ( $column ) {
        case 'last_updated':
            echo get_the_modified_date('F j, Y', $post_id);
            break;
    }
}
add_action( 'manage_posts_custom_column' , 'custom_last_updated_column', 10, 2 );

// Make the "Last Updated" column sortable
function sortable_last_updated_column( $columns ) {
    $columns['last_updated'] = 'last_updated';
    return $columns;
}
add_filter( 'manage_edit-post_sortable_columns', 'sortable_last_updated_column' );

// Set the query to sort the posts by last updated date
function last_updated_orderby( $query ) {
    if( ! is_admin() || ! $query->is_main_query() ) {
        return;
    }

    if ( 'last_updated' === $query->get( 'orderby') ) {
        $query->set( 'orderby', 'modified' );
    }
}
add_action( 'pre_get_posts', 'last_updated_orderby' );
