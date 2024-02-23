<?php
add_action( 'wp_enqueue_scripts', 'add_page_style' );

function add_page_style() {
	wp_enqueue_style( 'learn-page', get_template_directory_uri() . '/css/pages/learn.css', array('style'), rand(111,9999), 'all' );
	wp_enqueue_style( 'author-page', get_template_directory_uri() . '/css/pages/author.css', array('style'), rand(111,9999), 'all' );
}

if (get_query_var('paged')) {
    // This query has no paginated pages.
    // Redirect to first page like we do other "404's".
    $uri = get_author_posts_url(get_the_author_meta('ID'));
    wp_redirect( $uri, 302 );
    exit;
}

get_header();

$the_query = new WP_Query(array(
    // Hard-coded list of featured posts
    'post__in' => array(629, 1740, 642, 1559, 630, 634, 674, 1528, 633),
    'orderby' => 'post__in',
));

?>

<div class="container">
    <div class="author-page">
        <div class="author-header">
            <div class="author-img mobile">
                <?php
                    $get_author_id = get_the_author_meta('ID');
                    $get_author_gravatar = get_cupp_meta($get_author_id, 'large');
                    echo '<img src="'.$get_author_gravatar.'" alt="'.get_the_author_meta('display_name').'" />';
                ?>
                <?php if (get_the_author_meta('linkedin')) : ?>
                    <div class="social">
                        <a href="<?php the_author_meta('linkedin'); ?>" target="_blank" aria-label="go to linkedin">
                            <span class="mdi mdi-linkedin"></span>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            <div class="author-title">
                <h1><?php esc_html(the_author_meta('display_name')); ?></h1>
                <h2><?php esc_html(the_author_meta('position')); ?></h2>
            </div>
        </div>
        <div class="author-details">
            <div class="author-img desktop">
                <?php
                    $get_author_id = get_the_author_meta('ID');
                    $get_author_gravatar = get_cupp_meta($get_author_id, 'large');
                    echo '<img src="'.$get_author_gravatar.'" alt="'.get_the_author_meta('display_name').'" />';
                ?>
                <?php if (get_the_author_meta('linkedin')) : ?>
                    <div class="social">
                        <a href="<?php the_author_meta('linkedin'); ?>" target="_blank" aria-label="go to linkedin">
                            <span class="mdi mdi-linkedin"></span>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            <div class="author-about">
                <div class="author-description">
                    <p>
                    Dan Green is a loan officer, mortgage industry expert, and son
                    of a former real estate agent. Since 2003, he's helped millions of first-time home
                    buyers achieve their American Dream of homeownership as a loan originator and
                    author of mortgage- and real estate-focused information.
                    </p>
                    <p>
                    He's also a featured industry leader. Dan speaks to large and small audiences
                    about mortgage, real estate, and homeownership topics. The
                    <a target="_blank" href="https://www.wsj.com/articles/BL-DVB-11594">Wall Street Journal</a>,
                    <a target="_blank" href="https://www.wbez.org/stories/lending-law-criticized/8debb9e7-3504-4c3c-8282-e83873a88bb8">NPR</a>,
                    <a target="_blank" href="https://www.bloomberg.com/news/articles/2012-07-26/roadblock-to-mortgage-refinancing#xj4y7vzkg">Bloomberg</a>,
                    and other media outlets have cited his expertise.
                    </p>
                    <p>
                    Dan is a top-producing mortgage loan originator with multiple sales and customer
                    service awards, including
                    <a target="_blank"
                    href="https://www.linkedin.com/posts/techstars_givefirst-founders-startup-activity-6999496461629489152-WQze/?utm_source=share&utm_medium=member_desktop">The Techstars Give First Award</a>,
                    which is presented to the person who lives the ideal of relationships over transactions.
                    </p>
                    <p>
                    Today, Dan leads Homebuyer.com, the mortgage lender for first-time home buyers,
                    as its Chief Executive Officer. He leads the organization while continuing to
                    educate and inspire aspiring U.S. homeowners with articles, posts, and videos. 
                    </p>
					<p>
					Prior to Homebuyer.com, Dan built a career based on experience and trust. 
					</p>
					<p>
					He graduated with honors from Penn State University and joined the New York City
					office of PriceWaterhouseCoopers as a software engineer. His clients included
					Fortune 100 banks and other Wall Street companies.
					</p>
					<p>
					During this time, Dan built a customer relationship management (CRM) package for
					an upstart mortgage company. He fell in love with the mortgage industry and its
					ability to help everyday people build wealth through homeownership and
					strengthen neighborhoods and communities. The mortgage company offered him a
					full-time role as a mortgage loan originator. Dan accepted the position.
					</p>
					<p>
					He earned Rookie of the Year honors in his first year originating mortgages,
					and the Roger Bannister Award for developing systems that delivered better
					service and quality. Dan later originated loans for Chicago-based Mobium
					Mortgage where he was named to the Top Mortgages Lenders of Chicago, and
					after aligning with Milwaukee-based mortgage company Waterstone Mortgage,
					Dan was a top originator for multiple years.
					</p>
					<p>
					To support his practice, Dan built
					<a target="_blank" href="https://themortgagereports.com/">The Mortgage Reports</a>, a
					consumer-facing mortgage blog. The Mortgage Reports and its plain-language
					mortgage and real estate explanations earned the site a strong, repeat
					readership. The Mortgage Reports website attracted millions of renters, home
					buyers, and homeowners annually. 
					</p>
					<p>
					The Mortgage Reports was later acquired, after which Dan started Homebuyer.com. 
					</p>
					<p>
					Dan and his wife live in Cincinnati with their three children, two dogs, and one
					rabbit. The house is always lively.
					</p>
                </div>
            </div>
        </div>
    </div>
