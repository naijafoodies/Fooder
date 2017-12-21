/**
 * Object controls the coupon
 * @constructor
 */

var couponDeferred = [];

function NfCoupon() {

    this._applyCouponButton = $('#nf-discount-button');
    this._couponField = $('#inputCouponCode');
    this._system = NfEnvironment.getServerEnvironment();

    this.couponCost = 0;

}

/// Function makes ajax call to get discount of coupon

NfCoupon.prototype.setCouponCost = function(code) {

    let _self = this;
    let couponCode = code;

    if(!couponCode) {

        couponCode = this._couponField.val();
    }

    if(couponCode) {

        // Make ajax call to get coupon rebate

        let deferred = $.ajax({

            "url" : _self._system+'Coupons/getCouponCost/'+couponCode,
            "method" : "GET",
            "dataType" : "json",

            "success" : function(response) {

                _self.couponCost = response.couponCost;
            }
        });

        couponDeferred.push(deferred);
    }
    else {
        this.couponCost = 0;

        console.warn("Logger : No Initialized Coupon");
    }

};