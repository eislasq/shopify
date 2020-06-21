<?php

defined('ABSPATH') ?: die();

get_header('wpshopify');

global $post;

$Products = WP_Shopify\Factories\Render\Products\Products_Factory::build();

$Products->products(
    apply_filters('wps_products_single_args', [
        'dropzone_product_buy_button' => '#product_buy_button',
        'dropzone_product_title' => '#product_title',
        'dropzone_product_description' => '#product_description',
        'dropzone_product_pricing' => '#product_pricing',
        'dropzone_product_gallery' => '#product_gallery',
        'link_to' => 'none',
    ])
);
?>

<section class="wps-container">

   <style>

      .wps-breadcrumbs + .wps-product-single {
            margin-top: 0;
         }

      .wps-product-single {
         margin-top: 1em;
         margin-bottom: 4em;
         display: flex;
      }

      .wps-product-single-content,
      .wps-product-single-gallery {
         width: 50%;
         max-width: 50%;
         flex: 0 0 50%;
      }

      .wps-product-single-content {
         padding: 0em 2em 2em 2em;
      }

      .wps-component-products-title .wps-products-title {
         margin-top: 0;
         font-size: 34px;
      }

   </style>

   <?= do_action('wps_breadcrumbs') ?>

   <div class="wps-product-single">

      <div class="wps-product-single-gallery">
         <div id="product_gallery"></div>
      </div>

      <div class="wps-product-single-content">
         
         <div id="product_title"></div>
         <div id="product_pricing"></div>
         <div id="product_description"></div>
         <div id="product_buy_button"></div>

      </div>

   </div>

</section>

<?php get_footer('wpshopify');
