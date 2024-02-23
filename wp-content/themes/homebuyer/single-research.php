<?php
/**
 * Single post template, adapted from single.php
 */

add_action( 'wp_enqueue_scripts', 'add_page_script_style' );

function add_page_script_style() {
	wp_enqueue_style( 'learn-page', get_template_directory_uri() . '/css/pages/learn.css', array('style'), rand(111,9999), 'all' );
    wp_enqueue_style( 'hub-css', get_template_directory_uri() . '/css/hub/hub.css', array('style'), rand(111,9999), 'all' );
    wp_enqueue_script( 'hub-js', get_template_directory_uri() . '/js/hub/hub.js', array(), rand(111,9999), true );
}

$hostname = parse_url(get_site_url(), PHP_URL_HOST);
$target = 'https://app.homebuyer.com';

if (preg_match("/local/i", $hostname)) {
    $target = 'http://localhost:3000';
} else if (preg_match("/stage/i", $hostname)) {
    $target = 'https://app-staging.homebuyer.com';
}

get_header(); ?>
<div <?php post_class('hub hub-header'); ?>>
	<?php while ( have_posts() ) : the_post(); ?>
	<div class="hub-container">
        <ul class="hub-breadcrumb">
            <li> <a href="<?php echo home_url(); ?>"> Home </a> / </li>
            <li> <a href="<?php echo home_url(); ?>/research"> Research</a> / </li>
            <li> <strong><?php the_title(); ?> </strong> </li>
        </ul>
        <div class="hub-featured-image">
            <?php the_post_thumbnail('full'); ?>
        </div>
        <div class="fact-checked-container">
            <a class="fact-checked" id="fact-checked" aria-labelledby="fact-checked-notice">
                <span class="mdi mdi-check-circle"></span>
                <strong>Fact Checked</strong>
            </a>
            <div class="fact-checked-bubble" id="fact-checked-bubble" role="tooltip">
                <p class="mb-2">Each post <strong>edited</strong> and <strong>fact-checked</strong> by industry experts to ensure that we are providing accurate information for our readers.</p>
                <p class="m-0">See our full <a href="https://homebuyer.com/editorial-guidelines" target="_blank">editorial guidelines</a>.</p>
            </div>
        </div>
        <h1><?php the_title(); ?></h1>
    </div>
    <div class="hub-header-white">
        <!-- Author Block -->
        <div class="hub-header-author">
            <?php
                $get_author_id = get_the_author_meta('ID');
                $get_author_gravatar = get_cupp_meta($get_author_id, 'thumbnail');
                echo '<img src="'.$get_author_gravatar.'" alt="'.get_the_author_meta('display_name').'" />';
            ?>
            <div>
                <div>Author: <?php the_author_posts_link(); ?></div>
                <?php echo get_publish_or_updated_date(get_the_date()); ?>
            </div>
        </div>
        <!-- Author Block -->

        <!-- Notice Block -->
        <?php
        $display_notice = get_field('display_notice', 'option');
        $notice_content = get_field('blog_post_notice_content', 'option');

        if ($display_notice && $notice_content) {
            echo '<div class="hub-header-notice">' . $notice_content . '</div>';
        }
        ?>
        <!-- Notice Block -->
    </div>
</div>
<div class="hub hub-main">
    <div class="hub-container">
        <?php the_content(); ?>
        <!--
        <h2>Check out other related home buying terms:</h2>
        <div class="hub-cards-container">
            <a href="#" class="hub-card">
                <div class="title">What is a Housing Expense Ratio?</div>
                <p>Read More →</p>
            </a>
            <a href="#" class="hub-card">
                <div class="title">What is an Earnest Money Deposit?</div>
                <p>Read More →</p>
            </a>
            <a href="#" class="hub-card">
                <div class="title">What is an Deed-in-Lieu of Foreclosure?</div>
                <p>Read More →</p>
            </a>
        </div>
        -->
    </div>
</div>
<?php
endwhile; //resetting the page loop
wp_reset_query(); //resetting the page query
?>
<?php get_template_part('global/subscribe-newslatter'); ?>
<?php get_footer(); ?>
