/*****
 *  This is the menu controller
 */


$(function() {

    var menuDataPoint = new MenuDataPoint();

    $.when.apply($,menuDeferreds).then(function() {

        var cartHandle = new MenuParser();

        cartHandle.arrangeMenu(menuDataPoint._menu);

    });
});


function MenuParser() {

    let self = this;

    this._menuContainer = $('#menu-container');
    this._system = NfEnvironment.getServerEnvironment();

}

MenuParser.prototype.arrangeMenu = function(menuData) {

    let _self = this;
    let assetsFolder = 'assets/uploads/menu/';

    $.each(menuData,function(key,value) {

        var menuCart = '';

        menuCart += '<div class="card">';
        menuCart += '<a href = "' + _self._system+ 'describe/' + value.foodId + '">';
        menuCart += '<img class="card-img-top" src="'+ _self._system+''+assetsFolder+''+value.image +'" alt="'+ value.foodName + '">';
        menuCart += '<div class="card-body">';
        menuCart += '<h4 class="card-title w3-myfont">'+ value.foodName + '</h4>';
        menuCart += '</div>';
        menuCart += '</a>';
        menuCart += '<div class ="card-footer">';
        menuCart += '<small class = "text-muted">$'+value.cost+'</small>';
        menuCart += '</div>';
        menuCart += '</div>';

        _self._menuContainer.append(menuCart);

    });



};

