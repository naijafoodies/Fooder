/**
 *  This is the datapoint of the homepage. Script will contain all the API's needed for the controller to function
 **/
var deferreds = [];

var dataPoint = {

    menu : {},
    categories : null,

};



// make ajax call to get menu data

function getAllMenuItems() {

    deffered = $.ajax({

        "url" : NfEnvironment.getServerEnvironment() + "Menu/getAvailableMenu",
        "method" : "GET",
        "dataType" : "json",
        success : function(response) {

            dataPoint.menu = response;
        }

    });
    deferreds.push(deffered);

}
