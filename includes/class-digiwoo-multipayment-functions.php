<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://yourpropfirm.com
 * @since      1.0.0
 *
 * @package    Digiwoo_Multipayment
 * @subpackage Digiwoo_Multipayment/includes
 */
// Register a custom menu page
add_action('admin_menu', 'digiwoo_multipayment_menu');
function digiwoo_multipayment_menu() {
    add_menu_page(
        'MultiPayment', // Page title
        'DigiWoo Payment', // Menu title
        'manage_options', // Capability - making it available only for admins
        'digiwoo-multipayment', // Menu slug
        'digiwoo_multipayment_options_page', // Function to call when the page is loaded
        'dashicons-money', // Icon URL (using a WP core dashicon)
        20 // Position in the menu
    );
}

// Callback function for loading the options page
function digiwoo_multipayment_options_page() {
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form action="options.php" method="post">
            <?php 
            // Output security fields for the registered setting
            settings_fields('digiwoo_multipayment_options');
            // Output setting sections and their fields
            do_settings_sections('digiwoo-multipayment');
            // Output save settings button
            submit_button(__('Save Settings', 'digiwoo-multipayment'));
            ?>
        </form>
    </div>
    <?php
}

function digiwoo_multipayment_settings_init() {
    // Register a new setting for our options
    register_setting('digiwoo_multipayment_options', 'digiwoo_multipayment_options');

    // Add settings section
    add_settings_section(
        'digiwoo_multipayment_section', // ID of the section
        __('Payment Gateways', 'digiwoo-multipayment'), // Title of the section
        'digiwoo_multipayment_section_callback', // Callback function
        'digiwoo-multipayment' // Page on which to add this section of options
    );

    // Sqala Pix QR Code field
    add_settings_field(
        'sqala_pix_qr_code', 
        __('Sqala Pix QR Code', 'digiwoo-multipayment'), 
        'digiwoo_multipayment_field_callback',
        'digiwoo-multipayment', 
        'digiwoo_multipayment_section',
        [
            'label_for' => 'sqala_pix_qr_code',
            'class' => 'digiwoo_multipayment_class',
        ]
    );

    // Let Know field
    add_settings_field(
        'let_know',
        __('Let Know (Cryptocurrency Gateway)', 'digiwoo-multipayment'),
        'digiwoo_multipayment_field_callback',
        'digiwoo-multipayment',
        'digiwoo_multipayment_section',
        [
            'label_for' => 'let_know',
            'class' => 'digiwoo_multipayment_class',
        ]
    );

    // PayOps field
    add_settings_field(
        'payops',
        __('PayOps', 'digiwoo-multipayment'),
        'digiwoo_multipayment_field_callback',
        'digiwoo-multipayment',
        'digiwoo_multipayment_section',
        [
            'label_for' => 'payops',
            'class' => 'digiwoo_multipayment_class',
        ]
    );
}
add_action('admin_init', 'digiwoo_multipayment_settings_init');

// Callback function for the section
function digiwoo_multipayment_section_callback($args) {
    echo '<p>' . __('Choose which payment gateways to enable or disable.', 'digiwoo-multipayment') . '</p>';
}

// Callback function for fields
function digiwoo_multipayment_field_callback($args) {
    $options = get_option('digiwoo_multipayment_options', [
        'sqala_pix_qr_code' => 'disable',
        'let_know' => 'disable',
        'payops' => 'disable',
    ]);
    $field_id = esc_attr($args['label_for']);
    $selected_value = isset($options[$field_id]) ? $options[$field_id] : 'disable';
    ?>
    <select id="<?php echo $field_id; ?>" name="digiwoo_multipayment_options[<?php echo $field_id; ?>]">
        <option value="enable" <?php selected($selected_value, 'enable'); ?>><?php _e('Enable', 'digiwoo-multipayment'); ?></option>
        <option value="disable" <?php selected($selected_value, 'disable'); ?>><?php _e('Disable', 'digiwoo-multipayment'); ?></option>
    </select>
    <?php
}
