

	<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Delivery City</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>

        <div class="modal-body">

        <div class="clearfix"></div>

        <form class="ui form" id="deliveryForm" method="POST">

			<div class="field">
			    <label>City Name</label>
			    <input type="text" class = "requiredInput" name="inputCityName" id="inputCityName" placeholder="City Name">
			</div>

			<div class="field">
			    <label>City Cost</label>
			    <input type="number" class="requiredInput" name="inputCityCost" id="inputCityCost" placeholder="City Cost">
			</div>

		</form>


      	</div>

      	<!-- Start of modal footer -->

      	<div class="modal-footer">

		    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

		    <div class="ui vertical animated green button" id="addFoodBtn" tabindex="0" onclick="return submitAddDeliveryCity()">
			  	<div class="visible content">Add City</div>
			  	<div class="hidden content">
			    	<i class="shop icon"></i>
			  	</div>
			</div>
		    

      	</div>

      	<!-- End of modal footer -->

<!-- End of add to cart modal -->

<script>

function submitAddDeliveryCity()
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
		var data = $('#deliveryForm').serialize();

		$.post('<?php echo base_url(); ?>AdminManagement/submitAddDeliveryCity',data,function(response)
		{
				$('#largeModalBody').hide();

				UIkit.notification({
				message: 'City added successfully',
				status: 'success',
				pos: 'top-center',
				timeout: 2000
				});

				setTimeout(function(){ location.assign('<?php echo base_url(); ?>AdminManagement/viewDelivery'); }, 2000);
		});
	}
}

</script>
