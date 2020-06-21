<?php

namespace WP_Shopify\Render;

use WP_Shopify\Utils;
use WP_Shopify\Utils\Data as Utils_Data;

if (!defined('ABSPATH')) {
    exit();
}

class Attributes
{
    public function __construct()
    {
    }

    /*

    Formats shortcode attribute

    UNDER TEST

     */
    public function format_shortcode_attr($arg_value)
    {
        if (is_string($arg_value)) {
            if (Utils_Data::contains_comma($arg_value)) {
                return array_filter(
                    Utils::comma_list_to_array($this->to_type(trim($arg_value)))
                );
            } else {
                $this->to_type(trim($arg_value));
            }
        }

        return $this->to_type($arg_value);
    }

    public function to_type($value)
    {
        if ($value === 'true' || $value === 'false') {
            return $this->attr_to_boolean($value);
        }

        if (is_numeric($value)) {
            return $this->attr_to_integer($value);
        }

        return $value;
    }

    /*

    Formats shortcode attributeS

    UNDER TEST

     */
    public function format_shortcode_attrs($shortcode_args)
    {
        if (empty($shortcode_args)) {
            return [];
        }

        foreach ($shortcode_args as $arg_name => $arg_value) {
            if (\is_array($shortcode_args[$arg_name])) {
                $shortcode_args[$arg_name] = $this->format_shortcode_attrs(
                    $shortcode_args[$arg_name]
                );
            } else {
                $shortcode_args[$arg_name] = $this->format_shortcode_attr(
                    $arg_value
                );
            }
        }

        return $shortcode_args;
    }

    public function standardize_layout_data($shortcode_args)
    {
        if (!isset($shortcode_args) || !$shortcode_args) {
            return [];
        }

        return $this->format_shortcode_attrs($shortcode_args);
    }

    public function combine_user_and_default_atts($atts, $defaults_fn)
    {
        return shortcode_atts($defaults_fn(), $atts);
    }

    public function gather_shortcode_atts($atts, $defaults_method)
    {
        $combined = $this->combine_user_and_default_atts(
            $atts,
            function () use ($defaults_method) {
                return $defaults_method();
            }
        );

        return $this->standardize_layout_data($combined);
    }

    public function get_attributes($atts, $class, $method)
    {
        return $this->gather_shortcode_atts($atts, [$class, $method]);
    }

    public function attr_to_boolean($attr_val)
    {
        if ($attr_val === 'true' || $attr_val == 1) {
            return true;
        }

        return false;
    }

    public function attr_to_integer($attr_val)
    {
        return (int) $attr_val;
    }

    public function attr_to_string($attr_val)
    {
        if (\is_array($attr_val)) {
            return $attr_val;
        }

        if (is_bool($attr_val)) {
            return $attr_val ? 'true' : 'false';
        }

        return (string) $attr_val;
    }

    public function has_attr($attributes, $value)
    {
        return isset($attributes[$value]) && !empty($attributes[$value]);
    }

    public function add_boolean_to_query($key, $val)
    {
        if (is_bool($val)) {
            $bool_converted = $val ? 'true' : 'false';
        } else {
            $bool_converted = $val;
        }

        return $key . ':' . $bool_converted;
    }

    /*

    Defaults to a phrase query which surrounds each term in double quotes

     */
    public function add_string_to_query($key, $val)
    {
        if (substr($val, -1) === '*') {
            return $key . ':' . $val;
        } else {
            return $key . ':' . '"' . $val . '"';
        }
    }

    public function query_checks($key, $val, $query)
    {
        if (is_bool($val) || $val === 'true' || $val === 'false') {
            $query .= $this->add_boolean_to_query($key, $val);
        } else {
            $query .= $this->add_string_to_query($key, $val);
        }

        return $query;
    }

    public function add_nested_query($key, $values, $all_attrs)
    {
        $query = '';

        foreach ($values as $val) {
            $query = $this->query_checks($key, $val, $query);

            if ($val !== end($values)) {
                $query .= ' ' . strtoupper($all_attrs['connective']) . ' ';
            }
        }

        return $query;
    }

