<?php
/*
Plugin Name: Homebuyer.com Loan Limits 
Description: This plugin governs variables on the Homebuyer.com Loan Limits pages
Version: 0.3
Author: Will.AI.m
Author URI: https://homebuyer.com
Text Domain: hb-loan-limits
*/

if (!defined('ABSPATH')) {
    exit;
}


class HB_Loan_Limits_Settings
{
    private $options;

    public function __construct() {
        $this->options = get_option('hb_loan_limits', array());
        add_action('admin_menu', array($this, 'add_custom_menu'));
        add_action('admin_init', array($this, 'register_hb_loan_limits_settings'));
        add_shortcode('hb_loan_limits', array($this, 'hb_variable_shortcode'));
    }

    public function add_custom_menu() {
        add_menu_page(
            'Loan Limits Pages', 
            'Loan Limits Pages', 
            'manage_options', 
            'hb-loan-limits', 
            array($this, 'hb_loan_limits_admin_page'), 
            'dashicons-admin-tools', 
            20
        );
    }

    public function hb_loan_limits_admin_page() {
        ?>
        <div class="wrap">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            <form action="options.php" method="post">
                <?php
                    settings_fields('hb_loan_limits');
                    do_settings_sections('hb_loan_limits');
                    submit_button('Save Settings');
                ?>
            </form>
        </div>
        <?php
    }

    public function register_hb_loan_limits_settings() {
	register_setting('hb_loan_limits', 'hb_loan_limits', array('sanitize_callback' => array($this, 'sanitize_hb_loan_limits')));
        add_settings_section(
            'hb_loan_limits_main', 
            'Main Settings', 
            array($this, 'hb_loan_limits_section_text'), 
            'hb_loan_limits'
        );

        foreach ($this->options as $key => $value) {
            if ($key !== 'new_key' && $key !== 'new_value') {
                add_settings_field(
                    $key, 
                    $key, 
                    array($this, 'hb_loan_limits_input'), 
                    'hb_loan_limits', 
                    'hb_loan_limits_main',
                    array(
                        'label_for' => $key
                    )
                );
            }
        }

        add_settings_field(
            'new_variable', 
            'Add New Variable', 
            array($this, 'hb_loan_limits_new_input'), 
            'hb_loan_limits', 
            'hb_loan_limits_main'
        );
    }

    public function hb_loan_limits_section_text() {
        echo '<p>A plugin to set variables on the Homebuyer.com Loan Limits pages.</p>';
    }

    public function hb_loan_limits_input($args) {
        $option_name = $args['label_for'];
        $option_value = '';
        if (isset($this->options[$option_name])) {
            $option_value = $this->options[$option_name];
        }
        echo "<textarea id='{$option_name}' name='hb_loan_limits[{$option_name}]' rows='2' cols='50'>{$option_value}</textarea>";
        echo "<div><input type='checkbox' id='delete_{$option_name}' name='hb_loan_limits_delete[{$option_name}]' value='1' /> Delete</div>";
    }

    public function hb_loan_limits_new_input() {
        echo "<div style='margin-bottom: 8px;'><input id='new_key' name='hb_loan_limits[new_key]' placeholder='Variable Name' size='40' type='text' /></div>";
        echo "<textarea id='new_value' name='hb_loan_limits[new_value]' placeholder='Variable Value' rows='2' cols='50'></textarea>";
    }

    public function sanitize_hb_loan_limits($input) {
        // Delete any settings that were marked for deletion
        if (isset($_POST['hb_loan_limits_delete']) && is_array($_POST['hb_loan_limits_delete'])) {
            foreach ($_POST['hb_loan_limits_delete'] as $key => $value) {
                unset($input[$key]);
            }
        }

        $new_input = array();
        foreach ($this->options as $key => $value) {
            if (isset($input[$key])) {
                $new_input[$key] = wp_kses_post($input[$key]); // Sanitize for safe HTML content
            }
        }

        if (isset($input['new_key']) && !empty($input['new_key']) && isset($input['new_value'])) {
            $new_input[sanitize_text_field($input['new_key'])] = wp_kses_post($input['new_value']); // Sanitize for safe HTML content
        }

        return $new_input;
    }

    public function hb_variable_shortcode($atts) {
        $atts = shortcode_atts(array(
            'name' => '',
        ), $atts);

        return isset($this->options[$atts['name']]) ? $this->options[$atts['name']] : '';
    }
}
new HB_Loan_Limits_Settings();
?>
