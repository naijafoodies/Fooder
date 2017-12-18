<!-- start of the add to cart modal -->

	<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Addon</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>

        <div class="modal-body">

        <div class="clearfix"></div>

        <form class="ui form" id="addonForm" enctype="multipart/form-data" method="POST">

        <!-- Start of hidden input field -->

        <input type="hidden" name="inputAddonId" id = "inputAddonId" value = "<?php echo $addonId; ?>">

        <!-- End of hidden input field -->

		<div class="field">
		    <label>Addon Name</label>
		    <input type="text" class = "requiredInput" name="inputAddonName" id="inputAddonName" placeholder="Addon Name" value="<?php echo $addonDetails['AddonName']; ?>">
		</div>

		<div class="field">
		    <label>Price</label>
		    <input type="number" class="requiredInput" name="inputAddonCost" id="inputAddonCost" placeholder="Price" value="<?php echo $addonDetails['Price']; ?>">
		</div>

	  <!-- Start of food Category selection -->

  	<div class="field">
			<label>Vendor</label>
  		<select class="ui dropdown" class="requiredInput" name="inputVendor">
		  
		  	<?php foreach($allVendors AS $vendor) { ?>

		  		<option value="<?php echo $vendor['ClientId']; ?>" <?php echo ($addonDetails['VendorId'] == $vendor['ClientId']) ? 'selected' : ''; ?>><?php echo $vendor['ClientName']; ?></option>

		  	<?php } ?>

		</select>
	</div>

	  <!-- End of food Category selection -->

	  <!-- Start of food Status select box -->

  	<div class="field">

		<label>Availability Status</label>
  		<select class="ui dropdown" class="requiredInput" name="inputAddonStatus">

  			<option value="0" <?php echo ($addonDetails['IsAvailable'] == 0)? 'selected' : ''; ?>>Available</option>
  			<option value="1" <?php echo ($addonDetails['IsAvailable'] == 1)? 'selected' : ''; ?>>Not Available</option>

		</select>
	</div>

	  <!-- End of food status select box -->

		</form>


      	</div>

      	<!-- Start of modal footer -->

      	<div class="modal-footer">

		    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

		    <div class="ui vertical animated green button" id="addFoodBtn" tabindex="0" onclick="return submitEditAddon()">
			  	<div class="visible content">Edit Addon</div>
			  	<div class="hidden content">
			    <i class="shop icon"></i>
			  </div>
			</div>
		    

      	</div>

      	<!-- End of modal footer -->

<!-- End of add to cart modal -->

<script>

	function submitEditAddon()
	{
		var valid = true;

		$('.requiredInput').each(function()
		{
			$(this).parent().removeClass('error');
			

			if($(this).val() == '')
			{
				$(this).parent().addClass('error');
				$(this).effect('shake');

				valid = false;
			}
		});

		if(valid)
		{
			var data = $('#addonForm').serialize();

			//post data

			$.post('<?php echo base_url(); ?>AdminManagement/submitEditAddon',data,function(response)
			{
				$('#largeModalBody').hide();

				UIkit.notification({
				message: 'Addon details has been changed',
				status: 'success',
				pos: 'top-center',
				timeout: 2000
				});

				setTimeout(function(){ location.assign('<?php echo base_url(); ?>AdminManagement/viewAddon'); }, 2000);

			});
		}
	}


</script>
