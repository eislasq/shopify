<?php

namespace WP_Shopify\API\Tools;

use WP_Shopify\Messages;


if (!defined('ABSPATH')) {
	exit;
}


class Clear extends \WP_Shopify\API {


	public function __construct($Processing_Database, $DB_Settings_Syncing) {
      $this->Processing_Database = $Processing_Database;
      $this->DB_Settings_Syncing = $DB_Settings_Syncing;
	}


	/*

	Clear Synced

	*/
	public function clear_all($request) {
		return $this->Processing_Database->delete_posts_and_synced_data();
	}

	/*

	Clear Synced

	*/
	public function clear_synced($request) {
		return $this->Processing_Database->delete_only_synced_data();
	}


	/*

	Register route: cart_icon_color

	*/
  public function register_route_tools_clear_all() {

		return register_rest_route( WP_SHOPIFY_SHOPIFY_API_NAMESPACE, '/clear/all', [
			[
				'methods'         => \WP_REST_Server::CREATABLE,
            'callback'        => [$this, 'clear_all'],
            'permission_callback' => [$this, 'pre_process']
			]
		]);

	}


	/*

	Register route: cart_icon_color

	*/
  public function register_route_tools_clear_synced() {

		return register_rest_route( WP_SHOPIFY_SHOPIFY_API_NAMESPACE, '/clear/synced', [
			[
				'methods'         => \WP_REST_Server::CREATABLE,
            'callback'        => [$this, 'clear_synced'],
            'permission_callback' => [$this, 'pre_process']
			]
		]);

	}


	/*

	Hooks

	*/
	public function hooks() {
		add_action('rest_api_init', [$this, 'register_route_tools_clear_all']);
		add_action('rest_api_init', [$this, 'register_route_tools_clear_synced']);
	}


  /*

  Init

  */
  public function init() {
		$this->hooks();
  }


}
