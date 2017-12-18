<div class="ui mainLoader" style="background:#820D0D;">
  <div class="ui active inverted dimmer">
    <div class="ui massive text loader">Loading Admin</div>
  </div>

</div>

<!-- Start of admin login page -->

<div class="container-fluid row" style="margin-top:4em;margin-bottom: 4em;height: 100%;">

<!-- End of admin header -->

	<!-- Start of left div -->

	<div class="col-sm-3">

	<div class="ui inverted green segment">

		<h3 class="ui inverted top attached header">Today Sales Statistics</h3>

		  <div class="ui inverted relaxed divided list">

		    <div class="item">
		      <div class="content">
		        <div class="header">Total Order(s)</div>
		        <?php echo count($totalorder); ?>
		      </div>
		    </div>

		    <div class="item">
		      <div class="content">
		        <div class="header">Total Unfulfilled Order(s)</div>
		        <?php echo count($unfulfilledOrders); ?>
		      </div>
		    </div>

		    <div class="item">
		      <div class="content">
		        <div class="header">Total Fulfilled Order(s)</div>
		        <?php echo count($fulfilledOrders); ?>
		      </div>
		    </div>

		    <div class="item">
		      <div class="content">
		        <div class="header">Total Unassigned Order(s)</div>
		        <?php echo count($allUnassignedOrders); ?>
		      </div>
		    </div>

		  </div>
		</div>

	</div>

	<!-- End of left div -->

	<!-- Start of middle div -->

	<div class="col-sm-6" id="centerPanel">

	<!--Start of Order icon -->

	<h2 class="ui center aligned icon header">
	 <i class="shopping basket icon"></i>
	  Order Management
	</h2>


	<!-- End of Order icon -->

	<!-- Start of search box -->

	<div class="ui inverted segment">

	  <div class="ui fluid inverted left icon input">

	    <input type="text" placeholder="Enter Order ID" id="inputOrderId" onkeydown="return searchOrder(event);">
	    <i class="search icon"></i>
	  </div>

	</div>

	<!-- End of search box -->

	<!-- Start of order display -->

	<div id="orderDetails">


	</div>

	<!-- End of order display -->





	</div>

	<!-- End of middle div -->


	<!-- Start of right div -->

	<div class="col-sm-3">

	</div>

	<!-- End of right div -->

</div>


<!-- End of Admin login page -->

<!-- Start of script -->

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
  				$.post('<?php echo base_url(); ?>AdminManagement/manageOrder',
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


<!-- End of script -->