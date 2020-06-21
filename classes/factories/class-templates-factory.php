<?php

namespace WP_Shopify\Factories;

use WP_Shopify\Templates;
use WP_Shopify\Factories;

if (!defined('ABSPATH')) {
   exit();
}

class Templates_Factory
{
   protected static $instantiated = null;

   public static function build($plugin_settings = false)
   {
      if (is_null(self::$instantiated)) {
         $Templates = new Templates(
            Factories\Template_Loader_Factory::build(),
            Factories\DB\Settings_General_Factory::build(),
            Factories\Money_Factory::build(),
            Factories\DB\Variants_Factory::build(),
            Factories\DB\Products_Factory::build(),
            Factories\DB\Images_Factory::build(),
            Factories\DB\Tags_Factory::build(),
            Factories\DB\Options_Factory::build(),
            Factories\DB\Collections_Factory::build(),
            Factories\Render\Data_Factory::build(),
            Factories\DB\Customers_Factory::build()
         );

         self::$instantiated = $Templates;
      }

      return self::$instantiated;
   }
}
