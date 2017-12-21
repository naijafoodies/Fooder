<!-- Start of button groups -->

<div style="padding: 2em;">
  <div class="ui mini animated green button" tabindex="0" onclick="return addFood()">
    <div class="visible content">Add New Addon</div>
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
      <th>Addon Name</th>
      <th>Addon Cost</th>
      <th>Vendor</th>
      <th>Status</th>
    </tr>
  </thead>

  <!-- End of table header -->

  <!-- Start of table body -->

  <tbody>

    <?php foreach($addons AS $addon) { ?>

      <tr>

        <td>
          <div class="ui small basic icon buttons">
            <button class="ui button" onclick="return editFoodInventory('<?php echo $addon['AddonId']?>')"><i class="write icon"></i></button>
            <button class="ui button" onclick="return deleteFoodInventory('<?php echo $addon['AddonId']?>')"><i class="trash outline icon"></i></button>
          </div>
        </td>

        <td><?php echo $addon['AddonName']; ?></td>
        <td>$<?php echo number_format($addon['Price'],2); ?></td>
        <td><?php echo ($addon['ClientName']) ? $addon['ClientName'] : 'N/A' ; ?>
        <td><?php echo ($addon['IsAvailable'] == 0) ? 'Available' : 'Not Available'; ?></td>

      </tr>


    <?php } ?>

    <?php if(!$addons) { ?>

      <tr>
        <td colspan="7" style="color: red;" class="text-center">There is not addon item in inventory.</td>
      </tr>

    <?php } ?>
    
  </tbody>

  <!-- End of table body -->
  
 
</table>


<!-- scripts -->

<script>

function editFoodInventory(addonId)
{
    $('#largeModalBody').html('');
    $('#largeModalBody').load('<?php echo base_url() ?>AdminManagement/viewEditAddon?addonId='+addonId);
    $('#largeModal').modal('show');
}

function deleteFoodInventory(addonId)
{
    $('#questionModalBody').html('');
    $('#questionModalBody').load('<?php echo base_url() ?>AdminManagement/verifyDeleteAddon?addonId='+addonId);
    $('#questionModal').modal('show');
}

function addFood()
{
    $('#largeModalBody').html('');
    $('#largeModalBody').load('<?php echo base_url() ?>AdminManagement/viewAddAddon');
    $('#largeModal').modal('show');
}

</script>

<!-- End of scripts -->