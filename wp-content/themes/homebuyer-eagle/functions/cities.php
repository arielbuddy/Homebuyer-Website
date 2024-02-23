<?php

/*******************************************************************************
 * HUB TOP CITIES
 */

function homebuyer_top_cities_shortcode($atts = [], $content = null) {
  $allowed_tags = array('<a>', '<strong>', '<em>', '<h1>', '<h2>', '<h3>', '<h4>');
  $rows = json_decode(trim(strip_tags($content, $allowed_tags)), true);
  if (!$rows) {
    return '<font style="color: red;">Malformed JSON</font>';
  }
  ob_start();
  foreach ($rows as $i => $row) {
    $city = $row['City'];
    $state = $row['State Name'];
    $zipcode = $row['Zip Code'];
    $slug = _wp_to_kebab_case("$city-$state-$zipcode");
    $text = html_entity_decode($row['City Text'], ENT_QUOTES, 'UTF-8');
    $category = $row['Category'];
    $year = $row['Year'];
    $header = [$category => $year];
    $filtered = array_diff_key($row, ['City' => 1, 'State Name' => 1, 'Zip Code' => 1, 'City Text' => 1, 'Category' => 1, 'Year' => 1]);

    get_template_part(
      'partials/post-card',
      'city',
      [
        'i' => $i,
        'city' => $city,
        'state' => $state,
        'zipcode' => $zipcode,
        'slug' => $slug,
        'text' => $text,
        'row' => $header + $filtered,
      ],
    );
  }
  return ob_get_clean();
}
add_shortcode( 'homebuyer_top_cities', 'homebuyer_top_cities_shortcode' );

/*******************************************************************************
 * HUB BOTTOM CITIES
 */

function homebuyer_bottom_cities_shortcode($atts = [], $content = null) {
  // Extract shortcode attributes
  $atts = shortcode_atts(array(
    'starting_number' => 21 // Set default value
  ), $atts);
  $starting_number = intval($atts['starting_number']); // Ensure it's an integer

  $allowed_tags = array('<a>', '<strong>', '<em>', '<h1>', '<h2>', '<h3>', '<h4>');
  $rows = json_decode(trim(strip_tags($content, $allowed_tags)), true);
  if (!$rows) {
    return '<font style="color: red;">Malformed JSON</font>';
  }
  $category = array_key_first((array) $rows[0]);
  $year = array_key_last((array) $rows[0]);
  $header = [$category => $year];
  ob_start();
  ?>
  <div class="bg-brand-white rounded-2xl p-8 mb-14 shadow">
    <?php
      $object = [];
      foreach ($rows as $i => $row) {
          $key = ($i + $starting_number) . '.&nbsp;' . $row[$category];
          $value = $row[$year];
          $object[$key] = $value;
      }

      get_template_part(
        'partials/post-table',
        null,
        ['row' => $header + $object],
      );
    ?>
  </div>
  <?php
  return ob_get_clean();
}
add_shortcode( 'homebuyer_bottom_cities', 'homebuyer_bottom_cities_shortcode' );

/*******************************************************************************
 * Do not convert quotes to smart quotes, etc.
 */

add_filter( 'no_texturize_shortcodes', function ( $shortcodes ) {
    $shortcodes[] = 'homebuyer_top_cities';
    $shortcodes[] = 'homebuyer_bottom_cities';
    return $shortcodes;
});
