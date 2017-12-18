
<!-- Start of delivery details page -->

<!-- Page handles the management of meat in the table -->

<div class="container">

	<!-- Start of button groups -->

	<div class="nf-maginize nf-padinize">
	  <div class="ui mini animated green button" tabindex="0" onclick="return addDelivery()">
	    <div class="visible content">Add New Cities</div>
	    <div class="hidden content">
	      <i class="right arrow icon"></i>
	    </div>
	  </div>
	</div>

	<!-- End of button groups -->

	<div class="clearfix"></div>

	<!-- Start of meat table -->

	<table class="table table-hover table-bordered nf-maginize" id="nfTables">
		
		<!-- Start of table header -->

		<thead>

			<tr>

				<th class="text-center">Actions</th>
				<th class="text-center">City Name</th>
				<th class="text-center">Delivery Cost</th>
				<th class="text-center">Status</th>

			</tr>

		</thead>

		<!-- End of table header -->

		<!-- Start of table body -->

		<tbody>

			<?php foreach($deliveryDetails AS $delivery) { ?>

				<tr class="<?php echo ($delivery['RecordDisabled'] == 0)? '' : 'table-warning'; ?>">
					<td class="text-center">

						<div class="ui small basic icon buttons">
				            <button class="ui button" onclick="editDelivery(<?php echo $delivery['DeliveryId']; ?>)"><i class="write icon"></i></button>

				            <?php if($delivery['RecordDisabled'] == 0) { ?>

				            	<button class="ui button" onclick="deactivateCity(<?php echo $delivery['DeliveryId']; ?>)"><i class="hide icon"></i></button>

				            <?php } else { ?>

				            	<button class="ui button" onclick="activateCity(<?php echo $delivery['DeliveryId']; ?>)"><i class="unhide icon"></i></button>

				            <?php } ?>



				        </div>

					</td>

					<td class="text-center"><?php echo $delivery['DeliveryCityName']; ?></td>
					<td class="text-center"><?php echo $delivery['DeliveryPrice']; ?></td>
					<td class="text-center"><?php echo ($delivery['RecordDisabled'] == 0)? 'Active' : 'Not Active'; ?></td>

				</tr>

			<?php } ?>

		</tbody>

		<!-- End of table body -->

	</table>



	<!-- End of meat table -->



</div>

<!-- End of page -->

<script>

	function editDelivery(cityId)
	{
		$('#largeModalBody').html('');
    	$('#largeModalBody').load('<?php echo base_url() ?>AdminManagement/viewEditDelivery?cityId='+cityId);
    	$('#largeModal').modal('show');
	}

	function activateCity(cityId)
	{
		// function activates the city by sending a On status to controller

		$.post('<?php echo base_url(); ?>AdminManagement/toggleCity',
		{
			intent:0,
			cityId:cityId
		},function(response)
		{
			UIkit.notification('City successfully deactivated', {status:'success',pos:'top-center'});
			location.reload();
		});
	}

	function deactivateCity(cityId)
	{
		//function deactivates the city by sending a off status to controller

		$.post('<?php echo base_url(); ?>AdminManagement/toggleCity',
		{
			intent:1,
			cityId:cityId
		},function(response)
		{
			UIkit.notification('City successfully activated', {status:'success',pos:'top-center'});
			location.reload();
		});
	}

	function addDelivery()
	{
		$('#largeModalBody').html('');
	    $('#largeModalBody').load('<?php echo base_url() ?>AdminManagement/viewAddDelivery');
	    $('#largeModal').modal('show');
	}

</script>
