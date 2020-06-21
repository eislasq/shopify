<?php

namespace WP_Shopify\API\Processing;

if (!defined('ABSPATH')) {
	exit;
}


class Shop extends \WP_Shopify\API {

	public $Processing_Shop;

	public function __construct($Processing_Shop, $DB_Settings_Syncing) {
      $this->Processing_Shop = $Processing_Shop;
      $this->DB_Settings_Syncing = $DB_Settings_Syncing;
	}


	/*

	Responsible for firing off a background process for smart collections

	*/
	public function process_shop($request) {
		$this->Processing_Shop->process($request);
	}


	/*

	Register route: /process/smart_collections

	*/
  public function register_route_process_shop() {

		return register_rest_route( WP_SHOPIFY_SHOPIFY_API_NAMESPACE, '/process/shop', [
			[
				'methods'         => \WP_REST_Server::CREATABLE,
            'callback'        => [$this, 'process_shop'],
            'permission_callback' => [$this, 'pre_process']
			]
		]);

	}


	/*

	Hooks

	*/
	public function hooks() {
		// add_action('rest_api_init', [$this, 'register_route_process_shop']);
	}


  /*

  Init

  */
  public function init() {
		$this->hooks();
  }


}
