<?php

namespace WP_Shopify\Factories\Render\Products;

defined('ABSPATH') ?: die;

use WP_Shopify\Render\Products\Pre_Render_Gallery;
use WP_Shopify\Factories;

class Pre_Render_Gallery_Factory {

	protected static $instantiated = null;

	public static function build($plugin_settings = false) {

		if (is_null(self::$instantiated)) {

			self::$instantiated = new Pre_Render_Gallery();

		}

		return self::$instantiated;

	}

}
