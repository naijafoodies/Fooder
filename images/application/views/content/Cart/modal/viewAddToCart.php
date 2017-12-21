<!-- start of the add to cart modal -->

	<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo $foodDetails['FoodName']; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>

        <div class="modal-body">


        <div class="col-sm-12">
        	<img src="<?php echo base_url(); ?>images/menu/<?php echo $foodDetails['DisplayImage'];?>.jpg" alt="..." class="img-fluid">
        </div>

        <div class="clearfix"></div>

	        <form style="padding-top:2em;">

	        	<!-- Start of select adddon view -->

	        	<div class="ui mini form">
		        	<div class="three wide field">

		        		<label>Select Addon</label>
			          	<select class="ui fluid search dropdown" name="inputAddon" id="inputAddon">
			            	<?php foreach($addonDetails AS $addons) { ?>

			            		<option value="<?php echo $addons['AddonId']?>"><?php echo $addons['AddonName']; ?></option>
			            	<?php } ?>

			          </select>
			        </div>
		        </div>

		        <!-- End of select addon view -->

		        <!-- Start of select size view -->

				<div class="ui mini form">
		        	<div class="three wide field">

		        		<label>Select Size</label>
			          	<select class="ui fluid search dropdown" name="inputFoodSize" id="inputFoodSize">
			 
			            	<?php foreach($sizeDetails AS $size) { ?>

			            		<option value="<?php echo $size['FoodSizeId']?>"><?php echo $size['FoodSizeName']; ?></option>
			            	<?php } ?>

			          </select>
			        </div>
		        </div>

		        <!-- End of select food size view -->

		        <!-- Start of select quantity view -->

				<div class="ui mini form">
					<div class="field">
				  	<label>Quantity</label>
				    <div class="three wide field">
				      <input type="text" placeholder="Quantity" value="1" id="inputQuantity" name="inputQuantity">
				    </div>
				    </div>
				</div>


		        <!-- End pf select quantity view -->

	        </form>
	        <p class="addToCartError" style="background:red;"></p>

      	</div>

      	<!-- Start of modal footer -->

      	<div class="modal-footer">
		    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

		    <div class="ui vertical animated green button" tabindex="0" onclick="return addToCart();">
			  	<div class="visible content">Add To Cart</div>
			  	<div class="hidden content">
			    <i class="shop icon"></i>
			  </div>
			</div>
		    

      	</div>

      	<!-- End of modal footer -->



<!-- End of add to cart modal -->

<!-- Start of script section -->

<script>

	function addToCart()
	{
		//function sends all Item to the cart management controller where all further action takes place

		//variable declaration. Am setting up validation for quantity first. Quantity is validated against number and value

		var valid = true;

		var quantity = $('#inputQuantity').val();

		//validate 

		if(isNaN(quantity) || quantity <= 0)
		{
			valid = false;
			$('#inputQuantity').parent().addClass('error');

			//notify user of input error

			UIkit.notification({
		    message: 'The have entered an invalid quantity. Please enter a valid quanity and try again!',
		    status: 'danger',
		    pos: 'top-left',
		    timeout: 3000
		});

		}

		//do this is data is valid. Use this structure in case there are other validation might be included
		if(valid)
		{
			var addonId = $('#inputAddon').val();
			var sizeId = $('#inputFoodSize').val();
			var foodId = "<?php echo $foodId; ?>";

			//start ajax call. Call receives foodId,quantity,addon,and size and sent it to the cart management controller for further processing

			$.post('<?php echo base_url()?>CartManagement/addToCartTable',
				{
					foodId:foodId,
					addonId:addonId,
					quantity:quantity,
					sizeId:sizeId
				},function(response)
				{
					//conditions for return response

					switch(response)
					{
						case 0:
							$('.addToCartError').html('There was error adding your order to the cart. Please check your input and try again');
							$('.addToCartError').effect('shake');
								breaK;
						case 1:
							$('.addToCartError').html('invalid food selected. Please return to the menu and try again');
							$('.addToCartError').effect('shake');
								break;

						default:
							$('#largeModalBody').html('');
							$('#largeModal').modal('hide');

							$('#cartCount').html(response);
							$('#cartCount').effect('shake');

							UIkit.notification({
						    message: 'Item Added to cart',
						    status: 'danger',
						    pos: 'top-left',
						    timeout: 3000
						});


					}
				});

		}

	}


</script>

<!-- End of script section -->