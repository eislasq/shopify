<?php

namespace WP_Shopify\API\Items;

if (!defined('ABSPATH')) {
	exit;
}


class Variants extends \WP_Shopify\API {

	public function __construct($DB_Products, $DB_Variants, $DB_Settings_Syncing) {

		$this->DB_Products = $DB_Products;
      $this->DB_Variants = $DB_Variants;
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