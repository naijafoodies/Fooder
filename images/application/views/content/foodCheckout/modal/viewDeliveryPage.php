<!--Start od order summary and customer information collection -->

<!--start of price computation. This is submitted to the database -->

<?php

$edt = date('Y-m-d 12:i:s', strtotime('next saturday'));

    if(date('Y-m-d H:i:s') > date('Y-m-d 16:30:00'))
    {
      $arrivalDate = "Estimated arrival is tomorrow &nbsp;".date("m-d-Y", strtotime('tomorrow'));
    }
    else
    {
      $arrivalDate = "Estimated arrival date is today ".date("m-d-Y").' 5pm - 9pm';
    }
 ?>

    <p class="text-center" style="color:red;"><?php echo $arrivalDate; ?></p>

   <div class="text-center content-block success">
    <form action="<?php echo base_url(); ?>FoodCheckout/checkOutDelivery" method="POST">

      <script
        src="https://checkout.stripe.com/checkout.js" class="stripe-button text-center content-block disabled"
        data-key="pk_test_kjB1W1t0dlsr0H4qaOqInCm0"
        data-amount="<?php echo ($grossTotal * 100);?>"
        data-name="Naija Foodies"
        data-description=""
        data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
        data-locale="auto",
        data-shipping-address = "true"
        data-billing-address = "true"
        data-label="Pay With Card"
        >
      </script>
      
    </form>
  </div>
