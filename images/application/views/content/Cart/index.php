<!-- Start of cart display page -->

<?php 
	$grossTotal = 0;
?>

<div class="container-fluid row" style="padding: 2em;">


	<div class="col-sm-8 specialContent">
		<div class="ui divided items">
			<?php foreach($cartDetails AS $key=>$cart) { 
				$grossTotal += $cart['TotalCost'];
				?>

				<div class="item">

				    <div class="image">
				      <img src="<?php echo base_url();?>images/menu/<?php echo $cart['DisplayImage']; ?>.jpg">
				    </div>

				    <div class="content">

				      <a class="header"><?php echo $cart['FoodName']; ?></a>

				      <div class="meta">
				        <span class="cinema"></span>
				      </div>

				      <div class="description">
				        <p>Quantity: <span id="quantity"><?php echo $cart['Quantity'];?></span></p>

				      </div>

				      <div class="extra">

				      <p>Addon: <span id="quantity"><?php echo $cart['AddonName'];?></span></p>
				      <p>Size: <span id="quantity"><?php echo ($cart['FoodSize'] == 1) ? 'Small' : 'Party Tray';?></span></p>
				       <div class="ui label">$<?php echo $cart['TotalCost'];?></div>

				      </div>

				    </div>

				 </div>

			<?php } ?>	

				<?php if(!$cartDetails) { ?>

				<p class="text-center" style="color: red;">There is no Item in your cart at this moment</p>

				<?php } ?>

			<!-- Start of gross total display -->

				<p style="width: 100%; background:#ECE5E5; ">Total Cost: $<?php echo number_format($grossTotal,2); ?></p>

			<!-- End of gross total display -->

			</div>
	</div>

	<div class="col-sm-3" style="margin-top:2em;">
		<div class="ui cards">
		  <div class="card">
		    <div class="content">

		      <div class="header">
		        Total Cost
		      </div>
		      <div class="description">
		        <p>$<?php echo number_format($grossTotal,2); ?></p>
		      </div>
		    </div>
		    <div class="extra content">
		      <div class="ui two buttons">
		        <div class="ui basic green button" onclick="return getCustomerDetails()">Continue to checkout</div>
		        <div class="ui basic red button">Add More Item</div>
		      </div>
		    </div>
		  </div>
		</div>

	</div>

</div>

<!-- End of cart display page -->

<script>

	function getCustomerDetails()
	{
		var finalCost = "<?php echo $grossTotal; ?>";
		$('#largeModalBody').html('');
    	$('#largeModalBody').load('<?php echo base_url() ?>FoodCheckout/viewCustomerDataForm?grossTotal='+finalCost);
    	$('#largeModal').modal('show');
	}
</script>

