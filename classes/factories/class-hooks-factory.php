<?php

namespace WP_Shopify\Factories;

use WP_Shopify\Hooks;
use WP_Shopify\Factories;

if (!defined('ABSPATH')) {
	exit;
}

class Hooks_Factory {

	protected static $instantiated = null;

	public static function build($plugin_settings = false) {
      
      if (!$plugin_settings) {
         $plugin_settings = Factories\DB\Settings_Plugin_Factory::build();
      }

		if (is_null(self::$instantiated)) {

			$Hooks = new Hooks(
				Factories\Utils_Factory::build(),
				Factories\Templates_Factory::build(),
				Factories\Pagination_Factory::build(),
				Factories\Activator_Factory::build($plugin_settings),
            Factories\Render\Data_Factory::build(),
            $plugin_settings,
            Factories\DB\Settings_General_Factory::build(),
            Factories\DB\Settings_Syncing_Factory::build(),
            Factories\DB\Products_Factory::build()
			);

			self::$instantiated = $Hooks;

		}

		return self::$instantiated;

	}

}
