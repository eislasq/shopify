<?php

/*

Plugin Name:         WP Shopify
Plugin URI:          https://wpshop.io
Description:         Sell and build custom Shopify experiences on WordPress.
Version:             3.0.5
Author:              WP Shopify
Author URI:          https://wpshop.io
License:             GPL-2.0+
License URI:         http://www.gnu.org/licenses/gpl-2.0.txt
Text Domain:         wpshopify
Domain Path:         /languages
Requires at least:   4.7
Requires PHP:        5.6

*/

global $wp_version;
global $wpshopify;

require_once ABSPATH . 'wp-admin/includes/plugin.php';

if (
    !function_exists('version_compare') ||
    version_compare(PHP_VERSION, '5.6.0', '<')
) {
    wp_die(
        esc_html__(
            "Sorry, WP Shopify requires PHP version 5.6 or higher. Please look through <a href=\"https://docs.wpshop.io/#/getting-started/requirements\" target=\"_blank\">our requirements</a> page to learn more. Often times you can simply ask your webhost to upgrade for you. <br><br><a href=" .
                admin_url('plugins.php') .
                " class=\"button button-primary\">Back to plugins</a>.",
            'wpshopify'
        )
    );
}

if (version_compare($wp_version, '5.0', '<')) {
    wp_die(
        esc_html__(
            "Sorry, WP Shopify requires WordPress version 5.0 or higher. Please look through <a href=\"https://docs.wpshop.io/#/getting-started/requirements\" target=\"_blank\">our requirements</a> page to learn more. Often times you can simply ask your webhost to upgrade for you. <br><br><a href=" .
                admin_url('plugins.php') .
                " class=\"button button-primary\">Back to plugins</a>.",
            'wpshopify'
        )
    );
}


// If this file is called directly, abort.
defined('WPINC') ?: die();

// If this file is called directly, abort.
defined('ABSPATH') ?: die();

/*

Used for both free / pro versions

*/
if (!defined('WP_SHOPIFY_BASENAME')) {
    define('WP_SHOPIFY_BASENAME', plugin_basename(__FILE__));
}

if (!defined('WP_SHOPIFY_ROOT_FILE_PATH')) {
    define('WP_SHOPIFY_ROOT_FILE_PATH', __FILE__);
}

if (!defined('WP_SHOPIFY_PLUGIN_DIR')) {
    define('WP_SHOPIFY_PLUGIN_DIR', plugin_dir_path(__FILE__));
}

/*

Autoload everything

*/

require_once plugin_dir_path(__FILE__) . 'lib/autoloader.php'; // Our autoloader
require_once plugin_dir_path(__FILE__) . 'vendor/autoload.php'; // Composer autoloader

use WP_Shopify\Bootstrap;
use WP_Shopify\Utils;

if (!\function_exists('wpshopify_bootstrap')) {
    function wpshopify_bootstrap()
    {
        // initialize
        if (!isset($wpshopify)) {
            $wpshopify = new Bootstrap();
            $wpshopify->initialize();
        }

        // return
        return $wpshopify;
    }
}

wpshopify_bootstrap();

/*

Adds hooks which run on both plugin activation and deactivation.
The actions here are added during Activator->init() and Deactivator-init().

*/
register_activation_hook(__FILE__, function ($network_wide) {
    do_action('wps_on_plugin_activate', $network_wide);
});

register_deactivation_hook(__FILE__, function () {
    do_action('wps_on_plugin_deactivate');
});
