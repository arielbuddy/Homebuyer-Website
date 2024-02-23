<?php
// Add the admin options page.
function homebuyer_mortgage_compare_add_admin_page() {
    add_menu_page(
        'Homebuyer Mortgage Compare Settings', // The text to be displayed in the title tags of the page when the menu is selected
        'Mortgage Compare', // The text to be used for the menu
        'manage_options', // The capability required for this menu to be displayed to the user
        'homebuyer_mortgage_compare', // The slug name to refer to this menu by (should be unique for this menu)
        'homebuyer_mortgage_compare_options_page', // The function to be called to output the content for this page
        'dashicons-admin-home', // The icon to be used in the menu
        //6 // The position in the menu order this item should appear
    );
}
add_action('admin_menu', 'homebuyer_mortgage_compare_add_admin_page');

function homebuyer_mortgage_compare_options_page() {
    // Get the structured data from the JSON file.
    $structuredData = homebuyer_mortgage_compare_get_data();

    // Extract all unique product names.
    $productNames = [];
    foreach ($structuredData as $section) {
        foreach ($section['headers'] as $productName) {
            if (!in_array($productName, $productNames)) {
                $productNames[] = $productName;
            }
        }
    }
    ?>
    <div class="wrap">
        <h2>Homebuyer.com Mortgage Compare Settings</h2>

        <?php if (isset($_GET['upload_success'])): ?>
            <div class="notice notice-success is-dismissible">
                <p>JSON data uploaded successfully.</p>
            </div>
        <?php endif; ?>

            <form method="post" enctype="multipart/form-data" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                <input type="hidden" name="action" value="homebuyer_upload_json">
                <?php wp_nonce_field('homebuyer_mortgage_compare_upload_json', 'homebuyer_mortgage_compare_upload_json_nonce'); ?>
                <input type="file" name="homebuyer_mortgage_compare_json" id="homebuyer_mortgage_compare_json" accept=".json">
                <input type="submit" value="Upload JSON" name="submit">
            </form>
            
            <?php if (!empty($productNames)): ?>
            <!-- Display product names with checkboxes -->
            <form id="homebuyer_mortgage_compare_form" method="post">
                <fieldset>
                    <legend>Product List</legend>
                    <?php foreach ($productNames as $productName): ?>
                        <div class="form-group">
                            <label for="product-<?php echo esc_attr($productName); ?>">
                                <?php echo esc_html($productName); ?>
                            </label>
                            <input type="checkbox" id="product-<?php echo esc_attr($productName); ?>" name="products[]" value="<?php echo esc_attr($productName); ?>" />
                        </div>
                    <?php endforeach; ?>
                </fieldset>
                <button type="button" id="compare_button">Click to Compare</button>
            </form>
        <?php endif; ?>            <!-- Display file upload form if no JSON data is present -->


    </div>
    <script>
        document.getElementById('compare_button')?.addEventListener('click', function() {
            var checkedBoxes = document.querySelectorAll('#homebuyer_mortgage_compare_form input[type="checkbox"]:checked');
            var products = Array.from(checkedBoxes).map(function(checkbox) {
                return checkbox.value;
            });
            if (products.length > 0) {
                var shortcode = '[mortgage_compare_table columns="' + products.join(', ') + '"]';
                navigator.clipboard.writeText(shortcode).then(function() {
                    alert('Shortcode copied to clipboard: ' + shortcode);
                });
            } else {
                alert('Please select at least one product to compare.');
            }
        });
    </script>
    <?php
}

add_action('admin_menu', 'homebuyer_mortgage_compare_add_admin_page');

// Ensure the handle_json_upload function and add_admin_page function are defined elsewhere in your code as shown previously.


function homebuyer_mortgage_compare_admin_page() {
    ?>
    <div class="wrap">
        <h1>Upload Mortgage Data JSON</h1>
        <form method="post" enctype="multipart/form-data">
            <?php wp_nonce_field('homebuyer_mortgage_compare_upload', 'homebuyer_mortgage_compare_upload_nonce'); ?>
            <input type="file" name="homebuyer_mortgage_compare_json" id="homebuyer_mortgage_compare_json" accept=".json">
            <input type="submit" value="Upload" name="submit">
        </form>
    </div>
    <?php

    // Handle file upload.
    if (isset($_POST['submit']) && check_admin_referer('homebuyer_mortgage_compare_upload', 'homebuyer_mortgage_compare_upload_nonce')) {
        homebuyer_mortgage_compare_handle_upload();
    }
}

function homebuyer_mortgage_compare_handle_upload() {
    if (!function_exists('wp_handle_upload')) {
        require_once(ABSPATH . 'wp-admin/includes/file.php');
    }

    $uploadedfile = $_FILES['homebuyer_mortgage_compare_json'];
    $upload_overrides = array('test_form' => false);
    $movefile = wp_handle_upload($uploadedfile, $upload_overrides);

    if ($movefile && !isset($movefile['error'])) {
        homebuyer_mortgage_compare_process_json($movefile['file']);
    } else {
        // Handle error.
        echo $movefile['error'];
    }
}

function homebuyer_mortgage_compare_process_json($file_path) {
    // Read JSON data from the file.
    $json_content = file_get_contents($file_path);
    if ($json_content === false) {
        echo "Error reading the JSON file.";
        return;
    }

    $data = json_decode($json_content, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo "Error decoding the JSON file.";
        return;
    }

    // Save JSON data to the options table or wherever it's needed.
    update_option('homebuyer_mortgage_compare_data', $data);

    // Delete the temporary JSON file.
    unlink($file_path);

    echo "JSON data uploaded and processed successfully.";
}
function homebuyer_mortgage_compare_handle_json_upload() {
    // Check the nonce for security.
    check_admin_referer('homebuyer_mortgage_compare_upload_json', 'homebuyer_mortgage_compare_upload_json_nonce');

    // Check if the JSON file is set and there are no upload errors.
    if (isset($_FILES['homebuyer_mortgage_compare_json']) && $_FILES['homebuyer_mortgage_compare_json']['error'] == UPLOAD_ERR_OK) {
        $uploaded_file_path = $_FILES['homebuyer_mortgage_compare_json']['tmp_name'];

        // Optionally, you can add more validation here, such as checking the file size, file type, etc.

        // Read the contents of the uploaded file.
        $file_contents = file_get_contents($uploaded_file_path);
        if ($file_contents === false) {
            // Handle error - could not read file.
            wp_die('Error reading uploaded file');
        }

        // Decode the JSON data to ensure it's valid JSON.
        $json_data = json_decode($file_contents, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            // Handle error - JSON is not valid.
            wp_die('Uploaded file is not a valid JSON file');
        }

        // Save the JSON data using your existing function.
        if (!homebuyer_mortgage_compare_save_json_to_upload_dir($json_data)) {
            // Handle error - could not save data.
            wp_die('Error saving JSON data');
        }

        // Redirect back to your admin page with a success message.
        $redirect_url = add_query_arg('upload_success', '1', wp_get_referer());
        wp_safe_redirect($redirect_url);
        exit;
    } else {
        // Handle error - file not uploaded or upload error.
        wp_die('No file uploaded or there was an upload error');
    }
}

// Link the function to the 'admin_post_' action hook.
add_action('admin_post_homebuyer_upload_json', 'homebuyer_mortgage_compare_handle_json_upload');
