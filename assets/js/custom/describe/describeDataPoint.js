/**
 *  This is the datapoint of the homepage. Script will contain all the API's needed for the controller to function
 **/
var menuDeffereds = [];
var sidesDeffereds = [];
var meatDeffereds = [];
var categoryDeffereds = [];

var describeDataPoint = {

    menuDetails : {},
    cost : {},
    sides : {},
    meats : {},
    sameCategoryMenu : {},

    //// Function gets the cost of the id

    getMeatCost : function(meatId) {

        try {

            for (let i = 0; i < describeDataPoint.meats.meats.length; i++) {

                if (describeDataPoint.meats.meats[i].id === meatId) {

                    return describeDataPoint.meats.meats[i].cost;
                }

            }
        }
        catch(e) {

        }

    },

    getSideCost : function(sideId) {

        for(let i = 0; i < describeDataPoint.sides.sides.length; i++) {

            if(describeDataPoint.sides.sides[i].id === sideId) {

                return describeDataPoint.sides.sides[i].cost;
            }

        }
    }

};

var menuId;


$(function() {

    menuId = parseInt($('#main-data-element').attr('data-plugin'));

    getMenu(menuId);

});

// make ajax call to get menu data

function getMenu(menuId) {

    let deffered = $.ajax({

        "url" : NfEnvironment.getServerEnvironment() + "Menu/getMenu/"+menuId,
        "method" : "GET",
        "dataType" : "json",

        success : function(response) {

            describeDataPoint.menuDetails = response.menuDetails.details;
            describeDataPoint.cost = response.menuDetails.cost;
            describeDataPoint.vendor = response.menuDetails.vendor;

        }

    });
    menuDeffereds.push(deffered);

}

function getSides(vendorId) {

    let deffered = $.ajax({

        "url" : NfEnvironment.getServerEnvironment() + "Sides/getVendorSides/"+vendorId,
        "method" : "GET",
        "dataType" : "json",

        success : function(response) {

            describeDataPoint.sides = response;
        }
    });

    sidesDeffereds.push(deffered);
}

function getMeat(vendorId) {

    let deffered = $.ajax({

        "url" : NfEnvironment.getServerEnvironment() + "Meat/getVendorMeat/"+vendorId,
        "method" : "GET",
        "dataType" : "json",
        
        success : function (response) {

            describeDataPoint.meats = response;
        }

    });

    meatDeffereds.push(deffered);

}

function getCategoryMenu(categoryId) {

    let deferred = $.ajax({
        "url" : NfEnvironment.getServerEnvironment() + "Menu/getMenuByCategory/"+categoryId,
        "method" : "GET",
        "dataType" : "json",

        success : function(response) {
            describeDataPoint.sameCategoryMenu = response;
        }
    });

    categoryDeffereds.push(deferred);
}
