<?php

namespace WP_Shopify\API\Items;

use WP_Shopify\Messages;
use WP_Shopify\Utils;
use WP_Shopify\Transients;
use WP_Shopify\CPT;

if (!defined('ABSPATH')) {
    exit();
}

class Collections extends \WP_Shopify\API
{
    public function __construct(
        $DB_Settings_General,
        $DB_Settings_Syncing,
        $DB_Settings_Connection,
        $DB_Collects,
        $Shopify_API,
        $Processing_Collections_Custom,
        $Processing_Collections_Smart,
        $Processing_Posts_Collections_Smart,
        $Processing_Posts_Collections_Custom,
        $Processing_Images,
        $Processing_Collections_Smart_Collects
    ) {
        $this->DB_Settings_General = $DB_Settings_General;
        $this->DB_Settings_Syncing = $DB_Settings_Syncing;
        $this->DB_Settings_Connection = $DB_Settings_Connection;
        $this->DB_Collects = $DB_Collects;
        $this->Shopify_API = $Shopify_API;

        $this->Processing_Collections_Smart = $Processing_Collections_Smart;
        $this->Processing_Collections_Custom = $Processing_Collections_Custom;

        $this->Processing_Posts_Collections_Smart = $Processing_Posts_Collections_Smart;
        $this->Processing_Posts_Collections_Custom = $Processing_Posts_Collections_Custom;
        $this->Processing_Images = $Processing_Images;
        $this->Processing_Collections_Smart_Collects = $Processing_Collections_Smart_Collects;
    }

    /*

	Get Smart Collections Count

	Nonce checks are handled automatically by WordPress

	*/
    public function get_smart_collections_count($request)
    {
        // Get smart collections count
        $response = $this->Shopify_API->get_smart_collections_count();

        return $this->handle_response([
            'response' => $this->Shopify_API->pre_response_check($response),
            'access_prop' => 'count',
            'return_key' => 'smart_collections',
            'warning_message' => 'smart_collections_count_not_found'
        ]);
    }

    public function custom_collections_meta_info()
    {
        return [
            'post_type' => WP_SHOPIFY_COLLECTIONS_POST_TYPE_SLUG,
            'increment_name' => 'custom_collections'
        ];
    }

    public function smart_collections_meta_info()
    {
        return [
            'post_type' => WP_SHOPIFY_COLLECTIONS_POST_TYPE_SLUG,
            'increment_name' => 'smart_collections'
        ];
    }

    /*

	Get Custom Collections

	Nonce checks are handled automatically by WordPress

	*/
    public function get_custom_collections($request)
    {
        $page = $request->get_param('page');

        if (!is_integer($page)) {
            return $this->handle_response([
                'response' => Utils::wp_error([
                    'message_lookup' => 'Page is not of type integer',
                    'call_method' => __METHOD__,
                    'call_line' => __LINE__
                ])
            ]);
        }

        $page = sanitize_text_field($page);

        $param_limit = $this->DB_Settings_General->get_items_per_request();

        // Grab custom collections from Shopify
        $response = $this->Shopify_API->get_custom_collections_per_page(
            $param_limit
        );

        if (is_wp_error($response)) {
            return $this->handle_response(['response' => $response]);
        }

        // Sanitize it
        $response_body = $this->Shopify_API->sanitize_response(
            $response['body']
        );

        $response_body->custom_collections = CPT::add_props_to_items(
            $response_body->custom_collections,
            $this->custom_collections_meta_info()
        );

        return $this->handle_response([
            'response' => $response_body,
            'access_prop' => 'custom_collections',
            'return_key' => 'custom_collections',
            'warning_message' => 'custom_collections_count_not_found',
            'meta' => $this->custom_collections_meta_info(),
            'process_fns' => [
                $this->Processing_Collections_Custom,
                $this->Processing_Images,
                $this->Processing_Posts_Collections_Custom
            ]
        ]);
    }

    /*

	Get smart collections

	Nonce checks are handled automatically by WordPress

	*/
    public function get_smart_collections($request)
    {
        $page = $request->get_param('page');

        if (!is_integer($page)) {
            return $this->handle_response([
                'response' => Utils::wp_error([
                    'message_lookup' => 'Page is not of type integer',
                    'call_method' => __METHOD__,
                    'call_line' => __LINE__
                ])
            ]);
        }

        $page = sanitize_text_field($page);

        $param_limit = $this->DB_Settings_General->get_items_per_request();

        // Grab smart collections from Shopify
        $response = $this->Shopify_API->get_smart_collections_per_page(
            $param_limit
        );

        if (is_wp_error($response)) {
            return $this->handle_response(['response' => $response]);
        }

        // Sanitize it
        $response_body = $this->Shopify_API->sanitize_response(
            $response['body']
        );

        $response_body->smart_collections = CPT::add_props_to_items(
            $response_body->smart_collections,
            $this->smart_collections_meta_info()
        );

        $this->Processing_Collections_Smart_Collects->process(
            $response_body->smart_collections
        );

        return $this->handle_response([
            'response' => $response_body,
            'access_prop' => 'smart_collections',
            'return_key' => 'smart_collections',
            'warning_message' => 'smart_collections_count_not_found',
            'meta' => $this->smart_collections_meta_info(),
            'process_fns' => [
                $this->Processing_Collections_Smart,
                $this->Processing_Images,
                $this->Processing_Posts_Collections_Smart
            ]
        ]);
    }

    /*

	Get Custom Collections Count

	Nonce checks are handled automatically by WordPress

	*/
    public function get_custom_collections_count($request)
    {
        // Get custom collections count
        $response = $this->Shopify_API->get_custom_collections_count();

        return $this->handle_response([
            'response' => $this->Shopify_API->pre_response_check($response),
            'access_prop' => 'count',
            'return_key' => 'custom_collections',
            'warning_message' => 'custom_collections_count_not_found'
        ]);
    }

