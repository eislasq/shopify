<?php

namespace WP_Shopify;

use WP_Shopify\Utils;
use WP_Shopify\Utils\Data as Utils_Data;
use WP_Shopify\Transients;

if (!defined('ABSPATH')) {
    exit();
}

class CPT
{
    private $DB_Settings_General;
    private $DB_Products;
    private $DB_Collections_Custom;
    private $DB_Collections_Smart;
    private $DB_Collects;
    private $DB_Tags;

    /*

	Initialize the class and set its properties.

	*/
    public function __construct(
        $DB_Settings_General,
        $DB_Products,
        $DB_Collections_Custom,
        $DB_Collections_Smart,
        $DB_Collects,
        $DB_Tags
    ) {
        $this->DB_Settings_General = $DB_Settings_General;
        $this->DB_Products = $DB_Products;
        $this->DB_Collections_Custom = $DB_Collections_Custom;
        $this->DB_Collections_Smart = $DB_Collections_Smart;
        $this->DB_Collects = $DB_Collects;
        $this->DB_Tags = $DB_Tags;
    }

    public static function add_meta_to_cpt($posts)
    {
        return array_map(function ($post) {
            $post->post_meta = get_post_meta($post->ID);

            return $post;
        }, $posts);
    }

    public static function get_post_name($data)
    {
        if (!empty($data->product->post_name)) {
            $post_name = $data->product->post_name;
        } else {
            $post_name = $data->product->handle;
        }

        return $post_name;
    }

    public static function get_all_posts($post_type)
    {
        return get_posts([
            'posts_per_page' => -1,
            'post_type' => $post_type,
            'nopaging' => true,
        ]);
    }

    public static function get_all_posts_by_type($post_type)
    {
        return self::add_meta_to_cpt(self::get_all_posts($post_type));
    }

    public static function get_all_posts_compressed($post_type)
    {
        return self::truncate_post_data(self::get_all_posts($post_type));
    }

    public static function only_id_and_post_name($post)
    {
        return [
            'ID' => $post->ID,
            'post_name' => $post->post_name,
        ];
    }

    public static function truncate_post_data($posts)
    {
        return array_map([__CLASS__, 'only_id_and_post_name'], $posts);
    }

    public function get_page_info_from_type($type)
    {
        $post_id = $this->DB_Settings_General->get_col_value(
            'page_' . $type,
            'string'
        );

        return get_post($post_id);
    }

    public function get_page_slug_from_id($default_slug, $type)
    {
        $object = $this->get_page_info_from_type($type);

        if (empty($object)) {
            return $default_slug;
        }

        return $object->post_name;
    }

    public function find_post_type_slug($type)
    {
        $enable_default_pages = $this->DB_Settings_General->get_col_value(
            'enable_default_pages',
            'bool'
        );

        $default_slug = $type;

        if (!$enable_default_pages) {
            return $default_slug;
        }

        return $this->get_page_slug_from_id($default_slug, $type);
    }

    /*

	CPT: Products

	*/
    public function post_type_products()
    {
        if (post_type_exists(WP_SHOPIFY_PRODUCTS_POST_TYPE_SLUG)) {
            return;
        }

        $slug = $this->find_post_type_slug('products');

        $rewrite_rules = [
            'slug' => $slug,
            'with_front' => false,
            'feeds' => true,
        ];
        $publicly_queryable = true;
        $exclude_from_search = false;

        $labels = [
            'name' => _x('Products', 'Post Type General Name', 'wpshopify'),
            'singular_name' => _x(
                'Product',
                'Post Type Singular Name',
                'wpshopify'
            ),
            'menu_name' => __('Products', 'wpshopify'),
            'parent_item_colon' => __('Parent Item:', 'wpshopify'),
            'new_item' => __('Add New Product', 'wpshopify'),
            'edit_item' => __('Edit Product', 'wpshopify'),
            'not_found' => __('No Products found', 'wpshopify'),
            'not_found_in_trash' => __(
                'No Products found in trash',
                'wpshopify'
            ),
        ];

        $args = [
            'label' => __('Products', 'wpshopify'),
            'description' => __('Custom Post Type for Products', 'wpshopify'),
            'labels' => $labels,
            'supports' => [
                'title',
                'page-attributes',
                'editor',
                'custom-fields',
                'comments',
                'thumbnail',
            ],
            'taxonomies' => ['category'],
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => false,
            'menu_position' => 100,
            'menu_icon' => 'dashicons-megaphone',
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'can_export' => true,
            'has_archive' => false,
            'exclude_from_search' => $exclude_from_search,
            'publicly_queryable' => $publicly_queryable,
            'capability_type' => 'post',
            'rewrite' => $rewrite_rules,
            'capabilities' => [
                'create_posts' => false,
            ],
            'map_meta_cap' => true,
        ];

        register_post_type(
            WP_SHOPIFY_PRODUCTS_POST_TYPE_SLUG,
            apply_filters('wps_register_products_args', $args)
        );
    }

