<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://blankabrand.com
 * @since             1.0.6
 * @package           Blanka
 *
 * @wordpress-plugin
 * Plugin Name:       Blanka
 * Plugin URI:        https://blankabrand.com
 * Description:       Connects your Blanka account with WooCommerce.
 * Version:           1.0.7
 * Author:            Blanka
 * Requires at least: 6.2
 * Requires PHP:      7.2
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       blanka
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}




function no_woocommerce_admin_notice__error() {
    $class = 'notice notice-error';
    $message = __( 'Oops! Woocomerce needs to be active to use blanka.', 'blanka-text-domain' );
 
    printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) ); 
}




/**
 * Check if WooCommerce is activated
 */
if ( ! function_exists( 'is_woocommerce_activated' ) ) {
	function is_woocommerce_activated() {

		// Check if WooCommerce is active on the current site
		if (class_exists('WooCommerce')) {
			return true;
		}
		
		 // Check if multisite is enabled
		if (is_multisite()) {
			$network_plugins = wp_get_active_network_plugins();
			
			// Check if WooCommerce is active on any site in the network
			if (in_array('woocommerce/woocommerce.php', $network_plugins)) {
				return true;
			}
		}
		
		return false;
	}
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'BLANKA_VERSION', '1.0.7' );


define( 'BLANKA_APP_URL', 'https://app.blankabrand.com' );
define( 'BLANKA_API', 'https://api.blankabrand.com' );





/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-blanka-activator.php
 */
function activate_blanka() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-blanka-activator.php';
	Blanka_Activator::activate();
}

function load_interface(){
	

	if ( is_woocommerce_activated() ) {
		// Yes, WooCommerce is enabled
		require_once 'includes/class-blanka-admin-dashboard.php';
	} else {
		// WooCommerce is NOT enabled!
		no_woocommerce_admin_notice__error();
		require_once 'includes/class-blanka-admin-dashboard-error.php';
	}
	

}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-blanka-deactivator.php
 */
function deactivate_blanka() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-blanka-deactivator.php';
	Blanka_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_blanka' );
register_deactivation_hook( __FILE__, 'deactivate_blanka' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-blanka.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_blanka() {


	$plugin = new Blanka();
	$plugin->run();



}
run_blanka();
