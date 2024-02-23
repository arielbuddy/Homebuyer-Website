<?php
function homebuyer_fred_charts_admin_notices() {
    $messages = get_transient('homebuyer_fred_charts_admin_notices');
    if ($messages) {
        foreach ($messages as $message) {
            $class = 'notice';
            if ($message['type'] === 'error') {
                $class .= ' notice-error';
            } else {
                $class .= ' notice-success';
            }
            echo "<div class='{$class} is-dismissible'><p>{$message['content']}</p></div>";
        }
        // Clear the transient after displaying the messages
        delete_transient('homebuyer_fred_charts_admin_notices');
    }
}
add_action('admin_notices', 'homebuyer_fred_charts_admin_notices');

function homebuyer_fred_charts_add_admin_notice($message, $type = 'success') {
    $messages = get_transient('homebuyer_fred_charts_admin_notices');
    if (!$messages) {
        $messages = [];
    }
    $messages[] = ['content' => $message, 'type' => $type];
    set_transient('homebuyer_fred_charts_admin_notices', $messages, 10);
}

// Admin page callback
function homebuyer_fred_charts_admin_page() {
    $series_data = get_option('homebuyer_fred_charts_series_data', []);
	// Sort the array using the comparison function
	usort($series_data, 'compare_series_label');
	
    $api_key = get_option('homebuyer_fred_charts_api_key', '');
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'process_fred_data') {
        process_fred_data($api_key, $series_data);    
        homebuyer_fred_charts_add_admin_notice('Data processed successfully.', 'success');
    }
           

    if (isset($_POST['homebuyer_fred_series_nonce']) && wp_verify_nonce($_POST['homebuyer_fred_series_nonce'], 'homebuyer_fred_charts_series_settings_action')) {
        if (isset($_POST['add_update_series'])) {
            if (wp_verify_nonce($_POST['homebuyer_fred_series_nonce'], 'homebuyer_fred_charts_series_settings_action')) {
                // Sanitize and process series submission
                $new_label = sanitize_text_field($_POST['series_label']);
                $new_id = sanitize_text_field($_POST['series_id']);
                // Check if frequency is provided in the form
                $new_frequency = isset($_POST['frequency']) ? sanitize_text_field($_POST['frequency']) : '';
                $new_type = isset($_POST['series_type']) ? sanitize_text_field($_POST['series_type']) : '';
        
                // Update or add new series data
                $series_data[$new_id] = ['label' => $new_label, 'id' => $new_id, 'frequency' => $new_frequency, 'series_type' => $new_type];
                update_option('homebuyer_fred_charts_series_data', $series_data);
        
                homebuyer_fred_charts_add_admin_notice('Series Updated', 'success');
            }
        }

        // Handle deleting individual or selected series
        if (isset($_POST['delete_series'])) {
            $series_id_to_delete = sanitize_text_field($_POST['series_id']);
            unset($series_data[$series_id_to_delete]);
            update_option('homebuyer_fred_charts_series_data', $series_data);
            homebuyer_fred_charts_add_admin_notice('Series Deleted', 'success');
        } elseif (isset($_POST['delete_selected_series'])) {
            if (!empty($_POST['series_index']) && is_array($_POST['series_index'])) {
                $series_indices_to_delete = array_map('sanitize_text_field', $_POST['series_index']);
                foreach ($series_indices_to_delete as $id_to_delete) {
                    unset($series_data[$id_to_delete]);
                }
                update_option('homebuyer_fred_charts_series_data', $series_data);
                homebuyer_fred_charts_add_admin_notice('Selected Series Deleted', 'success');
            } else {
                // Add an error message to indicate no series were selected for deletion
                homebuyer_fred_charts_add_admin_notice('No series selected for deletion.', 'error');
            }
        }
    }
    
    // Handle API key submission
    if (isset($_POST['homebuyer_fred_charts_api_nonce']) && wp_verify_nonce($_POST['homebuyer_fred_charts_api_nonce'], 'homebuyer_fred_charts_api_settings_action')) {
        // Sanitize and save the API key
        $api_key = sanitize_text_field($_POST['homebuyer_fred_charts_api_key']);
        update_option('homebuyer_fred_charts_api_key', $api_key);
        homebuyer_fred_charts_add_admin_notice('API Key Updated', 'success');

    }

    // Redirect to avoid re-submissions
    if (!empty($_POST)) {
        wp_redirect(html_entity_decode($_SERVER['REQUEST_URI']));
        exit;
    }

     homebuyer_fred_charts_admin_notices();
    // Form HTML for API Key and Series Management
    ?>
    <div class="wrap">
        <h1>Homebuyer.com FRED Charts - Settings</h1>
        
        <!-- API Key Form -->
        <form method="post" action="<?php echo esc_attr($_SERVER['REQUEST_URI']); ?>">
            <h2>API Key Settings</h2>
            <?php wp_nonce_field('homebuyer_fred_charts_api_settings_action', 'homebuyer_fred_charts_api_nonce'); ?>
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="homebuyer_fred_charts_api_key">API Key:</label></th>
                    <td><input id="homebuyer_fred_charts_api_key" name="homebuyer_fred_charts_api_key" size="40" type="text" value="<?php echo esc_attr($api_key); ?>" /></td>
                </tr>
            </table>
            <p class="submit"><input type="submit" class="button button-primary" value="Save API Key"></p>
        </form>
        
		<!-- Download new data-->
		<form action="<?php echo esc_url(admin_url('admin.php?page=homebuyer-fred-charts')); ?>" method="post">
			<input type="hidden" name="action" value="process_fred_data">
			<button type="submit" id="homebuyer-fred-charts">Process FRED Data</button>
		</form>


        <!-- Series Management Form -->
        <h2>Series Management</h2>
        <form method="post" action="<?php echo esc_attr($_SERVER['REQUEST_URI']); ?>">
            <?php wp_nonce_field('homebuyer_fred_charts_series_settings_action', 'homebuyer_fred_series_nonce'); ?>
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="series_label">FRED Series Name</label></th>
                    <td><input name="series_label" type="text" id="series_label" value="" class="regular-text" placeholder="Enter series name"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="series_id">FRED Series ID</label></th>
                    <td><input name="series_id" type="text" id="series_id" value="" class="regular-text" placeholder="Enter series ID"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="frequency">FRED Series Frequency</label></th>
                    <td>
                        <select name="frequency" id="frequency">
                            <option value="d">Daily</option>
                            <option value="w">Weekly</option>
                            <option value="m">Monthly</option>
                            <option value="q">Quarterly</option>
                            <option value="a">Annual</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="series_type">FRED Series Type</label></th>
                    <td>
                        <select name="series_type" id="series_type">
                            <option value="currency">Currency</option>
                            <option value="number">Number</option>
                            <option value="percentage">Percentage</option>
                        </select>
                    </td>
                </tr>
            </table>
            <p class="submit">
                <input type="submit" name="add_update_series" id="add_update_series" class="button button-primary" value="Add/Update Variable">
            </p>
        </form>

        <!-- Existing Series Table with Save and Delete Actions -->
        <form method="post" action="<?php echo esc_attr($_SERVER['REQUEST_URI']); ?>">
            <h2>Existing Variables</h2>
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th scope="col" class="manage-column column-cb check-column">
                            <input id="cb-select-all-1" type="checkbox">
                        </th>
                        <th scope="col" class="manage-column">Variable Name</th>
                        <th scope="col" class="manage-column">Value</th>
                        <th scope="col" class="manage-column">Frequency</th>
                        <th scope="col" class="manage-column">Type</th>
                        <th scope="col" class="manage-column">Get Shortcode</th>
                    </tr>
                </thead>
                <tbody id="the-list">
                    <?php foreach ($series_data as $id => $entry) : ?>
                    <tr>
                        <th scope="row" class="check-column">
                            <input type="checkbox" name="series_index[]" value="<?php echo esc_attr($id); ?>">
                        </th>
                        <td class="title column-title"><?php echo esc_html($entry['label']); ?></td>
                        <td class="title column-title"><?php echo esc_html($entry['id']); ?></td>
                        <?php
                            switch ($entry['frequency']) {
                              case "d":
                                echo '<td class="title column-title">Daily</td>';                             
                                break;
                              case "w":
                                echo '<td class="title column-title">Weekly</td>';    
                                break;
                              case "m":
                                echo '<td class="title column-title">Monthly</td>';    
                                break;
                              case "q":
                                echo '<td class="title column-title">Quarterly</td>';    
                                break;
                              case "a":
                                echo '<td class="title column-title">Annual</td>';    
                                break;
                              default:
                                echo '<td class="title column-title">-</td>';    
                            }
                        ?>
                        <td class="title column-title"><?php echo ucfirst(esc_html($entry['series_type'])); ?></td>
                        <td class="title column-title"><button class="copy-shortcode" data-series-id="<?php echo esc_attr($entry['id']); ?>">Copy</button></td>       
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php wp_nonce_field('homebuyer_fred_charts_series_settings_action', 'homebuyer_fred_series_nonce'); ?>
            <p class="submit">
                <input type="submit" name="delete_selected_series" class="button action" value="Delete Selected Variables">
            </p>
        </form>
</div>
    <?php
}
// Define the comparison function for sorting
function compare_series_label($a, $b) {
    return strcmp($a['label'], $b['label']);
}
?>