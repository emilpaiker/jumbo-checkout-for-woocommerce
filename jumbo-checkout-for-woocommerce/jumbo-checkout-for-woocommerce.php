<?php

/**
 * Jumbo checkout for WooCommerce
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link
 * @since             0.1
 * @package           jumbo-checkout-for-woocommerce
 *
 * @wordpress-plugin
 * Plugin Name:       Jumbo checkout for WooCommerce
 * Plugin URI:        https://github.com/emilpaiker/jumbo-checkout-for-woocommerce
 * Description:       Creates a button on the WooCommerce checkout page that inits a sequence of easy to read popup fields.
 * Version:           0.1
 * Pressbooks tested up to: 5.10
 * Author:            Emil Paiker
 * Author URI:        https://github.com/emilpaiker
 * License:           GPL 3.0
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       jumbo-checkout-for-woocommerce
 * Domain Path:       /woocommerce
 * Network: 					Optional
 */

 // Make sure the file is not being accessed directly

defined ("ABSPATH") or die ("Access denied!");

// Include the functions.php file

include_once plugin_dir_path( __FILE__ ) . "/inc/jcfw-functions.php";

// Add action to load template that contains checkout field sequence.

add_action('woocommerce_before_checkout_form','jcfw_load_checkout_sequence_template');

// Add actions to load css and js files

add_action('wp_enqueue_scripts','jcfw_load_assets');

// Add filter to remove the State/Province Checkout field

add_filter( 'woocommerce_checkout_fields' , 'jcfw_remove_checkout_field' );

/**
* Function that enqueues the css file that styles elements of the jumbo checkout plugin
* @since 0.1
*/

function jcfw_load_assets() {
  wp_enqueue_style( 'jcfp-style', plugins_url( '/src/css/jcfw-style.css', __FILE__ ) );
  wp_enqueue_script( 'jcfp-style', plugins_url( '/src/js/jcfw-checkout-sequence.js', __FILE__ ) );
}
