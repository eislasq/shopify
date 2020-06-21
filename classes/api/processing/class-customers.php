<?php

namespace WP_Shopify\API\Processing;

if (!defined('ABSPATH')) {
	exit;
}


class Customers extends \WP_Shopify\API {

	public $Processing_Customers;


	public function __construct($Processing_Customers, $DB_Settings_Syncing) {
      $this->Processing_Customers = $Processing_Customers;
      $this->DB_Settings_Syncing = $DB_Settings_Syncing;
	}


	/*

	Responsible for firing off a background process for smart collections

	*/
	public function process_customers($request) {
		$this->Processing_Customers->process($request);
	}

   
	/*

	Register route: /process/customers

	*/
  public function register_route_process_customers() {

		return register_rest_route( WP_SHOPIFY_SHOPIFY_API_NAMESPACE, '/process/customers', [
			[
				'methods'         => \WP_REST_Server::CREATABLE,
            'callback'        => [$this, 'process_customers'],
            'permission_callback' => [$this, 'pre_process']
			]
		]);

	}


	/*

	Hooks

	*/
	public function hooks() {
		// add_action('rest_api_init', [$this, 'register_route_process_customers']);
	}


  /*

  Init

  */
  public function init() {
		$this->hooks();
  }


}
