<?php

namespace WP_Shopify\Render\Products;

use WP_Shopify\Utils\Data;

if (!defined('ABSPATH')) {
    exit();
}

class Defaults
{
    public $plugin_settings;
    public $Render_Attributes;

    public function __construct($plugin_settings, $Render_Attributes)
    {
        $this->plugin_settings = $plugin_settings;
        $this->Render_Attributes = $Render_Attributes;
    }

    public function lowercase_filter_params($filter_params)
    {
        return array_map(function ($value) {
            if (is_array($value)) {
                return $this->lowercase_filter_params($value);
            }

            if (is_string($value)) {
                return strtolower($value);
            }

            return $value;
        }, $filter_params);
    }

    public function create_product_query($all_attrs)
    {
        $filter_params = $this->Render_Attributes->get_products_filter_params_from_shortcode(
            $this->Render_Attributes->format_shortcode_attrs($all_attrs)
        );

        if (!isset($all_attrs['connective'])) {
            $defaults = $this->products_component_attributes($all_attrs);

            if (empty($all_attrs)) {
                $all_attrs = [];
            }

            $all_attrs['connective'] = strtoupper($defaults['connective']);
        }

        $final_query = $this->Render_Attributes->build_query(
            $this->lowercase_filter_params($filter_params),
            $all_attrs
        );

        return $final_query;
    }

    public function product_add_to_cart($attrs)
    {
        return $this->Render_Attributes->standardize_layout_data(
            array_merge($this->all_products_attributes($attrs), [
                'excludes' => apply_filters(
                    'wps_products_excludes',
                    $this->Render_Attributes->attr($attrs, 'excludes', [
                        'title',
                        'pricing',
                        'description',
                        'images',
                    ])
                ),
            ])
        );
    }

    public function product_buy_button($attrs)
    {
        return $this->product_add_to_cart($attrs);
    }

    public function product_title($attrs)
    {
        return $this->Render_Attributes->standardize_layout_data(
            array_merge($this->all_products_attributes($attrs), [
                'excludes' => apply_filters(
                    'wps_products_excludes',
                    $this->Render_Attributes->attr($attrs, 'excludes', [
                        'description',
                        'buy-button',
                        'images',
                        'pricing',
                    ])
                ),
            ])
        );
    }

    public function product_description($attrs)
    {
        return $this->Render_Attributes->standardize_layout_data(
            array_merge($this->all_products_attributes($attrs), [
                'excludes' => apply_filters(
                    'wps_products_excludes',
                    $this->Render_Attributes->attr($attrs, 'excludes', [
                        'title',
                        'buy-button',
                        'images',
                        'pricing',
                    ])
                ),
            ])
        );
    }

    public function product_pricing($attrs)
    {
        return $this->Render_Attributes->standardize_layout_data(
            array_merge($this->all_products_attributes($attrs), [
                'excludes' => apply_filters(
                    'wps_products_excludes',
                    $this->Render_Attributes->attr($attrs, 'excludes', [
                        'title',
                        'buy-button',
                        'images',
                        'description',
                    ])
                ),
            ])
        );
    }

    public function product_gallery($attrs)
    {
        return $this->Render_Attributes->standardize_layout_data(
            array_merge($this->all_products_attributes($attrs), [
                'excludes' => apply_filters(
                    'wps_products_excludes',
                    $this->Render_Attributes->attr($attrs, 'excludes', [
                        'title',
                        'pricing',
                        'description',
                        'buy-button',
                    ])
                ),
            ])
        );
    }

    public function products($attrs)
    {
        $layout_data = $this->Render_Attributes->standardize_layout_data(
            $this->all_products_attributes($attrs)
        );

        return $layout_data;
    }

