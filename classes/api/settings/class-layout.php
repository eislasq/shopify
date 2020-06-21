<?php

namespace WP_Shopify\API\Settings;


if (!defined('ABSPATH')) {
	exit;
}


class Layout extends \WP_Shopify\API {

  public $DB_Settings_General;

	public function __construct($DB_Settings_General, $DB_Settings_Syncing) {
      $this->DB_Settings_General = $DB_Settings_General;
      $this->DB_Settings_Syncing = $DB_Settings_Syncing;
	}

	/*

	Hooks

	*/
	public function hooks() {


	}


  /*

  Init

  */
  public function init() {
		$this->hooks();
  }


}
