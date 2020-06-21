<?php

namespace WP_Shopify\API\Processing;

if (!defined('ABSPATH')) {
	exit;
}


class Tags extends \WP_Shopify\API {

	public $Processing_Tags;


	public function __construct($Processing_Tags, $DB_Settings_Syncing) {
      $this->Processing_Tags = $Processing_Tags;
      $this->DB_Settings_Syncing = $DB_Settings_Syncing;
	}


	/*

	Responsible for firing off a background process for smart collections

	*/
	public function process_tags($request) {
		$this->Processing_Tags->process($request);
	}


	/*

	Register route: /process/tags

	*/
  public function register_route_process_tags() {

		return register_rest_route( WP_SHOPIFY_SHOPIFY_API_NAMESPACE, '/process/tags', [
			[
				'methods'         => \WP_REST_Server::CREATABLE,
            'callback'        => [$this, 'process_tags'],
            'permission_callback' => [$this, 'pre_process']
			]
		]);

	}


	/*

	Hooks

	*/
	public function hooks() {
		// add_action('rest_api_init', [$this, 'register_route_process_tags']);
	}


  /*

  Init

  */
  public function init() {
		$this->hooks();
  }


}
