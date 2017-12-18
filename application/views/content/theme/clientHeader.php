<nav class="navbar navbar-inverse bg-inverse navbar-toggleable-md navbar-light" style="background-color: #e3f2fd;">

  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <a class="navbar-brand" href="#">
    <img src="<?php echo base_url(); ?>images/logo/headerlogo.png" width="30" height="30" alt="">
  </a>

  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav mr-auto">

      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>

    </ul>

        <span class="navbar-text">
          <div class="ui mini menu">
            <div class="ui simple dropdown item">
              Hello
              <?php echo $userData['Username']; ?>
              <i class="dropdown icon"></i>
              
              <div class="menu">
                <div class="item">Profile</div>
                <div class="item">Account</div>
                <div class="item">Logout</div>
              </div>
            </div>
          </div>
        </span>

        </span>

  </div>
</nav>