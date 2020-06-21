<?php

$DB_Products      = WP_Shopify\Factories\DB\Products_Factory::build();
$DB_Variants      = WP_Shopify\Factories\DB\Variants_Factory::build();
$DB_Options       = WP_Shopify\Factories\DB\Options_Factory::build();
$DB_Images        = WP_Shopify\Factories\DB\Images_Factory::build();
$DB_Collects      = WP_Shopify\Factories\DB\Collects_Factory::build();
$DB_Tags          = WP_Shopify\Factories\DB\Tags_Factory::build();
$DB_Posts         = WP_Shopify\Factories\DB\Posts_Factory::build();

$product_id = $data->product_listing->product_id;
$post_id = $DB_Products->get_post_id_from_product_id($product_id);

$DB_Products->delete_products_from_product_id($product_id);
$DB_Variants->delete_variants_from_product_id($product_id);
$DB_Options->delete_options_from_product_id($product_id);
$DB_Images->delete_images_from_product_id($product_id);
$DB_Collects->delete_collects_from_product_id($product_id);
$DB_Tags->delete_tags_from_product_id($product_id);
$DB_Posts->delete_posts_by_ids($post_id);

WP_Shopify\Transients::delete_cached_prices();
WP_Shopify\Transients::delete_cached_variants();
WP_Shopify\Transients::delete_cached_product_single();
WP_Shopify\Transients::delete_cached_product_queries();