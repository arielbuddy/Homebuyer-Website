<?php
  [
    'h2s' => $h2s,
    'baseUrl' => $baseUrl,
  ] = $args;
?>
<div class="lg:hidden bg-brand-gray-lighter text-brand-purple mt-10">
  <div class="text-2xl md:text-3xl font-serif text-brand-purple border-b border-brand-gray-light py-5 px-4">
    TABLE OF CONTENTS
  </div>
  <ul class="!list-none !py-5 !px-9 !m-0">
    <?php foreach ($h2s as $i => $h2) { ?>
      <li class="py-2">
        →&nbsp;&nbsp;<a class="!decoration-dotted" href="<?php echo $baseUrl; ?>#toc-<?php echo ($i + 1); ?>"><?php echo $h2; ?></a>
      </li>
    <?php } ?>
  </ul>
</div>
