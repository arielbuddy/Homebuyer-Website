<?php get_header(); ?>
<div class="post container">
  <?php
    while (have_posts()) {
      the_post();
      the_title('<h1 class="mb-4">', '</h1>');
      the_content();
    }
  ?>
</div>
<?php
  $args = [ 'slug' => get_queried_object()->post_name ];
  get_footer(null, $args);
?>
