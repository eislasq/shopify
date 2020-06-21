<?php

namespace WP_Shopify\Render;

defined('ABSPATH') ?: exit();

/*

Render: Storefront

*/
class Storefront
{
   public $Templates;
   public $Render_Data;
   public $Defaults_Storefront;

   public function __construct($Templates, $Render_Data, $Defaults_Storefront)
   {
      $this->Templates = $Templates;
      $this->Render_Data = $Render_Data;
      $this->Defaults_Storefront = $Defaults_Storefront;
   }

   /*

	Storefront: Storefront

	*/
   public function storefront($data = [])
   {
      return $this->Templates->load([
         'path' => 'components/storefront/storefront',
         'type' => 'storefront',
         'defaults' => 'storefront',
         'data' => array_merge($this->Defaults_Storefront->storefront($data), $data),
         'skip_required_data' => true
      ]);
   }
}