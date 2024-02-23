<?php
  [
    'url' => $url,
    'thumbnail' => $thumbnail,
    'category' => $category,
    'ttr' => $ttr,
    'title' => $title,
    'excerpt' => $excerpt,
  ] = $args;
?>
<a href="<?php echo $url; ?>" title="<?php echo $title; ?>" class="flex flex-col rounded-2xl overflow-hidden shadow hover:-translate-y-1">
  <?php if ($thumbnail) { ?>
    <img class="w-full h-40 object-cover" alt="<?php echo $title; ?>" src="<?php echo $thumbnail; ?>">
  <?php } else { ?>
    <div class="w-full h-40 bg-brand-purple-lighter"></div>
  <?php } ?>

  <div class="flex-1 px-6 py-8 bg-white flex flex-col">
    <div class="flex items-center justify-between mb-4">
      <?php if ($category) { ?>
        <div class="category">
          <?php echo $category; ?>
        </div>
      <?php } ?>
      <span><?php echo $ttr; ?> min read</span>
    </div>
    <h4><strong><?php echo $title; ?></strong></h4>
    <p class="flex-1 mb-6"><?php echo $excerpt; ?>…</p>
    <p class="text-brand-purple">Read More →</p>
  </div>
</a>
