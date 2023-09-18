<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://yourpropfirm.com
 * @since             1.0.0
 * @package           Digiwoo_Multipayment
 *
 * @wordpress-plugin
 * Plugin Name:       Digital Multipayment Woocommerce
 * Plugin URI:        https://yourpropfirm.com
 * Description:       This Plugin Connect to Payment Gateway Sqala Pix QR Code, Let Know(Cryptocurrency Gateway) and PayOps
 * Version:           1.0.0
 * Author:            Ardika JM Consulting
 * Author URI:        https://yourpropfirm.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       digiwoo-multipayment
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'DIGIWOO_MULTIPAYMENT_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-digiwoo-multipayment-activator.php
 */
function activate_digiwoo_multipayment() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-digiwoo-multipayment-activator.php';
	Digiwoo_Multipayment_Activator::activate();
}

if (!function_exists('is_plugin_active')) {
    include_once(ABSPATH . '/wp-admin/includes/plugin.php');
}

/**
* Check for the existence of WooCommerce and any other requirements
*/
function digiwoo_multipayment_check_requirements() {
    if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
        return true;
    } else {
        add_action( 'admin_notices', 'digiwoo_multipayment_missing_wc_notice' );
        return false;
    }
}

/**
* Display a message advising WooCommerce is required
*/
function digiwoo_multipayment_missing_wc_notice() { 
    $class = 'notice notice-error';
    $message = __( 'Digital Multipayment requires WooCommerce to be installed and active.', 'digiwoo-multipayment' );
 
    printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) ); 
}

add_action( 'plugins_loaded', 'digiwoo_multipayment_check_requirements' );

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-digiwoo-multipayment-deactivator.php
 */
function deactivate_digiwoo_multipayment() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-digiwoo-multipayment-deactivator.php';
	Digiwoo_Multipayment_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_digiwoo_multipayment' );
register_deactivation_hook( __FILE__, 'deactivate_digiwoo_multipayment' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-digiwoo-multipayment.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-digiwoo-multipayment-functions.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_digiwoo_multipayment() {

	$plugin = new Digiwoo_Multipayment();
	$plugin->run();

}
run_digiwoo_multipayment();
