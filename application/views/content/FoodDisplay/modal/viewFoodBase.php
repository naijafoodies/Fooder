<div class="container-fluid" id="pageContent">

<!-- Start of food base view -->

<div class="col-sm-12 text-center center-block" style="margin-top:20px;">
  <div class="card text-center">

    <!-- Start of card header -->

    <div class="card-header">
      <div class="ui-widget ui fluid icon input">
        <input type="text" placeholder="Search..." id="nfMenuSearch" value = "<?php echo $keyword; ?>" onkeyup="searchInventory(event)">
        <i style="cursor: pointer;" class="search icon" id="searchButton" onclick="return updateMenu()"></i>
      </div>
    </div>

    <!-- End of card header -->

    <!-- Start of card display -->

    <div class="card-block text-center">
      <div class="ui stackable four column cards grid">

      <!-- Start of food display loop -->

      <?php foreach($allFoodDetails as $menuList) { ?>

          <div class="card">

          <!--Start of image presentation -->

            <div class="blurring dimmable image" onclick="return addItem('<?php echo $menuList['FoodId']; ?>');" style="cursor: pointer;">
              <div class="ui dimmer">
                <div class="content">
                  <div class="center">
                    <div class="ui inverted button" onclick="return addItem('<?php echo $menuList['FoodId']; ?>');">Add To Cart</div>
                  </div>
                </div>
              </div>
              <img class="img-thumbnail" width="100%"  src = "<?php echo base_url(); ?>assets/uploads/menu/<?php echo $menuList['DisplayImage']; ?>" />
            </div>

            <!-- End of Image presentation -->

            <!-- Start of details presentation -->

            <div class="content">
              <a class="header"><?php echo $menuList['FoodName']; ?></a>
              <div class="meta">
                <span class="date"><?php echo $menuList['Description']; ?></span>
              </div>
            </div>

            <!-- End of Details Presentation -->

            <!-- Start of price presentation -->

            <div class="extra content">
              <a>
                $<?php echo number_format($menuList['Regular'],2);?>
                <div class="ui star rating" data-rating="4"></div>
              </a>
            </div>

            <!-- End of price presentation -->

          </div>

        <!-- End of food display loop -->

        <?php } ?>

        <?php if(!$allFoodDetails) { ?>

          <p class="text-center">Sorry! We could not find any item with the name you have specified. </p>


        <?php } ?>

        </div>
  </div>

  <!-- End of card Display -->

  </div>

</div>

</div>



<script>

</script>

<script>

  function addItem(foodId)
  {
    $('#largeModalBody').html('');
    $('#largeModalBody').load('<?php echo base_url() ?>CartManagement/viewAddToCart?foodId='+foodId);
    $('#largeModal').modal('show');
  }

  function searchInventory(event)
  {

    var keyword = $('#nfMenuSearch').val();

    if(keyword != '')
    {
      if(event.keyCode == 13)
      {
        updateMenu();
      }
      else
      {

          var literal = [];

          $.post('<?php echo base_url(); ?>FoodDisplay/grabLikelyMenu',
          {
            keyword:keyword
          },function(response)
          {
            var data = JSON.parse(response);

            for(var counter = 0; counter < data.length; counter++)
            {
              literal.push(data[counter].FoodName);
            }

            $('#nfMenuSearch').autocomplete(
            {
              position: { my: "right top", at: "right bottom", collision : "none"},
              source:literal,
              select:function(event,ui)
              {
                updateFromJquery(ui.item.label);
              }
            });

          });

      }

    }
  }




</script>