</div>
<hr/>
<div class="container author-posts">
    <h3>Featured Posts</h3>
    <div class="col-xs-12">
        <div class="row ">
            <?php if ( $the_query->have_posts() ): ?>
            <?php while( $the_query->have_posts() ): ?>
            <?php $the_query->the_post(); ?>

            <div class="col-md-6 col-lg-4 learn_blog_card_section">
                <a class="blog_link" href="<?php the_permalink(); ?>">
                    <?php if ( has_post_thumbnail() ) :
                    $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ); ?>
                    <div class="card_image_section" style="background:url(<?php echo $featured_image['0']; ?>)">
                    </div>
                    <div class="homebuyers_learn_content">
                        <div class="learn_content_part">
                            <h4>
                                <?php
                                    $posttags = get_the_tags();
                                    if ($posttags) {
                                        foreach($posttags as $tag) {
                                            echo $tag->name . ' <br> '; 
                                        }
                                    }
                                ?>
                            </h4>
                            <h3><?php the_title(); ?></h3>
                        </div>
                        <?php endif; ?>
                        <p>
                            <?php $excerpt = get_the_excerpt(); 

                            $excerpt = substr( $excerpt, 0, 150 ); // Only display first 150 characters of excerpt
                            $result = substr( $excerpt, 0, strrpos( $excerpt, ' ' ) );
                            echo $result; ?>...
                        </p>
                        
                        <div class="learn_blog_link">
                            <p><?php _e( 'Read More' ); ?>	</p>
                        </div>
                    </div>
                </a>
            </div>

            <?php wp_reset_postdata(); ?>

            <?php endwhile; ?>
            <?php else: ?>
            <p class="px-3"><?php _e( 'No Blog Posts found', 'nd_dosth' ); ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>
<script>
   const link = document.getElementsByClassName('read-more-link')[0];
   const contents = document.getElementsByClassName('read-more-contents')[0];
   link.addEventListener('click', (e) => {
       e.preventDefault();
       if (contents.style.display === 'block') {
           contents.style.display = 'none';
           link.innerHTML = 'Read More…';
        } else {
           contents.style.display = 'block';
           link.innerHTML = 'Read Less…';
        }
   });
</script>

<?php get_template_part('global/subscribe-newslatter'); ?>
<?php get_footer() ?>
