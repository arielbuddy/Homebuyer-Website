<?php get_header(); ?>
<div class="four-oh-four">
    <img src="<?php echo get_template_directory_uri(); ?>/images/quirky-wrench-and-screwdriver.svg" alt="illustration">
    <h1 class="text-center">
        404 Page Not Found
    </h1>
    <p class="text-center">
        Unfortunately we can't find the page you are looking for. Please check your URL or return to the home page.
    </p>
    <a class="hb-button" href="<?php echo home_url(); ?>">
        Return to Homepage
    </a>
</div>
<?php get_template_part('global/subscribe-newslatter'); ?>
<?php get_footer(); ?>
