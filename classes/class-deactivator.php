<?php

namespace WP_Shopify;

if (!defined('ABSPATH')) {
	exit;
}


class Deactivator {


	/*

	Initialize the class and set its properties.

	*/
	public function __construct() {

	}


	/*

	Things to do on plugin deactivation

	*/
	public function on_plugin_deactivate() {
      unregister_post_type(WP_SHOPIFY_PRODUCTS_POST_TYPE_SLUG);
      unregister_post_type(WP_SHOPIFY_COLLECTIONS_POST_TYPE_SLUG);
	}


	public function hooks() {
		add_action('wps_on_plugin_deactivate', [$this, 'on_plugin_deactivate']);
	}


	public function init() {
		$this->hooks();
	}


}
