<div class="ui mainLoader" style="background:#820D0D;">
  <div class="ui active inverted dimmer">
    <div class="ui massive text loader">Loading Client</div>
  </div>

</div>


<!-- Start of admin login page -->

<div class="container-fluid row" style="margin-top:2em;margin-bottom: 4em;height: 100%;">

<!-- End of admin header -->

	<!-- Start of left div -->

	<div class="col-sm-2">

		<h2 class="ui center aligned icon header">
		 <i class="shopping basket icon"></i>
		  Order Management
		</h2>

	<div class="ui inverted segment">

	  <div class="ui fluid inverted left icon input">

	    <input type="text" placeholder="Enter Order ID" id="inputOrderId" onkeydown="return searchOrder(event);">
	    <i class="search icon"></i>
	  </div>

	</div>


	</div>

	<!-- End of left div -->

	<!-- Start of middle div -->

	<div class="col-sm-7" id="centerPanel">

	<div id="orderDetails">

			<div class="ui massive black message">Enter your order id in the search box and hit enter to search order details</div>
	</div>

	<!-- End of order display -->





	</div>

	<!-- End of middle div -->


	<!-- Start of right div -->

	<div class="col-sm-3">

	</div>

	<!-- End of right div -->

</div>


<script>
	function searchOrder(event)
	{
  		var keyPressed = event.keyCode;

  		if(keyPressed == 13)
  		{
  			var keyword = $('#inputOrderId').val();

  			if(isNaN(keyword))
  			{
  				UIkit.notification({
				    message: 'Please enter number in the correct format!',
				    status: 'danger',
				    pos: 'top-right',
				    timeout: 3000
				});
  			}
  			else
  			{
  				$.post('<?php echo base_url(); ?>Client/grabOrderDetails',
  				{
  					keyword:keyword
  				},function(response)
  				{
  					$('#orderDetails').html(response);
  				});
  			}
  		}

  	}

</script>
