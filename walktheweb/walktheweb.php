<?php
/*
Plugin Name: WalkTheWeb
Plugin URI: https://wordpress.org/plugins/walktheweb/
Description: WalkTheWeb is your opening into the 3D Internet Metaverse/Multiverse. WalkTheWeb allows you to put 3D Shopping Stores, using your existing WooCommerce online store, into a 3D Game environment in less than 5 minutes to give you more more Internet traffic and more sales! Join the 3D Internet now!
Version: 2.0.0
Author: WalkTheWeb
Author URI: https://www.walktheweb.com/
Developer: Dr. Aaron Dishno, HTTP3D Inc.
Developer URI: https://www.walktheweb.com/wiki/dr-aaron-dishno/
WC requires at least: 3.3
WC tested up to: 7.0
Copyright: © 2013-2022 WalkTheWeb.
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
Text Domain: walktheweb
Domain Path: /languages/
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 *  Define WTW_PLUGIN_FILE.
 */
if (!defined('WTW_PLUGIN_FILE')) {
	define('WTW_PLUGIN_FILE', __FILE__);
}

/**
 * Include the main WalkTheWeb class.
 */
if (!class_exists('WalkTheWeb')) {
	require_once dirname( __FILE__).'/classes/class-walktheweb.php';
}

/**
 * Main instance of WalkTheWeb.
 */
function wtw() {
	return WalkTheWeb::instance();
}

// Global for backwards compatibility.
$GLOBALS['WalkTheWeb'] = wtw();
?>