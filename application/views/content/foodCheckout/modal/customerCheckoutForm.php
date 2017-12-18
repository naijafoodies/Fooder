<!-- start of the add to cart modal -->

	<div class="modal-header">

		<h5 class="modal-title">Select Delivery Choice</h5>

        <!-- Gross Total input -->

        <input type="hidden" id="grossTotal" value="<?php echo number_format($grossTotal,2);?>">

        <!-- End of real gross total input -->

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

    </div>

        <div class="modal-body">
                <h5 class="modal-title" id="exampleModalLabel">Gross Total: $<span id="visibleGrossTotal"><?php echo number_format($grossTotal,2);?></span></h5>

	        <form class="ui form" style="padding-top:2em;">

	        	<!-- Start of select adddon view -->

	        	<div class="ui mini form">
	        		<div class="field">
		        		<label>Select Delivery Options &nbsp <span style="color:red;">*</span></label>
			          	<select class="ui fluid search dropdown requiredInput" name="inputDelivery" id="inputDelivery" onchange="return getDeliveryCost()">

			          		<option value="">Select Delivery Method</option>
			            	<?php foreach($deliveryCities AS $cities) { ?>
			            		<option value="<?php echo $cities['DeliveryId']; ?>"><?php echo $cities['DeliveryCityName']; ?></option>
			            	<?php } ?>

			          	</select>
			        </div>
		        </div>

		        <!-- End of select addon view -->

		        <!-- Start of select quantity view -->

				<div class="ui mini form">
					<div class="field">
				  	<label>Phone Number &nbsp <span style="color:red;">*</span></label>

					      <input type="number" class = "requiredInput" placeholder="Phone Number" id="inputPhone" name="inputPhone">
					    
				    </div>
				</div>

	        </form>
	        <p class="addToCartError" style="color:red;"></p>

	        <div class="deliveryPlatform">



	        </div>

      	</div>

      	<!-- Start of modal footer -->

      	<div class="modal-footer">
		    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

		    <div class="ui vertical animated green button" tabindex="0" onclick="return submitOrderData()">
			  	<div class="visible content">Next</div>
			  	<div class="hidden content">
			    <i class="shop icon"></i>
			  </div>
			</div>
		    

      	</div>

      	<!-- End of modal footer -->



<!-- End of add to cart modal -->

<!-- Start of script section -->

<script>
	function getDeliveryCost()
	{
		$('.deliveryPlatform').hide();
		$('.modal-footer').show();

		var deliveryId = $('#inputDelivery').val();

		if(!deliveryId || deliveryId == '')
		{
			$('.addToCartError').html('The delivery option you have picked is invalid');
			$('.addToCartError').effect('shake');

			var grossTotal = $('#grossTotal').val();

			$('#visibleGrossTotal').html(grossTotal);
		}

		else
		{
			//load ajax

			$('.addToCartError').html('');

			$.post('<?php echo base_url(); ?>FoodCheckout/getDeliveryPrice',
			{
				deliveryId:deliveryId
			},function(response)
			{
				switch(response)
				{
					case 0:
						$('.addToCartError').html('The delivery option you have picked is invalid');
						$('.addToCartError').effect('shake');
					break;

					case 1:
						$('.addToCartError').html('The delivery option you have picked is invalid');
						$('.addToCartError').effect('shake');
					break;

					default:

						var data = JSON.parse(response);

						var grossTotal = $('#grossTotal').val();
						grossTotal = parseFloat(grossTotal);

						var deliveryPrice = data.DeliveryPrice;
						deliveryPrice = parseFloat(deliveryPrice);

						$('#visibleGrossTotal').html((deliveryPrice + grossTotal).toFixed(2));
						$('#visibleGrossTotal').effect('fade');
						
				}
			});
		}
	}

	function submitOrderData()
	{
		//functions submit order Data. calculation of order is done at the backend

		//start data validation

		$('.addToCartError').html('');

		var valid = true;

		$('.requiredInput').each(function(){

			$(this).parent().removeClass('error');

			if($(this).val() == '')
			{
				valid = false;

				$(this).parent().addClass('error');

				$('.addToCartError').html('Error. All field is required');
				$('.addToCartError').effect('shake');
			}
		});

		if(valid)
		{
			var phone = $('#inputPhone').val();
			var deliveryMode = $('#inputDelivery').val();
			var gross = $('#visibleGrossTotal').text();

			$.post('<?php echo base_url() ?>FoodCheckout/registerUserData',
			{
				phone:phone,
				deliveryMode:deliveryMode,
				gross:gross

			},function(response)
			{
				$('.deliveryPlatform').show();
				$('.deliveryPlatform').html(response);

				$('.modal-footer').hide();
			})
		}

	}

</script>

<!-- End of script section -->