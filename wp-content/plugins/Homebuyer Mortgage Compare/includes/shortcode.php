<?php
// Prevent direct access to the file.
defined('ABSPATH') || die('No script kiddies please!');

// Shortcode to display the comparison table.
function homebuyer_mortgage_compare_shortcode($atts) {
    // Extract the column names from the shortcode attributes.
    $atts = shortcode_atts(array(
        'columns' => 'Conventional,FHA', // default columns if none provided
    ), $atts);
    $columns = explode(',', $atts['columns']);	

    // Clean up column names, removing any unwanted spaces.
    $columns = array_map('trim', $columns);

    // Fetch data from the JSON file using the helper function.
    $structuredData = homebuyer_mortgage_compare_get_data();
    $html = '';

    // Loop through each section and generate a table for it
    foreach ($structuredData as $section) {
        // Add section title
        $html .= '<h2>' . esc_html($section['section']) . '</h2>';
       
        $html .= '<table class="homebuyer-mortgage-compare-table">';
        
        // Generate table headers
        $html .= '<tbody>';
		$html .= '<tr>';
		$html .= '<td style="text-align: left; padding: 8px; border-right: 1px solid #666; border-bottom: 1px solid #666;">' . esc_html('Loan Feature') . '</td>';
        foreach ($columns as $column) {
            $html .= '<td style="text-align: left; padding: 8px; border-bottom: 1px solid #666;">' . homebuyer_mortgage_compare_sanitize_cell($column) . '</td>';
        }
        $html .= '</tr>';
        
        // Generate table body
		foreach ($section['rows'] as $row) {
			$html .= '<tr>';
			// Sanitize and display the row label
			$html .= '<td style="text-align: left; vertical-align: top; padding: 8px; border-right: 1px solid #666;">' . homebuyer_mortgage_compare_sanitize_cell($row['label']) . '</td>';
			foreach ($columns as $column) {
				$cellValue = isset($row[$column]) ? $row[$column] : '';
				// Sanitize and display the cell value
				$html .= '<td style="text-align: left; padding: 8px;">' . homebuyer_mortgage_compare_sanitize_cell($cellValue) . '</td>';
			}
			$html .= '</tr>';
		}        
		$html .= '</tbody></table>';
    }

    return $html;
}
function homebuyer_mortgage_compare_sanitize_cell($cell) {
    $allowed_html = array(
        'a' => array(
            'href' => array(),
            'title' => array()
        )
    );
    return wp_kses($cell, $allowed_html);
}

add_shortcode('mortgage_compare_table', 'homebuyer_mortgage_compare_shortcode');