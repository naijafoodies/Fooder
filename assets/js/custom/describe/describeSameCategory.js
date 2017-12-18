/***
 Object controls behaviour of same category dishes. It is dependent on flex slider to display

 */


function Category(menu) {

    this._slideHolder = $('#describe-category-menu');
    this._owl = $('.owl-carousel');
    this._menu = menu.menu;
    this.system = NfEnvironment.getServerEnvironment();

}

Category.prototype.loadSameCategoryMenu = function() {

    let self = this;

    $.each(this._menu,function(key,value) {

        var assetsFolder = 'assets/uploads/menu/';

        var str = '';
        str += '<div class="item">';
        str += '<a href =' + self.system + 'describe/' + value.foodId + '>';
        str += '<figure>';
        str += '<img src =' + self.system + '' + assetsFolder + '' + value.image + '>';
        str += '<figcaption>'+ value.foodName + '</figcaption>';
        str += '</figure>';
        str += '</a>';
        str += '</div>';

        self._slideHolder.append(str);

    });

    this._owl.owlCarousel({
        loop:true,
        autoplay:true,
        autoplayTimeout:5000,
        autoplayHoverPause:true,
        nav:false,
        items : 7,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:5
            }
        }
    })

};