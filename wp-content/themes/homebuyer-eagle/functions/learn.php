<?php

/*******************************************************************************
 * Truncated excerpt utility function
 */

function hb_get_excerpt($excerpt) {
  $preview = substr($excerpt, 0, 150); // Only display first 150 characters of excerpt
  $preview = substr($preview, 0, strrpos($preview, ' ')); // End on word
  return $preview;
}

/*******************************************************************************
 * Time-to-read utility function
 */

function hb_get_reading_time($content) {
  $word_count = str_word_count(strip_tags($content));
  $minutes = ceil($word_count / 200);
  return $minutes;
}

/*******************************************************************************
 * The Wordpress pagination function always returns HTML. Get the data, but throw away the HTML, so
 * that we can render however we want.
 */

function hb_get_paginated_links($query) {
  $big = 999999999;

  $args = array(
    'base' => str_replace($big, '%#%', get_pagenum_link( $big )),
    'format' => '',
    'current' => max(1, get_query_var('paged')),
    'total' => $query->max_num_pages,
    'prev_text' => '«',
    'next_text' => '»',
    'type' => 'array',
  
    // MODIFIED DAG 2023-11-28
    // Added the three lines below to force-display all paginated links
    // New display: 1 2 3 4 5 6 7 8
    // Former display: 1 2 3 ... 8
    'end_size' => 1, // Number of pages on the ends
    'mid_size' => $query->max_num_pages, // Number of pages to show around the current page
    'show_all' => true, // Show all pagination links
  );

  $links_array = paginate_links($args);

  if (empty($links_array)) {
    return array();
  }

  $result = array_map(function($link) {
      $is_current = strpos($link, 'current') !== false;
      preg_match('/href=["\']([^"\']+)["\']/', $link, $matches);
      return (object) array(
          'is_current' => $is_current,
          'text' => strip_tags($link),
          'url' => count($matches) ? $matches[1] : null,
      );
  }, $links_array );

  return $result;
}

/*******************************************************************************
 * ADDED 2023-02-15 DAG
 * Set the query to sort the posts by last updated date
 */

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
