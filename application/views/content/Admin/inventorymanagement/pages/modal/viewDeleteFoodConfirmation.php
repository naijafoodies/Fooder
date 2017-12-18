<!-- Start of verify food Deletetion modal -->

<div class="modal-header" style="background: #F05A39;">
	<h5 class="modal-title">Verify Delete Attempt</h5>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	  <span aria-hidden="true">&times;</span>
	</button>
</div>

<div class="modal-body">

	<div class="text-center" style="color:red;">

		<i class="huge icons">
		  <i class="big loading sun icon"></i>
		  <i class="trash outline icon"></i>
		</i>
	</div>
	<p class="text-center">Are you sure you want to delete this inventory item</p>
</div>

<div class="modal-footer">

	<div class="ui animated red button" tabindex="0" onclick="submitDeleteFood()">
	  <div class="visible content">Confirm</div>
	  <div class="hidden content">
	    <i class="trash outline icon"></i>
	  </div>
	</div>

	<button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
</div>


<script>
	function submitDeleteFood()
	{
		/**
		*	Function confirms deletion of food
		*/

		var foodId = "<?php echo $foodId; ?>";

		$.post('<?php echo base_url() ?>AdminManagement/submitDeleteFood',
		{
			foodId:foodId
		},function(response)
		{
			$('#questionModalBody').html('');
			$('#questionModal').modal('hide');

			UIkit.notification({
			    message: 'Food have been successfully removed from the database',
			    status: 'success',
			    pos: 'top-right',
			    timeout: 400
			});


			location.assign('<?php echo base_url(); ?>AdminManagement/viewFoodInventory');
		});
	}
</script>