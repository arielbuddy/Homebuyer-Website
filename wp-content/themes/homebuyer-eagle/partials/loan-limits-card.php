<?php
  [
    'url' => $url,
    'title' => $title,
    'link_text' => $link_text,
  ] = $args;
?>
<a class="min-h-30 !no-underline flex flex-col justify-between rounded-lg border border-brand-gray-light bg-brand-white p-4 " href="<?php echo $url; ?>">
  <div class="text-brand-gray-dark"><?php echo $title; ?></div>
  <div class="text-brand-purple"><?php echo $link_text; ?></div>
</a>
