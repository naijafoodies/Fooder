<!--This is the entry point of the application -->
<!--Start of page content -->
<div class="container-fluid">
  <div id="page-content">

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">

        <?php foreach($allFoodDetails AS $key=>$menu){ ?>

          <li data-target='#carouselExampleIndicators' data-slide-to='<?php echo $key;?>' class='<?php echo ($key == 0) ? 'active' : '';?>'>

        <?php } ?>

      </ol>

      <div class="carousel-inner" role="listbox" style="height:100%;">

        <?php foreach($allFoodDetails AS $key=>$menuImages) { ?>

          <div class="carousel-item <?php echo ($key == 0) ? 'active':''; ?>">
            <img class="d-block img-fluid" src="<?php echo base_url(); ?>images/menu/<?php echo $menuImages['DisplayImage']; ?>.jpg" alt="Menu" width="100%" height="100px;">
            <div class="carousel-caption d-none d-md-block">
              <h3><?php echo $menuImages['FoodName']; ?></h3>
              <p>$<?php echo $menuImages['Price']; ?></p>

              <div class="large ui green animated button" tabindex="0" onclick="location.assign('<?php echo base_url(); ?>FoodDisplay/viewMenu')">
                <div class="visible content">Menu</div>
                <div class="hidden content">
                  <i class="right arrow icon"></i>
                </div>
              </div>

            </div>
          </div>

        <?php } ?>

      </div>

      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>

    </div>

  </div>


<!--End of page content -->
