<!--Start of the selected food details module -->

<!--Start of modal header -->

<div class="modal-header">

		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
		<h1 class="modal-title"><?php echo $details['FoodName'];?> </h1>

</div>

<!--End of Modal header -->

<!--Start of modal Body -->

<div class="modal-body">

		  <div class="row">

		    <div class="col-sm-6">

					<!--Start of display Image -->

		    <img class="img-thumbnail img responsive" width="500" src="<?php echo base_url(); ?>images/menu/<?php echo $details['DisplayImage']; ?>.jpg" ><br/>

				<!--End of display Image -->

								<!--Start of Price Details -->
						<div class="panel panel-success">

								<div class="panel-heading panel-title text-center">Price Details</div>
								<div class="panel-body" id="priceDetails">

								</div>

						</div>
								<!--End of Price details -->
		  	</div>

				<!--Start of food customization -->
		<?php if($details['IsAvailable'] == 0){ ?>

		  <div class="col-sm-6">
		    <div class="panel panel-success" id="detailsBoard">
		        <div class="panel-heading panel-title">Build Your Dish</div>

		        <div class="panel-body">

							<!--Start of custom details form -->

		          <form class="form-horizontal col-sm-6">

								<div class="form-group">
									<label class="control-label">Quantity</label>
									<div>
										<input type="text" class="form-control requiredInput" name = "quantity" id="quantity" value="1">
									</div>
								</div>

		              <div class="form-group box-shadow">
		                  <label class="control-label">Select Size</label>
		                    <select class="form-control" name="foodPrice" id="foodQuantity">
		                        <?php foreach($foodPrice AS $price) { ?>

		                            <option value="<?php echo $price['PriceId']; ?>"><?php echo $price['category']; ?></option>

		                        <?php } ?>
		                    </select>
		              </div>

									<!--End of price select box -->

									<!--Start of soup Select Box -->

		              <div class="form-group">
		                  <label class="control-label">Select Soup</label>

		                  <select class="form-control" name="soupPrice" id="soupType">

		                      <?php foreach($allSoupDetails AS $soup) { ?>
		                          <option value="<?php echo $soup['SoupId']; ?>"><?php echo $soup['SoupName']; ?></option>

		                      <?php } ?>
		                  </select>

		              </div>

									<!--End of soup select box -->

									<!--Start of Addon -->

		              <div class="form-group">
		                  <label class="control-label">Select Addon</label>
		                  <select class="form-control" name="addonPrice" id="addonName">

		                      <?php foreach($allAddons as $addons) { ?>

		                        <option value="<?php echo $addons['AddonId']?>"><?php echo $addons['AddonName']; ?></option>

		                      <?php } ?>

		                  </select>

		              </div>

									<!--ENd of addon -->

									<!--Start of select dellivery -->

									<div class="form-group">
											<label class="control-label">Select Meat</label>
											<select class="form-control" name="selectMeat" id="meatName">
													<?php foreach($meatDetails as $meat){ ?>
															<option><?php echo $meat['MeatName']; ?></option>
													<?php } ?>

											</select>
									</div>

									<div class="form-group">
											<label class="control-label">Select Delivery</label>
											<select class="form-control" name="deliveryPrice" id="deliveryType">

												<?php foreach($deliveryModes as $delivery) { ?>
														<option value="<?php echo $delivery['DeliveryId']; ?>"><?php echo $delivery['DeliveryName']; ?></option>
													<?php } ?>

											</select>
									</div>

									<div class="form-group">
										<label class="control-label">Phone Number</label>&nbsp;<span style="color:red" class="glyphicon glyphicon-bell" data-toggle="tooltip" data-placement="top" title="So we can call you about your order"></span>
										<div>
											<input type="text" class="form-control requiredInput" name = "phoneNumber" id="phoneNumber">
										</div>
									</div>


									<!--End of select delivery -->

									<button type="button" class="btn btn-success btn-sm btn-block " onclick="return generatePricing()">Order</button>


		          </form>

							<!--End of custom details form -->

		        </div>



		    </div>

		  </div>

			<?php } else { ?>

				<div class="col-sm-6">
			    <div class="panel panel-warning" id="detailsBoard">
			        <div class="panel-heading panel-title">Status</div>

			        <div class="panel-body">
									<h1>Selected food is unavailable</h1>
							</div>

					</div>
					</div>
					<?php } ?>

			<!--End of customize food -->



</div>

<!--End of modal body -->

<script>

		function generatePricing()
		{
			$('.requiredInput').each(function(){
				valid = true;

				$(this).removeClass('errorField');

				if($(this).val() === '' || $(this).val() == 0){
					valid = false;

					$(this).addClass('errorField');
				}
			});

			if(valid){


			var pOfFood = $('select[name = "foodPrice"]').val();
			var pOfSoup = $('select[name = "soupPrice"]').val();
			var pOfAddon = $('select[name = "addonPrice"]').val();
			var pOfDelivery = $('select[name = "deliveryPrice"]').val();
			var quantity = $('input[name = "quantity"]').val();


			$.post('<?php echo base_url(); ?>FoodDisplay/getPrice', {
					foodId:pOfFood,
					soupId:pOfSoup,
					addonId:pOfAddon,
					deliveryId:pOfDelivery,
					quantity:quantity
			}, function(result){
				$('#priceDetails').html(result);
			});


			var selectedFood = $('#foodQuantity option:selected').text();
			var selectedSoup = $('#soupType option:selected').text();
			var selectedAddon = $('#addonName option:selected').text();
			var selectedDelivery = $('#deliveryType option:selected').text();
			var selectedMeat = $('#meatName option:selected').text();
			var foodName = "<?php echo $details['FoodName'] ?>";
			var quantity = $('input[name = "quantity"]').val();
			var phone = $('input[name = "phoneNumber"]').val();

			$.post('<?php echo base_url(); ?>FoodDisplay/foodSummary', {
				food:selectedFood,
				soup:selectedSoup,
				addon:selectedAddon,
				delivery:selectedDelivery,
				meat:selectedMeat,
				selectedFood:foodName,
				priceOfFood:pOfFood,
				priceOfSoup:pOfSoup,
				priceOfAddon:pOfAddon,
				priceOfDelivery:pOfDelivery,
				quantity:quantity,
				phone:phone

			}, function(success){
					$('#detailsBoard').html('');
					$('#detailsBoard').html(success);
			});
		}

		}

</script>
