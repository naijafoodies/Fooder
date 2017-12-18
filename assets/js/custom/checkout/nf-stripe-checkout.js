function StripeCheckout() {

    this._stripe = Stripe('pk_test_kjB1W1t0dlsr0H4qaOqInCm0');
    this._elements = this._stripe.elements();
    this._card = '';

    this._customerFirstName = '';
    this._customerLastName = '';
    this._billingAddress = '';
    this._city = '';
    this._state = '';
    this._zipCode = '';

    // Get Shipping Information

    this._shippingAddress = '';
    this._shippingCity = '';
    this._shippingState = '';
    this._shippingZipCode = '';

    this._emailAddress = '';

    // loader objects

    this._loaderContainer = $('#checkOutLoader');
    this._loaderText = $('#checkOutLoaderText');

    // checkout button

    this._checkOutButton = $('#checkOutButton');

    // Form objects

    this.formHandle = $('#form-handle');

    this._system = NfEnvironment.getServerEnvironment();

    this._cart = new NfCart();
}

StripeCheckout.prototype.mountCard = function() {

    let _self = this;

    let style = {
        base: {
            color: '#32325d',
            lineHeight: '18px',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };

    this._card = this._elements.create('card',{style : style});

    this._card.mount('#card-element');

    this._card.addEventListener('change', function(event) {

        var displayError = document.getElementById('card-errors');

        if (event.error) {
            displayError.textContent = event.error.message;

            _self._checkOutButton.attr("disabled","disabled");

        } else {

            _self._checkOutButton.removeAttr("disabled");
            displayError.textContent = '';
        }
    });

};

StripeCheckout.prototype.submitForm = function() {

    let _self = this;

    if(_self.validateCheckoutForm()) {

      _self._loaderText.text("Please wait while we process your order. This process may take a few seconds");
      _self._loaderContainer.show();

        var tokenData = {

            name : _self._customerFirstName + ' ' + _self._customerLastName,
            address_city : _self._city,
            address_state : _self._state,
            address_line1 : _self._billingAddress,
            address_zip : _self._zipCode
        };

        this._stripe.createToken(this._card,tokenData).then(function(result) {

            if (result.error) {

                // Inform the user if there was an error

                var errorElement = document.getElementById('card-errors');

                errorElement.textContent = result.error.message;

            } else {

                // Send the token to your serve

                _self.pay(result.token);


            }

        });
    }

};

/**
* Function handles the payment on the client side. A token is submitted which is used to determine the payment and do further processing
* This is a post element. It expects an json Object back. This object consist of an ID and message indicating the status of the transaction
* @param stripeToken -> Token used for client side processing
*/

StripeCheckout.prototype.pay = function(stripeToken) {

    let _self = this;

    $.post(_self._system+'CheckOut/payWithStripe',{

        token : stripeToken,
        shippingAddress : _self._shippingAddress,
        shippingCity : _self._shippingCity,
        shippingState : _self._shippingState,
        shippingZipCode : _self._shippingZipCode,
        emailAddress : _self._emailAddress

    },function(response) {

      // convert response into a json object
      var data = JSON.parse(response);

        var successComponent = '';
        successComponent += data.Message

        _self.formHandle.html(successComponent);

    }).done(function() {

      _self._loaderContainer.hide();

      _self._cart.setCartCount();

    }).fail(function() {

    });
};

/**
* TODO calculate arrival date based on the time this order was placed
*/
StripeCheckout.prototype.calculateArrivalDate = function() {

    return new Date();
};

StripeCheckout.prototype.validateCheckoutForm = function() {

    var valid = true;

    let _self = this;

    // make sure all input field are filled

    $.each($('.requiredInput'),function() {

        $(this).parent().removeClass('error');

        if(this.value == '') {

            $(this).parent().addClass('error');

            valid = false;
        }
    });

    if(valid) {

        _self._customerFirstName = $('#inputFirstName').val();
        _self._customerLastName = $('#inputLastName').val();
        _self._city = $('#inputCity').val();
        _self._state = $('#inputState').val();
        _self._billingAddress = $('#inputBillingAddress').val();
        _self._zipCode = $('#inputZipCode').val();

        // get shipping indoemation

        _self._shippingAddress = $('#inputShippingAddress').val();
        _self._shippingCity = $('#inputShippingCity').val();
        _self._shippingState = $('#inputShippingState').val();
        _self._shippingZipCode = $('#inputShippingZipCode').val();
        _self._emailAddress = $('#inputEmailAddress').val();

        return true
    }
    return false;


};
