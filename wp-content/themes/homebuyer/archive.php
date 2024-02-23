<?php
add_action( 'wp_enqueue_scripts', 'add_page_style' );

function add_page_style() {
	wp_enqueue_style( 'learn-page', get_template_directory_uri() . '/css/pages/learn.css', array('style'), rand(111,9999), 'all' );
}

get_header();

$tag = get_term_by('slug', 'research','post_tag');
$research_id = $tag->term_id;
?>

<div class="homebuyers_learn_heading_section">
	<div class="container">
		<div class="col-xs-12 col--centered text-center ">
			<div class=" homebuyers_learn_page_heading_section">
				<h1>Learn about homebuying</h1>
				<p>A collection of articles, infographics, news, and guides.</p>
			</div>
		</div>
	</div>
</div>

<div class="learn_link_section">
	<div class="container">
				<div class="row menu_link_section text-center">
					<h4>Topics:</h4>
					
					<ul class="nav">
  <li class="button-dropdown">
    <a href="javascript:void(0)" class="dropdown-toggle position-relative">
     Topics:
    </a>
    <ul class="dropdown-menu">
      <li>
        <a href="/learn" class="">All</a>
      </li>
      <?php 
						

$tags = get_tags(array('exclude' => $research_id));
$html = '';
foreach ( $tags as $tag ) {
    $tag_link = get_tag_link( $tag->term_id );
	$curlink = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] 
                === 'on' ? "https" : "http") . 
                "://" . $_SERVER['HTTP_HOST'] . 
                $_SERVER['REQUEST_URI'];
	$repuri = home_url().'/learn/tag/';
	$cururl = str_replace($repuri,"",$curlink);
	$cururl = str_replace("/","",$cururl);
if($cururl == str_replace(" ","-",strtolower($tag->name))){
$tagactive = $tag->slug.' active';}else{$tagactive = $tag->slug;}
    $html .= "<li><a href='{$tag_link}' title='{$tag->name} Tag' data-src='{$cururl}' data-new='{$repuri}' class='{$tagactive}'>";
    $html .= "{$tag->name}</a></li>";
}
$html .= '';
echo $html;

?>		
    </ul>
  </li>


</ul>
					<p><a href="/learn" class="">All</a></p>
					<?php 
						

$tags = get_tags(array('exclude' => $research_id));
$html = '';
foreach ( $tags as $tag ) {
    $tag_link = get_tag_link( $tag->term_id );
	$curlink = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] 
                === 'on' ? "https" : "http") . 
                "://" . $_SERVER['HTTP_HOST'] . 
                $_SERVER['REQUEST_URI'];
	$repuri = home_url().'/learn/tag/';
	$cururl = str_replace($repuri,"",$curlink);
	$cururl = str_replace("/","",$cururl);
if($cururl == str_replace(" ","-",strtolower($tag->name))){
$tagactive = $tag->slug.' active';}else{$tagactive = $tag->slug;}
    $html .= "<p><a href='{$tag_link}' title='{$tag->name} Tag' data-src='{$cururl}' data-new='{$repuri}' class='{$tagactive}'>";
    $html .= "{$tag->name}</a></p>";
}
$html .= '';
echo $html;

?>				
		</div>
	</div>
</div>


<div class="learn_blog_section">
	<div class="container">
		<div class="col-xs-12">
			<div class="row ">
				<?php if ( have_posts() ): ?>
				<?php while( have_posts() ): ?>
				<?php the_post(); ?>




				<div class="col-md-6 col-lg-4  learn_blog_card_section">
											<a class="blog_link" href="<?php the_permalink(); ?>">
							<?php if ( has_post_thumbnail() ) :
							$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ); ?>
							<div class="card_image_section" style="background:url(<?php echo $featured_image['0']; ?>)">
								
							</div>
							<div class="homebuyers_learn_content">
								<div class="learn_content_part">
									
									<h4> <?php
$posttags = get_the_tags();
if ($posttags) {
  foreach($posttags as $tag) {
    echo $tag->name . '<br>'; 
  }
}
?></h4>
									<h3><?php the_title(); ?></h3>
								</div>

								<?php endif; ?>
							
								<p>
									
							<?php $excerpt = get_the_excerpt(); 
 
$excerpt = substr( $excerpt, 0, 150 ); // Only display first 150 characters of excerpt
$result = substr( $excerpt, 0, strrpos( $excerpt, ' ' ) );
echo $result; ?>...	</p>
								
								
								<div class="learn_blog_link"> <p><?php _e( 'Read More' ); ?>	</p>
								</div>
							</div>
						</a>
									</div>

				<?php endwhile; ?>
				<?php else: ?>
				<p><?php _e( 'No Blog Posts found', 'nd_dosth' ); ?></p>
				<?php endif; ?>

			
			</div>
		</div>
	</div>
	<div class="btm_paginations">
		<div class="container">
			<nav role="navigation">
				<?php homebuyer_pagenavi($wp_query); ?>
			</nav>
		</div>
	</div>
	
</div>

<?php get_template_part('global/subscribe-newslatter'); ?>
<?php get_footer() ?>
