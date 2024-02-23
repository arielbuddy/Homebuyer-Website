<?php
  [
    'url' => $url,
    'title' => $title,
  ] = $args;
?>
<a href="<?php echo $url; ?>" class="!no-underline flex flex-col justify-between rounded-lg border border-brand-gray-light bg-brand-white p-4">
  <div class="text-lg mb-3"><?php echo $title; ?></div>
  <p class="!m-0 text-brand-purple font-sans-medium">Read More →</p>
</a>
