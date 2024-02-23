<?php 
require_once('functions/theme.php');
require_once('functions/admin.php');
require_once('functions/gtm.php');
require_once('functions/seo.php');
require_once('functions/usda.php');
require_once('functions/maps.php');
require_once('functions/charts.php');
require_once('functions/cities.php');
require_once('functions/research.php');
require_once('functions/post.php');
require_once('functions/learn.php');


// Load in ACF image with alt text
// 
function get_acf_image_with_alt( $imagefield, $postID, $imagesize = 'full', $subfield = false, $class = '' ) {
	
	if ( $subfield == true ) {
		$imageID = get_sub_field( $imagefield, $postID );
     
	}
	else {
		$imageID = get_field( $imagefield, $postID );
	}
	$attachment = get_post( $imageID );
	$image = wp_get_attachment_image_src( $imageID, $imagesize );
	$alt_text = get_post_meta( $imageID , '_wp_attachment_image_alt', true );
	$title = get_the_title( $imageID , '_wp_attachment_image_title', true );

	return '<img src="' . $image[0] . '" class="' . $class . '" width="' . $image[1] . '" height="' . $image[2] . '" alt="' . $alt_text . '" description="' . $attachment->post_content .'" title="'.$attachment->post_title .'"  />';
};

add_filter('acf/format_value/type=textarea', 'do_shortcode');

function shortcodes_in_cf7( $form ) {
	$form = do_shortcode( $form );
	return $form;
};

if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
}

