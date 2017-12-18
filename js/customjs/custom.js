
$(document).ready(function()
{
	$('.ui.checkbox').checkbox();
});


function updateMenu()
{
	var keyword = $('#nfMenuSearch').val();

	if(keyword != '')
	{

		$.post('../FoodDisplay/updateMenu',
		{
			keyword:keyword
		},
		function(response)
		{
			$('#pageContent').html(response);
		});
	}
}

//function handles search from jquery aucomplete box 

function updateFromJquery(keyword)
{
	if(keyword != '')
	{

		$.post('../FoodDisplay/updateMenu',
		{
			keyword:keyword
		},
		function(response)
		{
			$('#pageContent').html(response);
		});
	}
}

