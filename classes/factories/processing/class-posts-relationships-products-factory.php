<?php

namespace WP_Shopify\Factories\Processing;

use WP_Shopify\Processing;
use WP_Shopify\Factories;

if (!defined('ABSPATH')) {
	exit;
}

class Posts_Relationships_Products_Factory {

	protected static $instantiated = null;

  public static function build($plugin_settings = false) {

		if (is_null(self::$instantiated)) {

			self::$instantiated = new Processing\Posts_Relationships_Products(
				Factories\DB\Settings_Syncing_Factory::build(),
				Factories\CPT_Meta_Factory::build(),
				Factories\CPT_Query_Factory::build(),
				Factories\DB\Collections_Factory::build()
			);

		}

		return self::$instantiated;


  }

}
