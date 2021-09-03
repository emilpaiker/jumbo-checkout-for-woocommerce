// This file contains the functions for the jumbo checkout for WooCommerce plugin

document.addEventListener('DOMContentLoaded', function (e) {
  // define constants
    const showCheckoutSequenceBtn = document.getElementById('jcfw-show-checkout-sequence-form'),
        checkoutSequenceContainer = document.getElementById('jcfw-checkout-sequence-container'),
        close = document.getElementById('jcfw-checkout-sequence-close'),
        overlay = document.getElementById('jcfw-overlay'),
        fieldName = document.getElementById('jcfw-field-title'),
        nextFieldBtn = document.getElementById('jcfw-show-next-field-btn'),
        reviewAndOrderBtn = document.getElementById('jcfw-review-and-order-btn'),
        jcfwFieldIdList = ["jcfw_billing_first_name", "jcfw_billing_last_name", "jcfw_billing_company", "jcfw_billing_country", "jcfw_billing_address_1", "jcfw_billing_address_2", "jcfw_billing_city", "jcfw_billing_postcode", "jcfw_billing_phone", "jcfw_billing_email", "jcfw_order_comments", "jcfw_payment"],
        wcFieldIdList = ["billing_first_name", "billing_last_name", "billing_company", "select2-billing_country-container", "billing_address_1", "billing_address_2", "billing_city", "billing_postcode", "billing_phone", "billing_email", "order_comments"],
        jcfwFieldNameList = ["First Name", "Last Name", "Company name", "Country / Region", "Street Address", "Apt. / Suite", "City", "Postcode", "Phone", "Email", "Comments", "Payment Method"];

        // init state variable, this indicated the current field that is being edited by user
        var state = 0;
        //set the first field the user sees when opening the checkout sequence
        fieldName.innerHTML = jcfwFieldNameList[state];
        document.getElementById(jcfwFieldIdList[state]).classList.remove('hidden_element');

        // define what happens, when user clicks the "Large Display" button
    showCheckoutSequenceBtn.addEventListener('click', () => {
        checkoutSequenceContainer.classList.add('show');
        showCheckoutSequenceBtn.parentElement.classList.add('hide');
        overlay.classList.add('active');
        showCheckoutSequenceBtn.scrollIntoView();
    });
    // define what happens, when user clicks the "Close" button
    close.addEventListener('click', () => {
        closePopup();
    });
    // Define what happens, when user clicks the "Next" button
    nextFieldBtn.addEventListener('click', () => {
      const currJcfwField = document.getElementById(jcfwFieldIdList[state]); // get the current value of the jcfw field
      if (state == 3) { // exception for language selection field
        const currWcField = document.getElementById(wcFieldIdList[state]);
        const currWcFieldInner = document.getElementById('billing_country');
        currWcField.innerHTML = currJcfwField.options[currJcfwField.selectedIndex].text;
        currWcFieldInner.selectedIndex = currJcfwField.selectedIndex;
      }
      else if (state == 11) {
        // get the payment method radio selection
        const paymentGateways = document.getElementsByName('jcfw_payment_gateway');
        var paymentGatewayValue;
        for(var i = 0; i < paymentGateways.length; i++){
          if(paymentGateways[i].checked){
            paymentGatewayValue = paymentGateways[i].id;
          }
        }
        const paymentGatewayId = "payment_method_" + paymentGatewayValue;
        document.getElementById(paymentGatewayId).checked = true;
        // Switch out the button that is shown
        nextFieldBtn.classList.add('hidden_element');
        reviewAndOrderBtn.classList.remove('hidden_element');
        fieldName.innerHTML = "Review and Order";

      }
      else { // state is neither 3 nor 11.
        document.getElementById(wcFieldIdList[state]).value = currJcfwField.value; // set the woocommerce field with that value
      }
      document.getElementById(jcfwFieldIdList[state]).classList.add('hidden_element'); // hide the field that the user just edited
      state = state + 1; // count up the state
      if (jcfwFieldNameList[state]) {
        fieldName.innerHTML = jcfwFieldNameList[state]; // set the correct title for the next field in the sequence
        document.getElementById(jcfwFieldIdList[state]).classList.remove('hidden_element'); // show the next field in the sequence
      }
      else {
        state = 0; // reset the state
      }
    });
    // define what happens when user clicks the "Review and Order" button.
    reviewAndOrderBtn.addEventListener('click', () => {
      closePopup();
      document.getElementById('customer_details').scrollIntoView();
      fieldName.innerHTML = jcfwFieldNameList[state];
      document.getElementById(jcfwFieldIdList[state]).classList.remove('hidden_element');
      nextFieldBtn.classList.remove('hidden_element');
      reviewAndOrderBtn.classList.add('hidden_element');
    });
    // function that closes the JCFW display
    function closePopup() {
      checkoutSequenceContainer.classList.remove('show');
      showCheckoutSequenceBtn.parentElement.classList.remove('hide');
      overlay.classList.remove('active');
    }

});
