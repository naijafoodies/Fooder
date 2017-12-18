<!-- Start of admin login page -->

<h1 class="text-center" style="margin-top: 50px; font-family: 'Fredericka the Great', cursive;"><span style="color: red;">Naija</span> <spanm style = "color:green;">Foodies</span></h1>

<div class="container-fluid row" style="margin-top:4em;margin-bottom: 4em;">

<!-- End of admin header -->

	<!-- Start of left div -->

	<div class="col-sm-4">

	</div>

	<!-- End of left div -->

	<!-- Start of middle div -->

	<div class="col-sm-4 text-center center-block" id="centerPanel">

		<div class="uk-card uk-card-default uk-card-hover uk-card-small uk-card-body">

			<div class="uk-card-header">
            	<h3 class="uk-card-title">Client Login</h3>
            	<p id="inputError" style="color:red;"></p>
            </div>
			
			<div class="uk-card-body">
					
				<!-- Start of login form -->

				<form class="ui form">

				  <div class="field">
				    <label>Username</label>
				    <input type="text" class="requiredInput" name="inputUsername" id = "inputUsername" placeholder="Username">
				  </div>

				  <div class="field">
				    <label>Password</label>
				    <input type="password" class = "requiredInput" name="inputPassword" id = "inputPassword" placeholder="Password">
				  </div>

				</form>


				<!-- End of login form -->

			</div> 

			<div class="uk-card-footer">
				
				<button class="ui button" type="submit" id="submitButton" onclick="return validateLogin();">Submit</button>

			</div>


            
        </div>


	</div>

	<!-- End of middle div -->


	<!-- Start of right div -->

	<div class="col-sm-4">

	</div>

	<!-- End of right div -->

</div>


<!-- End of Admin login page -->

<!-- Start of script -->
	
	<script>

		function validateLogin()
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
				var username = $('#inputUsername').val();
				var password = $('#inputPassword').val();

				$.post('<?php echo base_url() ?>Client/validateLogin',
				{
					username:username,
					password:password
				},
				function(response)
				{
					switch(response)
					{
						case '0':
							$('#inputError').html('The username you provided does not exist. Please try again');
						break;

						case '1':
							$('#inputError').html('You have entered a wrong password. Please try again');
						break;

						case '2':
							location.assign('<?php echo base_url(); ?>Client/mainConsole');
						break;

						default:
							$('#centerPanel').html(response);


					}

				});
			}
		}

	</script>

<!-- End of script -->