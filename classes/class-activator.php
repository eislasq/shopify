<?php

namespace WP_Shopify;

use WP_Shopify\Utils;
use WP_Shopify\Options;
use WP_Shopify\Transients;

if (!defined('ABSPATH')) {
    exit();
}

class Activator
{
    public $DB_Settings_Connection;
    public $DB_Settings_General;
    public $DB_Settings_License;
    public $DB_Shop;
    public $DB_Products;
    public $DB_Variants;
    public $DB_Collects;
    public $DB_Options;
    public $DB_Collections_Custom;
    public $DB_Collections_Smart;
    public $DB_Images;
    public $DB_Tags;
    public $DB_Customers;
    public $DB_Orders;
    public $DB_Settings_Syncing;
    public $Async_Processing_Database;

    public function __construct(
        $DB_Settings_Connection,
        $DB_Settings_General,
        $DB_Settings_License,
        $DB_Shop,
        $DB_Products,
        $DB_Variants,
        $DB_Collects,
        $DB_Options,
        $DB_Collections_Custom,
        $DB_Collections_Smart,
        $DB_Images,
        $DB_Tags,
        $DB_Customers,
        $DB_Orders,
        $DB_Settings_Syncing,
        $Async_Processing_Database
    ) {
        $this->DB_Settings_Connection = $DB_Settings_Connection;
        $this->DB_Settings_General = $DB_Settings_General;
        $this->DB_Settings_License = $DB_Settings_License;
        $this->DB_Shop = $DB_Shop;
        $this->DB_Products = $DB_Products;
        $this->DB_Variants = $DB_Variants;
        $this->DB_Collects = $DB_Collects;
        $this->DB_Options = $DB_Options;
        $this->DB_Collections_Custom = $DB_Collections_Custom;
        $this->DB_Collections_Smart = $DB_Collections_Smart;
        $this->DB_Images = $DB_Images;
        $this->DB_Tags = $DB_Tags;
        $this->DB = $DB_Tags; // alias only

        // Pro only
        $this->DB_Customers = $DB_Customers;
        $this->DB_Orders = $DB_Orders;

        $this->DB_Settings_Syncing = $DB_Settings_Syncing;
        $this->Async_Processing_Database = $Async_Processing_Database;
    }

    /*

	Create DB Tables

	*/
    public function create_db_tables()
    {
        $results = [];

        $results[
            'DB_Settings_Connection'
        ] = $this->DB_Settings_Connection->create_table();
        $results[
            'DB_Settings_General'
        ] = $this->DB_Settings_General->create_table();
        $results[
            'DB_Settings_License'
        ] = $this->DB_Settings_License->create_table();
        $results['DB_Shop'] = $this->DB_Shop->create_table();
        $results['DB_Products'] = $this->DB_Products->create_table();
        $results['DB_Variants'] = $this->DB_Variants->create_table();
        $results['DB_Collects'] = $this->DB_Collects->create_table();
        $results['DB_Options'] = $this->DB_Options->create_table();
        $results[
            'DB_Collections_Custom'
        ] = $this->DB_Collections_Custom->create_table();
        $results[
            'DB_Collections_Smart'
        ] = $this->DB_Collections_Smart->create_table();
        $results['DB_Images'] = $this->DB_Images->create_table();
        $results['DB_Tags'] = $this->DB_Tags->create_table();
        $results[
            'DB_Settings_Syncing'
        ] = $this->DB_Settings_Syncing->create_table();


        return $results;
    }

    /*

	Sets default plugin settings and inserts default rows

	*/
    public function set_default_table_values()
    {
        $results = [];

        $results['DB_Settings_General'] = $this->DB_Settings_General->init();
        $results['DB_Settings_Syncing'] = $this->DB_Settings_Syncing->init();

        return $results;
    }

    public function set_table_charset_cache()
    {
        $this->DB_Settings_General->get_table_charset(
            $this->DB_Settings_Connection->get_table_name()
        );
        $this->DB_Settings_General->get_table_charset(
            $this->DB_Settings_General->get_table_name()
        );
        $this->DB_Settings_General->get_table_charset(
            $this->DB_Settings_License->get_table_name()
        );
        $this->DB_Settings_General->get_table_charset(
            $this->DB_Settings_Syncing->get_table_name()
        );
        $this->DB_Settings_General->get_table_charset(
            $this->DB_Shop->get_table_name()
        );
        $this->DB_Settings_General->get_table_charset(
            $this->DB_Products->get_table_name()
        );
        $this->DB_Settings_General->get_table_charset(
            $this->DB_Variants->get_table_name()
        );
        $this->DB_Settings_General->get_table_charset(
            $this->DB_Collects->get_table_name()
        );
        $this->DB_Settings_General->get_table_charset(
            $this->DB_Options->get_table_name()
        );
        $this->DB_Settings_General->get_table_charset(
            $this->DB_Collections_Custom->get_table_name()
        );
        $this->DB_Settings_General->get_table_charset(
            $this->DB_Collections_Smart->get_table_name()
        );
        $this->DB_Settings_General->get_table_charset(
            $this->DB_Images->get_table_name()
        );
        $this->DB_Settings_General->get_table_charset(
            $this->DB_Tags->get_table_name()
        );

    }

