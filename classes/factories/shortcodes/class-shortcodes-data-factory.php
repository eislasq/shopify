<?php

namespace WP_Shopify\Factories\Shortcodes;

defined('ABSPATH') ?: exit();

use WP_Shopify\Shortcodes;

class Shortcodes_Data_Factory
{
   protected static $instantiated = null;

   public static function build($plugin_settings = false)
   {
      if (is_null(self::$instantiated)) {
         self::$instantiated = new Shortcodes\Shortcodes_Data();
      }

      return self::$instantiated;
   }
}
