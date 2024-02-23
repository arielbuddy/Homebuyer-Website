<?php
  add_action('wp_enqueue_scripts', function () {
    wp_enqueue_script('utils-js', get_template_directory_uri() . '/js/utils.js', array(), rand(111, 9999), true);
    wp_enqueue_script('all-js', get_template_directory_uri() . '/js/all.js', array(), rand(111, 9999), true);
    wp_enqueue_script('header-js', get_template_directory_uri() . '/js/header.js', array(), rand(111, 9999), true);
  });
?><!doctype html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
    <meta name="ir-site-verification-token" value="-1336480780">
    <title><?php wp_title('&laquo;', true, 'right'); ?></title>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="all" />
    <link rel="stylesheet" data-mdi href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css" media="print">
    <script>document.querySelector('[data-mdi]').setAttribute('media', 'all');</script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script defer src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
    <?php wp_head(); ?>
  </head>
  <body class="pt-16 md:pt-20 bg-fixed bg-gradient-to-b from-brand-white from-50% to-brand-purple-lighter">
    <?php wp_body_open(); ?>
    <header id="header" class="w-full bg-white border-b border-solid border-brand-gray-light z-[9999] fixed top-0 [transition:background-color_150ms_ease-in-out,transform_300ms_ease-in]">

      <!-- Desktop Header
      ================================================== -->

      <div class="hidden md:flex items-center w-full max-w-screen-xl mx-auto h-20 px-12 lg:px-20">
        <a href="<?php echo home_url(); ?>" class="mr-12">
          <img class="w-48" src="<?php echo get_template_directory_uri(); ?>/images/homebuyer-logo.png" alt="Homebuyer.com logo">
        </a>
        <?php
          // Wordpress wants you to use wp_nav_menu here but screw that. Let's just get the data
          // and render it ourselves.

          $menu_items = wp_get_nav_menu_items('header-menu');

          $output = "<ul class=\"flex-1 flex gap-2 mt-6\">\n";

          $count = 0;
          $submenu = false;

          foreach ($menu_items as $menu_item) {
            $url = $menu_item->url;
            $title = $menu_item->title;
            $thumb_id = get_post_thumbnail_id($menu_item->object_id);
            $thumbs = wp_get_attachment_image_src($thumb_id, 'thumbnail');
            $thumb = null;
            $category = null;
            if (is_array($thumbs)) {
              $thumb = $thumbs[0];
            }
            $categories = get_the_category($menu_item->object_id);
            if (count($categories)) {
              $category = $categories[0]->name;
            }

            if (!$menu_item->menu_item_parent) {
              $parent_id = $menu_item->ID;

              $output .= "<li data-desktop-nav-menu class=\"group\">\n";
              $output .= "  <div class=\"pb-5 relative\">\n";
              $output .= "    <a class=\"flex items-center h-8 px-2 whitespace-nowrap hover:text-brand-purple hover:bg-brand-purple-lighter hover:rounded transition-all\" href=\"$url\">\n";
              if (isset($menu_items[$count + 1]) && $menu_items[$count + 1]->menu_item_parent == $parent_id) {
                $output .= "    $title&nbsp;<span class=\"text-2xl text-brand-gray mdi mdi-chevron-down\"></span>\n";
              } else {
                $output .= "    $title";
              }
              $output .= "    </a>\n";
              $output .= "    <div class=\"group-hover:opacity-100 opacity-0 absolute bottom-0 h-1 w-full bg-brand-purple transition-all\"></div>\n";
              $output .= "  </div>\n";
            }

            if ($parent_id == $menu_item->menu_item_parent) {
              if (!$submenu) {
                $submenu = true;
                $output .= "<ul data-desktop-nav-submenu class=\"hidden max-w-screen-xl mx-auto overflow-auto max-h-135 absolute left-0 right-0 z-50 shadow bg-white rounded-b mt-0.5 px-20 py-10 grid gap-x-11 gap-y-6 grid-cols-2 lg:grid-cols-3\">\n";
              }

              ob_start();
              get_template_part(
                'partials/nav-card',
                'desktop',
                [
                  'category' => $category,
                  'thumbnail' => $thumb,
                  'url' => $url,
                  'title' => $title,
                ],
              ) . "\n";
              $part = ob_get_contents();
              ob_end_clean();
              $output .= $part;

              if ((!isset($menu_items[$count + 1]) || $menu_items[$count + 1]->menu_item_parent != $parent_id) && $submenu) {
                $output .= "</ul>\n";
                $submenu = false;
              }
            }

            if (!isset($menu_items[$count + 1 ]) || $menu_items[$count + 1]->menu_item_parent != $parent_id) {
              $output .= "</li>\n";
              $submenu = false;
            }

            $count++;
          }

          $output .= "</ul>\n";

          // Make shortcodes work in nav menu
          echo do_shortcode($output);
        ?>
        <div class="flex mt-1">
          <a href="<?php echo home_url(); ?>/contact" class="mr-4 btn-secondary-small lg:btn-secondary lg:h-10">
            Contact Us
          </a>
          <a data-category="Pre-approval" data-action="Click" data-label="top-menu-button" href="https://app.homebuyer.com" class="btn-primary-small lg:btn-primary lg:h-10">
            Get Pre-approved
          </a>
        </div>
      </div>

      <!-- Mobile Header
      ================================================== -->

      <div class="md:hidden flex justify-between items-center w-full bg-white mx-auto h-16 px-6">
        <a href="<?php echo home_url(); ?>">
          <img class="w-48" src="<?php echo get_template_directory_uri(); ?>/images/homebuyer-logo.png" alt="Homebuyer.com logo">
        </a>
        <span id="mobile-menu-button" class="text-2xl text-brand-black mdi mdi-menu"></span>
        <div class="hidden fixed z-10 w-[200%] bg-brand-white top-16 right-0 bottom-0 left-0 overflow-auto" id="mobile-menu">
          <div class="p-6 w-1/2 flex flex-col justify-between">
            <?php
              // Wordpress wants you to use wp_nav_menu here but screw that. Let's just get the data
              // and render it ourselves.

              $menu_items = wp_get_nav_menu_items('header-menu');

              $output = "<ul class=\"text-brand-black divide-y divide-brand-gray-light border-y border-y-brand-gray-light\">\n";

              $count = 0;
              $submenu = false;

              foreach ($menu_items as $menu_item) {
                $url = $menu_item->url;
                $title = $menu_item->title;
                $thumb_id = get_post_thumbnail_id($menu_item->object_id);
                $thumbs = wp_get_attachment_image_src($thumb_id, 'thumbnail');
                $thumb = null;
                $category = null;
                if (is_array($thumbs)) {
                  $thumb = $thumbs[0];
                }
                $categories = get_the_category($menu_item->object_id);
                if (count($categories)) {
                  $category = $categories[0]->name;
                }

                if (!$menu_item->menu_item_parent) {
                  $parent_id = $menu_item->ID;
                  $parent_title = $title;

                  $output .= "<li data-mobile-nav-menu>\n";
                  if (isset($menu_items[$count + 1]) && $menu_items[$count + 1]->menu_item_parent == $parent_id) {
                    $output .= "  <a class=\"py-6 flex justify-between items-center\" href=\"#\">\n";
                    $output .= "    <span>$title</span>\n";
                    $output .= "    <span class=\"text-2xl text-brand-gray-dark mdi mdi-chevron-right\"></span>\n";
                    $output .= "  </a>\n";
                  } else {
                    $output .= "  <a class=\"py-6 flex justify-between items-center\" href=\"$url\">\n";
                    $output .= "    <span>$title</span>\n";
                    $output .= "  </a>\n";
                  }
                }

                if ($parent_id == $menu_item->menu_item_parent) {
                  if (!$submenu) {
                    $submenu = true;
                    $output .= "<div data-mobile-nav-submenu class=\"hidden translate-x-full absolute top-0 bottom-0 right-0 left-0 overflow-auto p-6 w-full flex flex-col justify-between\">\n";
                    $output .= "  <ul class=\"text-brand-black divide-y divide-brand-gray-light border-y border-y-brand-gray-light\">\n";
                    $output .= "    <li class=\"py-6 flex justify-center items-center\">\n";
                    $output .= "      <a data-back-button class=\"absolute left-4 py-6 pr-4 flex items-center text-brand-gray-dark\" href=\"#\">\n";
                    $output .= "        <span class=\"text-2xl text-brand-gray-dark mdi mdi-chevron-left\"></span> Back\n";
                    $output .= "      </a>\n";
                    $output .= "      <p class=\"h4\">$parent_title</p>\n";
                    $output .= "    </li>\n";
                  }

                  ob_start();
                  get_template_part(
                    'partials/nav-card',
                    'mobile',
                    [
                      'category' => $category,
                      'thumbnail' => $thumb,
                      'url' => $url,
                      'title' => $title,
                    ],
                  ) . "\n";
                  $part = ob_get_contents();
                  ob_end_clean();
                  $output .= $part;

                  if ((!isset($menu_items[$count + 1]) || $menu_items[$count + 1]->menu_item_parent != $parent_id) && $submenu) {
                    $output .= "  </ul>\n";
                    $output .= "</div>\n";
                    $submenu = false;
                  }
                }

                if (!isset($menu_items[$count + 1 ]) || $menu_items[$count + 1]->menu_item_parent != $parent_id) {
                  $output .= "</li>\n";
                  $submenu = false;
                }

                $count++;
              }

              $output .= "</ul>\n";

              // Make shortcodes work in nav menu
              echo do_shortcode($output);
            ?>
            <div class="mt-10 flex flex-col">
              <a data-category="Pre-approval" data-action="Click" data-label="top-menu-button" href="https://app.homebuyer.com" class="mb-4 btn-primary">
                Get Pre-approved
              </a>
              <a href="<?php echo home_url(); ?>/contact" class="mb-10 btn-secondary">
                Contact Us
              </a>
            </div>
          </div>
        </div>
      </div>
    </header>
    <div class="md:relative">
      <div id="overlay" class="hidden bg-brand-black bg-opacity-25 backdrop-blur-sm absolute top-0 bottom-0 left-0 right-0 z-50">
      </div>
