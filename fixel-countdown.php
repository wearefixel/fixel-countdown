<?php
/**
 * Plugin Name: Fixel Countdown
 * Description:
 * Version: 1.0.0
 * Author: Fixel
 * Author URI: https://wearefixel.com/
 */

define( 'FXC_VERSION', '1.0.0' );
define( 'FXC_FILE', __FILE__ );
define( 'FXC_PATH', plugin_dir_path( FXC_FILE ) );
define( 'FXC_URL', plugin_dir_url( FXC_FILE ) );
define( 'FXC_BASENAME', plugin_basename( FXC_FILE ) );
define( 'FXC_MIN_PHP', '7.0' );
define( 'FXC_MIN_WP', '4.9' );

function fxc_init() {
	if ( ! version_compare( PHP_VERSION, FXC_MIN_PHP, '>=' ) ) {
		add_action( 'admin_notices', 'fxc_fail_php_version' );
	} elseif ( ! version_compare( get_bloginfo( 'version' ), FXC_MIN_WP, '>=' ) ) {
		add_action( 'admin_notices', 'fxc_fail_wp_version' );
	} elseif ( ! class_exists( 'acf_pro' ) {
		add_action( 'admin_notices', 'fxc_fail_acf' );
	} else {
		// include plugin files
	}
}
add_action( 'plugins_loaded', 'fxc_init' );

function fxc_fail_php_version() {
	echo '<div class="error"><p>Fixel Countdown requires PHP version ' . FXC_MIN_PHP . ', plugin is currently NOT ACTIVE.</p></div>';
}

function fxc_fail_wp_version() {
	echo '<div class="error"><p>Fixel Countdown requires WordPress version ' . FXC_MIN_WP . ', plugin is currently NOT ACTIVE.</p></div>';
}

function fxc_fail_ssp() {
	echo '<div class="error"><p>Fixel Countdown requires <a href="https://www.advancedcustomfields.com/pro/" target="_blank">ACF Pro</a>, plugin is currently NOT ACTIVE.</p></div>';
}
