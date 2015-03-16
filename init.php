<?php
/*
Plugin Name: WooCommerce Shipment Tracking
Plugin URI: http://yithemes.com/themes/plugins/yith-woocommerce-order-tracking/
Description: Easy managing order tracking information for WooCommerce orders. Set the carrier and the tracking code and your customers will get notified about their shipping.
Author: woocommerceplugin
Text Domain: ywot
Version: 1.0.2
Author URI: http://yithemes.com

@author Yithemes
@package WooCommerce Shipment Tracking
@version 1.0.2
*/

/*  Copyright 2015  Your Inspiration Themes  (email : plugins@yithemes.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

if ( ! function_exists( 'is_plugin_active' ) ) 
{	require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

function yith_ywot_install_woocommerce_admin_notice() {
	?>
	<div class="error">
		<p><?php _e( 'WooCommerce Shipment Tracking is enabled but not effective. It requires Woocommerce in order to work.', 'yit' ); ?></p>
	</div>
<?php
}

function yith_ywot_install_free_admin_notice() {
	?>
	<div class="error">
		<p><?php _e( 'You can\'t activate the free version of WooCommerce Shipment Tracking while you are using the premium one.', 'yit' ); ?></p>
	</div>
<?php
}

if ( ! function_exists( 'yith_plugin_registration_hook' ) ) {
	require_once 'plugin-fw/yit-plugin-registration-hook.php';
}
register_activation_hook( __FILE__, 'yith_plugin_registration_hook' );

//region    ****    Define constants
if ( ! defined( 'YITH_YWOT_FREE_INIT' ) ) {
	define( 'YITH_YWOT_FREE_INIT', plugin_basename( __FILE__ ) );
}

if ( ! defined( 'YITH_YWOT_VERSION' ) ) {
	define( 'YITH_YWOT_VERSION', '1.0.2' );
}

if ( ! defined( 'YITH_YWOT_FILE' ) ) {
	define( 'YITH_YWOT_FILE', __FILE__ );
}

if ( ! defined( 'YITH_YWOT_DIR' ) ) {
	define( 'YITH_YWOT_DIR', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'YITH_YWOT_URL' ) ) {
	define( 'YITH_YWOT_URL', plugins_url( '/', __FILE__ ) );
}

if ( ! defined( 'YITH_YWOT_ASSETS_URL' ) ) {
	define( 'YITH_YWOT_ASSETS_URL', YITH_YWOT_URL . 'assets' );
}

if ( ! defined( 'YITH_YWOT_TEMPLATE_PATH' ) ) {
	define( 'YITH_YWOT_TEMPLATE_PATH', YITH_YWOT_DIR . 'templates' );
}

if ( ! defined( 'YITH_YWOT_ASSETS_IMAGES_URL' ) ) {
	define( 'YITH_YWOT_ASSETS_IMAGES_URL', YITH_YWOT_ASSETS_URL . '/images/' );
}
//endregion

function yith_ywot_init() {

	/**
	 * Load text domain and start plugin
	 */
	load_plugin_textdomain( 'ywot', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

	// Load required classes and functions
	require_once( YITH_YWOT_DIR . 'class.yith-woocommerce-order-tracking.php' );

	$YWOT_Instance = new Yith_WooCommerce_Order_Tracking();
}
add_action( 'yith_ywot_init', 'yith_ywot_init' );



function yith_ywot_install() {

	if ( ! function_exists( 'WC' ) ) {
		add_action( 'admin_notices', 'yith_ywot_install_woocommerce_admin_notice' );
	}
	elseif ( defined( 'YITH_YWOT_PREMIUM' ) ) {
		add_action( 'admin_notices', 'yith_ywot_install_free_admin_notice' );
		deactivate_plugins( plugin_basename( __FILE__ ) );
	}
	else {
		do_action( 'yith_ywot_init' );
	}
}
add_action( 'plugins_loaded', 'yith_ywot_install', 11 );


