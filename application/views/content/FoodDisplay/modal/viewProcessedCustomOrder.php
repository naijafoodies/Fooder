<?php
$finalCost = $deliveryPrice[0]['Price'] + $totalCost;
$edt = date('Y-m-d 12:i:s', strtotime('next saturday'));

if($deliveryMode == 'Home' || $deliveryMode == 'Office')
{
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
<div class="panel panel-success">

  <div class="panel-body">
    <p class="text-center lead" style="color:red;"><?php echo $arrivalDay; ?></p>
  </div>

  <div class="panel-footer">
    <div class="text-center">
      <form action="<?php echo base_url(); ?>FoodCheckout/checkOut" method="POST">
        <input name="totalPack" type="hidden" value="<?php echo $totalPack; ?>" >
        <input name="totalPieces" type="hidden" value="<?php echo $piecesPerPack; ?>" >
        <input name="totalCost" type="hidden" value="<?php echo $totalCost; ?>" >
        <input name="phoneNumber" type="hidden" value="<?php echo $phoneNumber; ?>" >
        <input name="deliveryMode" type="hidden" value="<?php echo $deliveryMode; ?>" >
        <input name="finalCost" type="hidden" value="<?php echo $finalCost; ?>">

      <script
        src="https://checkout.stripe.com/checkout.js" class="stripe-button text-center content-block disabled"
        data-key="pk_live_nmXPXIOyV5FkrPKwiafzGnwW"
        data-amount="<?php echo ($deliveryPrice[0]['Price'] + $totalCost) * 100; ?>",
        data-name="Naija Foodies",
        data-description="",
        data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
        data-locale="auto",
        data-shipping-address = "true",
        data-billing-address = "true",
        data-label = "Check Out",
        >

      </script>
      </form>
    </div>
  </div>

</div>

<script>

  $(document).ready(function(){
    $('#delivery').html('$<?php echo $deliveryPrice[0]['Price']; ?>');
    $('.deliverySection').show();
    $('.tCost').show();
    $('#totalCost').html('<?php echo $deliveryPrice[0]['Price'] + $totalCost ; ?>');
  });

  </script>
