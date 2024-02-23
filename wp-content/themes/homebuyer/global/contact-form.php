<?php if( get_row_layout() == 'contact_form_module' ): ?>  

<div class="press_contact_section" id="contact">
    <div class="container">
        <div class="contact_map_info">
            <div class="col-xs-12 col-lg-8 col--centered text-center">
                <div class="heading_content_section">
                    <h5><?php the_sub_field('sub_heading'); ?></h5>
                    <h2><?php the_sub_field('main_heading'); ?></h2>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12 col-lg-6">
                    <div class="press_contact_info">
                    <div class="contact_info_detail">
                        <h4><?php the_sub_field('homebuyer_title'); ?></h4>
                        <p><?php the_sub_field('about_content'); ?></p>
                    </div>
                    <div class="contact_info_detail">
                        <h4><?php the_sub_field('address_title'); ?></h4>
                        <p><?php the_sub_field('address'); ?></p>
                    </div>
                    <div class="contact_info_detail">   
                        <h4><?php the_sub_field('email_title'); ?></h4>
                        <p><a href="mailto:<?php the_sub_field('email'); ?>"><?php the_sub_field('email'); ?></a></p>
                    </div></div>
                </div>
                <div class="col-md-12 col-lg-6">
                    <div class="contact_us_map_section">
                        <iframe class="contact_map" src="<?php the_sub_field('map_iframe_code'); ?>" allowfullscreen="" loading="lazy"></iframe>  
                    </div>
                </div>
            </div>
        
    </div>
</div>
</div>

<?php endif; ?>
