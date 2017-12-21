<!-- STart of order client Management view -->

<?php if($orderDetails) { ?>

	<!-- Start of header -->
		<h3 class="ui block header">
		  Ordered by: <?php echo $orderDetails['ShippingName']; ?>
		</h3>

	<!-- End of header -->

	<div class="ui equal width grid">


	  <div class="column">

	  	<h3 class="ui top attached orange inverted header">
		  Order Details
		</h3>

	  	<ul class="list-group">

	  	<?php foreach($orderItems AS $items) { ?>

		  <li class="list-group-item justify-content-between">

		  	<p class="mb-1">Food Name: <?php echo $items['FoodName']; ?></p>
		  	<p class="mb-1">AddonName: <?php echo $items['AddonName']; ?></p>
		  	<p class="mb-1">Meat Name: <?php echo $items['MeatName']; ?></p>
		  	<p class="mb-1">Food Size: 
		  		<?php 
		  			if($items['FoodSize'] == 1)
		  			{
		  				$foodSize = "Regular";
		  			}
		  			else if($items['FoodSize'] == 2)
		  			{
		  				$foodSize = "Half Tray";
		  			}
		  			else if($items['FoodSize'] == 3)
		  			{
		  				$foodSize = "Full Size";
		  			}
		  		?>
		  		<?php echo $foodSize; ?></p>
		  	<p class="mb-1">Quantity: <?php echo $items['Quantity']; ?></p>
		    
		  </li>

		  <?php } ?>

		</ul>

	  </div>

	  <div class="column">

	  	<h3 class="ui top attached green inverted header">
		  Customer Information
		</h3>	

		<ul class="list-group">

		  <li class="list-group-item justify-content-between">
		    <p class="mb-1 lead">Customer Name</p>
		    <small><?php echo $orderDetails['ShippingName']; ?></small>
		  </li>

		  <li class="list-group-item justify-content-between">
		    <p class="mb-1 lead">Email Address</p>
		    <small><?php echo $orderDetails['EmailAddress']; ?></small>
		  </li>

		</ul>  	

	  </div>


	  <div class="column">

	  	<h3 class="ui top attached red inverted header">
		  Order Fulfilment Details
		</h3>

		<?php if($orderDetails['DeliveryMode'] == 5) { ?>

		<ul class="list-group">

		  <li class="list-group-item justify-content-between">
		    <p class="mb-1 lead" style="color: red;">This is a pickup order</p>
		  </li>

		</ul>  				
		<?php } else { ?>

		<ul class="list-group">

			<li class="list-group-item justify-content-between">
		   	 	<p class="mb-1 lead" style="color: red;">An assigned Fooder would come pick the order up once it is completed</p>
		  	</li>

		</ul>  

		<?php } ?>

		<label>Change Order Status</label>
	      <div class="two fields">

	        <div class="field">
	          <select class="ui fluid search dropdown" id="inputOrderStatus">

	            <?php foreach($orderStatus AS $status) { ?>

	            	<option value="<?php echo $status['StageId']; ?>" <?php echo ($status['StageId'] == $orderDetails['FulfilmentStage'])? 'selected': ''?>><?php echo $status['StageName']; ?></option>

	            <?php } ?>

	          </select>
	        </div>
	  </div>

	  <div class="ui animated button center-block text-center" tabindex="0" style="margin-top: 1em;" onclick=" return updateOrderStatus()">
		  <div class="visible content">Update Order Status</div>
		  <div class="hidden content">
		    <i class="right arrow icon"></i>
		  </div>
		</div>

	</div>




	<!-- End of client's order managament view -->

	<?php } else { ?>

	<div class="ui red inverted segment text-center">You are not directly attached to this order Or the number is not correct</div>

	<?php } ?>


	<script>

		function updateOrderStatus()
		{
			var orderId = "<?php echo $orderDetails['OrderId']; ?>"
			var status = $('#inputOrderStatus').val();

			$.post('<?php echo base_url();?>Client/updateOrderStatus',
			{
				orderId:orderId,
				status:status,
			},function(response){
				UIkit.notification("<span uk-icon='icon: check'></span> Order status have been uploaded. Please reenter order Id");
			});
		}


	</script>