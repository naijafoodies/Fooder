<nav class="navbar navbar-inverse bg-inverse navbar-toggleable-md navbar-light bg-faded">

  <!--  Start of mobile toggle button -->

  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- End of mobile toggle button -->

  <!-- Start of brand icon -->

  <a class="navbar-brand" href="#">
    <img src="<?php echo base_url(); ?>images/logo/headerlogo.png" width="30" height="30" alt="">
  </a>

  <!-- End of brand icon -->

  <!-- Start of navigation links -->

  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav mr-auto">

      <!-- Start of home button link -->

      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url(); ?>AdminManagement">Home <span class="sr-only">(current)</span></a>
      </li>

      <!-- End of home button link -->

      <!-- Start of order management link -->

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Reports
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="">Order Status</a>
          <a class="dropdown-item" href="<?php echo base_url(); ?>AdminManagement/viewReports">Order Report</a>
        </div>
      </li>

      <!-- Start of finance module link -->

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Invoices
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="">Sales Invoice</a>
          <a class="dropdown-item" href="#">Location Analytics</a>
          <a class="dropdown-item" href="">Vendor Analytics</a>
          <a class="dropdown-item" href="">Predictive Analytics</a>
        </div>
      </li>


      <!-- End of finance module link -->

      <!-- Start of inventory control button -->

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Inventory Control
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="<?php echo base_url();?>AdminManagement/viewFoodInventory">Manage Food</a>
          <a class="dropdown-item" href="<?php echo base_url(); ?>AdminManagement/viewAddon">Manage Addon</a>
          <a class="dropdown-item" href="<?php echo base_url(); ?>AdminManagement/viewDelivery">Manage Delivery</a>
          <a class="dropdown-item" href="<?php echo base_url(); ?>AdminManagement/viewMeatInventory">Manage Meat</a>
        </div>
      </li>

      <!-- End of inventory control button -->

    </ul>

        <span class="navbar-text">

        <!-- Start of User information and controls -->

        <div class="uk-inline" style="color: black !important;">
          <a class="ui image label">
            <i class="angle down icon"></i>
            Hello <?php echo ($userData['Username']) ? $userData['Username']: ''; ?>
          </a>

          <div uk-dropdown="pos: bottom-center">
              <ul class="uk-nav uk-dropdown-nav">

                  <li class="uk-active"><a href="#">Profile</a></li>
                  <li><a href="#">Account</a></li>
                  <li><a href="<?php echo base_url(); ?>AdminManagement/logout">Logout</a></li>

              </ul>
          </div>

        </div>

        <!-- End of user information and controls -->

      </span>

  </div>
</nav>
