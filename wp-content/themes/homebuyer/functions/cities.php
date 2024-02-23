<?php

//
// HUB TOP CITIES
//

function homebuyer_top_cities_shortcode($atts = [], $content = null) {
    $hostname = parse_url(get_site_url(), PHP_URL_HOST);
    $target = 'https://app.homebuyer.com';

    if (preg_match("/local/i", $hostname)) {
        $target = 'http://localhost:3000';
    } else if (preg_match("/stage/i", $hostname)) {
        $target = 'https://app-staging.homebuyer.com';
    }

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
        $filtered = ['City', 'State Name', 'Zip Code', 'City Text', 'Category', 'Year'];
        ?>
        <div class="hub-block">
            <h2>#<?php echo ($i + 1) . ": $city, $state $zipcode"; ?></h2>
            <p>
                <a href="<?php echo "$target?zip_code=$zipcode"; ?>" target="_blank" rel="noreferrer noopener">
                    Compare mortgage rates in <?php echo $city; ?>
                </a>
            </p>
            <?php echo do_shortcode("[homebuyer_map query=\"$zipcode\" type=\"zipcode\"]"); ?>
            <p id="<?php echo $slug; ?>" class="read-more-contents">
                <?php echo $text; ?><br>
            </p>
            <p class="read-more-link">
                <a href="#" data-id="<?php echo $slug; ?>" aria-label="read more">
                    Read More…
                </a>
            </p>
            <div class="hub-table">
                <div class="hub-table-body active">
                    <?php if ($category && $year) { ?>
                        <div class="hub-table-row">
                            <div><strong><?php echo $category; ?></strong></div>
                            <div><strong><?php echo $year; ?></strong></div>
                        </div>
                    <?php } ?>
                    <?php
                        foreach ($row as $key => $value) {
                            if (!in_array($key, $filtered)) {
                                ?>
                                <div class="hub-table-row">
                                    <div><?php echo $key; ?></div>
                                    <div><?php echo $value; ?></div>
                                </div>
                                <?php
                            }
                        }
                    ?>
                </div>
            </div>
            <div>
                <small>Sources: FFEIC Home Mortgage Disclosure Act, U.S. Census Bureau</small>
            </div>
        </div>
        <?php
    }
    return ob_get_clean();
}
add_shortcode( 'homebuyer_top_cities', 'homebuyer_top_cities_shortcode' );

//
// HUB BOTTOM CITIES
//

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
    ob_start();
    ?>
    <div class="hub-block">
        <div class="hub-table">
            <div class="hub-table-body active">
                <?php if ($category && $year) { ?>
                    <div class="hub-table-row">
                        <div><strong><?php echo $category; ?></strong></div>
                        <div><strong><?php echo $year; ?></strong></div>
                    </div>
                <?php } ?>
                <?php
                    foreach ($rows as $i => $row) {
                        $key = $row[$category];
                        $value = $row[$year];
                        ?>
                        <div class="hub-table-row">
                            <div><?php echo ($i + $starting_number) . ".&nbsp;$key"; ?></div>
                            <div><?php echo $value; ?></div>
                        </div>
                        <?php
                    }
                ?>
            </div>
        </div>
        <div>
            <small>Sources: FFEIC Home Mortgage Disclosure Act, U.S. Census Bureau</small>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'homebuyer_bottom_cities', 'homebuyer_bottom_cities_shortcode' );

add_filter( 'no_texturize_shortcodes', function ( $shortcodes ) {
    $shortcodes[] = 'homebuyer_top_cities';
    $shortcodes[] = 'homebuyer_bottom_cities';
    return $shortcodes;
});