    public function products_settings_attributes($attrs)
    {
        return [
            'add_to_cart_button_color' => apply_filters(
                'wps_products_add_to_cart_button_color',
                $this->Render_Attributes->attr(
                    $attrs,
                    'add_to_cart_button_color',
                    $this->plugin_settings['general']['add_to_cart_color']
                )
            ),
            'variant_button_color' => apply_filters(
                'wps_products_variant_button_color',
                $this->Render_Attributes->attr(
                    $attrs,
                    'variant_button_color',
                    $this->plugin_settings['general']['variant_color']
                )
            ),
            'variant_style' => apply_filters(
                'wps_products_variant_style',
                $this->Render_Attributes->attr(
                    $attrs,
                    'variant_style',
                    $this->plugin_settings['general']['variant_style']
                )
            ),
            'hide_quantity' => apply_filters(
                'wps_products_hide_quantity',
                $this->Render_Attributes->attr($attrs, 'hide_quantity', false)
            ),
            'add_to_cart_button_text' => apply_filters(
                'wps_products_add_to_cart_button_text',
                $this->Render_Attributes->attr(
                    $attrs,
                    'add_to_cart_button_text',
                    WP_SHOPIFY_DEFAULT_ADD_TO_CART_TEXT
                )
            ),
            'min_quantity' => apply_filters(
                'wps_products_min_quantity',
                $this->Render_Attributes->attr($attrs, 'min_quantity', 1)
            ),
            'max_quantity' => apply_filters(
                'wps_products_max_quantity',
                $this->Render_Attributes->attr($attrs, 'max_quantity', false)
            ),
            'show_quantity_label' => apply_filters(
                'wps_products_show_quantity_label',
                $this->Render_Attributes->attr(
                    $attrs,
                    'show_quantity_label',
                    'hello'
                )
            ),
            'quantity_label_text' => apply_filters(
                'wps_products_quantity_label_text',
                $this->Render_Attributes->attr(
                    $attrs,
                    'quantity_label_text',
                    'Quantity'
                )
            ),
            'show_price_range' => apply_filters(
                'wps_products_show_price_range',
                $this->Render_Attributes->attr(
                    $attrs,
                    'show_price_range',
                    $this->plugin_settings['general'][
                        'products_show_price_range'
                    ]
                )
            ),
            'show_compare_at' => apply_filters(
                'wps_products_show_compare_at',
                $this->Render_Attributes->attr(
                    $attrs,
                    'show_compare_at',
                    $this->plugin_settings['general']['products_compare_at']
                )
            ),
            'show_featured_only' => apply_filters(
                'wps_products_show_featured_only',
                $this->Render_Attributes->attr(
                    $attrs,
                    'show_featured_only',
                    false
                )
            ),
            'show_zoom' => apply_filters(
                'wps_products_show_zoom',
                $this->Render_Attributes->attr(
                    $attrs,
                    'show_zoom',
                    $this->plugin_settings['general'][
                        'products_images_show_zoom'
                    ]
                )
            ),
        ];
    }

    public function products_query_attributes($attrs)
    {
        $page_size = $this->Render_Attributes->attr(
            $attrs,
            'page_size',
            $this->plugin_settings['general']['num_posts']
        );

        return [
            'query' => apply_filters(
                'wps_products_query',
                $this->Render_Attributes->attr(
                    $attrs,
                    'query',
                    $this->create_product_query($attrs)
                )
            ),
            'sort_by' => apply_filters(
                'wps_products_sort_by',
                $this->Render_Attributes->attr($attrs, 'sort_by', 'TITLE')
            ),
            'reverse' => apply_filters(
                'wps_products_reverse',
                $this->Render_Attributes->attr($attrs, 'reverse', false)
            ),
            'page_size' => apply_filters('wps_products_page_size', $page_size),
        ];
    }

