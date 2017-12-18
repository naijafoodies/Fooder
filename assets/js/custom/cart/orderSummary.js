
function OrderSummary(totalCost) {

    this._totalHandle = $('#total-description');
    this._taxHandle = $('#tax-description');
    this._grossTotalHandle = $('#gross-total-description');
    this._discounthandle = $('#total-discount');
    this._shippingCostHandle = $('#shipping-cost');

    this._discount = 0;
    this._shippingCost = 0;

    this._taxPercent = 0.07;
    this._totalCost = totalCost;

}


OrderSummary.prototype.calculateGrossTotal = function() {

   return (this._totalCost + this.calculateTax() + this._shippingCost - this._discount);
};


OrderSummary.prototype.calculateTax = function() {

   return (this._totalCost + this._shippingCost - this._discount) * this._taxPercent;
};

OrderSummary.prototype.showOrderSummary = function() {

    this._totalHandle.html(parseFloat(this._totalCost).toFixed(2));
    this._taxHandle.html(parseFloat(this.calculateTax()).toFixed(2));
    this._discounthandle.html(parseFloat(this._discount).toFixed(2));

    (this._shippingCostHandle) ? this._shippingCostHandle.html(parseFloat(this._shippingCost).toFixed(2)) : '';

    this._grossTotalHandle.html(parseFloat(this.calculateGrossTotal()).toFixed(2));

};
