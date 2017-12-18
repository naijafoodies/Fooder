/*******
 *  Object controls the behaviour of the Cart
 */


//////////
// Throughout the system, cart form will have the id nf-cart-form.
//  Add To Cart button will have id nf-add-to-cart-button
//  Expected parem is inputFoodId, inputSideOne, inputSideTwo, inputMeatOrFish, inputQuantity
////////

function NfCart() {

    let self = this;

    this._addToCartButton = $('#nf-add-to-cart-button');
    this._removeFromCartButton = $('.nf-remove-cart-item');
    this.cartArea = $('#cart-area');

    this._cartIcon = $('#cartIcon');

    this.itemLength = 0;

    this._system = NfEnvironment.getServerEnvironment();

    // Create Event handlers through IIFE

    (function() {

        // declare variables

        // holding the form for adding to cart
        NfCart.prototype._cartForm  = $('#nf-cart-form');
        NfCart.prototype._cartCounter = $('#nf-cart-counter');

        // set Counter

        self.setCartCount();

        self.cartArea.on('click',function() {

            if(self.itemLength) {
                location.assign(NfEnvironment.getServerEnvironment() +'cart');
            }
        });
        // Add to Cart Handler

        self._addToCartButton.on('click', function() {

            self.addToCart();
        });

        self._removeFromCartButton.on('click', function(e) {

            e.preventDefault();

            let orderId = parseInt(this.getAttribute("data-attribute"));

            self.removeFromCart(orderId);
        });


    })();
}


NfCart.prototype.removeFromCart = function(orderId) {

    let _self = this;

    $.ajax({

        "url" : _self._system + 'Cart/removeCartItem/' + orderId,
        "method" : "POST",
        "dataType": "json",

        success : function(response) {

        }
    });

    location.reload();

};

/////////
////    Function sets the cart based on the result of ajax call
////////
NfCart.prototype.setCartCount = function() {

    let _self = this;

    $.ajax({

        "url" : _self._system + "Cart/getCartItems",
        "method" : 'GET',
        "dataType" : 'json',
        
        success : function (cartItems) {

            _self.itemLength = cartItems.cartItems.length;
            _self._cartCounter.text(cartItems.cartItems.length);
        }

    });

};


NfCart.prototype.addToCart = function() {

    let _self = this;

    let formData = _self._cartForm.serialize();

    $.ajax({

        "url" : _self._system + 'Cart/addItemToCart',
        "data" : formData,
        "method" : "POST",

        success : function(response) {

            _self.setCartCount();

            // show success message here

            UIkit.notification('Successfully Added to your cart', 'success');

            setTimeout(function() {
                location.assign(_self._system + "menu");
            },1000);
        }

    });

};