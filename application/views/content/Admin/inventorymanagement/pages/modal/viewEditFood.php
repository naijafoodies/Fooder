<!-- start of the add to cart modal -->

	<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Food</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>

        <div class="modal-body">

        <div class="clearfix"></div>

        <form class="ui form" id="foodForm" enctype="multipart/form-data" method="POST">

        <!-- Start of hidden input field -->

        <input type="hidden" name="inputFoodId" id = "inputFoodId" value = "<?php echo $foodId; ?>">

        <!-- End of hidden input field -->

		<div class="field">
		    <label>Food Name</label>
		    <input type="text" class = "requiredInput" name="inputFoodName" id="inputFoodName" placeholder="Food Name" value="<?php echo $foodDetails['FoodName']; ?>">
		</div>

		<div class="field">
		    <label>Regular Price</label>
		    <input type="number" class="requiredInput" name="inputRegularPrice" id="inputRegularPrice" placeholder="Regular Price" value="<?php echo $foodDetails['Regular']; ?>">
		</div>

		<div class="field">
		    <label>Half Tray Price</label>
		    <input type="number" class = "requiredInput" name="inputHalfTray" id="inputHalfTray" placeholder="Half tray" value = "<?php echo $foodDetails['HalfTray']; ?>">
		</div>

		<div class="field">
		    <label>Full Tray Price</label>
		    <input type="number" class = "requiredInput" name="inputFullTray" id="inputFullTray" placeholder="Full tray" value = "<?php echo $foodDetails['FullTray']; ?>">
		</div>

	  <div class="field">
	    <label>Food Desription</label>
	    <textarea rows="2" class="requiredInput" id="inputDescription" name = "inputDescription" placeholder="Food Details"><?php echo $foodDetails['Description']; ?></textarea>
	  </div>

	  <!-- Start of food Category selection -->

  	<div class="field">
			<label>Food Category</label>
  		<select class="ui dropdown" class="requiredInput" name="inputFoodCategoryId">
		  
		  	<?php foreach($foodCategories AS $category) { ?>

		  		<option value="<?php echo $category['FoodCategoryId']; ?>" <?php echo ($foodDetails['FoodCategoryId'] == $category['FoodCategoryId']) ? 'selected' : ''; ?>><?php echo $category['CategoryName']; ?></option>

		  	<?php } ?>

		</select>
	</div>

	  <!-- End of food Category selection -->


	  <!-- Start of vendor attached -->

  	<div class="field">
			<label>Vendor</label>
  		<select class="ui dropdown" class="requiredInput" name="inputVendor">
		  	
		  	<option value="">Pick A Vendor</option>
		  	<?php foreach($vendors AS $vendor) { ?>

		  		<option value="<?php echo $vendor['ClientId']; ?>" <?php echo ($foodDetails['VendorId'] == $vendor['ClientId']) ? 'selected' : ''; ?>><?php echo $vendor['ClientName']; ?></option>

		  	<?php } ?>

		</select>
	</div>


	  <!-- End of vendor attached -->

	  <!-- Start of food Status select box -->

  	<div class="field">

		<label>Availability Status</label>
  		<select class="ui dropdown" class="requiredInput" name="inputFoodStatus">

  			<option value="0" <?php echo ($foodDetails['IsAvailable'] == 0)? 'selected' : ''; ?>>Available</option>
  			<option value="1" <?php echo ($foodDetails['IsAvailable'] == 1)? 'selected' : ''; ?>>Not Available</option>

		</select>
	</div>

	  <!-- End of food status select box -->

	  <!-- Start of food origin -->


	 <div class="field">
			<label>Origin</label>
  		<select class="ui dropdown" class="requiredInput" name="inputOrigin">

  			<option value="">Select Food Origin</option>
		  
		  	<?php foreach($foodOrigin AS $origin) { ?>
		  		<option value="<?php echo $origin['FoodOriginId']; ?>" <?php echo ($foodDetails['FoodOriginId'] == $origin['FoodOriginId']) ? 'selected':'';?>><?php echo $origin['OriginName']; ?></option>
		  	<?php } ?>
		  	
		</select>
	</div>  

	<!-- End of food origin -->

		</form>


      	</div>

      	<!-- Start of modal footer -->

      	<div class="modal-footer">

		    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

		    <div class="ui vertical animated green button" id="addFoodBtn" tabindex="0" onclick="return submitEditFood()">
			  	<div class="visible content">Edit Food</div>
			  	<div class="hidden content">
			    <i class="shop icon"></i>
			  </div>
			</div>
		    

      	</div>

      	<!-- End of modal footer -->

<!-- End of add to cart modal -->

<script>

	function submitEditFood()
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
			var data = $('#foodForm').serialize();

			//post data

			$.post('<?php echo base_url(); ?>AdminManagement/submitEditFood',data,function(response)
			{
				$('#largeModalBody').hide();

				UIkit.notification({
				message: 'Food Details has been changed',
				status: 'success',
				pos: 'top-center',
				timeout: 2000
				});

				setTimeout(function(){ location.assign('<?php echo base_url(); ?>AdminManagement/viewFoodInventory'); }, 2000);

			});
		}
	}


</script>
