
var checkoutDeferred = [];

function CheckoutDataPoint() {

    this._discountCode = '';
    this._system = NfEnvironment.getServerEnvironment();

    this._deliveryLocations = '';

}

// Function gets discount code

CheckoutDataPoint.prototype.getCustomerDiscountCode = function() {

    let _self = this;

    var deferred = $.ajax({

        "url" : _self._system+'Coupons/getCouponCode',
        "method" : "GET",
        "dataType" : "json",

        success : function(response) {

            _self._discountCode = response.couponCode;

        }
    });

    checkoutDeferred.push(deferred);

};

CheckoutDataPoint.prototype.getDeliveryLocations = function() {

    let _self = this;

    var deferred = $.ajax({

        "url" : _self._system +'Delivery/getDeliveryLocations',
        "method" : "GET",
        "dataType" : "json",

        success : function(response) {

            _self._deliveryLocations = response.locations;

        }
    });

    checkoutDeferred.push(deferred);

};

/**
 * Function gets the cost of a shipping city based on the id provided
 * @param id
 */
CheckoutDataPoint.prototype.getShippingCost = function(id) {

    let _self = this;

    if(id) {

        if(_self._deliveryLocations) {

            for(var i = 0; i < _self._deliveryLocations.length; i++) {

                if(id === _self._deliveryLocations[i].id) {

                    return _self._deliveryLocations[i].cost;
                }
            }
        }
        else {

            _self.getDeliveryLocations();

            $.when.apply($,checkoutDeferred).then(function() {

                _self.getShippingCost(id);

            });
        }
    }
};