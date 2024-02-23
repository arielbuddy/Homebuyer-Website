<?php

// Native paginations
function homebuyer_pagenavi($query) {
	$big = 999999999;

	$args = array(
		'base'    => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
		'format'  => '',
		'current' => max( 1, get_query_var('paged') ),
		'total'   => $query->max_num_pages,
		'prev_text'    => __('«'),
		'next_text'    => __('»'),
	);

	$result = paginate_links( $args );
	echo $result;
}


// ADDED 2023-02-15 DAG
function sort_posts_by_modified_date( $query ) {
    // conditions when is_archive is true:
    //   is_post_type_archive
    //   is_date
    //   is_author
    //   is_category
    //   is_tag
    //   is_tax
    if( $query->is_main_query() && ! is_admin() && ( $query->is_home() || $query->is_search() || $query->is_archive() ) ) {
        $query->set( 'orderby', 'modified' );
        $query->set( 'order', 'DESC' );
        $query->set( 'cat', '-196' ); // Exclude Research category posts from "All" posts
    }
}
add_action( 'pre_get_posts', 'sort_posts_by_modified_date' );