    public function build_query($filter_params, $all_attrs)
    {
        if (!array_filter($filter_params)) {
            return 'TITLE:*'; // Returns the default query instead
        }

        if (isset($filter_params['available_for_sale'])) {
            if ($filter_params['available_for_sale'] === 'unavailable') {
                $filter_params['available_for_sale'] = 'false';
            } elseif ($filter_params['available_for_sale'] === 'available') {
                $filter_params['available_for_sale'] = 'true';
            } elseif ($filter_params['available_for_sale'] === 'any') {
                $filter_params['available_for_sale'] = false;
            }
        }

        $query = '';
        $valid_filter_params = array_filter($filter_params);

        foreach ($valid_filter_params as $key => $value) {
            if (\is_array($value)) {
                $query .= $this->add_nested_query($key, $value, $all_attrs);
            } else {
                $query = $this->query_checks($key, $value, $query);
            }

            if ($value !== end($valid_filter_params)) {
                if ($key === 'available_for_sale') {
                    $query .= ' AND ';
                } else {
                    $query .= ' ' . strtoupper($all_attrs['connective']) . ' ';
                }
            }
        }

        // Fallback
        if ($query === '') {
            $query = '*';
        }

        return $query;
    }

    public function attr($attrs, $attr_name, $default, $override = false)
    {
        if (
            !\is_array($attrs) ||
            !\array_key_exists($attr_name, $attrs) ||
            empty($attrs)
        ) {
            return $default;
        }

        return $attrs[$attr_name];
    }

    public function gather_products_attrs($shortcode_atts)
    {
        $products_only_attrs = [];

        if (!empty($shortcode_atts)) {
            foreach ($shortcode_atts as $key => $value) {
                if (Utils::str_contains($key, 'products_')) {
                    $products_only_attrs[$key] = $value;
                }
            }
        }

        return $products_only_attrs;
    }

    public function add_products_attrs_to_data($all_atts, $products_only_attrs)
    {
        if (empty($products_only_attrs)) {
            return $all_atts;
        } else {
            foreach ($products_only_attrs as $key => $value) {
                $without_prefix = str_replace('products_', '', $key);
                $all_atts['products'][$without_prefix] = $value;
            }
        }

        return $all_atts;
    }

    public function attr_to_bool($attr_val)
    {
        if ($attr_val === 'true' || $attr_val == 1) {
            return true;
        }

        return false;
    }

    public function attr_to_int($attr_val)
    {
        return (int) $attr_val;
    }

    public function combine_products_attributes($all_atts)
    {
        return $this->add_products_attrs_to_data(
            $all_atts,
            $this->gather_products_attrs($all_atts)
        );
    }

    public function get_products_filter_params_from_shortcode($attrs)
    {
        return [
            'available_for_sale' => isset($attrs['available_for_sale'])
                ? $attrs['available_for_sale']
                : 'any',
            'created_at' => isset($attrs['created_at'])
                ? $attrs['created_at']
                : false,
            'product_type' => isset($attrs['product_type'])
                ? $attrs['product_type']
                : false,
            'tag' => isset($attrs['tag']) ? $attrs['tag'] : false,
            'title' => isset($attrs['title']) ? $attrs['title'] : false,
            'updated_at' => isset($attrs['updated_at'])
                ? $attrs['updated_at']
                : false,
            'variants_price' => isset($attrs['variants_price'])
                ? $attrs['variants_price']
                : false,
            'vendor' => isset($attrs['vendor']) ? $attrs['vendor'] : false,
            'id' => isset($attrs['product_id']) ? $attrs['product_id'] : false,
            'collection' => isset($attrs['collection'])
                ? $attrs['collection']
                : false,
        ];
    }

    public function get_collections_filter_params_from_shortcode($attrs)
    {
        return [
            'updated_at' => isset($attrs['updated_at'])
                ? $attrs['updated_at']
                : false,
            'title' => isset($attrs['title']) ? $attrs['title'] : false,
            'collection_type' => isset($attrs['collection_type'])
                ? $attrs['collection_type']
                : false,
        ];
    }
}
