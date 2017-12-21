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

								<div class="panel-heading panel-title text-center">Order Summary</div>
								<div class="panel-body" id="priceDetails">

                  <ul class="list-group orderSummary">

                    <li class="list-group-item">
                      <span class="badge" id="totalPack">1</span>
                      Total Pack
                    </li>

                    <li class="list-group-item">
                      <span class="badge" id="totalPieces">6</span>
                      Total Pieces
                    </li>

                    <li class="list-group-item deliverySection" style="display:none;">
                      <span class="badge" id="delivery"></span>
                      Delivery
                    </li>

                    <li class="list-group-item">
                      <span class="badge" id="cost">$12.96</span>
                      Cost
                    </li>

                    <li class="list-group-item tCost" style="display:none;">
                      <span class="badge" id="totalCost">$12.96</span>
                      Total Cost
                    </li>

                  </ul>
								</div>

						</div>
								<!--End of Price details -->
		  	</div>

				<!--Start of food customization -->
		<?php if($details['IsAvailable'] == 0){ ?>

		  <div class="col-sm-6">
		    <div class="panel panel-success" id="detailsBoard">
		        <div class="panel-heading panel-title">Build your Order</div>

		        <div class="panel-body">

							<!--Start of custom details form -->

		          <form class="form-horizontal col-sm-6">

								<div class="form-group">
									<label class="control-label">Number Of Pack</label>
									<div>
										<input type="text" class="form-control requiredInput pack" name = "quantity" id="quantity" value="1" onkeyup="return quantityConversion();">
									</div>
								</div>

                <div class="form-group">
									<label class="control-label">Pieces</label>
									<div>
										<input type="text" class="form-control requiredInput pieces" name = "quantity" id="quantity" value="6" Disabled>
									</div>
								</div>

									<!--End of soup select box -->

									<div class="form-group">
											<label class="control-label">Select Delivery</label>
											<select class="form-control" name="deliveryMode" id="deliveryType">

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

									<button type="button" class="btn btn-success btn-sm btn-block " onclick="return savePurchaseData()">Process Order</button>


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

  function savePurchaseData()
  {

    var valid = true;
    $('.requiredInput').each(function(){

      $(this).removeClass('errorField');

      if($(this).val() === '' || $(this).val() == 0)
      {
        $(this).addClass('errorField');
        valid = false;
      }
    });

    if(valid)
    {
      var pack = $('.pack').val();
      var piecesPerPack = $('.pieces').val();
      var totalCost = piecesPerPack * 2.16;
      var phoneNumber = $('input[name="phoneNumber"]').val();
      var deliveryMode = $('#deliveryType option:selected').text();
      var deliveryId = $('select[name="deliveryMode"]').val();

      //send data to get payment button

      $.post('<?php echo base_url() ?>FoodDisplay/processCustomOrder',
      {
        pack:pack,
        piecesPerPack:piecesPerPack,
        totalCost:totalCost,
        phoneNumber:phoneNumber,
        deliveryMode:deliveryMode,
        deliveryId:deliveryId

      },function(response){
          $('#detailsBoard').html(response);
      });
    }

  }

  function quantityConversion()
  {
    var pack = $('.pack').val();
    var estimate = pack * 6;
    var cost = estimate * 2.16;

    $('.pieces').val(estimate);
    $('#totalPack').html(pack);
    $('#totalPieces').html(estimate);
    $('#cost').html('$' + cost.toFixed(2));

        }

</script>
