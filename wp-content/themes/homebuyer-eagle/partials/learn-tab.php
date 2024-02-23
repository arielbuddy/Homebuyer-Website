<?php
  [
    'is_active' => $is_active,
    'url' => $url,
    'category' => $category,
  ] = $args;
?>
<li class="py-2 relative group">
  <!-- Mobile -->
  <a class="md:hidden category-white <?php echo $is_active ? 'category-inverted' : ''; ?>" href="<?php echo $url; ?>"><?php echo $category; ?></a>
  <!-- Desktop -->
  <a class="hidden md:block py-2 text-brand-gray-dark hover:text-brand-purple transition-all <?php echo $is_active ? 'text-brand-purple' : ''; ?>" href="<?php echo $url; ?>">
    <?php echo $is_active ? "<strong>$category</strong>" : $category; ?>
  </a>
  <div class="hidden md:block group-hover:opacity-100 opacity-0 absolute bottom-0 h-1 w-full bg-brand-purple transition-all <?php echo $is_active ? 'opacity-100' : ''; ?>"></div>
</li>
