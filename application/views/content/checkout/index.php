<!DOCTYPE html>
<html>
<head>

    <title>Naija Foodies Checkout</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="google-site-verification" content="qCmPSJiDMcsJ4hCYYgrWxiF4V7gEYU5FAp5YwgOjq3g" />
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>images/logo/favicon.ico">

    <meta name="keywords" content="Food,Nigerian American Food,Carribean Meal,Africa,Morsel meal,Food Delivery,Business in Indiana">
    <meta name="author" content="Olusegun Akinyelure">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- Start of semantic ui style -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/semantic-ui/2.2.10/semantic.min.css">

    <!-- Material Icons -->

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/lib/owl.carousel.min.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/lib/owl.theme.green.min.css">


    <!-- Jquery Search theme -->

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/lib/EasyAutocomplete-1.3.5/easy-autocomplete.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/lib/EasyAutocomplete-1.3.5/easy-autocomplete.themes.css">


    <!-- End of search theme -->

    <!-- Start of carousel theme -->

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/lib/flexslider/flexslider.css" />

    <!-- End of carousel theme -->

    <!-- Start of search theme -->

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/headerwithsearch/nav-searcher.css" />

    <!-- End of search theme -->

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom/homepage.css" />

    <!-- W3c css -->

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom/cart.css" />

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom/checkout.css">


    <!-- window image -->

    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>images/logo/favicon.ico">

</head>

<body>

  <div class="page-content">

    <div class="ui active inverted dimmer" id="checkOutLoader">
      <div class="ui text loader" id = "checkOutLoaderText" style="color : green;">Wait while we prepare your order for checkout. If this process takes longer than 3 seconds, please refresh the page</div>
    </div>


    <!-- Start of navigation bar NOTE: Page Uses Bootstrap 4.0.0-alpha.6 -->

    <div class="upper-body fixed-top">

        <nav class="navbar navbar-toggleable-md navbar-light" style="background-color: rgba(242,253,239,0);">

            <a href="/">
                <img class="brand" src="<?php echo base_url(); ?>images/logo/headerlogo1.png" alt="Naija Foodies" width="100" height="50"/>
            </a>

            <!-- Start of toggler button -->

            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- End of toggler button -->

            <!-- Start of nav items -->

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav mr-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>">Home <span class="sr-only">(current)</span></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>menu">Menu</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/about">About Us</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/contact">Contact Us</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/catering">Catering Services</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/how">How It Works</a>
                    </li>

                </ul>

                <form class="form-inline my-2 my-lg-0" id="cart-area">

                    <div class="mr-sm-2">
                        <i class="material-icons dp48">shopping_cart</i>
                    </div>

                    <div class="mr-sm-2">
                        <a href="#" class="badge badge-danger" id="nf-cart-counter"></a>
                    </div>

                </form>

            </div>

            <!-- End of nav items-->
        </nav>

        <!-- Start of searcg box -->

        <div class="container-fluid">
            <div class="row">

                <div class = "col-sm-3"></div>


                <div class="col-sm-6">

                    <input type="text" class="form-control"  id="nf-searchalize-protected" placeholder="Search ..." aria-label="Search Menu">

                </div>
                <div class="col-sm-3">

                </div>
            </div>
        </div>

    </div>

    <!-- End of navigation -->

    <!-- End of navigation -->

    <!-- Start of content -->

    <div class="container-fluid" id="content-grid">

        <div class="row">

            <div class="col-sm-6">
                <div class="ui tall stacked segment">

                    <h4 class="ui header">Checkout Summary</h4>

                        <li class="list-group-item"><span id="total-items"><strong>Total Items: </strong></span><span id="total-items-description"></span></li>
                        <li class="list-group-item"><span id="total-title"><strong>Total Cost: $</strong></span><span id="total-description"></span></li>
                        <li class="list-group-item"><span id="discount-title"><strong>Discount: $</strong></span><span id="total-discount"></span></li>
                        <li class="list-group-item"><span id="tax-title"><strong>Tax: $</strong></span><span id="tax-description"></span></li>
                        <li class="list-group-item"><span id="shipping-cost-title"><strong>Shipping Cost: $</strong></span><span id="shipping-cost"></span><span style="color: green; font-size: 10px;">&nbsp;Shipping cost will be calculated after you have entered your shipping address</span></li>
                        <li class="list-group-item list-group-item-success text-right"><span id="total-title"><strong>Gross Total</strong>: $</span><span id="gross-total-description"></span></li>

                </div>

            </div>

            <div class="col-sm-6">
                <div class="ui tall stacked segment" id="form-handle">

                    <h4 class="ui header">Billing</h4>


                    <form method="post" id="payment-form">

                        <div class="form-row">

                            <label for="card-element">
                                Enter Billing Information
                            </label>

                            <div class="ui form">

                                <div class="fields">

                                    <div class="field">
                                        <label>First name</label>
                                        <input type="text" class="requiredInput" placeholder="First Name" name="inputFirstName" id="inputFirstName">
                                    </div>

                                    <div class="field">
                                        <label>Last name</label>
                                        <input type="text" class="requiredInput" placeholder="Last Name" name="inputLastName" id="inputLastName">
                                    </div>

                                </div>
                            </div>


                            <div class="ui form">
                                <div class="field">
                                    <label>Billing Address</label>
                                    <input type="text" class="requiredInput" placeholder="Address 1" name="inputBillingAddress" id="inputBillingAddress">
                                </div>
                            </div>

                            <div class="ui form">

                                <div class="fields">

                                    <div class="field">
                                        <label>City</label>
                                        <input type="text" class="requiredInput" placeholder="City" id="inputCity" name="inputCity">
                                    </div>

                                    <div class="field">
                                        <label>State</label>
                                        <input type="text" class="requiredInput" placeholder="State" id="inputState" name="inputState">
                                    </div>

                                    <div class="field">
                                        <label>Zip Code</label>
                                        <input type="text" class="requiredInput" placeholder="Zip Code" name="inputZipCode" id="inputZipCode">
                                    </div>

                                </div>
                            </div>

                            <div class="field">
                                <label class="stripe-label">Card Details</label>
                                <div id="card-element" class="stripe-spacer requiredInput">
                                    <!-- a Stripe Element will be inserted here. -->
                                </div>
                            </div>


                            <!-- Used to display Element errors -->
                            <div id="card-errors" role="alert"></div>

                        </div>

                        <div class="ui horizontal divider">
                            Shipping Information
                        </div>

                        <div class="ui form">
                            <div class="field">
                                <label>Email Address</label>
                                <input type="email" class="requiredInput" placeholder="Email Address" name="inputEmailAddress" id="inputEmailAddress">
                            </div>
                        </div>

                        <div class="ui form">
                            <div class="field">
                                <label>Shipping Address</label>
                                <input type="text" class="requiredInput" placeholder="Address 1" name="inputShippingAddress" id="inputShippingAddress">
                            </div>
                        </div>

                        <div class="ui form">

                            <div class="fields">

                                <div class="field">
                                    <label>City</label>
                                    <select class="ui fluid dropdown requiredInput" id="inputShippingCity" name="inputShippingCity">
                                        <option value="">Select State</option>
                                    </select>
                                </div>

                                <div class="field">
                                    <label>State</label>
                                    <input type="text" class="requiredInput" value="Indiana" placeholder="State" id="inputShippingState" name="inputShippingState" disabled>
                                </div>

                                <div class="field">
                                    <label>Zip Code</label>
                                    <input type="text" class="requiredInput" placeholder="Zip Code" name="inputShippingZipCode" id="inputShippingZipCode">
                                </div>

                            </div>

                            <span style="color: red">* We only deliver to select cities</span>
                        </div>


                        <br/>
                        <div class="stripe-section">
                            <button type="submit" class="btn btn-outline-success pull-left ladda-button" id= "checkOutButton" data-style="contract-overlay">Make Payment</button>
                            <span class="pull-right stripe-promotion">Powered by stripe</span>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>


  </div>

