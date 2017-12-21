<!-- start of the add to cart modal -->

	<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Meat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>

        <div class="modal-body">

        <div class="clearfix"></div>

        <form class="ui form" id="meatForm" method="POST">

        	<!-- Start of hidden input field -->

        	<input type="hidden" value="<?php echo $meatDetails['MeatId']; ?>" name = "inputMeatId">

        	<!-- End of hidden input field -->

			<div class="field">
			    <label>Meat Name</label>
			    <input type="text" class = "requiredInput" name="inputMeatName" id="inputMeatName" placeholder="Meat Name" value="<?php echo $meatDetails['MeatName']; ?>">
			</div>

			<div class="field">
			    <label>Meat Cost</label>
			    <input type="number" class="requiredInput" name="inputMeatCost" id="inputMeatCost" placeholder="Meat Cost" value="<?php echo $meatDetails['MeatPrice']; ?>">
			</div>

			<!-- Start of meat Status select box -->

		  	<div class="field">

				<label>Availability Status</label>
		  		<select class="ui dropdown" class="requiredInput" name="inputMeatStatus">

		  			<option value="0" <?php echo ($meatDetails['IsAvailable'] == 0)? 'selected' : ''; ?>>Available</option>
		  			<option value="1" <?php echo ($meatDetails['IsAvailable'] == 1)? 'selected' : ''; ?>>Not Available</option>

				</select>
			</div>

			  <!-- End of food status select box -->

			  <!-- Start of vendorlist -->

		  	<div class="field">
					<label>Vendor</label>
		  		<select class="ui dropdown" class="requiredInput" name="inputVendor">
				  
				  	<?php foreach($allVendors AS $vendor) { ?>

				  		<option value="<?php echo $vendor['ClientId']; ?>" <?php echo ($meatDetails['VendorId'] == $vendor['ClientId']) ? 'selected' : ''; ?>><?php echo $vendor['ClientName']; ?></option>

				  	<?php } ?>

				</select>
			</div>


			  <!-- End of vendor list -->

		</form>


      	</div>

      	<!-- Start of modal footer -->

      	<div class="modal-footer">

		    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

		    <div class="ui vertical animated green button" id="addMeatBtn" tabindex="0" onclick="editMeatDetails()">
			  	<div class="visible content">Edit Meat</div>
			  	<div class="hidden content">
			    <i class="shop icon"></i>
			  </div>
			</div>
		    

      	</div>

      	<!-- End of modal footer -->

<!-- End of add to cart modal -->


<script>
	
	function editMeatDetails()
	{
		var valid = true;

		$('.requiredInput').each(function(){

			$(this).parent().removeClass('error');

			if($(this).val() == '')
			{
				$(this).parent().addClass('error');

				valid = false;
			}
		});

		if(valid)
		{
			var data = $('#meatForm').serialize();

			$.post('<?php echo base_url(); ?>AdminManagement/submitEditMeat',data,function(response)
			{
				$('#largeModalBody').hide();

				UIkit.notification({
				message: 'Meat details has been changed successfully',
				status: 'success',
				pos: 'top-center',
				timeout: 2000
				});

				setTimeout(function(){ location.assign('<?php echo base_url(); ?>AdminManagement/viewMeatInventory'); }, 2000);
			});
		}

	}

</script>
