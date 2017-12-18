<!-- Page handles the management of meat in the table -->

<div class="container">

	<!-- Start of button groups -->

	<div class="nf-maginize nf-padinize">
	  <div class="ui mini animated green button" tabindex="0" onclick="return addMeat()">
	    <div class="visible content">Add New Meat</div>
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
				<th class="text-center">Meat Name</th>
				<th class="text-center">Meat Cost</th>
				<th class="text-center">Vendor</th>
				<th class="text-center">Status</th>

			</tr>

		</thead>

		<!-- End of table header -->

		<!-- Start of table body -->

		<tbody>

			<?php foreach($allMeat AS $meat) { ?>

				<tr>
					<td class="text-center">

						<div class="ui small basic icon buttons">
				            <button class="ui button" onclick="editMeat(<?php echo $meat['MeatId']; ?>)"><i class="write icon"></i></button>
				            <button class="ui button" onclick="deleteMeat(<?php echo $meat['MeatId']; ?>)"><i class="trash outline icon"></i></button>
				        </div>

					</td>

					<td class="text-center"><?php echo $meat['MeatName']; ?></td>
					<td class="text-center"><?php echo $meat['MeatPrice']; ?></td>
					<td class="text-center"><?php echo ($meat['ClientName']) ? $meat['ClientName'] : 'N/A' ; ?></td>
					<td class="text-center"><?php echo ($meat['IsAvailable'] == 0)? 'Available' : 'Not Available'; ?></td>

				</tr>

			<?php } ?>

		</tbody>

		<!-- End of table body -->

	</table>



	<!-- End of meat table -->



</div>

<!-- End of page -->

<script>

	function editMeat(meatId)
	{
		$('#largeModalBody').html('');
    	$('#largeModalBody').load('<?php echo base_url() ?>AdminManagement/viewEditMeat?meatId='+meatId);
    	$('#largeModal').modal('show');
	}

	function deleteMeat(meatId)
	{
		$('#questionModalBody').html('');
    	$('#questionModalBody').load('<?php echo base_url() ?>AdminManagement/viewDeleteMeat?meatId='+meatId);
    	$('#questionModal').modal('show');
	}

	function addMeat()
	{
		$('#largeModalBody').html('');
	    $('#largeModalBody').load('<?php echo base_url() ?>AdminManagement/viewAddMeat');
	    $('#largeModal').modal('show');
	}

</script>
