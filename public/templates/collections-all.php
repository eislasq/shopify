<?php

defined('ABSPATH') ?: die;

get_header('wpshopify');

$Collections = WP_Shopify\Factories\Render\Collections\Collections_Factory::build();
$Settings = WP_Shopify\Factories\DB\Settings_General_Factory::build();

?>

<section class="wps-container">
   <?= do_action('wps_breadcrumbs') ?>

   <div class="wps-collections-all">
      
      <?php if ($Settings->get_col_value('collections_heading_toggle')) { ?>
         <h1 class="wps-heading"><?= $Settings->get_col_value('collections_heading'); ?></h1>
      <?php }

      $Collections->collections(apply_filters('wps_collections_all_args', [])); 
      
      ?>

   </div>

</section>


<?php

get_footer('wpshopify');