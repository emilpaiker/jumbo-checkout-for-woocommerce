<?php

/**
* Function that creates the jumbo checkout form, which when clicked triggers the custom checkout field sequence.
* @since 0.1
*/

function jcfw_load_checkout_sequence_template() {
  $file = include_once plugin_dir_path( __FILE__ ) . "/../templates/jcfw-checkout-sequence.php";

  if ( file_exists( $file ) ) {
    load_template( $file, true );
  }
}

/**
* Function that removes the State / Province checkout field
* @since 0.1
*/

function jcfw_remove_checkout_field( $fields ) {

  unset($fields['billing']['billing_state']);

  return $fields;
}

/**
* Function that fetches all active WooCommerce payment gateways
* @since 0.1
*/

function jcfw_fetch_active_payment_gateways() {
  return WC()->payment_gateways->get_available_payment_gateways();
}

/**
* Function that prints activated WooCommerce payment gateways to html
* @since 0.1
*/

function jcfw_print_active_payment_gateways() {
  $available_payment_methods = jcfw_fetch_active_payment_gateways();
  if ($available_payment_methods) {
    $first = true;
    foreach ($available_payment_methods as $id => $av_method) {
      echo('<div class="jcfw_payment_option"><label>');
      echo('<input type="radio" name="jcfw_payment_gateway" id="' . $id . '" ');
      if ($first) {
        echo('checked >');
        $first = false;
      }
      else {
        echo('>');
      }
      echo($av_method->get_method_title() . '</label></div>');
    }
  }
}
