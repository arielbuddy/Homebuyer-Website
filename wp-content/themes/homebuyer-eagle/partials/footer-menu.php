<?php
  [
    'slug' => $slug,
  ] = $args;

  $locations = get_nav_menu_locations();
  $menu = get_term($locations[$slug]);
  $menu_items = wp_get_nav_menu_items($menu->slug);
?>
<div>
  <p class="h4 mb-4"><?php echo $menu->name; ?></p>
  <ul>
    <?php foreach ($menu_items as $menu_item) { ?>
      <li class="mb-2">
        <a class="text-brand-purple" href="<?php echo $menu_item->url; ?>">
          <?php echo $menu_item->title; ?>
        </a>
      </li>
    <?php } ?>
    <?php if ($slug === 'footer-first-column-menu') { ?>
      <li class="mb-2 mt-4 flex gap-3">
        <a class="text-brand-white text-xl bg-brand-purple block w-8 h-8 flex justify-center items-center rounded-full hover:bg-brand-red-dark transition-all" href="https://www.linkedin.com/company/homebuyer" target="_blank" aria-label="Go to LinkedIn">
          <span class="mdi mdi-linkedin"></span>
        </a>
        <a class="text-brand-white text-xl bg-brand-purple block w-8 h-8 flex justify-center items-center rounded-full hover:bg-brand-red-dark transition-all" href="https://www.youtube.com/homebuyermortgage" target="_blank" aria-label="Go to YouTube">
          <span class="mdi mdi-youtube"></span>
        </a>
      </li>
    <?php } ?>
  </ul>
</div>
