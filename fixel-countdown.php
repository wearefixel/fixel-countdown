<?php
/**
 * Plugin Name: Fixel Countdown
 * Description: A set of reusable ACF fields and helper functions for countdowns.
 * Version: 1.1.1
 * Author: Fixel
 * Author URI: https://wearefixel.com/
 */

define('FXC_VERSION', '1.1.1');
define('FXC_FILE', __FILE__);
define('FXC_PATH', plugin_dir_path(FXC_FILE));
define('FXC_URL', plugin_dir_url(FXC_FILE));
define('FXC_BASENAME', plugin_basename(FXC_FILE));
define('FXC_MIN_PHP', '7.0');
define('FXC_MIN_WP', '4.9');

function fxc_init() {
	if (! version_compare(PHP_VERSION, FXC_MIN_PHP, '>=')) {
		add_action('admin_notices', 'fxc_fail_php_version');
	} elseif (! version_compare(get_bloginfo('version'), FXC_MIN_WP, '>=')) {
		add_action('admin_notices', 'fxc_fail_wp_version');
	} elseif (! class_exists('acf_pro')) {
		add_action('admin_notices', 'fxc_fail_acf');
	} elseif (! get_option('timezone_string')) {
		add_action('admin_notices', 'fxc_fail_timezone');
	} else {
		include_once FXC_PATH . 'vendor/autoload.php';

		Puc_v4_Factory::buildUpdateChecker(
			'https://github.com/wearefixel/fixel-countdown/',
			FXC_FILE,
			'fixel-countdown'
		);

		include_once FXC_PATH . 'includes/acf.php';
		include_once FXC_PATH . 'includes/functions.php';
	}
}
add_action('plugins_loaded', 'fxc_init');

function fxc_fail_php_version() {
	echo '<div class="error"><p>Fixel Countdown requires PHP version ' . FXC_MIN_PHP . ', plugin is currently NOT ACTIVE.</p></div>';
}

function fxc_fail_wp_version() {
	echo '<div class="error"><p>Fixel Countdown requires WordPress version ' . FXC_MIN_WP . ', plugin is currently NOT ACTIVE.</p></div>';
}

function fxc_fail_acf() {
	echo '<div class="error"><p>Fixel Countdown requires <a href="https://www.advancedcustomfields.com/pro/" target="_blank">ACF Pro</a>, plugin is currently NOT ACTIVE.</p></div>';
}

function fxc_fail_timezone() {
	echo '<div class="error"><p>Fixel Countdown requires a <a href="' . esc_url(admin_url('options-general.php')) . '">timezone string</a> (e.g.: “Los Angeles” or “Chicago”) be set, plugin is currently NOT ACTIVE.</p></div>';
}
