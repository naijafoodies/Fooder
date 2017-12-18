

	<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Addon</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>

        <div class="modal-body">

        <div class="clearfix"></div>

        <form class="ui form" id="addonForm" enctype="multipart/form-data" method="POST">

			<div class="field">
			    <label>Addon Name</label>
			    <input type="text" class = "requiredInput" name="inputAddonName" id="inputAddonName" placeholder="Addon Name">
			</div>

			<div class="field">
			    <label>Addon Cost</label>
			    <input type="number" class="requiredInput" name="inputAddonCost" id="inputAddonCost" placeholder="Addon Cost">
			</div>

			<div class="field">
				<label>Vendor</label>
				<select class="ui dropdown" class="requiredInput" name="inputVendor">
			  
			  	<?php foreach($allVendors AS $vendor) { ?>

			  		<option value="<?php echo $vendor['ClientId']; ?>"><?php echo $vendor['ClientName']; ?></option>

			  	<?php } ?>

				</select>
			</div>			

		</form>


      	</div>

      	<!-- Start of modal footer --> 

      	<div class="modal-footer">

		    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

		    <div class="ui vertical animated green button" id="addFoodBtn" tabindex="0" onclick="return submitAddAddon()">
			  	<div class="visible content">Add Addon</div>
			  	<div class="hidden content">
			    <i class="shop icon"></i>
			  </div>
			</div>
		    

      	</div>

      	<!-- End of modal footer -->

<!-- End of add to cart modal -->

<script>

function submitAddAddon()
{
	/**
	*	Function adds new meat to inventory
	*/

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
		var data = $('#addonForm').serialize();

		$.post('<?php echo base_url(); ?>AdminManagement/submitAddAddon',data,function(response)
		{
				$('#largeModalBody').hide();

				UIkit.notification({
				message: 'Meat added successfully',
				status: 'success',
				pos: 'top-center',
				timeout: 2000
				});

				setTimeout(function(){ location.assign('<?php echo base_url(); ?>AdminManagement/viewAddon'); }, 2000);
		});
	}
}

</script>
