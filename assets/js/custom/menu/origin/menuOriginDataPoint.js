/*****
 *  Function controls the data for the menu
 */
var originDeferred = [];

function OriginMenuDataPoint() {

    let self = this;

    this._system = NfEnvironment.getServerEnvironment();
    this._menu;
    this._originId = $('#origin-id').val();

    (function() {
        self.fetchMenu();
    })();
}

OriginMenuDataPoint.prototype.fetchMenu = function() {

    let _self = this;

    var deferred = $.ajax({

        "url" : _self._system+'/Menu/getMenuByOrigin/'+_self._originId,
        "method" : "GET",
        "dataType" : "json",

        "success" : function(response) {

            _self._menu = response.menu;
        }
    });

    originDeferred.push(deferred);

};