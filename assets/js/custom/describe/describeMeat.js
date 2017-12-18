/***
 Class controls The meat selection and loading
 */

"use strict";

function Meat(meatData) {

    // Load DOM item

    this._meatOptionBox = $('#describe-meat-fish');
    this._meatData = meatData.meats;
}

Meat.prototype.loadMeat = function() {

    let _self = this;

    $.each(this._meatData,function(key,value) {

        if(value.available) {

            _self._meatOptionBox.append("<option value = '"+ value.id +"'>"+ value.name + "</option>")
        }
    });
};

Meat.prototype.getMeatCost = function(meatId) {

    let _self = this;

};