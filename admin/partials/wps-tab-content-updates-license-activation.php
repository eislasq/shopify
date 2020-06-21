<!--

License Activation

-->
<div class="postbox wps-postbox-license-activation">

  <div class="inside">

    <form method="post" name="cleanup_options" action="" id="wps-license" class="wps-admin-form">

      <?php
//   settings_fields(WP_SHOPIFY_SETTINGS_GENERAL_OPTION_NAME);
//   do_settings_sections(WP_SHOPIFY_SETTINGS_GENERAL_OPTION_NAME);
?>

      <!-- Nonce -->
      <input hidden type="text" class="regular-text" id="<?= WP_SHOPIFY_SETTINGS_GENERAL_OPTION_NAME ?>_nonce_license_id" name="<?= WP_SHOPIFY_SETTINGS_GENERAL_OPTION_NAME ?>[nonce]" value="<?php echo wp_create_nonce(
    uniqid('', true)
); ?>"/>

      <!-- License Key -->
      <div class="wps-form-group">

        <h3><?php _e('License Key', 'wpshopify'); ?></h3>

        <small class="wps-is-hidden">
          <?php printf(
              __(
                  'You can find your license key <a class="wps-plugin-link" href="%1$s" target="_blank">within your account</a> or contained inside your payment confirmation email.',
                  'wpshopify'
              ),
              esc_url("https://wpshop.io/login")
          ); ?>
        </small>


        <input autocomplete="off" required <?= $DB_Settings_License->has_license_key(
            $license
        )
            ? 'disabled'
            : '' ?> type="text" class="regular-text wps-input-license-key <?= $DB_Settings_License->has_license_key(
     $license
 )
     ? 'valid'
     : '' ?> wps-is-hidden" id="<?= WP_SHOPIFY_SETTINGS_GENERAL_OPTION_NAME ?>_license" name="<?= WP_SHOPIFY_SETTINGS_GENERAL_OPTION_NAME ?>[license_key]" value="<?= $DB_Settings_License->mask_license_key(
    $license
) ?>" placeholder=""><div class="wps-form-icon wps-animated wps-is-hidden"></div>

      </div>

      <!-- Submit -->
      <div class="wps-button-group wps-button-group-settings button-group-ajax wps-is-hidden">

        <?php if ($DB_Settings_License->has_license_key($license)) { ?>
          <?php submit_button(
              __('Deactivate License', 'wpshopify'),
              'primary large',
              'submit-license',
              false,
              ['data-status' => 'deactivate']
          ); ?>

        <?php } else { ?>
          <?php submit_button(
              __('Activate License', 'wpshopify'),
              'primary large',
              'submit-license',
              false,
              ['data-status' => 'activate']
          ); ?>

        <?php } ?>

        <div class="spinner"></div>

      </div>

      <div class="spinner"></div>


    </form>

  </div>

</div>
