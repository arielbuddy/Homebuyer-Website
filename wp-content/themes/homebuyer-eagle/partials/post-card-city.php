<?php
  [
    'i' => $i,
    'city' => $city,
    'state' => $state,
    'zipcode' => $zipcode,
    'slug' => $slug,
    'text' => $text,
    'row' => $row,
  ] = $args;
?>
<div class="bg-brand-white rounded-2xl p-6 md:p-8 mb-14 shadow">
  <h2>#<?php echo ($i + 1) . ": $city, $state $zipcode"; ?></h2>
  <p>
    <a href="<?php echo "https://app.homebuyer.com/?zip_code=$zipcode"; ?>" target="_blank" rel="noreferrer noopener">
      Compare mortgage rates in <?php echo $city; ?>
    </a>
  </p>
  <?php echo do_shortcode("[homebuyer_map query=\"$zipcode\" type=\"zipcode\"]"); ?>
  <p id="<?php echo $slug; ?>" class="line-clamp-10 md:line-clamp-2 text-ellipsis">
    <?php echo $text; ?><br>
  </p>
  <p data-read-more-link class="text-right -mt-[1.1111rem]">
    <a href="#" data-id="<?php echo $slug; ?>" aria-label="read more">
      Read More…
    </a>
  </p>
  <?php
    get_template_part(
      'partials/post-table',
      null,
      ['row' => $row],
    );
  ?>
  <div>
    <small>Sources: FFEIC Home Mortgage Disclosure Act, U.S. Census Bureau</small>
  </div>
</div>
