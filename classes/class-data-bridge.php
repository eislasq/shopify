<?php

namespace WP_Shopify;

use WP_Shopify\Options;
use WP_Shopify\Utils;
use WP_Shopify\Utils\Data;

if (!defined('ABSPATH')) {
    exit();
}

class Data_Bridge
{
    public $plugin_settings;
    public $Render_Products_Defaults;

    public function __construct($plugin_settings, $Render_Products_Defaults)
    {
        $this->plugin_settings = $plugin_settings;
        $this->Render_Products_Defaults = $Render_Products_Defaults;
    }

    public function replace_rest_protocol()
    {
        if (\is_ssl()) {
            return str_replace("http://", "https://", \get_rest_url());
        }

        return \get_rest_url();
    }

    public function get_has_connection($connection)
    {
        if (empty($connection)) {
            return false;
        }

        if (
            empty($connection['api_key']) ||
            empty($connection['api_password']) ||
            empty($connection['shared_secret']) ||
            empty($connection['storefront_access_token']) ||
            empty($connection['domain'])
        ) {
            return false;
        }

        return true;
    }

    public function get_settings()
    {
        global $post;
        $general = (array) $this->plugin_settings['general'];
        $connection = $this->plugin_settings['connection'];

        $general_sanitized_settings = Data::sanitize_settings($general);
        $products = $this->get_settings_products();

        return [
            'settings' => [
                'search' => [],
                'storefront' => [],
                'products' => $products,
                'collections' => [],
                'shop' => [],
                'customers' => [],
                'checkout' => [],
                'cart' => [],
                'syncing' => [
                    'reconnectingWebhooks' => false,
                    'hasConnection' => $this->get_has_connection($connection),
                    'isSyncing' => false,
                    'manuallyCanceled' => false,
                    'isClearing' => false,
                    'isDisconnecting' => false,
                    'isConnecting' => false,
                    'maxItemsPerRequest' => WP_SHOPIFY_MAX_ITEMS_PER_REQUEST,
                ],
                'general' => $general_sanitized_settings,
                'connection' => [
                    'storefront' => [
                        'domain' => $connection['domain'],
                        'storefrontAccessToken' =>
                            $connection['storefront_access_token'],
                    ],
                ],
            ],
            'api' => [
                'namespace' => WP_SHOPIFY_SHOPIFY_API_NAMESPACE,
                'baseUrl' => \site_url(),
                'urlPrefix' => \rest_get_url_prefix(),
                'restUrl' => $this->replace_rest_protocol(),
                'nonce' => \wp_create_nonce('wp_rest'),
            ],
            'components' => [
                'payloadCache' => false,
                'options' => \maybe_unserialize(
                    get_option('wpshopify_component_options')
                ),
            ],
            'notices' => $this->plugin_settings['notices'],
            'misc' => [
                'postID' => $post ? $post->ID : false,
                'ajax' => \admin_url('admin-ajax.php'),
                'isMobile' => \wp_is_mobile(),
                'pluginsDirURL' => \plugin_dir_url(dirname(__FILE__)),
                'pluginsDistURL' => plugin_dir_url(dirname(__FILE__)) . 'dist/',
                'adminURL' => \get_admin_url(),
                'siteUrl' => \site_url(),
                'latestVersion' => WP_SHOPIFY_NEW_PLUGIN_VERSION,
                'cacheCleared' => Data::coerce(
                    Options::get('wp_shopify_cache_cleared'),
                    'bool'
                ),
                'latestVersionCombined' => str_replace(
                    '.',
                    '',
                    WP_SHOPIFY_NEW_PLUGIN_VERSION
                ),
                'timers' => [
                    'syncing' => false,
                ],
            ],
        ];
    }

    public function get_settings_products()
    {
        return $this->Render_Products_Defaults->all_products_attributes();
    }

    public function stringify_settings($settings)
    {
        $settings_encoded_string = wp_json_encode(
            Utils::convert_underscore_to_camel_array($settings)
        );

        if (is_admin()) {
            $js_string = "const wpshopify = " . $settings_encoded_string . ";";
        } else {
            $js_string =
                "function deepFreeze(object) {let propNames = Object.getOwnPropertyNames(object);for (let name of propNames) {let value = object[name];object[name] = value && typeof value === 'object' ? deepFreeze(value) : value;}return Object.freeze(object);}const wpshopify = " .
                $settings_encoded_string .
                ";deepFreeze(wpshopify);";
        }

        return $js_string;
    }

    public function add_settings_script($script_dep)
    {
        wp_add_inline_script(
            $script_dep,
            $this->stringify_settings($this->get_settings()),
            'before'
        );
    }
}
