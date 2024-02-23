    
<?php if( get_row_layout() == 'testimonial_slider' ): ?>  

<div class="education_course_review text-center">
                <div class="review_stars d-flex justify-content-center">
                    <span>&#9733;</span>
                    <span>&#9733;</span>
                    <span>&#9733;</span>
                    <span>&#9733;</span>
                    <span>&#9733;</span>
                </div>
                <h3><?php the_sub_field('sub_title'); ?></h3>
                <h2><?php the_sub_field('main_heading'); ?></h2>
                <p><?php the_sub_field('main_pragraph'); ?></p>
            </div>
<div class="education_course_testi">
<div class="slider" id="education_course_testi">
	
		<?php if( have_rows('testimonials') ): ?>
<?php while( have_rows('testimonials') ): the_row(); ?>
	
    <div>
        <div class="qt_bs">
            <div class="qt_bs_cnt">
                <img src="<?php echo get_template_directory_uri(); ?>/images/quote-icon.svg" width="34" height="25" alt="quote-icon"/>
                <blockquote>          
					<?php $testimonial_client_content = the_sub_field('testimonial_client_content'); ?>
                </blockquote>
                <h3><?php $client_name = the_sub_field('client_name'); ?></h3>
                <p><?php $name = the_sub_field('name'); ?></p>
            </div>
        </div>
    </div>
    
		<?php endwhile; ?>
<?php endif; ?>
 
</div>
</div>


<?php endif; ?>
