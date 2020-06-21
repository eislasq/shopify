<?php

namespace WP_Shopify\API\Settings;

if (!defined('ABSPATH')) {
    exit();
}

class License extends \WP_Shopify\API
{
    public $DB_Settings_License;
    public $HTTP;
    public $Shopify_API;

    public function __construct(
        $DB_Settings_License,
        $HTTP,
        $Shopify_API,
        $DB_Settings_Syncing
    ) {
        $this->DB_Settings_License = $DB_Settings_License;
        $this->HTTP = $HTTP;
        $this->Shopify_API = $Shopify_API;
        $this->DB_Settings_Syncing = $DB_Settings_Syncing;
    }

    /*

	Get License Details

	*/
    public function get_license($request)
    {
        return $this->handle_response([
            'response' => $this->DB_Settings_License->get(),
        ]);
    }

    /*

	Set License Details

	*/
    public function set_license($request)
    {
        $license = $this->Shopify_API->sanitize_response(
            $request->get_param('license')
        );

        return $this->handle_response([
            'response' => $this->DB_Settings_License->insert_license($license),
        ]);
    }

    /*

	Delete License Details

	*/
    public function delete_license($request)
    {
        return $this->handle_response([
            'response' => $this->deactivate_license(
                $this->DB_Settings_License->get_license()
            ),
        ]);
    }

    /*

	Deactivate License

	*/
    public function deactivate_license($license_key)
    {
        if (empty($license_key) || empty($license_key->license_key)) {
            return false;
        }

        // Deletes the key locally
        $this->DB_Settings_License->truncate();

        $url =
            WP_SHOPIFY_PLUGIN_ENV .
            '/edd-sl?edd_action=deactivate_license&item_name=' .
            WP_SHOPIFY_PLUGIN_NAME_ENCODED .
            '&license=' .
            $license_key->license_key .
            '&url=' .
            home_url();

        return $this->HTTP->request('GET', $url);
    }

    /*

	Register route: collections_heading

	*/
    public function register_route_license()
    {
        return register_rest_route(
            WP_SHOPIFY_SHOPIFY_API_NAMESPACE,
            '/license',
            [
                [
                    'methods' => \WP_REST_Server::READABLE,
                    'callback' => [$this, 'get_license'],
                    'permission_callback' => [$this, 'pre_process'],
                ],
                [
                    'methods' => \WP_REST_Server::CREATABLE,
                    'callback' => [$this, 'set_license'],
                    'permission_callback' => [$this, 'pre_process'],
                ],
            ]
        );
    }

    /*

	Register route: collections_heading

	*/
    public function register_route_license_delete()
    {
        return register_rest_route(
            WP_SHOPIFY_SHOPIFY_API_NAMESPACE,
            '/license/delete',
            [
                [
                    'methods' => \WP_REST_Server::CREATABLE,
                    'callback' => [$this, 'delete_license'],
                    'permission_callback' => [$this, 'pre_process'],
                ],
            ]
        );
    }

    /*

	Hooks

	*/
    public function hooks()
    {
        add_action('rest_api_init', [$this, 'register_route_license']);
        add_action('rest_api_init', [$this, 'register_route_license_delete']);
    }

    /*

  Init

  */
    public function init()
    {
        $this->hooks();
    }
}
