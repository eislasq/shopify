<?php

namespace WP_Shopify\API\Processing;

if (!defined('ABSPATH')) {
	exit;
}


class Collections extends \WP_Shopify\API {

	public $Processing_Collections_Smart;
	public $Processing_Collections_Custom;
	public $Processing_Posts;

	public function __construct($Processing_Collections_Smart, $Processing_Collections_Custom, $Processing_Posts, $DB_Settings_Syncing) {

		$this->Processing_Collections_Smart 		= $Processing_Collections_Smart;
		$this->Processing_Collections_Custom 		= $Processing_Collections_Custom;
      $this->Processing_Posts 								= $Processing_Posts;
      $this->DB_Settings_Syncing = $DB_Settings_Syncing;

	}


	/*

	Responsible for firing off a background process for smart collections

	*/
	public function process_smart_collections($request) {

		$this->Processing_Collections_Smart->process($request);
		$this->Processing_Posts->process($request);

	}


	/*

	Responsible for firing off a background process for custom collections

	*/
	public function process_custom_collections($request) {

		$this->Processing_Collections_Custom->process($request);
		$this->Processing_Posts->process($request);

	}


	/*

	Register route: /process/smart_collections

	*/
  public function register_route_process_smart_collections() {

		return register_rest_route( WP_SHOPIFY_SHOPIFY_API_NAMESPACE, '/process/smart_collections', [
			[
				'methods'         => \WP_REST_Server::CREATABLE,
            'callback'        => [$this, 'process_smart_collections'],
            'permission_callback' => [$this, 'pre_process']
			]
		]);

	}


	/*

	Register route: /process/custom_collections

	*/
  public function register_route_process_custom_collections() {

		return register_rest_route( WP_SHOPIFY_SHOPIFY_API_NAMESPACE, '/process/custom_collections', [
			[
				'methods'         => \WP_REST_Server::CREATABLE,
            'callback'        => [$this, 'process_custom_collections'],
            'permission_callback' => [$this, 'pre_process']
			]
		]);

	}


	/*

	Hooks

	*/
	public function hooks() {
		// add_action('rest_api_init', [$this, 'register_route_process_smart_collections']);
		// add_action('rest_api_init', [$this, 'register_route_process_custom_collections']);
	}


  /*

  Init

  */
  public function init() {
		$this->hooks();
  }


}
