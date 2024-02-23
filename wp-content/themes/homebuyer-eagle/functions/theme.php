<?php

/*******************************************************************************
 * Register theme menu locations
 */

add_action('after_setup_theme', function() {
  register_nav_menus(array(
    'header-menu' => __('Header Menu'),
    'footer-first-column-menu' => __('Footer First Column Menu'),
    'footer-second-column-menu' => __('Footer Second Column Menu'),
    'footer-third-column-menu' => __('Footer Third Column Menu'),
    'footer-fourth-column-menu' => __('Footer Fourth Column Menu'),
  ));
});

/*******************************************************************************
 * Add thumbnails support
 */

add_action('after_setup_theme', function() {
  add_theme_support('post-thumbnails');
});

/*******************************************************************************
 * Add custom logo support
 */

add_theme_support('custom-logo', array(
  'height'      => 100,
  'width'       => 400,
  'flex-height' => true,
  'flex-width'  => true,
  'header-text' => array('site-title', 'site-description'),
));
add_theme_support('custom-logo');

/*******************************************************************************
 * Add responsive embeds support
 */

add_theme_support( 'responsive-embeds' );

/*******************************************************************************
 * Remove jQuery Migrate
 */

function remove_jquery_migrate($scripts) {
  if (!is_admin() && isset($scripts->registered['jquery'])) {
    $script = $scripts->registered['jquery'];
    if ($script->deps) {
      $script->deps = array_diff($script->deps, array('jquery-migrate'));
    }
  }
}
add_action('wp_default_scripts', 'remove_jquery_migrate');

/*******************************************************************************
 * Remove tags on AMP legacy theme.
 */

function amp_remove_tags($tag_list) {
  // condition to check AMP page.
  if (function_exists('amp_is_request') && amp_is_request()) {
    return array();
  }
  return $tag_list;
}
add_action('the_tags', 'amp_remove_tags');

/*******************************************************************************
 * Remove Global Styles and SVG Filters from WP 5.9.1 - 2022-02-27
 */

function remove_global_styles_and_svg_filters() {
  remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
  remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');

  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('wp_print_styles', 'print_emoji_styles');
}
add_action('init', 'remove_global_styles_and_svg_filters');

/*******************************************************************************
 * Remove scripts
 */

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
add_action('wp_enqueue_scripts', 'remove_unuse_style_scripts');

/*******************************************************************************
 * Insert subfolders into WP template hierarchy
 */

function page_template_add_subdir($templates = array()) {
  $page_tpl_idx = 0;
  if ($templates[0] === get_page_template_slug()) {
    // Custom templates are still at the top of the hierarchy.  If there is custom template, then
    // our page-{slug}.php template is at the next index.
    $page_tpl_idx = 1;
  }

  $page_tpls = array('curriculum/' . $templates[$page_tpl_idx]);
  array_splice($templates, $page_tpl_idx, 0, $page_tpls);

  return $templates;
}
add_filter('page_template_hierarchy', 'page_template_add_subdir');
