<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php
  // Not using wp_* functions to add this script because it needs to be in the very top of the head.
  // Also, this is in two places, because the Nurla uses a different header file,
$hostname = parse_url(get_site_url(), PHP_URL_HOST);
$target = 'https://app.homebuyer.com';

if (preg_match("/local/i", $hostname)) {
    $target = 'http://localhost:3000';
} else if (preg_match("/stage/i", $hostname)) {
    $target = 'https://app-staging.homebuyer.com';
}
?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<title><?php wp_title('&laquo;', true, 'right'); ?><?php //bloginfo('name'); ?></title>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css" rel="stylesheet">
<meta name="ir-site-verification-token" value="-1336480780">
<?php wp_head(); ?>
</head>
<body <?php body_class('has-custom-notification no-custom-notification'); ?>>
	<?php wp_body_open(); ?>
	<header class="header a">
	<?php
	$notification_content = get_field('notification_content','option');
	$display_notification = get_field('display_notification','option');
	if($display_notification){
		if($notification_content){
			echo '
			<div class="custom__notification">
				<div class="cross-notification">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="512" height="512" x="0" y="0" viewBox="0 0 386.667 386.667" style="enable-background:new 0 0 512 512" xml:space="preserve" class="njt-nofi-close-icon"><g><path xmlns="http://www.w3.org/2000/svg" d="m386.667 45.564-45.564-45.564-147.77 147.769-147.769-147.769-45.564 45.564 147.769 147.769-147.769 147.77 45.564 45.564 147.769-147.769 147.769 147.769 45.564-45.564-147.768-147.77z" fill="#ffffff" data-original="#000000" style="" class=""></path></g></svg>
				</div>
				<span class="content">'.$notification_content.'</span>
			</div>
			';
		}
	}
	?>
	<nav class="navbar navbar-expand-lg">
		<div class="container">
			<a class="navbar-brand p-0" href="<?php echo home_url(); ?>">
                <?php $custom_logo_id = get_theme_mod( 'custom_logo' ); $image = wp_get_attachment_image_src( $custom_logo_id , 'full' ); ?>
                <img src="<?php echo $image[0]; ?>" width="180" height="28" alt="Logo" title="">
            </a>
			<button class="navbar-toggler" type="button" onclick="openNav()" id="menu_taggle" aria-label="Toggle Menu">
                <span></span>
                <span></span>
                <span></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent"><a href="javascript:void(0)" class="closeNavbtn" onclick="closeNav()">&times;</a>
				<?php
                    $args = array(
                        'menu'              => 'primary',
                        'theme_location'    => 'header_menu',
                        'depth'             => 2,
                        'container'         => 'div',
                        'container_class'   => '',
                        'container_id'      => '',
                        'menu_class'        => 'navbar-nav mr-auto',
                        'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                        'walker'            => new wp_bootstrap_navwalker(),
                    );

                    wp_nav_menu( $args );
				?>
                <?php
                    /*
                    <a href="#search" class="search_header"><img src="<?php echo home_url(); ?>/wp-content/themes/homebuyer/images/search-icon.png"></a>
                    <div id="search-box">
                        <div class="container">
                            <a class="close" href="#close"></a>
                            <div class="search-main">
                                <div class="search-inner">
                                    <form class="search" method="get" action="<?php echo home_url(); ?>" role="search">
                                    <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
                                    <button type="submit" class="btn btn-default right"/><span class="glyphicon glyphicon-search white"></span</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    */
                ?>
                &nbsp;&nbsp;
                    <a
                        class="hb-button"
                        data-category="Pre-approval"
                        data-action="Click"
                        data-label="top-menu-button"
                        href="<?php echo $target; ?>"
                    >Get pre-approved</a>
            </div>
        </div>
    </nav>
</header>
