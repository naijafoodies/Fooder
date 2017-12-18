/*****
 *  Function controls the data for the menu
 */
var categoryDeferred = [];

function CategoryMenuDataPoint() {

    let self = this;

    this._system = NfEnvironment.getServerEnvironment();
    this._menu;
    this._categoryId = $('#category-id').val();

    (function() {
        self.fetchMenu();
    })();
}

CategoryMenuDataPoint.prototype.fetchMenu = function() {

    let _self = this;

    var deferred = $.ajax({

        "url" : _self._system+'/Menu/getMenuByCategory/'+_self._categoryId,
        "method" : "GET",
        "dataType" : "json",

        "success" : function(response) {

            _self._menu = response.menu;
        }
    });

    categoryDeferred.push(deferred);

};