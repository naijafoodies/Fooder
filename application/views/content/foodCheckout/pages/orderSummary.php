<!-- Page summary base -->

<div class="container-fluid">

<h3>Your order have been successfully placed</h3>
	<h3 class="text-center">Order #: <?php echo sprintf('%04d',$customerData['OrderId']); ?></h3>

	<hr class="uk-divider-icon">

	<div class="row">

		<!--  Customer data -->

		<div class="col-sm-6 text-justify">

			<div class="card">
				<div class="card-block">

					<h4 class="card-title">Customer Details</h4>

					<div class="customer-name card-text">
						<p><?php echo $customerData['ShippingName']; ?></p>					
					</div>

					<div class="customer-email card-text">
						<p><?php echo $customerData['EmailAddress']; ?></p>
					</div>

					<div class="customer-phone card-text">
						<p><?php echo $customerData['Phone']; ?></p>
					</div>

				</div>

			</div>

		</div>

		<!-- End of customer Data -->

		<!-- Start of shipping info -->

		<div class="col-sm-6">

			<div class="card">

				<div class="card-block">


					<?php

					$edt = date('Y-m-d 12:i:s', strtotime('next saturday'));

					    if(date('Y-m-d H:i:s') > date('Y-m-d 13:00:00'))
					    {
					      $arrivalDate = "Estimated arrival is tomorrow &nbsp;".date("m-d-Y", strtotime('tomorrow')). ' between 6pm - 9pm';
					    }
					    else
					    {
					      $arrivalDate = "Estimated arrival date is today ".date("m-d-Y").' 6pm - 9pm';
					    }
					 ?>

						<!-- Display order details for delivery -->

						<?php if($customerData['DeliveryMode'] != 5) { ?>

						<h4 class="card-title">Ship To : </h4>

						<p><?php echo $customerData['ShippingName']; ?></p>
						<p><?php echo $customerData['ShippingAddress']; ?></p>
						<p><?php echo $customerData['ShippingCity']; ?></p>
						<p><?php echo $customerData['ShippingState'] . ', ' .$customerData['ShippingZip'] . ' '. $customerData['ShippingCountry']; ?></p>

						<hr class="uk-divider-icon">

						<p>ETA : <?php echo $arrivalDate; ?></p>


						<?php } else { ?>

						<!-- Display for pick up -->

						<h4 class="card-title">Pick Up At: </h4>

						<p>Pick up venue is at 3748 Lafayette Rd, Indianapolis, IN 46222</p>
						<p>Estimated Wait Time : 47 Minutes</p>

						<?php } ?>

					</div>

				</div>
			</div>

		<!-- End of shipping Info -->

	</div>

</div>

<!-- Start of order details table -->

  <div class="ui horizontal divider">
    Order Details
  </div>

<div class="container-fluid">

	<div class="col-sm-12">

		<table class="table table-bordered">	

			<thead>

				<th>Item</th>
				<th>Food Price</th>
				<th>Quantity</th>
				<th>SubTotal</th>

			</thead>		

			<tbody>
					
				<?php foreach($orderDetails AS $orders) { ?>

					<tr>

						<td><?php echo $orders['FoodName'] . ', '. $orders['AddonName']. ', '. $orders['AddonTwoName'] . ', '. $orders['MeatName']; ?></td>
						<td>$<?php echo $orders['FoodPrice']; ?></td>
						<td><?php echo $orders['Quantity']; ?></td>
						<td>$<?php echo $orders['TotalCost']; ?></td>

					</tr>

				<?php } ?>


			</tbody>	

			<tfoot class="text-right">

				<?php 
					
					$total = 0;

			          foreach($orderDetails AS $collatedTotal)
			          {
			            $total +=  $collatedTotal['TotalCost'];
			          }

			         $tax = $total * 0.07;

				?>

				<tr>
					<td colspan="4" style="background: #D3D3D0">Order Total : $<?php echo $total; ?></td>
				</tr>

				<?php if($customerData['DeliveryMode'] != 5) { ?>

				<tr>
					<td colspan="4" style="background: #D3D3D0">Shipping Cost : $<?php echo number_format($deliveryDetails['DeliveryPrice'],2); ?></td>
				</tr>

				<?php } ?>


				<tr>
					<td colspan="4" style="background: #D3D3D0">Tax : $<?php echo number_format($tax,2); ?></td>
				</tr>	

				<tr>
					<td colspan="4" style="background: #D3D3D0">Gross Total : $<?php echo $customerData['OrderCost']; ?></td>
				</tr>			

			</tfoot>


		</table>



	</div>

</div>


