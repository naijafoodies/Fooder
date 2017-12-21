<!-- Start of update password view -->
	
	<div class="uk-card uk-card-default uk-card-hover uk-card-small uk-card-body">

			<div class="uk-card-header">
            	<h3 class="uk-card-title">Update Password</h3>
            	<p id="inputError" style="color:red;"></p>
            </div>
			
			<div class="uk-card-body">
					
				<!-- Start of login form -->

				<form class="ui form">

				  <div class="field">
				    <label>Password</label>
				    <input type="password" class = "requiredInput" name="inputPassword" id = "inputPassword" placeholder="Password">
				  </div>

				  <div class="field">
				    <label>Verify Password</label>
				    <input type="password" class = "requiredInput" name="inputVerifyPassword" id = "inputVerifyPassword" placeholder="Password">
				  </div>

				</form>


				<!-- End of login form -->

			</div> 

			<div class="uk-card-footer">
				
				<button class="ui button" type="submit" id="submitButton" onclick="return updatePassword()">Submit</button>

			</div>


            
        </div>


<!-- End of update password view -->

<script>
function updatePassword()
{

	var valid = true;
	
	$('.requiredInput').each(function(){

		$(this).parent().removeClass('error');

		//check if empty

		if($(this).val() == '')
		{
			valid = false;
			$('.requiredInput').parent().addClass('error');
		}
	});

	if(valid)
	{
		var password = $('#inputPassword').val();
		var verifyPassword = $('#inputVerifyPassword').val();
		var clientId = "<?php echo $clientId; ?>";

		if(password !== verifyPassword)
		{
			$('#inputError').html('Your password do not match');
		}
		else
		{	
			$.post('<?php echo base_url(); ?>Client/updatePassword',
			{
				password:password,
				verifyPassword:verifyPassword,
				clientId:clientId

			},function(response)
			{

				if(response == '1')
				{
					$('#inputError').html('Your password do not match');
				}
				else
				{
					UIkit.notification({
					message: 'Your password has been updated!',
					status: 'primary',
					pos: 'top-right',
					timeout: 5000
					});

					location.assign('<?php echo base_url(); ?>Client/')
				}
			});
		}

	}
}

</script>