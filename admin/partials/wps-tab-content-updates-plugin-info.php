<div class="postbox wps-postbox-plugin-info" id="wps-plugin-info">

  <div class="spinner"></div>

  <h3><?php _e('Plugin Information', 'wpshopify'); ?></h3>

  <table class="form-table wps-is-hidden">

    <tr valign="top">

      <td scope="row">
        <label for="tablecell">
          <?php _e('Name', 'wpshopify'); ?>
        </label>
      </td>

      <td class="wps-col wps-col-plugin-name">
        <?= WP_SHOPIFY_PLUGIN_NAME_FULL_PRO ?>
      </td>

    </tr>

    <tr valign="top" class="alternate">

      <td scope="row">
        <label for="tablecell">
          <?php _e('Tested up to WordPress', 'wpshopify'); ?>
        </label>
      </td>

      <td class="wps-col wps-col-tested-up-to">
        <?php echo get_bloginfo('version'); ?>
      </td>

    </tr>

    <tr valign="top">

      <td scope="row">
        <label for="tablecell">
          <?php _e('Installed version', 'wpshopify'); ?>
        </label>
      </td>

      <td class="wps-col wps-col-plugin-ver">
        <?= WP_SHOPIFY_NEW_PLUGIN_VERSION ?>
      </td>

    </tr>

    <tr valign="top" class="alternate">

      <td scope="row">
        <label for="tablecell">
          <?php _e('Latest version', 'wpshopify'); ?>
        </label>
      </td>

      <td class="wps-col wps-col-plugin-version">
        <?= WP_SHOPIFY_NEW_PLUGIN_VERSION ?>
      </td>

    </tr>

  </table>

</div>
