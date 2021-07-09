<?php
/**
 * Plugin Name: Green Checker
 * Description: The Green Web Foundation's service to check if a website is hosted green or not.
 * Version: 0.1
 * Author: Hannah Smith
 * License: GPL v2 or laster
 * Text Domain: tgwfgreenchecker
 *
 * @package tgwfgreenchecker
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define plugin wide variables.
define( 'PDEV_DIR', plugin_dir_path( __FILE__ ) );
define( 'URL_DIR', plugin_dir_url( __FILE__ ) );


// Load core modules.
require_once PDEV_DIR . 'src/templates.php';
require_once PDEV_DIR . 'src/shortcodes/green-web-checker.php';

