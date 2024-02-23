<?php

require_once(__DIR__ . '/../wp_bootstrap_navwalker.php');

add_action( 'wp_enqueue_scripts', 'theme_style_scripts' );
add_action( 'wp_enqueue_scripts', 'remove_unuse_style_scripts' );

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

function theme_style_scripts() {
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), rand(111,9999), 'all');
	wp_enqueue_style( 'style', get_template_directory_uri() . '/css/style.css', array(), rand(111,9999), 'all' );

	if (is_front_page() ||	is_page('education-course')) {
		wp_enqueue_style( 'slick', get_template_directory_uri() . '/css/slick.min.css');
		wp_enqueue_script( 'slick-js', get_template_directory_uri() . '/js/slick.min.js', array(), false, true );
		wp_enqueue_script( 'settings-slick-js', get_template_directory_uri() . '/js/custom-slick.js', array('slick-js'), false, true );
	}
}

function remove_unuse_style_scripts() {
	$styles = array('wp-block-library', 'genesis-blocks-style-css');
	$scripts = array('genesis-blocks-dismiss-js');

	foreach ($styles as $_style) {
		wp_dequeue_style($_style);
	}

	foreach ($scripts as $_script) {
		wp_dequeue_script($_script);
	}
}

// *********** Logo Code *********** //
add_theme_support( 'custom-logo', array(
	'height'      => 100,
	'width'       => 400,
	'flex-height' => true,
	'flex-width'  => true,
	'header-text' => array( 'site-title', 'site-description' ),
) );
add_theme_support( 'custom-logo' );


// *********** Menu Code *********** //

function pwwp_mytheme_setup() {
	register_nav_menus(
		array(
			//'footer_nav' => __( 'Footer Menu', 'mytheme' ),
			'header_menu' => __( 'Header Menu', 'mytheme' ),
		)
	);
	
add_theme_support( 'post-thumbnails' );
	
}
add_action( 'after_setup_theme', 'pwwp_mytheme_setup' );

// *********** Menu End *********** //

// First footer widget area, located in the footer. Empty by default.
register_sidebar(
	array(
		'name' => __( 'First Footer Widget Area', 'compass' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 'compass' ),
		'before_widget' => '<div class="widget-container %2$s" id="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	)
);
// Second Footer Widget Area, located in the footer. Empty by default.
register_sidebar(
	array(
		'name' => 'Second Footer Widget Area',
		'id' => 'second-footer-widget-area',
		'description' => 'The second footer widget area',
		'before_widget' => '<div class="widget-container %2$s" id="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	)
);
// Third Footer Widget Area, located in the footer. Empty by default.
register_sidebar(
	array(
		'name' => 'Third Footer Widget Area',
		'id' => 'third-footer-widget-area',
		'description' => 'The third footer widget area',
		'before_widget' => '<div class="widget-container %2$s" id="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	)
);

// Fourth Footer Widget Area, located in the footer. Empty by default.
register_sidebar(
	array(
		'name' => 'Fourth Footer Widget Area',
		'id' => 'fourth-footer-widget-area',
		'description' => 'The fourth footer widget area',
		'before_widget' => '<div class="widget-container %2$s" id="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	)
);
// Bottom Footer Widget Area, located in the footer. Empty by default.
register_sidebar(
	array(
		'name' => 'Bottom Footer Widget Area',
		'id' => 'bottom-footer-widget-area',
		'description' => 'The bottom footer widget area',
		'before_widget' => '<div class="widget-container %2$s" id="%1$s">',
		'after_widget' => '</div>',
	)
);

// Copyright Footer Widget Area, located in the footer. Empty by default.
register_sidebar(
	array(
		'name' => 'Copyright Footer Widget Area',
		'id' => 'copyright-footer-widget-area',
		'description' => 'The copyright footer widget area',
		'before_widget' => '<div class="widget-container %2$s" id="%1$s">',
		'after_widget' => '</div>',
	)
);

// Remove Global Styles and SVG Filters from WP 5.9.1 - 2022-02-27
function remove_global_styles_and_svg_filters() {
	remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
	remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );
}
add_action('init', 'remove_global_styles_and_svg_filters');

/**
 * Remove tags on AMP legacy theme.
 * 
 * @param array $tag_list Tag List.
 * @return array
 */
function amp_remove_tags( $tag_list ) {
        // condition to check AMP page.
	if ( function_exists( 'amp_is_request' ) && amp_is_request() ) {
		return array();
	}
	return $tag_list;
}
add_action( 'the_tags', 'amp_remove_tags' );

// Responsive embeds
add_theme_support( 'responsive-embeds' );

// ADDED May 23 2023
// Make shortcodes available in WordPress menu
add_filter('wp_nav_menu_items', 'do_shortcode');

