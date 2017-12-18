<!--Start od order summary and customer information collection -->

<!--start of price computation. This is submitted to the database -->

<?php
$finalCost = (($priceOfFood[0]['Price'] * $quantity) + $priceOfAddon[0]['Price'] + $priceOfDelivery[0]['Price']) * 100;
$edt = date('Y-m-d 12:i:s', strtotime('next saturday'));

if($delivery == 'Home' || $delivery == 'Office'){
  $deliveryDates = array('wednesday'=>'Wednesday, '.date('m-d-Y', strtotime('wednesday this week')),  'saturday'=>'Saturday, '.date('m-d-Y', strtotime('saturday this week')), 'sunday'=>'Sunday, '.date('m-d-Y', strtotime('sunday this week')), 'wed'=>'Wednesday, '.date('m-d-Y', strtotime('next Wednesday')));
  $dayNow = date('Y-m-d H:i:s', strtotime('now'));

  //instance one

  if($dayNow >= date('Y-m-d 12:i:s',strtotime('sunday this week ')) AND $dayNow <= date('Y-m-d 12:i:s', strtotime('wednesday this week'))){
    $arrivalDay = 'Estimated Arrival is '.$deliveryDates['wednesday']. ', 5pm - 8pm';
  }

  else if ($dayNow >= date('Y-m-d 12:i:s', strtotime('wednesday this week')) AND $dayNow <= date('Y-m-d 12:i:s', strtotime('saturday this week'))){
    $arrivalDay = 'Estimated Arrival is '. $deliveryDates['saturday'] . ', 4pm - 8pm';
  }

  else if ($dayNow >= date('Y-m-d 12:i:s', strtotime('saturday this week')) AND $dayNow <= date('Y-m-d 12:i:s', strtotime('sunday this week'))){
    $arrivalDay = 'Estimated Arrival is '. $deliveryDates['sunday'] . ', 4pm - 8pm';
  }
  else{
    $arrivalDay = 'Estimated Arrival is '.$deliveryDates['wed']. ', 5pm - 8pm';
  }

}

else{
  $arrivalDay = 'Pick Up at 2442 Central Ave, Indianapolis, IN 46205';
}

 ?>

<!--End of price computation -->

<div class="panel-heading panel-title text-center">Order Summary</div>
<div class="panel-body">

    <!--Start of summary table -->

    <table class="table table-striped content-center">

      <tr>
          <td class="font-weight-500">Food Name</td>
          <td id="food"><?php echo $foodSelected; ?></td>
      </tr>

      <tr>
          <td class="font-weight-500">quantity</td>
          <td id="addon"><?php echo $quantity; ?></td>
      </tr>

      <tr>
          <td class="font-weight-500">Size</td>
          <td id="size"><?php echo $food; ?></td>
      </tr>

      <tr>
          <td class="font-weight-500">Selected Soup</td>
          <td id="soup"><?php echo $soup; ?></td>
      </tr>

      <tr>
          <td class="font-weight-500">Addon</td>
          <td id="addon"><?php echo $addon; ?></td>
      </tr>

      <tr>
          <td class="font-weight-500">Meat</td>
          <td id="meat"><?php echo $meat; ?></td>
      </tr>

      <tr>
          <td class="font-weight-500">Delivery</td>
          <td style="color:red !important; font-size: 12px"><?php echo $arrivalDay; ?></td>
      </tr>

<?php if($delivery == 'Home' || $delivery == 'Office') { ?>
      <tr>
          <td colspan="2">
            <div class="form-group box-shadow">
                <label class="control-label">Pick a Location for Delivery</label>
                  <select class="form-control" name="city" id="city" onchange="return validateCity()">
                      <option value="0"></option>
                      <option value="1">Fishers</option>
                      <option value="2">Carmel</option>
                      <option value="3">Columbus</option>
                      <option value="4">Indianapolis</option>
                      <option value="5">Greenwood</option>
                  </select>
            </div>
          </td>
      </tr>

<?php } ?>

  </table>

  <!--End of table summary -->

</div>

<!--Start of Customer Information -->

<!--Stripe implementation -->

<?php if($delivery == 'Home' || $delivery == 'Office') { ?> <div id="showCity" style="display:none"> <?php } else { ?> <div> <?php } ?>
<p class="text-center" style="font-family: 'Caveat', cursive; font-size:12px;"><code>By clicking the <strong>PAY</strong> button, you have agreed to our <a href="<?php echo base_url();?>Terms/termsAndConditions" >terms of service</a></p>
<?php if($delivery == 'Home' || $delivery == 'Office') { ?>

  <div class="text-center content-block success">
    <form action="<?php echo base_url(); ?>FoodCheckout/checkOut" method="POST">

      <script
        src="https://checkout.stripe.com/checkout.js" class="stripe-button text-center content-block disabled"
        data-key="pk_live_nmXPXIOyV5FkrPKwiafzGnwW"
        data-amount="<?php echo $finalCost; ?>"
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


<?php } else { ?>

<div class="text-center content-block success">
  <form action="<?php echo base_url(); ?>FoodCheckout/checkOut" method="POST">
   

    <script
      src="https://checkout.stripe.com/checkout.js" class="stripe-button text-center content-block disabled"
      data-key="pk_live_nmXPXIOyV5FkrPKwiafzGnwW"
      data-amount="",
      data-name="Naija Foodies",
      data-description="",
      data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
      data-locale="auto",
      data-shipping-address = "true",
      data-billing-address = "true",
      data-label = "Pay Now",
      >

    </script>
  </form>
</div>

</div>

<?php } ?>

<script>

  function validateCity(){
    var cityValue = $('#city').val();
    if(cityValue != 0){
      $('#showCity').show();
    }
    else{
      $('#showCity').hide();
    }
  }
</script>


<!--End of stripe button implementation -->
