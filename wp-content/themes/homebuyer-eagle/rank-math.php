<?php

/*******************************************************************************
 * MORTGAGE LOAN LIMITS
 */

// Add Loan Limits pages to RankMath sitemaps
include('mortgage-loan-limits/mortgage-loan-limits-sitemap.php');

add_filter('rank_math/sitemap/providers', function( $external_providers ) {
    $external_providers['mortgage-loan-limits'] = new \RankMath\Sitemap\Providers\MortgageLoanLimits();
    return $external_providers;
});

// Remove all RankMath SEO tags because we have to add our own customised
add_action( 'wp_head', function () {
	global $post;
	if ( $post->post_name == 'mortgage-loan-limits' ) {
        remove_all_actions( 'rank_math/head' );
    }
}, 1 );