    /*

	CPT: Collections

	*/
    public function post_type_collections()
    {
        if (post_type_exists(WP_SHOPIFY_COLLECTIONS_POST_TYPE_SLUG)) {
            return;
        }

        $slug = $this->find_post_type_slug('collections');

        $rewrite_rules = [
            'slug' => $slug,
            'with_front' => false,
            'feeds' => true,
        ];
        $publicly_queryable = true;
        $exclude_from_search = false;

        $labels = [
            'name' => _x('Collections', 'Post Type General Name', 'wpshopify'),
            'singular_name' => _x(
                'Collection',
                'Post Type Singular Name',
                'wpshopify'
            ),
            'menu_name' => __('Collections', 'wpshopify'),
            'parent_item_colon' => __('Parent Item:', 'wpshopify'),
            'new_item' => __('Add New Collection', 'wpshopify'),
            'edit_item' => __('Edit Collection', 'wpshopify'),
            'not_found' => __('No Collections found', 'wpshopify'),
            'not_found_in_trash' => __(
                'No Collections found in trash',
                'wpshopify'
            ),
        ];

        $args = [
            'label' => __('Collections', 'wpshopify'),
            'description' => __(
                'Custom Post Type for Collections',
                'wpshopify'
            ),
            'labels' => $labels,
            'supports' => [
                'title',
                'page-attributes',
                'editor',
                'custom-fields',
                'comments',
                'thumbnail',
            ],
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => false,
            'menu_position' => 100,
            'menu_icon' => 'dashicons-megaphone',
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'can_export' => true,
            'has_archive' => false,
            'exclude_from_search' => $exclude_from_search,
            'publicly_queryable' => $publicly_queryable,
            'capability_type' => 'post',
            'rewrite' => $rewrite_rules,
            'capabilities' => [
                'create_posts' => false,
            ],
            'map_meta_cap' => true,
        ];

        register_post_type(
            WP_SHOPIFY_COLLECTIONS_POST_TYPE_SLUG,
            apply_filters('wps_register_collections_args', $args)
        );
    }

    /*

	Find Latest Menu Order

	*/
    public static function wps_find_latest_menu_order($type)
    {
        global $post;

        $args = [
            'post_type' => 'wps_' . $type,
            'posts_per_page' => 1,
        ];

        $posts = get_posts($args);

        if (is_array($posts) && empty($posts)) {
            return 1;
        } else {
            return $posts[0]->menu_order + 1;
        }
    }

    /*

	$product_or_collection = Array

	*/
    public static function find_existing_post_id($product_or_collection)
    {
        if (
            is_array($product_or_collection) &&
            !empty($product_or_collection)
        ) {
            $product_or_collection = Utils::get_first_array_item(
                $product_or_collection
            );

            return $product_or_collection->ID;
        } else {
            return false;
        }
    }

    /*

	Returns an array containing only products / collections that match the passed in ID.

	*/
    public static function find_only_existing_posts(
        $existing_items,
        $item_id,
        $post_type = ''
    ) {
        return array_filter($existing_items, function ($existing_item) use (
            $item_id,
            $post_type
        ) {
            if (
                isset($existing_item->post_meta[$post_type . '_id']) &&
                is_array($existing_item->post_meta[$post_type . '_id'])
            ) {
                return $existing_item->post_meta[$post_type . '_id'][0] ==
                    $item_id;
            }
        });
    }

    /*

	Adds the post ID if one exists. Used for building the product / collections model

	*/
    public static function set_post_id_if_exists($model, $existing_post_id)
    {
        if (!empty($existing_post_id)) {
            $model['ID'] = $existing_post_id;
        }

        return $model;
    }

    /*

	Post exists

	*/
    public static function post_exists_by_handle($posts, $post_handle)
    {
        return in_array($post_handle, array_column($posts, 'post_name'));
    }

    /*

	At this point the $savedCollections contains only collection IDs that are NEW.
	We need to now create the proper collects row connection

	*/
    public function add_collects_to_post($saved_collections, $product)
    {
        $insertion_results = [];

        foreach ($saved_collections as $new_saved_collection_id => $value) {
            $product_id = (int) $product->product_id;
            $number_string_1 = (int) substr(
                strval($new_saved_collection_id),
                0,
                -4
            );
            $number_string_2 = (int) substr(strval($product_id), 0, -4);

            $collect = [
                'collect_id' => $number_string_1 . $number_string_2 . 1111,
                'product_id' => $product->product_id,
                'collection_id' => $new_saved_collection_id,
                'featured' => '',
                'position' => '',
                'sort_value' => '',
                'created_at' => date_i18n('Y-m-d H:i:s'),
                'updated_at' => date_i18n('Y-m-d H:i:s'),
            ];

            // Inserts any new collects
            $insertion_results[] = $this->DB_Collects->insert_collect($collect);
        }

        return $insertion_results;
    }

