<?php

namespace WP_Shopify\Factories\Render\Cart;

if (!defined('ABSPATH')) {
    exit();
}

use WP_Shopify\Render\Cart\Defaults;
use WP_Shopify\Factories;

class Defaults_Factory
{
    protected static $instantiated = null;

    public static function build($plugin_settings = false)
    {

      if (!$plugin_settings) {
         $plugin_settings = Factories\DB\Settings_Plugin_Factory::build();
      }

      if (is_null(self::$instantiated)) {
         self::$instantiated = new Defaults(
            $plugin_settings,
            Factories\Render\Attributes_Factory::build()
         );
      }

      return self::$instantiated;
      
    }
}