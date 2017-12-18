
$(function() {

    var cartList = new CartDataPoint();
    var phoneNumberField = $('#inputPhoneNumber');
    var checkOutButton = $('#nf-checkout-button');

    $.when.apply($,cartDeferred).then(function() {

        if(!cartList._cartList.length) {

            alert("No item in cart");

            location.assign(cartList._system + 'menu');
        }
        else {

            var lister = new CartLister(cartList._cartList);

            lister.listCart();

            var orderSummary = new OrderSummary(cartList.getTotalCost());
            orderSummary.showOrderSummary();

            var couponInstance = new NfCoupon();

            // Event handler for coupon button

            (function() {

                couponInstance._applyCouponButton.on('click',function(e) {

                    // Set coupon cost
                    couponInstance.setCouponCost();

                    $.when.apply($,couponDeferred).then(function() {

                        // set discount
                        orderSummary._discount = couponInstance.couponCost;

                        // show summary
                        orderSummary.showOrderSummary(cartList.getTotalCost());
                    });

                });

                // set event handler for checkout button

                checkOutButton.on('click',function() {

                    // TODO this still needs validation for the type of input to be entered

                    if(phoneNumberField.val()) {

                        cartList.setCheckoutPhoneNumber(phoneNumberField.val());

                        location.assign(cartList._system + 'checkout');
                    }
                    else {

                        UIkit.notification('Please enter your phone number', 'danger');
                    }
                });

            })();
        }
    })
});


function CartLister(cartList) {

    this._cartList = cartList;
    this._cartContainer = $('#cart-list');
}

CartLister.prototype.listCart = function() {

    let _self = this;

    $.each(this._cartList, function (key, value) {

        var component = '';

        component += '<div class="ui raised segment">';
        component += '<p><span><strong>Food Name: </strong></span><span>' + value.foodDetails.name + '</span></p>';
        component += '<p><span><strong>Food Cost: </strong></span><span>' + parseFloat(value.foodDetails.cost).toFixed(2) + '</span></p>';
        component += '<p><span><strong>Quantity: </strong></span><span>' + parseInt(value.quantity) + '</span></p>';

        component += '<div class="ui horizontal divider">Sides</div>';

        component += '<p><span><strong>Side 1: </strong></span><span>' + value.sideOneDetails.name + '</span></p>';
        component += '<p><span><strong>Cost: $</strong></span><span>' + parseFloat(value.sideOneDetails.cost).toFixed(2) + '</span></p>';

        component += '<p><span><strong>Side 2: </strong></span><span>' + value.sideTwoDetails.name + '</span></p>';
        component += '<p><span><strong>Cost: $</strong></span><span>' + parseFloat(value.sideTwoDetails.cost).toFixed(2) + '</span></p>';

        component += '<div class="ui horizontal divider">Meat And Fish Selection</div>';

        component += '<p><span><strong>Meat / Fish: </strong></span><span>' + value.meatDetails.name + '</span></p>';
        component += '<p><span><strong>Cost: $</strong></span><span>' + parseFloat(value.meatDetails.cost).toFixed(2) + '</span></p>';

        component += '<p class="text-right"><span><strong>Total: </strong></span><span>' + parseFloat((value.foodDetails.cost * value.quantity) + value.sideOneDetails.cost + value.sideTwoDetails.cost + value.meatDetails.cost).toFixed(2) + '</span></p>';
        component += '<p class="nf-remove-cart-item" data-attribute = '+ value.orderId +'><a class="uk-link-muted delete-item" href="#">Remove Item</a></p>'

        component += '</div>';

        _self._cartContainer.append(component);

    });

    var cartEngine = new NfCart();
};
