<?php
  [
    'id' => $id,
    'left_tab' => $left_tab,
    'right_tab' => $right_tab,
    'left_row' => $left_row,
    'right_row' => $right_row,
  ] = $args;
?>
<div id="<?php echo $id; ?>" class="mt-6 mb-2">
  <div class="flex gap-4 mb-3">
    <div data-left-table-tab class="border-b border-brand-gray-light cursor-pointer text-sm transition-all text-brand-purple font-sans-medium border-b-2 border-brand-purple"><?php echo $left_tab; ?></div>
    <div data-right-table-tab class="border-b border-brand-gray-light cursor-pointer text-sm transition-all"><?php echo $right_tab; ?></div>
  </div>
  <div data-left-table class="rounded-2xl border border-brand-gray-light bg-white overflow-hidden">
    <?php
      foreach (array_keys($left_row) as $i => $key) {
        $value = $left_row[$key];
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
  <div data-right-table class="hidden rounded-2xl border border-brand-gray-light bg-white overflow-hidden">
    <?php
      foreach (array_keys($right_row) as $i => $key) {
        $value = $right_row[$key];
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
