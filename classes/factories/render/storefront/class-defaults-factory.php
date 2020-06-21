<?php

namespace WP_Shopify\Factories\Render\Storefront;

defined('ABSPATH') ?: exit();

use WP_Shopify\Render\Storefront\Defaults;
use WP_Shopify\Factories;

class Defaults_Factory
{
    protected static $instantiated = null;

    public static function build($plugin_settings = false)
    {
        if (is_null(self::$instantiated)) {
            self::$instantiated = new Defaults(
             Factories\DB\Settings_General_Factory::build(),
             Factories\Render\Attributes_Factory::build(),
             Factories\Render\Products\Defaults_Factory::build()
         );
        }

        return self::$instantiated;
    }
}