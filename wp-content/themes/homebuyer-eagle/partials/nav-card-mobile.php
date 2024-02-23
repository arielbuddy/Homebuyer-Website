<?php
  [
    'category' => $category,
    'thumbnail' => $thumbnail,
    'url' => $url,
    'title' => $title,
  ] = $args;
?>
<li>
  <?php if ($thumbnail && $category) { ?>
    <a class="py-6 flex justify-between items-center" title="<?php echo $title; ?>" href="<?php echo $url; ?>">
      <div class="rounded overflow-hidden mr-4">
        <img class="w-20 h-20 object-cover" alt="<?php echo $title; ?>" src="<?php echo $thumbnail; ?>">
      </div>
      <div class="flex-1 flex flex-col h-20 items-start justify-around">
        <div class="category">
          <?php echo $category; ?>
        </div>
        <strong><?php echo $title; ?></strong>
      </div>
      <span class="text-2xl text-brand-gray-dark mdi mdi-chevron-right"></span>
    </a>
  <?php } else { ?>
    <a class="py-6 flex justify-between items-center" title="<?php echo $title; ?>" href="<?php echo $url; ?>">
      <div class="rounded-full bg-brand-gray-light overflow-hidden mr-4">
        <img class="w-20 h-20 object-contain" alt="Homebuyer Logo" src="<?php echo get_template_directory_uri(); ?>/images/homebuyer-icon.png">
      </div>
      <div class="flex-1 flex flex-col h-20 items-start justify-around">
        <strong class="text-brand-gray-dark"><?php echo $title; ?></strong>
      </div>
      <span class="text-2xl text-brand-gray-dark mdi mdi-chevron-right"></span>
    </a>
  <?php } ?>
</li>
