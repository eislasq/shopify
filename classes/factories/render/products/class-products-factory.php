<?php

namespace WP_Shopify\Factories\Render\Products;

defined('ABSPATH') ?: die;

use WP_Shopify\Render\Products;
use WP_Shopify\Factories;

class Products_Factory {

	protected static $instantiated = null;

	public static function build($plugin_settings = false) {

		if (is_null(self::$instantiated)) {

			self::$instantiated = new Products(
            Factories\Render\Templates_Factory::build(),
            Factories\Render\Data_Factory::build(),
            Factories\Render\Products\Defaults_Factory::build()
			);

		}
      
		return self::$instantiated;

	}

}