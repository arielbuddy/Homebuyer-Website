<?php
  [
    'row' => $row,
  ] = $args;
?>
<div class="mt-6 mb-2">
  <div class="rounded-2xl border border-brand-gray-light bg-white overflow-hidden">
    <?php
      foreach (array_keys($row) as $i => $key) {
        $value = $row[$key];
        if ($i === 0) {
          ?>
            <div class="py-3 px-6 flex justify-between items-center even:bg-brand-white odd:bg-brand-white/[0.35]">
              <div><strong><?php echo $key; ?></strong></div>
              <div><strong><?php echo $value; ?></strong></div>
            </div>
          <?php
        } else {
          ?>
            <div class="py-3 px-6 flex justify-between items-center even:bg-brand-white odd:bg-brand-white/[0.35]">
              <div><?php echo $key; ?></div>
              <div><?php echo $value; ?></div>
            </div>
          <?php
        }
      }
    ?>
  </div>
</div>
