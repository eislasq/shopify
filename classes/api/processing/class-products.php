<?php

namespace WP_Shopify\API\Processing;

if (!defined('ABSPATH')) {
	exit;
}


class Products extends \WP_Shopify\API {

	public $Processing_Products;

	public function __construct($Processing_Products, $DB_Settings_Syncing) {
      $this->Processing_Products = $Processing_Products;
      $this->DB_Settings_Syncing = $DB_Settings_Syncing;
	}


	/*

	Responsible for firing off a background process for smart collections

	*/
	public function process_products($request) {
		$this->Processing_Products->process($request);
	}


	/*

	Register route: /process/products

	*/
  public function register_route_process_products() {

		return register_rest_route( WP_SHOPIFY_SHOPIFY_API_NAMESPACE, '/process/products', [
			[
				'methods'         => \WP_REST_Server::CREATABLE,
            'callback'        => [$this, 'process_products'],
            'permission_callback' => [$this, 'pre_process']
			]
		]);

	}


	/*

	Hooks

	*/
	public function hooks() {
		// add_action('rest_api_init', [$this, 'register_route_process_products']);
	}


  /*

  Init

  */
  public function init() {
		$this->hooks();
  }


}
