<?php

namespace WP_Shopify\API\Processing;

if (!defined('ABSPATH')) {
	exit;
}


class Images extends \WP_Shopify\API {

	public $Processing_Images;


	public function __construct($Processing_Images, $DB_Settings_Syncing) {
      $this->Processing_Images = $Processing_Images;
      $this->DB_Settings_Syncing = $DB_Settings_Syncing;
	}


	/*

	Responsible for firing off a background process for images

	*/
	public function process_images($request) {
		$this->Processing_Images->process($request);
	}


	/*

	Register route: /process/images

	*/
  public function register_route_process_images() {

		return register_rest_route( WP_SHOPIFY_SHOPIFY_API_NAMESPACE, '/process/images', [
			[
				'methods'         => \WP_REST_Server::CREATABLE,
            'callback'        => [$this, 'process_images'],
            'permission_callback' => [$this, 'pre_process']
			]
		]);

	}


	/*

	Hooks

	*/
	public function hooks() {
		// add_action('rest_api_init', [$this, 'register_route_process_images']);
	}


  /*

  Init

  */
  public function init() {
		$this->hooks();
  }


}
