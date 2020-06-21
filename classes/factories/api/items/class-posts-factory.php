<?php

namespace WP_Shopify\Factories\API\Items;

defined('ABSPATH') ?: die;

use WP_Shopify\API;
use WP_Shopify\Factories;

class Posts_Factory {

	protected static $instantiated = null;

	public static function build($plugin_settings = false) {

		if (is_null(self::$instantiated)) {

			self::$instantiated = new API\Items\Posts(
				Factories\DB\Posts_Factory::build(),
				Factories\Processing\Posts_Relationships_Products_Factory::build(),
				Factories\Processing\Posts_Relationships_Collections_Factory::build(),
            Factories\DB\Products_Factory::build(),
            Factories\DB\Settings_Syncing_Factory::build()
			);

		}

		return self::$instantiated;

	}

}
