<?php

namespace WP_Shopify\Utils;

use WP_Shopify\Utils;

if (!defined('ABSPATH')) {
	exit;
}


class Posts {

	public static function is_modify_posts_error($result) {

		if ( is_wp_error($result) || $result === false ) {
			return true;
		}

		return false;

	}

}
