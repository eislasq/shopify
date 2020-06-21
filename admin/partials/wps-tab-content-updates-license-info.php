<!--

License Info

-->
<div class="postbox wps-postbox-license-info <?= $DB_Settings_License->has_license_key(
    $license
)
    ? ''
    : 'wps-is-hidden' ?>" id="wps-license-info">

  <div class="spinner"></div>

  <h3><?php _e('License Details', 'wpshopify'); ?></h3>

  <table class="form-table wps-is-hidden">

    <tr valign="top" class="alternate">

      <td scope="row">
        <label for="tablecell">
          <?php _e('Status', 'wpshopify'); ?>
        </label>
      </td>

      <td class="wps-col wps-col-license-status"></td>

    </tr>

    <tr valign="top">

      <td scope="row">
        <label for="tablecell">
          <?php _e('Name', 'wpshopify'); ?>
        </label>
      </td>

      <td class="wps-col wps-col-license-name">
        <?php printf(
            esc_html__('%s', 'wpshopify'),
            $DB_Settings_License->get_license_customer_name($license)
        ); ?>
      </td>

    </tr>

    <tr valign="top" class="alternate">

      <td scope="row">
        <label for="tablecell">
          <?php _e('Email', 'wpshopify'); ?>
        </label>
      </td>

      <td class="wps-col wps-col-license-email">
        <?php printf(
            esc_html__('%s', 'wpshopify'),
            $DB_Settings_License->get_license_customer_email($license)
        ); ?>
      </td>

    </tr>

    <tr valign="top">

      <td scope="row">
        <label for="tablecell">
          <?php _e('Expires on', 'wpshopify'); ?>
        </label>
      </td>

      <td class="wps-col wps-col-license-expire">

        <?php
        $expiration = $DB_Settings_License->get_license_expiration($license);

        if ($DB_Settings_License->license_expires($expiration)) {
            echo $DB_Settings_License->format_license_expiration_date(
                $expiration
            );
        } else {
            _e('Never expires', 'wpshopify');
        }
        ?>

      </td>

    </tr>

    <tr valign="top" class="alternate">

      <td scope="row">
        <label for="tablecell">
          <?php _e('Activation count', 'wpshopify'); ?>
        </label>
      </td>

      <td class="wps-col wps-col-license-limit">

        <?php printf(
            esc_html__('%1$d / %2$d', 'wpshopify'),
            $DB_Settings_License->get_license_site_count($license),
            $DB_Settings_License->get_license_limit($license)
        ); ?>

        <?php if ($DB_Settings_License->is_local($license)) { ?>
          <small class="wps-table-supporting">
            <?php _e(
                '(Activations on dev environments don\'t add to total)',
                'wpshopify'
            ); ?>
          </small>
        <?php } ?>

      </td>

    </tr>


    <tr valign="top" class="alternate">

      <td scope="row">
        <label for="tablecell">
          <?php _e('Activations left', 'wpshopify'); ?>
        </label>
      </td>

      <td class="wps-col wps-col-license-activations-left"></td>

    </tr>

  </table>

</div>
