<?php
  [
    'url' => $url,
    'thumbnail' => $thumbnail,
    'title' => $title,
  ] = $args;
?>
<a class="!no-underline p-6 mb-10 rounded-lg shadow bg-white flex flex-col md:flex-row items-center" rel="follow" title="<?php echo $title; ?>" href="<?php echo $url; ?>">
  <?php echo $thumbnail; ?>
  <p class="h4"><?php echo $title; ?></p>
</a>
