<?php

namespace WP_Shopify\Factories\Render\Products;

defined('ABSPATH') ?: die;

use WP_Shopify\Render\Products\Hooks;
use WP_Shopify\Factories;

class Hooks_Factory {

	protected static $instantiated = null;

	public static function build($plugin_settings = false) {

		if (is_null(self::$instantiated)) {

			self::$instantiated = new Hooks(
				Factories\Render\Products\Products_Factory::build()
			);

		}

		return self::$instantiated;

	}

}
