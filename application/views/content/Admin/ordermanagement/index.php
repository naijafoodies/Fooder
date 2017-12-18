<!-- Start of order Information page -->

<?php if($orderDetails) { ?>

		<?php if($orderDetails['DeliveryMode'] != 5){ ?>

			<div class="ui orange inverted segment">Delivery Option</div>

		<?php } else { ?>

			<div class="ui green inverted segment">Pick Up</div>

		<?php } ?>

		<?php foreach($orderItems as $item) { ?>

			<img class="ui top aligned tiny image" src="../assets/uploads/menu/<?php echo $item['DisplayImage']; ?>">
			<span>Food Name: <?php echo $item['FoodName']; ?> - $<?php echo $item['FoodPrice']; ?></span><br/>
			<span>Addon Name: <?php echo $item['AddonName']; ?> - $<?php echo $item['AddonPrice']; ?></span><br/>
			<span>Quantity: <?php echo $item['Quantity']; ?></span><br/>
			<span style="background: #DBD9D9;">Total Cost: $<?php echo $item['TotalCost']; ?></span><br/>

			<div class="ui divider"></div>

		  <?php } ?>

		    <div class="ui horizontal divider">
			    Buyer Information
			  </div>

			  <!-- Start of buyer information display -->

			  <div class="list-group text-center center-block">

				  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start active">
				    <div class="d-flex w-100 justify-content-between">
				      <h5 class="mb-1">Customer Name: </h5>
				      <small>Total Order Cost: <?php echo $orderDetails['OrderCost']; ?></small>
				    </div>
				    <p class="mb-1"><?php echo $orderDetails['ShippingName']; ?></p>
				  </a>

				  <?php if($orderDetails['DeliveryMode'] != 5) { ?>

				  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
				    <div class="d-flex w-100 justify-content-between">
				      <h5 class="mb-1">Shipping Address</h5>
				      <small class="text-muted"><?php echo ($orderDetails['Phone'])?$orderDetails['Phone']:'No phone number provided'; ?></small>
				    </div>
				    <p class="mb-1"><?php echo $orderDetails['ShippingAddress'] . ', ' . $orderDetails['ShippingCity']. ', '. $orderDetails['ShippingState']. ' '. $orderDetails['ShippingZip'] ; ?></p>
				    <small class="text-muted"><?php echo $orderDetails['EmailAddress']; ?></small>
				  </a>

				  <?php } else { ?>

				  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
				    <div class="d-flex w-100 justify-content-between">
				      <h5 class="mb-1">Other Details</h5>
				      <small class="text-muted"><?php echo ($orderDetails['Phone'])?$orderDetails['Phone']:'No phone number provided'; ?></small>
				    </div>
				    <p class="mb-1"></p>
				    <small class="text-muted"><?php echo $orderDetails['EmailAddress']; ?></small>
				  </a>

				  <?php } ?>

				</div>

			  <!-- End of buyer inofmration display -->

			  <!-- Start of Order status display -->

			  		    <div class="ui horizontal divider">
					    	Order Status Information
					  	</div>

				<div class="ui equal width grid" style="margin-top: 1em;">

				  <div class="equal width row">

				    <div class="column">

				    	<label>Order Status: <span style="color:blue;"><?php echo $orderDetails['StageName']?></span></label>

				    	<?php if($orderDetails['FulfilmentStage'] == 1) { ?>
				    		<div class="progress">
							  <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: 20%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
				    	<?php } ?>


				    	<?php if($orderDetails['FulfilmentStage'] == 2) { ?>
				    		<div class="progress">
							  <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
				    	<?php } ?>


				    	<?php if($orderDetails['FulfilmentStage'] == 3) { ?>
				    		<div class="progress">
							  <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
				    	<?php } ?>


				    	<?php if($orderDetails['FulfilmentStage'] == 4) { ?>
				    		<div class="progress">
							  <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
				    	<?php } ?>
				    	
				    </div>

				    <div class="column">

				    <label>Assigned To:
				    	<?php if(!$orderDetails['AssignedTo']) { ?>
				    		<span style="color: red;" id="assignmentStatus">Order have not been Assigned to any client yet.</span>
				    	<?php } else { ?>
				    		<span style="color: green;" id="assignmentStatus"><?php echo $orderDetails['ClientName']; ?> by <?php echo ($orderDetails['AssignedBy'] == $this->session->userdata('adminId')) ? 'you' : $orderDetails['Username']; ?></span>
				    	<?php } ?>
				    </label>

				    <?php if(!$orderDetails['AssignedTo']) { ?>

				    <div class="field" id="clientSection">
				      <label>Select Clients</label>
				      <select class="ui fluid dropdown" id="inputClients">

					      <option value="">----</option>
					      <?php foreach($clientList AS $clients) { ?>

					        <option value="<?php echo $clients['ClientId']; ?>"><?php echo $clients['ClientName']; ?></option>

					        <?php } ?>
					    
				      </select>

				      <!-- Start of assign button -->

				      <div class="ui animated green button" tabindex="0" style="margin-top: 3px;" onclick="return assignSales('<?php echo $orderDetails['OrderId']; ?>');">
						  <div class="visible content">Assign</div>
						  <div class="hidden content">
						    <i class="handshake icon"></i>
						  </div>
					</div>

				    </div>

				     <?php } ?>
				    	
				    </div>

				  </div>
				   

				</div>



			  <!-- End of order status display -->
	
	<?php } else { ?>

		<p style="color: red;" class="text-center">There is no order with the ID you selected in the database</p>

	<?php } ?>

<!-- End of order information page -->


<!-- Script -->

<script type="text/javascript">
	function assignSales(orderId)
	{
		var clientId = $('#inputClients').val();

		if(clientId == '')
		{
			UIkit.notification({
			    message: 'Please select a client to assign sales to!',
			    status: 'primary',
			    pos: 'top-right',
			    timeout: 5000
			});
		}
		else
		{
			$.post('<?php echo base_url(); ?>AdminManagement/assignSales',
			{
				clientId:clientId,
				orderId:orderId
			}, function(response)
			{
				if(response == '0')
				{
					UIkit.notification({
					message: 'Order have been assigned but client has no email attached to It. Please contact user directly!',
					status: 'primary',
					pos: 'top-center',
					timeout: 3000
					});

					$('#assignmentStatus').html('Order have been assigned but client has no email attached to It. Please contact user directly!');
					$('#clientSection').hide();
				}
				else
				{
					var selectedClient = $('#inputClients option:selected').text();
					UIkit.notification("<span uk-icon='icon: check'></span> "+response);
					$('#assignmentStatus').html('Order have been assigned to '+selectedClient+' by you');
					$('#assignmentStatus').css("color","green");
					$('#clientSection').hide();

				}
				
			});
		}
	}
</script>