    /*

	Gets all collections

	*/
    public function get_all_collections($request)
    {
        $has_connection = $this->DB_Settings_Connection->has_connection();

        if (!$has_connection) {
            return $this->send_error(
                Messages::get('connection_not_found') . ' (get_all_collections)'
            );
        }

        $param_limit = $this->DB_Settings_General->get_items_per_request();

        $smart_collections_response = $this->Shopify_API->get_smart_collections_per_page(
            $param_limit
        );

        if (is_wp_error($smart_collections_response)) {
            return $this->handle_response([
                'response' => $smart_collections_response
            ]);
        }

        $custom_collections_response = $this->Shopify_API->get_custom_collections_per_page(
            $param_limit
        );

        if (is_wp_error($custom_collections_response)) {
            return $this->handle_response([
                'response' => $custom_collections_response
            ]);
        }

        $smart_collections = $this->Shopify_API->sanitize_response(
            $smart_collections_response['body']
        );
        $custom_collections = $this->Shopify_API->sanitize_response(
            $custom_collections_response['body']
        );

        if (Utils::has($smart_collections, 'errors')) {
            return $this->handle_response([
                'response' => $smart_collections
            ]);
        }

        if (Utils::has($custom_collections, 'errors')) {
            return $this->handle_response([
                'response' => $custom_collections
            ]);
        }

        $collections_merged = array_merge(
            $smart_collections->smart_collections,
            $custom_collections->custom_collections
        );

        if (!empty($collections_merged)) {
            $collections_merged_final_reduced = array_map(function (
                $collection
            ) {
                $new_collection_obj = new \stdClass();
                $new_collection_obj->id = $collection->id;
                $new_collection_obj->title = $collection->title;

                return $new_collection_obj;
            },
            $collections_merged);

            return $this->handle_response([
                'response' => $collections_merged
            ]);
        }
    }

    public function insert_collections_posts()
    {
        return $this->handle_response([
            'response' => CPT::get_all_posts_truncated(
                WP_SHOPIFY_COLLECTIONS_POST_TYPE_SLUG,
                ['ID', 'post_name']
            ),
            'process_fns' => [$this->Processing_Posts]
        ]);
    }

    /*

	Register route: cart_icon_color

	*/
    public function register_route_collections_posts()
    {
        return register_rest_route(
            WP_SHOPIFY_SHOPIFY_API_NAMESPACE,
            '/collections/posts',
            [
                [
                    'methods' => \WP_REST_Server::CREATABLE,
                    'callback' => [$this, 'insert_collections_posts'],
                    'permission_callback' => [$this, 'pre_process']
                ]
            ]
        );
    }

    /*

	Register route: cart_icon_color

	*/
    public function register_route_smart_collections_count()
    {
        return register_rest_route(
            WP_SHOPIFY_SHOPIFY_API_NAMESPACE,
            '/smart_collections/count',
            [
                [
                    'methods' => \WP_REST_Server::CREATABLE,
                    'callback' => [$this, 'get_smart_collections_count'],
                    'permission_callback' => [$this, 'pre_process']
                ]
            ]
        );
    }

    /*

	Register route: cart_icon_color

	*/
    public function register_route_custom_collections_count()
    {
        return register_rest_route(
            WP_SHOPIFY_SHOPIFY_API_NAMESPACE,
            '/custom_collections/count',
            [
                [
                    'methods' => \WP_REST_Server::CREATABLE,
                    'callback' => [$this, 'get_custom_collections_count'],
                    'permission_callback' => [$this, 'pre_process']
                ]
            ]
        );
    }

    /*

	Register route: cart_icon_color

	*/
    public function register_route_smart_collections()
    {
        return register_rest_route(
            WP_SHOPIFY_SHOPIFY_API_NAMESPACE,
            '/smart_collections',
            [
                [
                    'methods' => \WP_REST_Server::CREATABLE,
                    'callback' => [$this, 'get_smart_collections'],
                    'permission_callback' => [$this, 'pre_process']
                ]
            ]
        );
    }

    /*

	Register route: cart_icon_color

	*/
    public function register_route_custom_collections()
    {
        return register_rest_route(
            WP_SHOPIFY_SHOPIFY_API_NAMESPACE,
            '/custom_collections',
            [
                [
                    'methods' => \WP_REST_Server::CREATABLE,
                    'callback' => [$this, 'get_custom_collections'],
                    'permission_callback' => [$this, 'pre_process']
                ]
            ]
        );
    }

    /*

	Register route: cart_icon_color

	*/
    public function register_route_collections()
    {
        return register_rest_route(
            WP_SHOPIFY_SHOPIFY_API_NAMESPACE,
            '/collections',
            [
                [
                    'methods' => \WP_REST_Server::CREATABLE,
                    'callback' => [$this, 'get_all_collections'],
                    'permission_callback' => [$this, 'pre_process']
                ]
            ]
        );
    }

    /*

	Hooks

	*/
    public function hooks()
    {
        add_action('rest_api_init', [
            $this,
            'register_route_smart_collections_count'
        ]);
        add_action('rest_api_init', [
            $this,
            'register_route_smart_collections'
        ]);

        add_action('rest_api_init', [
            $this,
            'register_route_custom_collections_count'
        ]);
        add_action('rest_api_init', [
            $this,
            'register_route_custom_collections'
        ]);

        add_action('rest_api_init', [$this, 'register_route_collections']);
    }

    /*

  Init

  */
    public function init()
    {
        $this->hooks();
    }
}
