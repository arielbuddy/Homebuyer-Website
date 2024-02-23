<?php

// Get the Post ID in a shortcode [return_post_id]
// Used in Footer Links for UTM tracking
add_shortcode( 'return_post_id', 'get_post_slug' );
function get_post_slug() {
	$slug = "";
	$slug = get_post_field( 'post_name', get_post() );
	return $slug;
}

// Get today's date in a shortcode [current_date]
// Used in posts for "last updated"
add_shortcode( 'current_date', 'current_date' );
function current_date() {
	return date("F j, Y");
}

// Get the current year in a shortcode [current_year]
add_shortcode( 'current_year', 'current_year' );
function current_year() {
	return date("Y");
}

// Get the current month in a shortcode [current_month]
add_shortcode( 'current_month', 'current_month' );
function current_month() {
	return date("F");
}

// Get the current monthyear in a shortcode [current_month_year]
add_shortcode( 'current_month_year', 'current_month_year' );
function current_month_year() {
	return date("F Y");
}


// This functions gets image meta data from the media library and 
// displays ALT tags when the in-post meta data is missing or omitted
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


function get_publish_or_updated_date($date) {
	$t="";
	$u_time = get_the_time('U');
	$u_modified_time = get_the_modified_time('U');
	if ($u_modified_time >= $u_time + 86400) {
		$updated_date = get_the_modified_time('F j, Y');
		$t='<div>Last Updated: '. $updated_date . '</div>';
	}
	else {
		$t='<div>Published '. $date . '</div>';
	}
	return $t;
}

// Make a Table of Contents for posts
// Insert it before the first <H2> tag
function insert_toc($html) {
	$toc = '';
	$categories = get_the_category();
    $id = get_the_ID();
    $allowed_ids = [2892];
	if (is_single() && ((count($categories) && $categories[0]->slug !== 'research') || in_array($id, $allowed_ids))) {
		if (!$html) return $html;
		$dom = new DOMDocument();
		libxml_use_internal_errors(true);
		$dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
		libxml_clear_errors();
		$toc = '<div class="toc-bound">
			<div class="toc-ctr">
			Table of Contents
			</div>
			<ul class="toc">';
		$h2_status = 0;
		$i = 1;
		foreach($dom->getElementsByTagName('*') as $element) {
			if($element->tagName == 'h2') {
				if($h2_status){
					$toc .= '</li>';
					$h2_status = 0;
				}
				$h2_status = 1;
				$toc .= '<li>&#8594&nbsp;&nbsp;<a href="' . get_the_permalink() . '#toc-' . $i . '">' . $element->textContent . '</a>';
				$element->setAttribute('id', 'toc-' . $i);
				$i++;
			}
		}
		if($h2_status){
			$toc .= '</li>';
		}
		$toc .= '</ul></div>';
		$html = $dom->saveHTML();
	}
	$insert_before = "<h2";
	$pos = strpos($html, $insert_before);
	if ($pos !== false) {
    	$html = substr_replace($html, $toc . $insert_before, $pos, strlen($insert_before));
	}
	return $html;
}
add_filter('the_content', 'insert_toc');

function call_to_action_shortcode() {
    $hostname = parse_url(get_site_url(), PHP_URL_HOST);
    $target = 'https://app.homebuyer.com';

    if (preg_match("/local/i", $hostname)) {
        $target = 'http://localhost:3000';
    } else if (preg_match("/stage/i", $hostname)) {
        $target = 'https://app-staging.homebuyer.com';
    }

	$cta = '
    <div>
        <a class="cta hub-cta-box" data-category="Pre-approval" data-action="Click" data-label="article-inline-image" href="' . $target . '">
            <div>
                <img alt="Get my pre-approval illustration" src="' . get_template_directory_uri() .  '/images/cta-button-hero.png">
            </div>
            <div class="text-center">
                <p class="text">Mortgage<br>Pre-Approval<br>in Minutes</p>
                <button class="hb-button">Get Pre-approved</button>
            </div>
        </a>
    </div>
    ';
	return $cta;
}
// Get the CTA button in a shortcode [show_cta]
// Used mid-page in blog posts
add_shortcode( 'show_cta', 'call_to_action_shortcode' );