    /*

	At this point the $savedCollections contains only collection IDs that are NEW.
	We need to now create the proper collects row connection

	*/
    public function add_tags_to_post($saved_tags, $product)
    {
        $insertion_results = [];

        foreach ($saved_tags as $saved_tag => $saved_tag_value) {
            $product_id = (int) $product->product_id;
            $numberString1 = (int) ord($saved_tag);
            $numberString2 = (int) substr(strval($product_id), 0, -4);

            $product->id = $product->product_id;

            $final_tags_to_add = $this->DB_Tags->add_tag_id_to_tag(
                $this->DB_Tags->construct_tag_model(
                    $saved_tag,
                    $product,
                    $product->post_id
                )
            );

            // Inserts any new tags
            $insertion_results[] = $this->DB_Tags->insert_tag(
                $final_tags_to_add
            );
        }

        return $insertion_results;
    }

    /*

	Removing collects row from post

	*/
    public function remove_collects_from_post($collects_to_remove)
    {
        $removalResult = [];

        foreach ($collects_to_remove as $collect_id) {
            $removalResult[] = $this->DB_Collects->delete_rows_in(
                $this->DB_Collects->lookup_key,
                $collect_id
            );
        }

        return $removalResult;
    }

    /*

	Removing tags row from post

	*/
    public function remove_tags_from_post($tags_to_remove)
    {
        $removalResult = [];

        foreach ($tags_to_remove as $key => $tag_id) {
            $removalResult[] = $this->DB_Tags->delete_rows_in(
                $this->DB_Tags->lookup_key,
                $tag_id
            );
        }

        return $removalResult;
    }

    /*

	Creating array of collects to potentially remove

	*/
    public function find_items_to_add($current_items, $saved_items)
    {
        foreach ($current_items as $key => $current_item) {
            if (
                isset($current_item->collection_id) &&
                $current_item->collection_id
            ) {
                if (isset($saved_items[$current_item->collection_id])) {
                    unset($saved_items[$current_item->collection_id]);
                }
            }

            if (isset($current_item->tag) && $current_item->tag) {
                if (isset($saved_items[$current_item->tag])) {
                    unset($saved_items[$current_item->tag]);
                }
            }
        }

        return $saved_items;
    }

    public function found_item_to_remove($current_item_id, $saved_items)
    {
        return in_array($current_item_id, $saved_items, true);
    }

    /*

	Creating array of collects to potentially remove

	*/
    public function find_items_to_remove($current_items, $saved_items)
    {
        $current_items_orig = Utils::convert_to_assoc_array($current_items);
        $current_items_to_remove = [];

        foreach ($current_items_orig as $current_item) {
            // Collects
            if (!empty($current_item['collection_id'])) {
                if (
                    !$this->found_item_to_remove(
                        $current_item['collection_id'],
                        $saved_items
                    )
                ) {
                    $current_items_to_remove[] = $current_item['collect_id'];
                }
            }

            // Tags
            if (!empty($current_item['tag_id'])) {
                if (
                    !$this->found_item_to_remove(
                        $current_item['tag_id'],
                        $saved_items
                    )
                ) {
                    $current_items_to_remove[] = $current_item['tag_id'];
                }
            }
        }

        return $current_items_to_remove;
    }

    /*

	Find the WP Post ID of the product being updated

	*/
    public static function find_existing_post_id_from_collection(
        $existing_collections,
        $collection
    ) {
        $found_post = self::find_only_existing_posts(
            $existing_collections,
            $collection->{WP_SHOPIFY_SHOPIFY_PAYLOAD_KEY},
            'collection'
        );
        $found_post_id = self::find_existing_post_id($found_post);

        return $found_post_id;
    }

    /*

	Find the WP Post ID of the product being updated

	*/
    public static function find_existing_post_id_from_product(
        $existing_products,
        $product
    ) {
        $product_id = Utils::find_product_id($product);

        $found_post = self::find_only_existing_posts(
            $existing_products,
            $product_id,
            'product'
        );
        $found_post_id = self::find_existing_post_id($found_post);

        return $found_post_id;
    }

    public static function num_of_posts($type)
    {
        return Utils_Data::add_totals(
            array_values(get_object_vars(wp_count_posts($type)))
        );
    }

    /*

	Checks whether any posts of a given type exist or not

	*/
    public static function posts_exist($type)
    {
        if (self::num_of_posts($type) > 0) {
            return true;
        } else {
            return false;
        }
    }

