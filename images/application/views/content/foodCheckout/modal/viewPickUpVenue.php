<!-- Start of pick up venue paragraph -->
  
  <p class="text-center" style="color:red;">Pick up venue is at 3748 Lafayette Rd, Indianapolis, IN 46222</p>

<!-- End of pick up[ venue paragraph -->
  
<div class="text-center content-block success">
  <form action="<?php echo base_url(); ?>FoodCheckout/checkOutPickUp" method="POST">
   

    <script
      src="https://checkout.stripe.com/checkout.js" class="stripe-button text-center content-block disabled"
      data-key="pk_test_kjB1W1t0dlsr0H4qaOqInCm0"
      data-amount="<?php echo ($grossTotal * 100);?>",
      data-name="Naija Foodies",
      data-description="",
      data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
      data-locale="auto",
      data-shipping-address = "false",
      data-billing-address = "true",
      data-label = "Pay Now",
      >

    </script>
  </form>
</div>
