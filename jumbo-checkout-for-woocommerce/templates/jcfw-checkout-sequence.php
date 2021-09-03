<?php
/**
 * Generate a template for the checkout sequence. Shown in front end on the WooCommerce checkout page.
 *
 * @since 0.1 (when the file was introduced)
 * @package jumbo-checkout-for-woocommerce
 */

 global $woocommerce;
 ?>

 <form id="jcfw-checkout-sequence-form" action="#" method="post" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
   <div id="jcfw-overlay" class="jcfw-overlay-cl"></div>
    <div class="checkout-sequence-btn">
        <input class="submit_button" type="button" value="Large Display" id="jcfw-show-checkout-sequence-form">
    </div>
    <div id="jcfw-checkout-sequence-container" class="checkout-sequence-container">
        <a id="jcfw-checkout-sequence-close" class="close">&times;</a>
        <h2 id="jcfw-field-title"></h2>
        <input id="jcfw_billing_first_name" type="text" name="billing_first_name" class="hidden_element">
        <input id="jcfw_billing_last_name" type="text" name="billing_last_name" class="hidden_element">
        <input id="jcfw_billing_company" type="text" name="jcfw_billing_company" class="hidden_element">
        <?php // load the language selection template
        $file = include_once plugin_dir_path( __FILE__ ) . "/jcfw-country-options.php";

        if ( file_exists( $file ) ) {
          load_template( $file, true );
        }
        ?>
        <input id="jcfw_billing_address_1" type="text" name="jcfw_billing_address_1" class="hidden_element">
        <input id="jcfw_billing_address_2" type="text" name="jcfw_billing_address_2" class="hidden_element">
        <input id="jcfw_billing_city" type="text" name="jcfw_billing_city" class="hidden_element">
        <input id="jcfw_billing_postcode" type="number" name="jcfw_billing_postcode" class="hidden_element">
        <input id="jcfw_billing_phone" type="number" name="jcfw_billing_phone" class="hidden_element">
        <input id="jcfw_billing_email" type="email" name="jcfw_billing_email" class="hidden_element">
        <input id="jcfw_order_comments" type="text" name="jcfw_order_comments" class="hidden_element">
        <div id="jcfw_payment" class="jcfw_payment_cl hidden_element">
        <?php
          jcfw_print_active_payment_gateways();
         ?>
        </div>

        <input class="submit_button" type="button" value="Next" name="submit" id="jcfw-show-next-field-btn">
        <input class="submit_button hidden_element" type="button" value="Review and Order" name="submit" id="jcfw-review-and-order-btn">
        <p class="status"></p>
        <?php wp_nonce_field( 'ajax-checkout-nonce', 'jcfw_checkout-sequence' ); ?>
    </div>
</form>
