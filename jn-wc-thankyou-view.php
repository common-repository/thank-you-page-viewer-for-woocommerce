<?php
/*
Plugin Name: Thank you page viewer for Woocommerce
Plugin URI: https://www.jevnet.es/woocommerce-thankyou-page-view
Description: Puts a button that shows the purchase "thank you page" from Woocommerce order admin page.
Version: 4.6.7
Author: JEVNET
Author URI: https://www.jevnet.es
License: GPLv2 or later
Text Domain: thank-you-page-viewer-for-woocommerce
Domain Path:       /lang
*/

if ( !function_exists( 'add_action' ) ) {
	echo '¿?';
	exit;
}

/* Translations */
add_action('plugins_loaded', 'jntpvw_load_textdomain');
function jntpvw_load_textdomain() {
	load_plugin_textdomain( 'thank-you-page-viewer-for-woocommerce', false, dirname( plugin_basename(__FILE__) ) . '/lang/' );
}

/* Shows the link */
add_action('woocommerce_admin_order_data_after_order_details','jntpvw_viewThankYouPage');
function jntpvw_viewThankYouPage($order)
{
	echo '<p class="form-field form-field-wide wc-customer-memberships" style="margin-top:1rem"><label for="customer_memberships">'.__('Thank you page:','thank-you-page-viewer-for-woocommerce').'</label><button class="button" onclick="event.preventDefault();window.open(\''.$order->get_checkout_order_received_url().'\',\'_blank\')"><span class="dashicons dashicons-visibility" style="padding-top:.1em"></span> '.__('View Thank you page','thank-you-page-viewer-for-woocommerce').'</button></p>';
}


function jntpvw_noWooCommerce_notice()
{
	if(!class_exists('WooCommerce'))
	{
	?>
		<div class="notice  notice-info">
			<p><?php echo __( 'Thank you page viewer for WooCommerce is active but WooCommerce is not active or not installed. There is no problem and you can keep it active if you love it. We know love has no sense.', 'thank-you-page-viewer-for-woocommerce' ); ?></p>
		</div>
	<?php
	}
}
add_action( 'admin_notices', 'jntpvw_noWooCommerce_notice' );