/*****
 Function controls the Summary
 */

function Summary() {

    let self = this;

    this._foodCost = null;

    // Get DOM handles

    this._foodCostHandle = $('#foodCost');
    this._firstSideHandle = $('#firstSideCost');
    this._secondSideHandle = $('#secondSideCost');
    this._meatOrFishHandle = $('#meatOrFishCost');
    this._quantity = $('#quantity');
    this._totalHandle = $('#total');

    // Get DOM Select Boxes

    this._sideOneSelectBox = $('#describe-side-1');
    this._sideTwoSelectBox = $('#describe-side-2');
    this._meatAndFishSelectBox = $('#describe-meat-fish');

    // Set Up initial menu ID

    this._sideOneIdValue = null;
    this._sideTwoIdValue = null;
    this._meatAndFishIdValue = null;

    // Use an IIFE to rewrite food cost

    (function() {

        self._foodCost = describeDataPoint.cost.cost;
        self._foodCostHandle.html((describeDataPoint.cost.cost).toFixed(2));
        self._totalHandle.html((describeDataPoint.cost.cost).toFixed(2));

        // Set Event Listeners for sides1

        self._sideOneSelectBox.on('change',function() {

            self._sideOneIdValue = parseInt(this.value);

            self.computeTotal();

        });


        // Set Event listeners for sides2

        self._sideTwoSelectBox.on('change',function() {

            self._sideTwoIdValue = parseInt(this.value);

            self.computeTotal();
        });

        // Set Event handler for meat and fish change

        self._meatAndFishSelectBox.on('change',function() {

            self._meatAndFishIdValue = parseInt(this.value);

            self.computeTotal();
        });

        // Set Event handler for quantity

        self._quantity.on('input',function() {

            self.computeTotal();
        });

    })();


}


Summary.prototype.computeTotal = function() {

    // get Cost of all options

    var meatCost = describeDataPoint.getMeatCost(this._meatAndFishIdValue);
    var side1Cost = describeDataPoint.getSideCost(this._sideOneIdValue);
    var side2Cost = describeDataPoint.getSideCost(this._sideTwoIdValue);
    var quantity = (!this._quantity.val() || parseInt(this._quantity.val()) === 0) ? 1 : this._quantity.val();

    meatCost = (meatCost) ? meatCost : 0.00;
    side1Cost = (side1Cost) ? side1Cost : 0.00;
    side2Cost = (side2Cost) ? side2Cost : 0.00;

    this._firstSideHandle.text(parseFloat(side1Cost).toFixed(2));
    this._secondSideHandle.text(parseFloat(side2Cost).toFixed(2));
    this._meatOrFishHandle.text(parseFloat(meatCost).toFixed(2));
    this._foodCostHandle.text(parseFloat(this._foodCost * quantity).toFixed(2));

    var total = (meatCost + side1Cost + side2Cost + (this._foodCost * quantity));

    this._totalHandle.text(parseFloat(total).toFixed(2));


};
