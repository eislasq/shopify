<?php

namespace WP_Shopify\Factories;

use WP_Shopify\Checkouts;

if (!defined('ABSPATH')) {
	exit;
}

class Checkouts_Factory {

	protected static $instantiated = null;

	public static function build($plugin_settings = false) {

		if (is_null(self::$instantiated)) {

			self::$instantiated = new Checkouts();

		}

		return self::$instantiated;

	}

}
