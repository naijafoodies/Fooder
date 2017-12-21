<!DOCTYPE html>
<html>
<head>

    <title>Naija Foodies Describe</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="google-site-verification" content="qCmPSJiDMcsJ4hCYYgrWxiF4V7gEYU5FAp5YwgOjq3g" />
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>images/logo/favicon.ico">

    <meta name="keywords" content="Food,Nigerian American Food,Carribean Meal,Africa,Morsel meal,Food Delivery,Business in Indiana">
    <meta name="author" content="Olusegun Akinyelure">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

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

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom/describe.css" />

    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.35/css/uikit.min.css" />


    <!-- W3c css -->

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">



    <!-- window image -->

    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>images/logo/favicon.ico">

</head>

<body>


<!-- Start of navigation bar -->

<div class="upper-body fixed-top">

    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: rgba(242,253,239,0);">

        <a href="/">
            <img class="brand" src="<?php echo base_url(); ?>images/logo/headerlogo1.png" alt="Naija Foodies" width="100" height="50"/>
        </a>

        <!-- Start of toggler button -->

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- End of toggler button -->

        <!-- Start of nav items -->

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">

            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

                <li class="nav-item active">
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

    <!-- Start of search fields -->

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

    <!-- End of search fields -->

</div>

<!-- End of navigation -->

<!-- End of navigation -->


<div class="container-fluid container-content" id="main-data-element" data-plugin="<?php echo $menuId; ?>">

    <div class="row">

        <!---------------------- Start of Menu Detail ------------------------->

        <div class="col-sm-5">

            <!-- Start of food details card -->

            <div class="w3-card-4" id="describe-food-card">

                <header class="w3-container" id="describe-food-header">

                </header>

                <img src="" alt="NaijaFoodies" id="describe-food-image" class="text-center center-block align-center describe-images">

                <div class="w3-container w3-center" id="describe-content">


                </div>
            </div>

        </div>

            <!----------------End of menu Details ------------------>

        <!----------------- Start of Addons Selection ------------------>

        <div class="col-sm-4 text-center align-content-center" id="describe-options">

            <div class="card">

                <div class="card-header">
                    Add Options
                </div>

                <ul class="list-group list-group-flush">

                    <form id="nf-cart-form">

                        <input type="hidden" value="<?php echo $menuId; ?>" name="inputFoodId"/>

                        <!-- Start of form side One select box -->

                        <li class="list-group-item">

                            <div class="two fields">
                                <div class="field">
                                    <label>Select Side 1 : </label>
                                    <select class="ui fluid dropdown" id="describe-side-1" name="inputSideOneId">
                                        <option value="-1">None</option>
                                    </select>

                                </div>
                            </div>

                        </li>

                        <!-- End of side One select box -->

                        <!-- Start of side One Select box -->

                        <li class="list-group-item">
                            <div class="two fields">
                                <div class="field">
                                    <label>Select Side 2 : </label>
                                    <select class="ui fluid dropdown" id="describe-side-2" name="inputSideTwoId">
                                        <option value="-1">None</option>
                                    </select>

                                </div>
                            </div>
                        </li>

                        <!-- End of Side Two select Box -->

                        <!-- Start of Meat and Fish selection -->

                        <li class="list-group-item">

                            <div class="two fields">
                                <div class="field">
                                    <label>Meat or Fish Choice : </label>
                                    <select class="ui fluid dropdown" id="describe-meat-fish" name="inputMeatAndFishId">
                                        <option value="-1">None</option>
                                    </select>
                                </div>
                            </div>

                        </li>

                        <!-- End of meat and fish selection -->

                        <!-- Start of quantity input field -->

                        <li class="list-group-item">

                            <div class="ui form">
                                    <div class="wide field">
                                        <label>Quantity</label>
                                        <input type="number" id="quantity" value="1" min="1" max="300" placeholder="Quantity" name="inputQuantity" required>
                                    </div>
                            </div>

                        </li>

                        <!-- End of quantity input field -->

                    </form>

                </ul>

                <!-- start of button -->

                <div class="extra content">
                    <div class="ui two buttons">
                        <div class="ui basic green button" id="nf-add-to-cart-button">Add To Cart</div>
                        <div class="ui basic red button">Go To Menu</div>
                    </div>
                </div>

            </div>


        </div>


        <div class="col-sm-3 text-align-left" id="describe-other-menu">

            <div class="card">

                <div class="card-header">
                    Order Summary
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><span class="list-title">Food Cost : </span><span id="foodCost">0.00</span></li>
                    <li class="list-group-item"><span class="list-title">Side 1: </span><span id="firstSideCost">0.00</span></li>
                    <li class="list-group-item"><span class="list-title">Side 2: </span><span id="secondSideCost">0.00</span></li>
                    <li class="list-group-item"><span class="list-title">Meat : </span><span id="meatOrFishCost">0.00</span></li>
                    <li class="list-group-item list-group-item-secondary text-center"><span class="list-title">Total : $</span><span id="total">0.000</span></li>

                </ul>


            </div>


        </div>


        </div>


    </div>

</div>

<div class="ui horizontal divider">We also recommend these items</div>


<div class="container-fluid row">

    <div class="col-sm-12">
        <div class="owl-carousel owl-theme" id="describe-category-menu">

        </div>

    </div>
</div>





<!-- End of content -->



<!-- Start of script here -->

<!-- jQuery first, then Popper.js, then Bootstrap JS -->

<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

<!-- Start of semantic js -->

<script src="https://cdn.jsdelivr.net/semantic-ui/2.2.10/semantic.min.js"></script>

<!-- UIkit JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.35/js/uikit.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.35/js/uikit-icons.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

<script src="<?php echo base_url(); ?>assets/js/lib/flexslider/jquery.flexslider-min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/lib/owl.carousel.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/lib/EasyAutocomplete-1.3.5/jquery.easy-autocomplete.js"></script>


<script src="<?php echo base_url(); ?>assets/js/custom/system.js"></script>
<script src="<?php echo base_url(); ?>assets/js/headerwithsearch/nfCart.js"></script>

<script src="<?php echo base_url(); ?>assets/js/custom/describe/describeDataPoint.js"></script>

<script src="<?php echo base_url(); ?>assets/js/custom/describe/describeSides.js"></script>
<script src="<?php echo base_url(); ?>assets/js/custom/describe/describeMeat.js"></script>
<script src="<?php echo base_url(); ?>assets/js/custom/describe/describeSameCategory.js"></script>
<script src="<?php echo base_url(); ?>assets/js/custom/describe/describeSummary.js"></script>

<script src="<?php echo base_url(); ?>assets/js/custom/describe/describe.js"></script>

<script src="<?php echo base_url(); ?>assets/js/headerwithsearch/nav-DataPoint.js"></script>
<script src="<?php echo base_url(); ?>assets/js/headerwithsearch/nav-searcher.js"></script>

</body>

</html>