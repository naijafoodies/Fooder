
  <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <a href="<?php echo base_url();?>FoodDisplay">
      <img class="brand" src="<?php echo base_url(); ?>images/logo/headerlogo1.png" alt="Naija Foodies" width="120px" height="50px"/>
    </a>

    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav mr-auto">

        <li class="nav-item active">
          <a class="nav-link" href="<?php echo base_url(); ?>FoodDisplay/viewMenu">Menu <span class="sr-only">(current)</span></a>
        </li>

        <li class="nav-item"  onclick="ajaxLoad('page-content','<?php echo base_url(); ?>AboutUs')">
          <a class="nav-link" href="#">About Us</a>
        </li>

        <li class="nav-item" onclick="ajaxLoad('page-content','<?php echo base_url(); ?>CateringService')">
          <a class="nav-link" href="#">Catering Services</a>
        </li>

        <li class="nav-item" onclick="ajaxLoad('page-content','<?php echo base_url(); ?>HowItWorks')">
          <a class="nav-link" href="#">How It Works</a>
        </li>

        <li class="nav-item" onclick="ajaxLoad('page-content','<?php echo base_url(); ?>ContactUs')">
          <a class="nav-link" href="#">Contact Us</a>
        </li>

      </ul>
      <span class="navbar-text" onclick="viewCart();" style="cursor: pointer;">
        <i class="add to cart icon"></i>Cart
        <a class="ui red circular label" id="cartCount"><?php echo count($cartDetails);?></a>
      </span>
    </div>
</nav>

<script>

  function viewCart()
  {
    location.assign('<?php echo base_url(); ?>CartManagement/viewCart')
  }
</script>
