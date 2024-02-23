<?php

/*******************************************************************************
 * Get the Post ID in a shortcode [return_post_id]
 * Used in Footer Links for UTM tracking
 */

add_shortcode( 'return_post_id', 'get_post_slug' );
function get_post_slug() {
  $slug = "";
  $slug = get_post_field( 'post_name', get_post() );
  return $slug;
}

/*******************************************************************************
 * Get today's date in a shortcode [current_date]
 * Used in posts for "last updated"
 */

add_shortcode( 'current_date', 'current_date' );
function current_date() {
  // Create a DateTime object for 'now' in the Eastern Time Zone
  $date = new DateTime('now', new DateTimeZone('America/New_York'));

  // Return the formatted date
  return $date->format('F j, Y');
}


/*******************************************************************************
 * Get the current year in a shortcode [current_year]
 */

add_shortcode( 'current_year', 'current_year' );
function current_year() {
  return date("Y");
}

/*******************************************************************************
 * Get the current month in a shortcode [current_month]
 */

add_shortcode( 'current_month', 'current_month' );
function current_month() {
  return date("F");
}

/*******************************************************************************
 * Get the current monthyear in a shortcode [current_month_year]
 */

add_shortcode( 'current_month_year', 'current_month_year' );
function current_month_year() {
  return date("F Y");
}

/*******************************************************************************
 * This functions gets image meta data from the media library and 
 * displays ALT tags when the in-post meta data is missing or omitted
 */

if ( !function_exists('wp_get_attachment') ) {
    function wp_get_attachment( $attachment_id )
    {
        $attachment = get_post( $attachment_id );
        return array(
            'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
            'caption' => $attachment->post_excerpt,
            'description' => $attachment->post_content,
            'href' => get_permalink( $attachment->ID ),
            'src' => $attachment->guid,
            'title' => $attachment->post_title
        );
    }
}

/*******************************************************************************
 * Get timestamp to render in post header
 */

function hb_get_publish_or_updated_date() {
  $t = '';
  $date = get_the_date();
  $u_time = get_the_time('U');
  $u_modified_time = get_the_modified_time('U');

  if ($u_modified_time >= $u_time + 86400) {
    $updated_date = get_the_modified_time('F j, Y');
    // $t = "Last Updated: $updated_date";
    $t = "Published: $updated_date";
  }
  else {
    $t = "Published: $date";
  }
  return $t;
}

/*******************************************************************************
 * Make a Table of Contents for posts
 * Insert it before the first <H2> tag when not hidden
 */

function insert_toc($html) {
  if (!is_single()) {
    return $html;
  }

  $hide_toc = get_post_meta(get_the_ID(), 'hide_toc', true);
  if ($hide_toc) {
    return $html;
  }

  if (!$html) {
    return $html;
  }

  $dom = new DOMDocument();
  libxml_use_internal_errors(true);
  $flags = str_starts_with(trim($html), '<h2') ? 0 : LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD;
  $dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'), LIBXML_SCHEMA_CREATE | $flags);
  libxml_clear_errors();

  $h2s = [];
  $i = 1;
  foreach ($dom->getElementsByTagName('h2') as $element) {
    $h2s[] = $element->textContent;
    $element->setAttribute('id', "toc-{$i}");
    $i++;
  }
  $html = $dom->saveHTML();

  ob_start();
  get_template_part(
    'partials/post-toc',
    null,
    ['h2s' => $h2s, 'baseUrl' => get_the_permalink()],
  );
  $toc = ob_get_contents();
  ob_end_clean();

  $insert_before = '<h2';
  $pos = strpos($html, $insert_before);
  if ($pos !== false) {
    $html = substr_replace($html, $toc . $insert_before, $pos, strlen($insert_before));
  }

  return $html;
}
add_filter('the_content', 'insert_toc', 99);

/*******************************************************************************
 * Get the CTA button in a shortcode [show_cta]
 * Used mid-page in blog posts
 */

function call_to_action_shortcode() {
  ob_start();
  get_template_part('partials/post-cta');
  $cta = ob_get_contents();
  ob_end_clean();
  return $cta;
}
add_shortcode('show_cta', 'call_to_action_shortcode');

/*******************************************************************************
 * Get the NI widget in a shortcode [show_table_cta]
 * Used mid-page in blog posts
 */

function table_cta_shortcode($atts = []) {
  if (isset($atts['slot'])) {
    return "<div data-ni-slot=\"{$atts['slot']}\"></div>\n";
  }
  return "<div data-ni-slot></div>\n";
}
add_shortcode('show_table_cta', 'table_cta_shortcode');
