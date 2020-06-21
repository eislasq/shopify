<?php

namespace WP_Shopify\Render;

use WP_Shopify\Utils;
use WP_Shopify\Options;

if (!defined('ABSPATH')) {
    exit();
}

class Root
{
    public function __construct($Template_Loader)
    {
        $this->Template_Loader = $Template_Loader;
    }

    public function generate_component_id($encoded_data_string)
    {
        return Utils::hash($encoded_data_string);
    }

    public function encode_component_data($data)
    {
        return Utils::base64($data);
    }

    public function encode_component_query_params($data)
    {
        if ($data->type === 'cart') {
            return false;
        }

        return $this->encode_component_data([
            'query' => isset($data->data['query']) ? $data->data['query'] : '*',
            'first' => isset($data->data['page_size'])
                ? $data->data['page_size']
                : 10,
            'reverse' => isset($data->data['reverse'])
                ? $data->data['reverse']
                : false,
            'sort_by' => isset($data->data['sort_by'])
                ? $data->data['sort_by']
                : false
        ]);
    }

    public function encode_component_connection_params($data)
    {
        if ($data->type !== 'collections') {
            return false;
        }

        return $this->encode_component_data([
            'query' => isset($data->data['products']['query'])
                ? $data->data['products']['query']
                : '*',
            'sortKey' => isset($data->data['products']['sort_by'])
                ? $data->data['products']['sort_by']
                : false,
            'reverse' => isset($data->data['products']['reverse'])
                ? $data->data['products']['reverse']
                : false,
            'first' => isset($data->data['products']['page_size'])
                ? $data->data['products']['page_size']
                : 9
        ]);
    }

    public function update_component_options($component_id, $data)
    {
        return Options::update(
            'wpshopify_component_options_' . $component_id,
            $data
        );
    }

    public function render_root_component($data)
    {
        return $this->Template_Loader
            ->set_template_data($data)
            ->get_template_part('components/root/element');
    }
}
