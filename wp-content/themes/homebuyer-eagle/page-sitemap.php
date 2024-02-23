<?php get_header(); ?>
<div class="post container">
  <h1 class="mb-4">Sitemap</h1>
  <?php echo do_shortcode( '[rank_math_html_sitemap]' ); ?>
</div>
<?php
  $args = [ 'slug' => get_queried_object()->post_name ];
  get_footer(null, $args);
?>