<!-- End of content -->

<!-- Start of script here -->

<!-- jQuery first, then Popper.js, then Bootstrap JS -->

<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

<!-- Start of semantic js -->

<script src="https://cdn.jsdelivr.net/semantic-ui/2.2.10/semantic.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

<script src="https://js.stripe.com/v3/"></script>

<script src="<?php echo base_url(); ?>assets/js/lib/flexslider/jquery.flexslider-min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/lib/owl.carousel.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/lib/EasyAutocomplete-1.3.5/jquery.easy-autocomplete.js"></script>

<script src="<?php echo base_url(); ?>assets/js/headerwithsearch/nfCart.js"></script>


<script src="<?php echo base_url(); ?>assets/js/custom/cart/nf-coupon.js"></script>

<script src="<?php echo base_url(); ?>assets/js/custom/cart/orderSummary.js"></script>

<script src="<?php echo base_url(); ?>assets/js/custom/cart/cartDataPoint.js"></script>

<script src="<?php echo base_url(); ?>assets/js/custom/checkout/checkoutDataPoint.js"></script>


<script src="<?php echo base_url(); ?>assets/js/custom/checkout/nf-stripe-checkout.js"></script>

<script src="<?php echo base_url(); ?>assets/js/custom/checkout/nfCheckOut.js"></script>


<script src="<?php echo base_url(); ?>assets/js/custom/system.js"></script>

<script src="<?php echo base_url(); ?>assets/js/headerwithsearch/nav-DataPoint.js"></script>
<script src="<?php echo base_url(); ?>assets/js/headerwithsearch/nav-searcher.js"></script>


</body>

</html>
