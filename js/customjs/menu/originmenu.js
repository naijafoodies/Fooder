/**
 * Created by Olusegun on 10/11/2017.
 */

var originId = parseInt($('#inputOriginId').val());
var menuData;
var host = "http://localhost:8080/naijafoodies/assets/uploads/menu/";

$('.special.cards .image').dimmer({
    on: 'hover'
});

$(function(){


    /**
     * Get All menu
     */

    $.get('http://localhost:8080/naijafoodies/Menu/MenuByOrigin/getOriginMenu',
        {
            originId:originId
        },function(response) {

            menuData = JSON.parse(response);

            console.log(menuData);

        }).done(function(){

            for(var count = 0;count < menuData.length;count++) {
                $('#originMenu').append("<div class='card'><div class='blurring dimmable image'>" +
                    "<div class='ui dimmer'><div class='content'><div class='center'>" +
                    "<div class='ui inverted button'>" +
                    "Add Friend</div></div></div></div><img src="+host+menuData[count].DisplayImage+"></div>" +
                    "<div class='content'><a class='header'>"+menuData[count].FoodName+"</a> <div class='meta'> <span class='date'>"+menuData[count].FoodDescription+"</span>" +
                    "</div> </div> <div class='extra content'> <a> <i class='users icon'></i>2 Members </a> </div> </div> </div>");
            }

        $('.special.cards .image').dimmer({
            on: 'hover'
        });


    }).fail(function() {

    });

});
