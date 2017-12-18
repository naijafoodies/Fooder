/****
 Script controls the sides Options
 */

function Sides(sides) {

    // initialize DOM elements. Component is the view file. This is done through dependency injection

    this._sideOneOption = $('#describe-side-1');
    this._sideTwoOption = $('#describe-side-2');
    this._sides = sides.sides;
}

/////
//  Function draws the sides for all sides options
/////

Sides.prototype.loadSides = function() {

    let _self = this;
    let i;

    // Loop through available sides to get side data

    for(i = 0; i < this._sides.length; i++) {

        // Only pick available sides

        if(_self._sides[i].available) {
            _self._sideOneOption.append("<option value = '"+ _self._sides[i].id +"'>"+ _self._sides[i].name + "</option>");
            _self._sideTwoOption.append("<option value = '"+ _self._sides[i].id +"'>"+ _self._sides[i].name + "</option>");
        }
    }

};

Sides.prototype.getSidesPrice = function(sideId) {

};