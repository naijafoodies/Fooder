
<!--Start of catering service panel -->

<div class="panel panel-info">

  <ol class="breadcrumb success" >

    <li><a href="<?php echo base_url(); ?>">Home</a></li>
    <li class="active">Catering Service</li>

  </ol>
  <!--Start of panel header -->

  <div>
    <h1 class="panel-title text-center" style="font-family: 'Macondo', cursive; font-size:30px;">Catering Service</h1>
  </div>

  <div class="panel-body">

  <div style="font-family: 'Shadows Into Light', cursive; font-size:20px;">
    <p class="text-center">Thanks for considering Naija Foodies to cater your event! &#9786; We look forward to serving you.</p>
    <p class="text-center">Please complete the form below and we will contact you with the pricing for your event.</p>
  </div>

    <form class="form-horizontal">

      <div class="form-group">
        <label for="name" class="col-sm-2 control-label">Full Name</label>
        <div class="col-sm-10">
          <input type="text" class="form-control requiredInput" name = "name" id="name" placeholder="Full Name">
        </div>
      </div>

      <div class="form-group">
        <label for="phone" class="col-sm-2 control-label">Phone Number</label>
        <div class="col-sm-10">
          <input type="tel" class="form-control requiredInput" name = "phone" id="phone" placeholder="Phone Number">
        </div>
      </div>

      <div class="form-group">
        <label for="email" class="col-sm-2 control-label">Email Address</label>
        <div class="col-sm-10">
          <input type="email" class="form-control requiredInput" name="email" id="email" placeholder="Email">
        </div>
      </div>

      <div class="form-group">
        <label for="expectedGuest" class="col-sm-2 control-label">Number Of Expected Guest</label>
        <div class="col-sm-10">
          <input type="number" class="form-control requiredInput"  name="expectedGuest" id="expectedGuest" placeholder="Number of expected Guests">
        </div>
      </div>

      <div class="form-group">
        <label for="foodTrays" class="col-sm-2 control-label">Number of Food Trays</label>
        <div class="col-sm-10">
          <input type="text" class="form-control requiredInput" name="foodTrays" id="foodTrays" placeholder="Number of Food Trays">
        </div>
      </div>

      <div class="form-group">
        <label for="serviceInformation" class="col-sm-2 control-label">Food Description</label>
        <div class="col-sm-10">
          <textarea class="form-control requiredInput" rows="3"  name="serviceInformation" id="serviceInformation" placeholder="Describe the type of food you wish to get quote for"></textarea>
        </div>
      </div>

      <div class="form-group">
        <label for="deliveryAddress" class="col-sm-2 control-label">Delivery Address</label>
        <div class="col-sm-10">
          <input type="text" class="form-control requiredInput"  name="deliveryAddress" id="deliveryAddress" placeholder="Delivery Address">
        </div>
      </div>

      <div class="form-group">
        <label for="deliveryDate" class="col-sm-2 control-label">Date of Event</label>
        <div class="col-sm-10">
          <input type="date" class="form-control requiredInput"  name="date" id="date" placeholder="Date Of Event">
        </div>
      </div>

</form>
<div class="alert alert-success text-center center-block" role="alert" style="width:300px;"><i class="glyphicon glyphicon-ok"> </i> Form Submitted Successfully</div>
  </div>

  <div class="panel-footer text-center">
    <button type="submit" class="btn btn-success" onclick="return submitCateringForm()">Submit</button>
    <br/>
    <br/>
    <br/>
  </div>


</div>

<!--Start of script-->

<script>
  $(document).ready(function(){
    $('.alert').hide();
  });

</script>

  <script>

    function submitCateringForm(){
        var validated = true;

          $('.requiredInput').each(function(){

            $(this).removeClass('errorField');

              if($(this).val() == '') {

                validated = false;
                
                $(this).addClass('errorField');
              }

            });

          if(validated)
          {
              var name = $('input[name="name"]').val();
              var phone = $('input[name="phone"]').val();
              var email = $('input[name="email"]').val();
              var expectedGuest = $('input[name="expectedGuest"]').val();
              var foodTrays = $('input[name="foodTrays"]').val();
              var description = $('#serviceInformation').val();
              var address = $('input[name="deliveryAddress"]').val();
              var date = $('#date').val();

              $.post("<?php echo base_url() ?>CateringService/submitCateringRequest", {
                requestName:name,
                requestPhone:phone,
                requestEmail:email,
                requestexpectedGuest:expectedGuest,
                requestFoodTrays:foodTrays,
                requestDescription:description,
                requestAddress:address,
                requestDate:date
              }, function(success){

                $('.alert').show();
                setTimeout(function(){
                  ajaxLoad('page-content','<?php echo base_url(); ?>CateringService');
                }, 3000);
              });
              return false;
          }
    }

  </script>
