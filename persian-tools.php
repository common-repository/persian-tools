<?php
/*
 * Plugin Name: Persian Tools
 * Plugin URI: https://themefour.com/
 * Description: یک ابزار کاربردی برای وب‌سایت‌های وردپرسی فارسی!
 * Version: 1.0.7.0
 * Author: تم فور
 * Author URI: https://themefour.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: persian-tools
 * Domain Path: /languages/
 *
 * Requires PHP: 7.4
 * Requires Plugins:
 *
 * Tested up to: 6.6.1
 * WC tested up to: 9.2.0
 * WC requires at least: 8.0
 *
 * @package Persian Tools
 *
 * Copyright 2024 themefour.com

*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/* Define PERSIAN TOOLS_PLUGIN_FILE */
if ( ! defined( 'PERSIAN_TOOLS_PLUGIN_FILE' ) ) {
	define( 'PERSIAN_TOOLS_PLUGIN_FILE', __FILE__ );
}

define('PERSIAN_TOOLS_VERSION', '1.0.7');
define('PERSIAN_TOOLS_URL', plugin_dir_url( __FILE__ ) );
define('PERSIAN_TOOLS_PATH', plugin_dir_path( __FILE__ ) );
define('PERSIAN_TOOLS_FILE_PATH',__FILE__);
define('PERSIAN_TOOLS_ASSETS_PATH', PERSIAN_TOOLS_URL . '/assets' );


/* Run Setup */
include PERSIAN_TOOLS_PATH . '/includes/persian-tools-functions.php';
include PERSIAN_TOOLS_PATH . '/includes/persian-tools-settings.php';
