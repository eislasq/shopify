<?php

namespace WP_Shopify;

use WP_Shopify\Utils;
use WP_Shopify\Messages;

if (!defined('ABSPATH')) {
    exit();
}

class Webhooks
{
    public $DB_Settings_Connection;
    public $DB_Settings_General;
    public $Template_Loader;

    public function __construct(
        $DB_Settings_Connection,
        $DB_Settings_General,
        $Template_Loader
    ) {
        $this->DB_Settings_Connection = $DB_Settings_Connection;
        $this->DB_Settings_General = $DB_Settings_General;
        $this->Template_Loader = $Template_Loader;
    }

}
