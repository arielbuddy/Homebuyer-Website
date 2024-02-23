<?php /* Template Name: Nurla Template (blank) */ ?>
<?php get_header(); ?>


<div class="entry-content">
	<div class="container">
<?php
// STARTS - wrap your content with this conditional statement
if ( post_password_required() ) :

    // if your post is password protected with our Pro version, show our password form instead
    echo get_the_password_form();

/* display the password protected content if the correct password is entered */ 
else :
 $flexible_data = get_post_meta( $post->ID, 'content_area', true );
		echo apply_filters('the_content', $flexible_data);
endif;
// ENDS - hide custom fields with PPWP password protection
?>
</div>
</div>

<?php get_footer(); ?>
