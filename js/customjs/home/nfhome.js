/**
 * Naija Foodies 2017
 * This is the script that controls the homepage of naijafoodies.com
 * Data is gotten through an ajax call to the NFHome API.  Dependencies include
 -	@jquery -nice-select --> https://github.com/hernansartorio/jquery-nice-select.git
 -	@Swipwe-3.4.2 --> https://github.com/nolimits4web/Swiper.git
 -
 *
*/

$(document).ready(function(){

	"use strict";
	var originData;

	//	instantiate nice select
	$('select').niceSelect();

	$.get('Home/getFoodOrigins',
	{

	},function(response)
	{
		originData = JSON.parse(response);
		for(var count = 0; count < originData.origins.length; count++)
		{
			$('#inputOrigin').append("<option value="+originData.origins[count].OriginId+">"+originData.origins[count].OriginName+"</option>");
		}

	}).done(function(){

		$('select').niceSelect('update');

	}).fail(function()
	{

	})

});

//** start of event listners */

$('#viewMenuButton').on('click',function() {

	var originId = parseInt($('#inputOrigin').val());

	if(originId != 0) {
		location.assign('view-menu/origin/'+originId);
	}

});