<?php

$CPT_Model            = WP_Shopify\Factories\CPT_Model_Factory::build();
$DB_Products          = WP_Shopify\Factories\DB\Products_Factory::build();
$DB_Tags              = WP_Shopify\Factories\DB\Tags_Factory::build();
$DB_Variants          = WP_Shopify\Factories\DB\Variants_Factory::build();
$DB_Options           = WP_Shopify\Factories\DB\Options_Factory::build();
$DB_Images            = WP_Shopify\Factories\DB\Images_Factory::build();
$DB_Collects          = WP_Shopify\Factories\DB\Collects_Factory::build();
$API_Items_Collects   = WP_Shopify\Factories\API\Items\Collects_Factory::build();

// Needed because of discrepancies between Shopify's API Product and ProductListing endpoints
$data = $data->product_listing;
$data = $DB_Products->switch_shopify_ids($data, 'product_id', 'id');

$post_id            = $CPT_Model->insert_or_update_product_post($data);
$variants_result    = $DB_Variants->modify_from_shopify( $DB_Variants->modify_options( $DB_Variants->maybe_add_product_id_to_variants($data) ) );
$options_result     = $DB_Options->modify_from_shopify( $DB_Options->modify_options($data) );
$images_result      = $DB_Images->modify_from_shopify( $DB_Images->modify_options($data) );
$collects_result    = $DB_Collects->modify_from_shopify( $DB_Collects->modify_options( $API_Items_Collects->get_collects_from_product($data) ) );

$tags_result        = $DB_Tags->modify_from_shopify(
                        $DB_Tags->modify_options(
                           $DB_Tags->add_tags_to_product(
                           $DB_Tags->construct_tags_for_insert($data, $post_id),
                           $data
                           )
                        )
                     );

if ( $DB_Products->product_exists($data->id) ) {
   $data_result = $DB_Products->update_items_of_type($data);

} else {
   $data_result = $DB_Products->insert_items_of_type( $DB_Products->mod_before_change($data, $post_id) );
}

WP_Shopify\Transients::delete_cached_single_product_by_id($post_id);
WP_Shopify\Transients::delete_cached_product_queries();
WP_Shopify\Transients::delete_cached_prices();