    public function bootstrap_tables()
    {
        $results = [];

        $results['create_db_tables'] = $this->create_db_tables();
        $results[
            'set_default_table_values'
        ] = $this->set_default_table_values();
        $results['set_table_charset_cache'] = $this->set_table_charset_cache();

        return $results;
    }

    public function deactivate_free_version()
    {
        require_once Utils::get_abs_admin_path('includes/plugin.php');

        \deactivate_plugins($this->DB_Settings_General->get_free_basename());
    }

    /*

	Helper for checking whether the bootstrapping has occurred or not.

	*/
    public function plugin_ready()
    {
        return Options::get('wp_shopify_is_ready');
    }

    public function get_ready()
    {
        $results = [];

        /* 
      
      Important to clear for wordpress.com / object caching. Otherwise, tables are 
      not created for some reason.

      */
        $results['bootstrap_wp_cache_flush'] = wp_cache_flush();

        $results[
            'bootstrap_transient_delete_all_cache'
        ] = Transients::delete_all_cache();

        // Builds the custom tables
        $results['bootstrap_tables'] = $this->bootstrap_tables();

        // Create plugin default pages
        // add_role( 'wpshopify_customer', 'Shopify Customer', ['read' => true, 'edit_posts' => false] );

        return $results;
    }

    public function bootstrap_blogs()
    {
        $blog_ids = $this->DB->get_network_sites();
        $results = [];

        foreach ($blog_ids as $blog_id) {
            $results[] = $this->bootstrap_blog($blog_id);
        }

        return $results;
    }

    /*

	Runs when the plugin is activated as a result of register_activation_hook.

	Runs for both Free and Pro versions

	*/
    public function on_plugin_activate($network_wide)
    {
        if (is_multisite() && $network_wide) {
            return $this->bootstrap_blogs();
        }

        return $this->get_ready();
    }

    public function bootstrap_blog($blog_id)
    {
        switch_to_blog($blog_id);

        // Bootstraps tables, creates CPTs, and flushes rewrites
        $ready_result = $this->get_ready();

        restore_current_blog();

        return $ready_result;
    }

    /*

	Runs when a new blog is created within a multi-site setup. NOT when activated network wide.

	*/
    public function on_blog_create(
        $blog_id,
        $user_id,
        $domain,
        $path,
        $site_id,
        $meta
    ) {
        if (Utils::is_network_wide()) {
            $this->bootstrap_blog($blog_id);
        }
    }

    public function on_blog_create_from_wp_site($blog)
    {
        if (is_object($blog) && isset($blog->blog_id)) {
            if (Utils::is_network_wide()) {
                $this->bootstrap_blog($blog->blog_id);
            }
        }
    }

    /*

	Deletes custom tables when blog is deleted

	$tables is an array containing a list of table names in string format

	*/
    public function on_blog_delete($tables)
    {
        $tables[] = $this->DB_Settings_Connection->get_table_name();
        $tables[] = $this->DB_Settings_General->get_table_name();
        $tables[] = $this->DB_Settings_License->get_table_name();
        $tables[] = $this->DB_Shop->get_table_name();
        $tables[] = $this->DB_Products->get_table_name();
        $tables[] = $this->DB_Variants->get_table_name();
        $tables[] = $this->DB_Collects->get_table_name();
        $tables[] = $this->DB_Options->get_table_name();
        $tables[] = $this->DB_Collections_Custom->get_table_name();
        $tables[] = $this->DB_Collections_Smart->get_table_name();
        $tables[] = $this->DB_Images->get_table_name();
        $tables[] = $this->DB_Tags->get_table_name();
        $tables[] = $this->DB_Settings_Syncing->get_table_name();


        return $tables;
    }

    /*

     Runs when the plugin updates.

     Will only run once since we're updating the plugin version after everything gets executed.

     TODO: This functions gets executed many times. Even though most of the time it will return
     immediately, it will still make an unnecessary call to get_current_plugin_version() which
     actually gets the DB. We should figure out a way to avoid this.

     */
    public function on_plugin_update()
    {
        $new_version_number = WP_SHOPIFY_NEW_PLUGIN_VERSION;

        $current_version_number = $this->DB_Settings_General->get_col_value(
            'plugin_version',
            'string'
        );

        if (!$current_version_number) {
            return;
        }

        //   $new_version_number = '7.2';

        // If current version is behind new version
        if (
            \version_compare($current_version_number, $new_version_number, '<')
        ) {
            $this->Async_Processing_Database->sync_table_deltas();
            $this->DB_Settings_General->update_plugin_version(
                $new_version_number
            );

            Transients::delete_all_cache();
            Options::delete('wp_shopify_migration_needed');
        }
    }

    public function hooks()
    {
        global $wp_version;

        // plugins_loaded loads before activation before before init
        add_action('plugins_loaded', [$this, 'on_plugin_update']);
        add_action('wps_on_plugin_activate', [$this, 'on_plugin_activate']);
        add_filter('wpmu_drop_tables', [$this, 'on_blog_delete']);

        if (is_multisite()) {
            if (version_compare($wp_version, 5.1, '<')) {
                add_action('wpmu_new_blog', [$this, 'on_blog_create'], 10, 6);
            } else {
                add_action('wp_initialize_site', [
                    $this,
                    'on_blog_create_from_wp_site',
                ]);
            }
        }
    }

    public function init()
    {
        $this->hooks();
    }
}
