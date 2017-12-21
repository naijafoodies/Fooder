<!-- start of the add to cart modal -->

	<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit City</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>

        <div class="modal-body">

        <div class="clearfix"></div>

        <form class="ui form" id="cityForm" method="POST">

        	<!-- Start of hidden input field -->

        	<input type="hidden" value="<?php echo $deliveryDetails['DeliveryId']; ?>" name = "inputCityId">

        	<!-- End of hidden input field -->

			<div class="field">
			    <label>City Name</label>
			    <input type="text" class = "requiredInput" name="inputDeliveryCityName" id="inputDeliveryCityName" placeholder="City Name" value="<?php echo $deliveryDetails['DeliveryCityName']; ?>">
			</div>

			<div class="field">
			    <label>Cost of Delivery</label>
			    <input type="number" class="requiredInput" name="inputDeliveryCost" id="inputDeliveryCost" placeholder="Delivery Cost" value="<?php echo $deliveryDetails['DeliveryPrice']; ?>">
			</div>

			<!-- Start of meat Status select box -->

		  	<div class="field">
				<label>Availability Status</label>
		  		<select class="ui dropdown" class="requiredInput" name="inputCityStatus">

		  			<option value="0" <?php echo ($deliveryDetails['RecordDisabled'] == 0)? 'selected' : ''; ?>>Active</option>
		  			<option value="1" <?php echo ($deliveryDetails['RecordDisabled'] == 1)? 'selected' : ''; ?>>Inactive</option>

				</select>
			</div>

			  <!-- End of food status select box -->

		</form>


      	</div>

      	<!-- Start of modal footer -->

      	<div class="modal-footer">

		    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

		    <div class="ui vertical animated green button" id="editCityBtn" tabindex="0" onclick="editCityDetails()">
			  	<div class="visible content">Edit City</div>
			  	<div class="hidden content">
			    <i class="shop icon"></i>
			  </div>
			</div>
		    

      	</div>

      	<!-- End of modal footer -->

<!-- End of add to cart modal -->


<script>
	
	function editCityDetails()
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
			var data = $('#cityForm').serialize();

			$.post('<?php echo base_url(); ?>AdminManagement/submitEditCity',data,function(response)
			{
				$('#largeModalBody').hide();

				UIkit.notification({
				message: 'City details has been changed successfully',
				status: 'success',
				pos: 'top-center',
				timeout: 2000
				});

				setTimeout(function(){ location.assign('<?php echo base_url(); ?>AdminManagement/viewDelivery'); }, 2000);
			});
		}

	}

</script>
