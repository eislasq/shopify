<?php

namespace WP_Shopify\Factories\Render;

if (!defined('ABSPATH')) {
   exit();
}


use WP_Shopify\Render\Attributes;

class Attributes_Factory
{
   protected static $instantiated = null;

   public static function build($plugin_settings = false)
   {
      if (is_null(self::$instantiated)) {
         self::$instantiated = new Attributes();
      }

      return self::$instantiated;
   }
}