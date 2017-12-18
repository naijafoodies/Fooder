<!-- Module displays the calculation view of the application. This os where te price of all goods will be calculated -->

<!--Start of Price form -->

<form class="form-horizontal">
  <!--Start of core food price section -->

  <div class="form-group">
        <div>
            <span><label class="col-sm-4 text-left font-weight-500">Quantity:</label><?php echo $quantity ; ?></span>
        </div>
  </div>

<div class="form-group">

      <div>
            <span><label class="col-sm-4 text-left font-weight-500">FoodPrice:</label>$<?php echo number_format($foodPrice[0]['Price'] * $quantity, 2); ?></span>
        </div>
</div>

<!--End of core food Price section -->

<!--Start of Addon price section -->

<div class="form-group">
      <div>
        <span><label class="col-sm-4 text-left font-weight-500">Addon Price:</label><?php echo '$'. number_format($addonPrice[0]['Price'], 2); ?></span>
      </div>
</div>

<!--End of addon price section -->

<!--Start of Delivery price section -->

<div class="form-group">

    <div>
      <span><label class="col-sm-4 text-left font-weight-500">Delivery Price:</label>$<?php echo $deliveryPrice[0]['Price']; ?></span>
    </div>

</div>

<!--End of delivery price section -->

<!--Start of Total price section -->

<div class="form-group">
  <div>
    <label class="col-sm-4 text-left font-weight-500">Total:</label><span id="totalAmount">$<?php  echo number_format($addonPrice[0]['Price'] + ($foodPrice[0]['Price']* $quantity) + $deliveryPrice[0]['Price'], 2); ?></span>
  </div>

</div>

<!--End of total price section -->

</form>

<!--End of price form -->
