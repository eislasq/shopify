<?php

defined('ABSPATH') ?: die();

get_header('wpshopify');

$Products = WP_Shopify\Factories\Render\Products\Products_Factory::build();

global $post;
?>

<style>
.wps-products-wrapper {
  display: flex;
}

.wps-products-content {
  flex: 1;
}

.wps-products-sidebar {
  width: 30%;
}
</style>

<section class="wps-products-wrapper wps-container">

   <div class="wps-products-content">

      <header class="wps-products-header">
         <h1 class="wps-heading">
            <?= apply_filters('wps_products_all_title', $post->post_title) ?>
         </h1>
      </header>
      
      <?= do_action('wps_breadcrumbs') ?>

      <div class="wps-products-all">
         <?php $Products->products(
             apply_filters('wps_products_all_args', [])
         ); ?>
      </div>

      <section class="wps-page-content">
         <?= apply_filters(
             'wps_products_all_content',
             get_post_field('post_content', $post->ID)
         ) ?>
      </section>
      
   </div>

   <?php if (apply_filters('wps_products_show_sidebar', true)) { ?>
      <div class="wps-sidebar wps-products-sidebar">
         <?= get_sidebar('wpshopify') ?>
      </div>
   <?php } ?>

</section>

<?php get_footer('wpshopify');
