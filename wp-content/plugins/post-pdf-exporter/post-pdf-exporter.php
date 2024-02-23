<?php
/**
 * Plugin Name: Post PDF Exporter
 * Plugin URI: https://homebuyer.com
 * Description: Exports all active blog posts as PDFs and stores them in /pdf/[YYYYMMDD].
 * Version: 1.3
 * Author: Dan Green
 * Author URI: https://homebuyer.com
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: post-pdf-exporter
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add admin menu item
 */
function post_pdf_exporter_admin_menu() {
    add_menu_page('Post PDF Exporter', 'Post PDF Exporter', 'manage_options', 'post_pdf_exporter', 'post_pdf_exporter_page');
}
add_action('admin_menu', 'post_pdf_exporter_admin_menu');

/**
 * Render the admin page
 */
function post_pdf_exporter_page() {
    echo '<div class="wrap">';
    echo '<h1>Post PDF Exporter</h1>';
    echo '<p>Click the button below to generate PDFs for all active blog posts:</p>';
    echo '<form method="post" action="">';
    wp_nonce_field('post_pdf_exporter_generate_pdfs', 'post_pdf_exporter_nonce');
    echo '<input type="hidden" name="post_pdf_exporter_action" value="generate_pdfs">';
    echo '<button type="submit" class="button button-primary">Generate PDFs</button>';
    echo '</form>';
    echo '</div>';
}

/**
 * Handle form submission and generate PDFs
 */
function post_pdf_exporter_generate_pdfs() {
	
    // Increase execution time to 10 minutes
    set_time_limit(600);
    
    // Increase memory limit
    ini_set('memory_limit', '256M');
	
    if (isset($_POST['post_pdf_exporter_action']) && $_POST['post_pdf_exporter_action'] === 'generate_pdfs') {
        if (!wp_verify_nonce($_POST['post_pdf_exporter_nonce'], 'post_pdf_exporter_generate_pdfs')) {
            wp_die('Nonce verification failed.');
        }

        // Load the required libraries for TCPDF
        require_once(plugin_dir_path(__FILE__) . 'tcpdf/tcpdf.php');

        // Define the directory to store PDFs
        $date_directory = date('Ymd');
        $pdf_directory = plugin_dir_path(__FILE__) . 'pdf/' . $date_directory;

        // Create directory if it doesn't exist
        if (!is_dir($pdf_directory)) {
            mkdir($pdf_directory, 0777, true);
        }

        // Query all blog posts that are active
        $posts = get_posts(array(
            'post_type'      => 'post',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'ASC',
            'post__not_in'   => array(2223, 669, 636)
        ));

        $csv_array = array();  // Array to store CSV data
        $error_log = array();  // Array to store errors

        foreach ($posts as $post) {
            try {
				// Create a new PDF document
				$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

				// Set document information
				$pdf->SetCreator(PDF_CREATOR);
				$pdf->SetAuthor(get_bloginfo('name'));
				$pdf->SetTitle($post->post_title);
				$pdf->SetSubject($post->post_title);
				$pdf->SetKeywords('WordPress, PDF, blog post');

				// Set header and footer data
				$pdf->setHeaderData('', 0, get_bloginfo('name'), get_bloginfo('description'));
				$pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

				// Set header and footer fonts
				$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
				$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

				// Set default monospaced font
				$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

				// Set margins
				$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
				$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
				$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

				// Set auto page breaks
				$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

				// Set image scale factor
				$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

				// Add a page
				$pdf->AddPage();

				// Set font
				$pdf->SetFont('helvetica', '', 12);

				// Prepare content
				$content = '';
				$content .= '<h1>' . $post->post_title . '</h1>';
				$content .= '<p>';
				$content .= 'URL: ' . get_permalink($post->ID)  . '<br/>';
				$content .= 'Published on: ' . get_the_date('', $post) . '<br/>';
				//$content .= 'Modified on: ' . get_the_modified_date('', $post) . '<br/>';
				$content .= 'Word count: ' . str_word_count(strip_tags($post->post_content)) . '</p>';
				$content .= '<div>' . apply_filters('the_content', $post->post_content) . '</div>';

				// Process the post content through the replace_google_maps function
				$processed_content = "";
				$processed_content = replace_google_maps($content);

				// Write the content to the PDF
				$pdf->writeHTML($processed_content, true, false, true, false, '');
				// Save the PDF to the new directory structure
				$filename = sanitize_file_name($post->post_title . '.pdf');
				$pdf->Output($pdf_directory . '/' . $filename, 'F');

				// Prepare CSV content
				$csv_array[] = array(
					$post->post_title,
					$filename,
					get_the_date('m/d/Y', $post),
					str_word_count(strip_tags($post->post_content))
				);
			} catch (Exception $e) {
                $error_log[] = "Error generating PDF for post ID {$post->ID} ({$post->post_title}): " . $e->getMessage();
            }
        }

        // Write CSV content to a file
        $csv_file = $pdf_directory . '/FileSummary.csv';
        $handle = fopen($csv_file, 'w');
        foreach ($csv_array as $line) {
            fputcsv($handle, $line);
        }
        fclose($handle);

        // If there were errors, write them to an error log file
        if (!empty($error_log)) {
            $error_log_file = $pdf_directory . '/ErrorLog.txt';
            file_put_contents($error_log_file, implode("\n", $error_log));
        }

        // Display admin notice based on success or errors
        add_action('admin_notices', function() use ($error_log) {
            if (empty($error_log)) {
                echo '<div class="notice notice-success is-dismissible">';
                echo '<p>', __('PDFs and CSV summary have been successfully generated for all active blog posts.', 'post-pdf-exporter'), '</p>';
                echo '</div>';
            } else {
                echo '<div class="notice notice-error is-dismissible">';
                echo '<p>', __('PDF generation completed with errors. Please check the ErrorLog.txt file for details.', 'post-pdf-exporter'), '</p>';
                echo '</div>';
            }
        });
    }
}
add_action('admin_init', 'post_pdf_exporter_generate_pdfs');

// Function to replace Google Maps content
function replace_google_maps($content) {
    $pattern = '/\(g=>\{var h,a,k,p="The Google Maps JavaScript API".*?"\d+", "zipcode"\);/s';
    $replacement = '[The Google Maps API cannot be displayed in a PDF document]';
    return preg_replace($pattern, $replacement, $content);
}
