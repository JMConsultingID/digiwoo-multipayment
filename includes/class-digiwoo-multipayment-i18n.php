<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://yourpropfirm.com
 * @since      1.0.0
 *
 * @package    Digiwoo_Multipayment
 * @subpackage Digiwoo_Multipayment/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Digiwoo_Multipayment
 * @subpackage Digiwoo_Multipayment/includes
 * @author     Ardika JM Consulting <ardi@jm-consulting.id>
 */
class Digiwoo_Multipayment_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'digiwoo-multipayment',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
