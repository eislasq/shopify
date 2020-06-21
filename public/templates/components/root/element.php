<div
   data-wpshopify-component
   data-wpshopify-component-type="<?= $data->component_type ?>"
   data-wpshopify-payload-settings="<?= $data->component_options ?>">
   
   <?php if ($data->component_type !== 'cart') { ?>
      <div class="wpshopify-loading-placeholder"><?= apply_filters(
          'wpshopify_loading_text',
          '',
          $data
      ) ?></div>
   <?php } ?>
</div>