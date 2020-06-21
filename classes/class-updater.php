<?php

namespace WP_Shopify;

use WP_Shopify\Utils;
use WP_Shopify\Options;

if (!defined('ABSPATH')) {
    exit();
}

class Updater
{
    private $DB_Settings_License;
    private $DB_Settings_General;

    public function __construct($DB_Settings_License, $DB_Settings_General)
    {
        $this->DB_Settings_License = $DB_Settings_License;
        $this->DB_Settings_General = $DB_Settings_General;
    }

    /*

	check_for_updates

	*/
    public function check_for_updates($license)
    {
        /*

		This is the URL our updater / license checker pings. This should be the URL of the site with EDD installed
		you should use your own CONSTANT name, and be sure to replace it throughout this file

		*/
        if (!defined('EDD_SL_STORE_URL')) {
            define('EDD_SL_STORE_URL', WP_SHOPIFY_PLUGIN_ENV);
        }

        // The name of your product. This should match the download name in EDD exactly
        if (!defined('EDD_SAMPLE_ITEM_ID')) {
            define('EDD_SAMPLE_ITEM_ID', 35);
        }

        // load our custom updater
        if (!class_exists('WP_Shopify_EDD_SL_Plugin_Updater')) {
            include WP_SHOPIFY_PLUGIN_DIR_PATH .
                'vendor/EDD/WP_Shopify_EDD_SL_Plugin_Updater.php';
        }

        // Setup the updater
        // Calls the init() function within the constructor
        return new \WP_Shopify_EDD_SL_Plugin_Updater(
            EDD_SL_STORE_URL,
            WP_SHOPIFY_BASENAME,
            [
                'version' => WP_SHOPIFY_NEW_PLUGIN_VERSION,
                'license' => $license->license_key,
                'item_name' => WP_SHOPIFY_PLUGIN_NAME_FULL,
                'item_id' => EDD_SAMPLE_ITEM_ID,
                'author' => WP_SHOPIFY_PLUGIN_NAME_FULL,
                'url' => home_url(),
                'beta' => $this->DB_Settings_General->get_enable_beta(),
            ]
        );
    }

    public function init_updates()
    {
        $license = $this->DB_Settings_License->get_license();

        if ($this->DB_Settings_License->has_active_license_key($license)) {
            $this->check_for_updates($license);
        }
    }

    /*

	Init

	*/
    public function init()
    {
    }
}
