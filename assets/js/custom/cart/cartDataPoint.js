/***
 Function controls the cart listing
 */

var cartDeferred = [];

function CartDataPoint() {

    let self = this;

    this._cartList;

    this._system = NfEnvironment.getServerEnvironment();

    this.getCartDetails();

}

/**
 * Function makes ajax call to get cart list
 */
CartDataPoint.prototype.getCartDetails = function() {

    let _self = this;

    let deferred = $.ajax({

        "url" : _self._system+'Cart/getCartDetails',
        "method" : "GET",
        "dataType" : "json",

        success : function(response) {

            _self._cartList = response;

        }
    });

    cartDeferred.push(deferred);
};


CartDataPoint.prototype.getTotalCost = function() {

    let _self = this;
    let totalOrderCost = 0;

    $.each(this._cartList,function(key,value) {

        totalOrderCost += value.foodDetails.cost * value.quantity;
        totalOrderCost += value.meatDetails.cost;
        totalOrderCost += value.sideOneDetails.cost;
        totalOrderCost += value.sideTwoDetails.cost;
    });

    return totalOrderCost;
};

CartDataPoint.prototype.setCheckoutPhoneNumber = function(phoneNumber) {

    let _self = this;

    $.ajax({

        "url" : _self._system+'CheckOut/setCheckoutPhoneNumber/'+phoneNumber,
        "method" : "GET",
    });
};