    public function products_component_attributes($attrs)
    {
        return [
            'product' => apply_filters(
                'wps_products_product',
                $this->Render_Attributes->attr($attrs, 'product', false)
            ),
            'product_id' => apply_filters(
                'wps_products_product_id',
                $this->Render_Attributes->attr($attrs, 'product_id', false)
            ),
            'post_id' => apply_filters(
                'wps_products_post_id',
                $this->Render_Attributes->attr($attrs, 'post_id', false)
            ),
            'available_for_sale' => apply_filters(
                'wps_products_available_for_sale',
                $this->Render_Attributes->attr(
                    $attrs,
                    'available_for_sale',
                    'any'
                )
            ),
            'created_at' => apply_filters(
                'wps_products_created_at',
                $this->Render_Attributes->attr($attrs, 'created_at', false)
            ),
            'product_type' => apply_filters(
                'wps_products_product_type',
                $this->Render_Attributes->attr($attrs, 'product_type', false)
            ),
            'tag' => apply_filters(
                'wps_products_tag',
                $this->Render_Attributes->attr($attrs, 'tag', false)
            ),
            'collection' => apply_filters(
                'wps_products_collection',
                $this->Render_Attributes->attr($attrs, 'collection', false)
            ),
            'title' => apply_filters(
                'wps_products_query_title',
                $this->Render_Attributes->attr($attrs, 'title', false)
            ),
            'title_size' => apply_filters(
                'wps_products_title_size',
                $this->Render_Attributes->attr($attrs, 'title_size', '22px')
            ),
            'title_color' => apply_filters(
                'wps_products_title_color',
                $this->Render_Attributes->attr($attrs, 'title_color', '#111')
            ),
            'description_length' => apply_filters(
                'wps_products_description_length',
                $this->Render_Attributes->attr(
                    $attrs,
                    'description_length',
                    false
                )
            ),
            'description_size' => apply_filters(
                'wps_products_description_size',
                $this->Render_Attributes->attr(
                    $attrs,
                    'description_size',
                    '16px'
                )
            ),
            'description_color' => apply_filters(
                'wps_products_description_color',
                $this->Render_Attributes->attr(
                    $attrs,
                    'description_color',
                    '#111'
                )
            ),
            'updated_at' => apply_filters(
                'wps_products_query_updated_at',
                $this->Render_Attributes->attr($attrs, 'updated_at', false)
            ),
            'variants_price' => apply_filters(
                'wps_products_variants_price',
                $this->Render_Attributes->attr($attrs, 'variants_price', false)
            ),
            'vendor' => apply_filters(
                'wps_products_vendor',
                $this->Render_Attributes->attr($attrs, 'vendor', false)
            ),
            'post_meta' => apply_filters(
                'wps_products_post_meta',
                $this->Render_Attributes->attr($attrs, 'post_meta', false)
            ),
            'connective' => apply_filters(
                'wps_products_connective',
                $this->Render_Attributes->attr($attrs, 'connective', 'AND')
            ),
            'render_from_server' => apply_filters(
                'wps_products_render_from_server',
                $this->Render_Attributes->attr(
                    $attrs,
                    'render_from_server',
                    false
                )
            ),
            'limit' => apply_filters(
                'wps_products_limit',
                $this->Render_Attributes->attr($attrs, 'limit', false)
            ),
            'random' => apply_filters(
                'wps_products_random',
                $this->Render_Attributes->attr($attrs, 'random', false)
            ),
            'excludes' => apply_filters(
                'wps_products_excludes',
                $this->Render_Attributes->attr($attrs, 'excludes', [
                    'description',
                ])
            ),
            'items_per_row' => apply_filters(
                'wps_products_items_per_row',
                $this->Render_Attributes->attr($attrs, 'items_per_row', 3)
            ),
            'no_results_text' => apply_filters(
                'wps_products_no_results_text',
                $this->Render_Attributes->attr(
                    $attrs,
                    'no_results_text',
                    'No products left to show'
                )
            ),
            'align_height' => apply_filters(
                'wps_products_align_height',
                $this->Render_Attributes->attr($attrs, 'align_height', false)
            ),
            'pagination' => apply_filters(
                'wps_products_pagination',
                $this->Render_Attributes->attr($attrs, 'pagination', true)
            ),
            'pagination_page_size' => apply_filters(
                'wps_products_pagination_page_size',
                $this->Render_Attributes->attr(
                    $attrs,
                    'pagination_page_size',
                    false
                )
            ),
            'pagination_load_more' => apply_filters(
                'wps_products_pagination_load_more',
                $this->Render_Attributes->attr(
                    $attrs,
                    'pagination_load_more',
                    true
                )
            ),
            'dropzone_pagination' => apply_filters(
                'wps_products_dropzone_pagination',
                $this->Render_Attributes->attr(
                    $attrs,
                    'dropzone_pagination',
                    false
                )
            ),
            'dropzone_page_size' => apply_filters(
                'wps_products_dropzone_page_size',
                $this->Render_Attributes->attr(
                    $attrs,
                    'dropzone_page_size',
                    false
                )
            ),
            'dropzone_load_more' => apply_filters(
                'wps_products_dropzone_load_more',
                $this->Render_Attributes->attr(
                    $attrs,
                    'dropzone_load_more',
                    false
                )
            ),
            'dropzone_product_buy_button' => apply_filters(
                'wps_products_dropzone_product_buy_button',
                $this->Render_Attributes->attr(
                    $attrs,
                    'dropzone_product_buy_button',
                    false
                )
            ),
            'dropzone_product_title' => apply_filters(
                'wps_products_dropzone_product_title',
                $this->Render_Attributes->attr(
                    $attrs,
                    'dropzone_product_title',
                    false
                )
            ),
            'dropzone_product_vendor' => apply_filters(
                'wps_products_dropzone_product_vendor',
                $this->Render_Attributes->attr(
                    $attrs,
                    'dropzone_product_vendor',
                    false
                )
            ),
            'dropzone_product_tax' => apply_filters(
                'wps_products_dropzone_product_tax',
                $this->Render_Attributes->attr(
                    $attrs,
                    'dropzone_product_tax',
                    false
                )
            ),
            'dropzone_product_description' => apply_filters(
                'wps_products_dropzone_product_description',
                $this->Render_Attributes->attr(
                    $attrs,
                    'dropzone_product_description',
                    false
                )
            ),
            'dropzone_product_pricing' => apply_filters(
                'wps_products_dropzone_product_pricing',
                $this->Render_Attributes->attr(
                    $attrs,
                    'dropzone_product_pricing',
                    false
                )
            ),
            'dropzone_product_gallery' => apply_filters(
                'wps_products_dropzone_product_gallery',
                $this->Render_Attributes->attr(
                    $attrs,
                    'dropzone_product_gallery',
                    false
                )
            ),
            'skip_initial_render' => apply_filters(
                'wps_products_skip_initial_render',
                $this->Render_Attributes->attr(
                    $attrs,
                    'skip_initial_render',
                    false
                )
            ),
            'data_type' => apply_filters(
                'wps_products_data_type',
                $this->Render_Attributes->attr($attrs, 'data_type', 'products')
            ),
            'infinite_scroll' => apply_filters(
                'wps_products_infinite_scroll',
                $this->Render_Attributes->attr($attrs, 'infinite_scroll', false)
            ),
            'infinite_scroll_offset' => apply_filters(
                'wps_products_infinite_scroll_offset',
                $this->Render_Attributes->attr(
                    $attrs,
                    'infinite_scroll_offset',
                    -200
                )
            ),
            'is_singular' => is_singular(WP_SHOPIFY_PRODUCTS_POST_TYPE_SLUG),
            'hide_wrapper' => apply_filters(
                'wps_products_hide_wrapper',
                $this->Render_Attributes->attr($attrs, 'hide_wrapper', false)
            ),
            'link_to' => apply_filters(
                'wps_products_link_to',
                $this->Render_Attributes->attr(
                    $attrs,
                    'link_to',
                    $this->plugin_settings['general']['products_link_to']
                )
            ),
            'link_target' => apply_filters(
                'wps_products_link_target',
                $this->Render_Attributes->attr(
                    $attrs,
                    'link_target',
                    $this->plugin_settings['general']['products_link_target']
                )
            ),
            'direct_checkout' => apply_filters(
                'wps_products_direct_checkout',
                $this->Render_Attributes->attr($attrs, 'direct_checkout', false)
            ),
        ];
    }

    public function all_products_attributes($attrs = [])
    {
        return array_merge(
            $this->products_query_attributes($attrs),
            $this->products_settings_attributes($attrs),
            $this->products_component_attributes($attrs)
        );
    }
}
