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
    <a href="<?php echo $url; ?>" title="<?php echo $title; ?>" class="rounded-lg p-6 flex items-center bg-brand-white hover:bg-brand-purple-lightest hover:shadow transition-all group/card">
      <div class="rounded overflow-hidden mr-4">
        <img class="w-24 h-24 object-cover" alt="<?php echo $title; ?>" src="<?php echo $thumbnail; ?>">
      </div>
      <div class="flex-1 flex flex-col min-h-24 items-start justify-around">
        <div class="category">
          <?php echo $category; ?>
        </div>
        <p class="font-sans-medium group-hover/card:font-sans-bold group-hover/card:text-brand-black transition-all"><?php echo $title; ?></p>
      </div>
    </a>
  <?php } else { ?>
    <a href="<?php echo $url; ?>" title="<?php echo $title; ?>" class="rounded-lg p-6 flex items-center bg-brand-white hover:bg-brand-purple-lightest hover:shadow transition-all group/card">
      <div class="rounded-full bg-brand-gray-light overflow-hidden mr-4">
        <img class="w-24 h-24 object-contain" alt="Homebuyer Logo" src="<?php echo get_template_directory_uri(); ?>/images/homebuyer-icon.png">
      </div>
      <div class="flex-1 flex flex-col min-h-24 items-start justify-around">
        <p class="font-sans-medium group-hover/card:font-sans-bold group-hover/card:text-brand-purple-dark transition-all text-brand-purple"><?php echo $title; ?></p>
      </div>
    </a>
  <?php } ?>
</li>
