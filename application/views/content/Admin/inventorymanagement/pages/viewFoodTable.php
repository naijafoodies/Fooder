<!-- Start of button groups -->

<div style="padding: 2em;">
  <div class="ui mini animated green button" tabindex="0" onclick="return addFood()">
    <div class="visible content">Add New Food</div>
    <div class="hidden content">
      <i class="right arrow icon"></i>
    </div>
  </div>
</div>

<!-- End of button groups -->
<div class="clearfix"></div>

<table class="table table-hover table-bordered display" cellspacing="0" width="100%" id="nfTables" style="margin-top: 1em;">

  <!--  Start of table header -->

  <thead>
    <tr>
      <th>Actions</th>
      <th>Food Name</th>
      <th>Regular Price</th>
      <th>Half Tray Price</th>
      <th>Full Tray Price</th>
      <th>Description</th>
      <th>Vendor</th>
      <th>Food Category</th>
      <th>Food Status</th>
    </tr>
  </thead>

  <!-- End of table header -->

  <!-- Start of table body -->

  <tbody>

    <?php foreach($foodDetails AS $food) { ?>

      <tr>

        <td>
          <div class="ui small basic icon buttons">
            <button class="ui button" onclick="return editFoodInventory('<?php echo $food['FoodId']?>')"><i class="write icon"></i></button>
            <button class="ui button" onclick="return deleteFoodInventory('<?php echo $food['FoodId']?>')"><i class="trash outline icon"></i></button>
          </div>
        </td>

        <td><?php echo $food['FoodName']; ?></td>
        <td>$<?php echo number_format($food['Regular'],2); ?></td>
        <td>$<?php echo number_format($food['HalfTray'],2); ?></td>
        <td>$<?php echo number_format($food['FullTray'],2); ?></td>
        <td><?php echo $food['Description']; ?></td>
        <td><?php echo ($food['ClientName']) ? $food['ClientName'] : 'N/A' ; ?>
        <td><?php echo ($food['CategoryName'])?$food['CategoryName'] : 'N/A'; ?></td>
        <td><?php echo ($food['IsAvailable'] == 0) ? 'Available' : 'Not Available'; ?></td>

      </tr>


    <?php } ?>

    <?php if(!$foodDetails) { ?>

      <tr>
        <td colspan="7" style="color: red;" class="text-center">There is not food item in inventory.</td>
      </tr>

    <?php } ?>
    
  </tbody>

  <!-- End of table body -->
  
 
</table>


<!-- scripts -->

<script>

function editFoodInventory(foodId)
{
    $('#largeModalBody').html('');
    $('#largeModalBody').load('<?php echo base_url() ?>AdminManagement/viewEditFood?foodId='+foodId);
    $('#largeModal').modal('show');
}

function deleteFoodInventory(foodId)
{
    $('#questionModalBody').html('');
    $('#questionModalBody').load('<?php echo base_url() ?>AdminManagement/showVerifyFood?foodId='+foodId);
    $('#questionModal').modal('show');
}

function addFood()
{
    $('#largeModalBody').html('');
    $('#largeModalBody').load('<?php echo base_url() ?>AdminManagement/viewAddFood');
    $('#largeModal').modal('show');
}

</script>

<!-- End of scripts -->