<!-- start of the add to cart modal -->

	<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Food</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>

        <div class="modal-body">

        <div class="clearfix"></div>

        <form class="ui form" id="foodForm" enctype="multipart/form-data" method="POST">

		<div class="field">
		    <label>Food Name</label>
		    <input type="text" class = "requiredInput" name="inputFoodName" id="inputFoodName" placeholder="Food Name">
		</div>

		<div class="field">
		    <label>Regular Price</label>
		    <input type="number" class="requiredInput" name="inputRegularPrice" id="inputRegularPrice" placeholder="Regular Price">
		</div>

		<div class="field">
		    <label>Half Tray Price</label>
		    <input type="number" class = "requiredInput" name="inputHalfTray" id="inputHalfTray" placeholder="Half tray">
		</div>

		<div class="field">
		    <label>Full Tray Price</label>
		    <input type="number" class = "requiredInput" name="inputFullTray" id="inputFullTray" placeholder="Full tray">
		</div>

	  <div class="field">
	    <label>Food Desription</label>
	    <textarea rows="2" class="requiredInput" id="inputDescription" name = "inputDescription" placeholder="Food Details"></textarea>
	  </div>

	  <!-- Start of food Category selection -->

  	<div class="field">
			<label>Food Category</label>
  		<select class="ui dropdown" class="requiredInput" name="inputFoodCategoryId">
		  
		  	<?php foreach($foodCategory AS $category) { ?>

		  		<option value="<?php echo $category['FoodCategoryId']; ?>"><?php echo $category['CategoryName']; ?></option>

		  	<?php } ?>

		</select>
	</div>

	  <!-- End of food Category selection -->

	  <!-- Start of client select box -->

  	<div class="field">
			<label>Vendor</label>
  		<select class="ui dropdown" class="requiredInput" name="inputVendor">

  			<option value="">Select Vendor</option>
		  
		  	<?php foreach($vendors AS $vendor) { ?>
		  		<option value="<?php echo $vendor['ClientId']; ?>"><?php echo $vendor['ClientName']; ?></option>
		  	<?php } ?>
		  	
		</select>
	</div>

	  <!-- End of client select box -->

	  <!-- Start of food origin -->


	  	<div class="field">
			<label>Origin</label>
  		<select class="ui dropdown" class="requiredInput" name="inputVendor">

  			<option value="">Select Food Origin</option>
		  
		  	<?php foreach($foodOrigin AS $origin) { ?>
		  		<option value="<?php echo $origin['FoodOriginId']; ?>"><?php echo $origin['OriginName']; ?></option>
		  	<?php } ?>
		  	
		</select>
	</div>  

	<!-- End of food origin -->

	<div class="uk-margin" uk-margin>
		<label style="color: red;">Click to upload</label>
        <div class="" uk-form-custom="target: true">
        	<input type="file" name="userfile" id="userfile">
            <input type="text" class="form-control requiredInput" name="user_file" id='file_name' value="" placeholder="upload Image" />
        </div>
        <button class="uk-button uk-button-default" disabled="true">Submit</button>
   	</div>


		</form>


      	</div>

      	<!-- Start of modal footer -->

      	<div class="modal-footer">

		    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

		    <div class="ui vertical animated green button" id="addFoodBtn" tabindex="0" onclick="return submitAddFood()">
			  	<div class="visible content">Add Food</div>
			  	<div class="hidden content">
			    <i class="shop icon"></i>
			  </div>
			</div>
		    

      	</div>

      	<!-- End of modal footer -->

<!-- End of add to cart modal -->

<script>

function submitAddFood()
{

	$('#addFoodBtn').addClass('loading');

	if (typeof FormData !== 'undefined') 
		{
		var formData = new FormData( $("#foodForm")[0] );  
	    $.ajax({
	    	url : '<?php echo base_url(); ?>AdminManagement/addFood',
	    	type : 'POST',
	    	data : formData,
	    	mimeType: "multipart/form-data",
	    	async : true,
	    	cache : false,
	    	contentType : false,
	    	processData : false,
	    	xhr: function()
			{
				var xhr = new XMLHttpRequest();
				xhr.upload.addEventListener("progress", function(event) {

				}, true);
				return xhr;
			},
	    	success : function(data) 
	    	{	
	    		$('#largeModalBody').hide();

				UIkit.notification({
				message: 'Inventory updated successfully',
				status: 'success',
				pos: 'top-center',
				timeout: 2000
				});

				setTimeout(function(){ location.assign('<?php echo base_url(); ?>AdminManagement/viewFoodInventory'); }, 2000);
	    	}
		});
	} 
	else
	{
		$('#largeModalBody').hide();

		UIkit.notification({
			message: 'Error! File not uploaded. Please try again',
			status: 'danger',
			pos: 'top-center',
			timeout: 2000
		});

		setTimeout(function(){ location.assign('<?php echo base_url(); ?>AdminManagement/viewFoodInventory'); }, 2000);
		
					
	}

	return false;

}



</script>


<script type="text/javascript">
$('input[type="file"]').change(function(e)
{	

    var fileName = e.target.files[0].name;
    $('#file_name').val(fileName);
   
});
</script>