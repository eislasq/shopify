<?php

namespace WP_Shopify\Factories\Render\Products;

defined('ABSPATH') ?: die;

use WP_Shopify\Render\Products\Pre_Render_Options;
use WP_Shopify\Factories;

class Pre_Render_Options_Factory {

	protected static $instantiated = null;

	public static function build($plugin_settings = false) {

		if (is_null(self::$instantiated)) {

			self::$instantiated = new Pre_Render_Options();

		}

		return self::$instantiated;

	}

}
