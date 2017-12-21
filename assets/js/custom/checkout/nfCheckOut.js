$(function() {

    // Initialize global variaBLES

    var checkOutInstance = new CheckoutDataPoint();
    var couponInstance = new NfCoupon();

    var itemsHandler = $('#total-items-description');
    var cityHandle = $('#inputShippingCity');

    // initialize dropdown

    cityHandle.dropdown();

    // get customer discount code

    checkOutInstance.getCustomerDiscountCode();
    checkOutInstance.getDeliveryLocations();

    $.when.apply($,checkoutDeferred).then(function() {

        // set coupon instance

        couponInstance.setCouponCost(checkOutInstance._discountCode);

        var setShippingCities = (function() {

            $.each(checkOutInstance._deliveryLocations,function(key,value) {

                cityHandle.append('<option value ='+value.id+'>'+value.city+'</option>');

            });

        })();

        // get instance of the cart

        var cart = new CartDataPoint();

        $.when.apply($,cartDeferred).then(function() {

            if(!cart._cartList.length) {

                location.assign(NfEnvironment.getServerEnvironment() + 'menu');
            }

            itemsHandler.html(cart._cartList.length);

            var orderSummary = new OrderSummary(cart.getTotalCost());

            orderSummary._discount = couponInstance.couponCost;

            orderSummary.showOrderSummary();

            // hide loader

            $('#checkOutLoader').hide();

            ///// Event handler for cost

            cityHandle.on('change',function() {

                if(this.value) {

                    orderSummary._shippingCost = checkOutInstance.getShippingCost(parseInt(this.value));

                    orderSummary.showOrderSummary();
                }
            });

        });

    });

    var stripeInstance = new StripeCheckout();

    stripeInstance.mountCard();

    var form = document.getElementById('payment-form');

    form.addEventListener('submit',function (event) {

        event.preventDefault();

        stripeInstance.submitForm();

    });
});
