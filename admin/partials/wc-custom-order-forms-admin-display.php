<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://github.com/Orinwebsolutions
 * @since      1.0.0
 *
 * @package    Wc_Custom_Order_Forms
 * @subpackage Wc_Custom_Order_Forms/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<h1> <?php echo  'Welcome to custom admin page.'; ?> </h1>
<form method="POST" action="options.php">
<?php
settings_fields( 'wc-custom-order-page' );
do_settings_sections( 'wc-custom-order-page' );
submit_button();
?>
</form>