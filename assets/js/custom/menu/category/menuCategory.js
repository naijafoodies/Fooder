

$(function() {

    var categoryMenuData = new CategoryMenuDataPoint();

    $.when.apply($,categoryDeferred).then(function() {

        var menu = new MenuArranger(categoryMenuData._menu);

        menu.arrangeMenu();
    });
});


function MenuArranger(menu) {
    let self = this;

    this._gridContainer = $('#menu-container');
    this._menu = menu;

    this._system = NfEnvironment.getServerEnvironment();
}

MenuArranger.prototype.arrangeMenu = function() {

    let _self = this;
    let assetsFolder = 'assets/uploads/menu/';

    $.each(this._menu,function(key,value) {

        var menuCart = '';

        menuCart += '<div class="card">';
        menuCart += '<a href = "' + _self._system + 'describe/' + value.foodId + '">';
        menuCart += '<img class="card-img-top" src="'+ _self._system + ''+ assetsFolder + '' + value.image + '" alt="' + value.foodName + '">';
        menuCart += '<div class="card-body">';
        menuCart += '<h4 class="card-title w3-myfont">' + value.foodName + '</h4>';
        menuCart += '<p class="card-text"><small class="text-muted">$' + value.cost + '</small></p>';
        menuCart += '</div>';
        menuCart += '</a>';
        menuCart += '</div>';

        _self._gridContainer.append(menuCart);

    });
};
