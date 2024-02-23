<?php

/*******************************************************************************
 * Anywhere that the Research category link is generated, such as in a sitemap categories listing,
 * it will get generated as the custom link below.
 */

add_filter( 'category_link', 'custom_category_permalink', 10, 2 );
function custom_category_permalink( $link, $cat_id ) {
    $slug = get_term_field( 'slug', $cat_id, 'category' );
    // Research category custom permalinks
    if ( ! is_wp_error( $slug ) && 'research' === $slug ) {
        $link = home_url( user_trailingslashit( '/research/', 'category' ) );
    }
    return $link;
}

/*******************************************************************************
 * Anywhere that a Research category post link is generated, such as in a category page or search
 * results, it will get generated as the custom link below.
 */

add_filter( 'post_link', 'custom_permalink', 10, 3 );
function custom_permalink( $permalink, $post, $leavename ) {
    $category = get_the_category($post->ID);
    // Research category custom permalinks
    if ( !empty($category) && $category[0]->name == 'Research' ) {
        $cat_name = strtolower($category[0]->name);
        $permalink = untrailingslashit( home_url('/'. $cat_name . '/' . $post->post_name ) );
    }
    return $permalink;
}

/*******************************************************************************
 * Programmatic SEO URL rewrites
 */

add_action( 'init', 'prog_seo_rewrites' );
function prog_seo_rewrites() {
    // Mortgage Loan Limits (https://wordpress.stackexchange.com/q/26388/234771)
    add_rewrite_rule('mortgage-loan-limits/([a-zA-Z0-9-]+)/?$', 'index.php?pagename=mortgage-loan-limits&county_name=$matches[1]', 'top');
    add_rewrite_tag( '%county_name%', '([^&]+)' );

    // Research category custom permalinks (https://wordpress.stackexchange.com/q/296699/234771)
    add_rewrite_rule('research(?:/page/?([0-9]{1,})|)/?$', 'index.php?category_name=research&paged=$matches[1]', 'top');
    add_rewrite_rule('research/([^/]+)(?:/([0-9]+))?/?$', 'index.php?category_name=research&name=$matches[1]&page=$matches[2]', 'top');
}