    function get_shopify_featured_image()
    {
    }

    function has_existing_featured_image()
    {
    }

    function wp_get_attachment_image_attributes_filter(
        $attr,
        $attachment,
        $size
    ) {
        global $post;

        $media = get_attached_media('image', $post->ID);
        $post_type = get_post_type($post->ID);

        if ($post_type !== 'wps_products' && $post_type !== 'wps_collections') {
            return $attr;
        }

        return $attr;
    }

    public function post_thumbnail_html_filter(
        $html,
        $post_ID,
        $post_thumbnail_id,
        $size,
        $attr
    ) {
        if (!empty($html)) {
            return $html;
        }

        $post_type = get_post_type($post_ID);

        if ($post_type !== 'wps_products' && $post_type !== 'wps_collections') {
            return $html;
        }
    }

    /*

	Grabs the current author ID

	*/
    public static function return_author_id()
    {
        if (get_current_user_id() === 0) {
            $author_id = 1;
        } else {
            $author_id = get_current_user_id();
        }

        return intval($author_id);
    }

    /*

	Responsible for assigning a post_id to a post

	*/
    public static function set_post_id($post, $post_id)
    {
        $post->post_id = $post_id;

        return $post;
    }

    public static function get_all_posts_truncated($post_type, $inclusions)
    {
        return Utils::lessen_array_by(
            CPT::get_all_posts($post_type),
            $inclusions
        );
    }

    public static function add_props($item, $props)
    {
        foreach ($props as $key => $value) {
            $item->{$key} = $value;
        }

        return $item;
    }

    public static function add_props_to_items($items, $props)
    {
        return array_map(function ($item) use ($props) {
            return self::add_props($item, $props);
        }, $items);
    }

    public function maybe_flush_rewrite_rules()
    {
        if (get_option('wp_shopify_has_flushed_rewrite_rules')) {
            return;
        }

        flush_rewrite_rules();
        update_option('wp_shopify_has_flushed_rewrite_rules', 1);
    }

    public function create_default_products_page()
    {
        return \wp_insert_post([
            'post_title' => wp_strip_all_tags('WP Shopify Products'),
            'post_status' => 'publish',
            'post_author' => get_current_user_id(),
            'post_type' => 'page',
            'post_name' => 'products',
        ]);
    }

    public function create_default_collections_page()
    {
        return \wp_insert_post([
            'post_title' => wp_strip_all_tags('WP Shopify Collections'),
            'post_status' => 'publish',
            'post_author' => get_current_user_id(),
            'post_type' => 'page',
            'post_name' => 'collections',
        ]);
    }

    public function maybe_create_default_pages()
    {
        $gen_set = $this->DB_Settings_General->get();

        if (!$gen_set) {
            return [];
        }

        $already_created = $this->DB_Settings_General->get_col_value(
            'default_pages_created',
            'bool'
        );

        if ($already_created) {
            return [];
        }

        $created_successfully = false;

        $results = [
            'products' => $this->create_default_products_page(),
            'collections' => $this->create_default_collections_page(),
        ];

        if ($results['products'] && $results['collections']) {
            $created_successfully = true;
        }

        if ($created_successfully) {
            $this->DB_Settings_General->update_column_single(
                ['default_pages_created' => true],
                ['id' => 1]
            );

            if (
                !is_wp_error($results['products']) &&
                $results['products'] !== 0
            ) {
                $this->DB_Settings_General->update_column_single(
                    ['page_products' => $results['products']],
                    ['id' => 1]
                );

                $this->DB_Settings_General->update_column_single(
                    ['page_products_default' => $results['products']],
                    ['id' => 1]
                );

                $this->DB_Settings_General->update_column_single(
                    ['url_products' => get_permalink($results['products'])],
                    ['id' => 1]
                );
            }

            if (
                !is_wp_error($results['collections']) &&
                $results['collections'] !== 0
            ) {
                $this->DB_Settings_General->update_column_single(
                    ['page_collections' => $results['collections']],
                    ['id' => 1]
                );

                $this->DB_Settings_General->update_column_single(
                    ['page_collections_default' => $results['collections']],
                    ['id' => 1]
                );

                $this->DB_Settings_General->update_column_single(
                    [
                        'url_collections' => get_permalink(
                            $results['collections']
                        ),
                    ],
                    ['id' => 1]
                );
            }
        }

        return $results;
    }

    /*

	Hooks

	*/
    public function hooks()
    {
        $this->post_type_products();
        $this->post_type_collections();
        $this->maybe_flush_rewrite_rules();
        $this->maybe_create_default_pages();
    }

    /*

	Register

	*/
    public function init()
    {
        // Already fires on init action from bootstrap
        $this->hooks();
    }
}
