/****
 *  Function is the data point for the menu system. It fetches the menu and manages it
 */

var menuDeferreds = [];

function MenuDataPoint() {

    let self = this;
    this._menu;
    this.system = NfEnvironment.getServerEnvironment();

    (function() {

        self.getMenu();

    })();
}

MenuDataPoint.prototype.getMenu = function() {

    let _self = this;

    let deferred = $.ajax({

        "url" : _self.system + "Menu/getAvailableMenu",
        "method" : "GET",
        "dataType" : "json",

        "success" : function (response) {

            _self._menu = response.activeMenu;

        }
    });

    menuDeferreds.push(deferred);

};

MenuDataPoint.prototype.getMenuData = function() {


};
