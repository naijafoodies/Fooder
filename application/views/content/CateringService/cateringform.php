
<!--Start of catering service page -->

  <div class="container-fluid row">

  <div class="col-sm-3">

  </div>

  <div class="col-sm-6 text-center center-block">


      <h2 class="ui center aligned icon header">
        <i class="food icon"></i>
        Catering Service
      </h2>

      <div class="card text-center">

        <div class="card-header">
          <p>Please complete the form below and we will contact you with the pricing for your event.</p>
        </div>

        <div class="card-block">

          <form class="ui form">

            <div class="form-group">
              <label for="name" class="col-sm-12 control-label">Full Name</label>
              <div class="col-sm-12">
                <input type="text" class="form-control requiredInput" name = "name" id="name" placeholder="Full Name">
              </div>
            </div>

            <div class="form-group">
              <label for="phone" class="col-sm-12 control-label">Phone Number</label>
              <div class="col-sm-12">
                <input type="tel" class="form-control requiredInput" name = "phone" id="phone" placeholder="Phone Number">
              </div>
            </div>

            <div class="form-group">
              <label for="email" class="col-sm-12 control-label">Email Address</label>
              <div class="col-sm-12">
                <input type="email" class="form-control requiredInput" name="email" id="email" placeholder="Email">
              </div>
            </div>

            <div class="form-group">
              <label for="expectedGuest" class="col-sm-12 control-label">Number Of Expected Guest</label>
              <div class="col-sm-12">
                <input type="number" class="form-control requiredInput"  name="expectedGuest" id="expectedGuest" placeholder="Number of expected Guests">
              </div>
            </div>

            <div class="form-group">
              <label for="foodTrays" class="col-sm-12 control-label">Number of Food Trays</label>
              <div class="col-sm-12">
                <input type="text" class="form-control requiredInput" name="foodTrays" id="foodTrays" placeholder="Number of Food Trays">
              </div>
            </div>

            <div class="form-group">
              <label for="serviceInformation" class="col-sm-12 control-label">Food Description</label>
              <div class="col-sm-12">
                <textarea class="form-control requiredInput" rows="3"  name="serviceInformation" id="serviceInformation" placeholder="Describe the type of food you wish to get quote for"></textarea>
              </div>
            </div>

            <div class="form-group">
              <label for="serviceInformation" class="col-sm-12 control-label">Additional Details</label>
              <div class="col-sm-12">
                <textarea class="form-control requiredInput" rows="3"  name="additionalDetails" id="inputAdditionalDetails" placeholder="Describe the other services you need. Include need for Stewards and other equipment"></textarea>
              </div>
            </div>

            <div class="ui horizontal divider"></div>

            <div class="ui toggle checkbox" id="inputChafferStatus">
              <input type="checkbox" tabindex="0" class="hidden" id="inputChaffers">
              <label>Should we include Chaffers?</label>
            </div>

            <hr class="divider">

            <div class="form-group">
              <label for="deliveryAddress" class="col-sm-12 control-label">Delivery Address</label>
              <div class="col-sm-12">
                <input type="text" class="form-control requiredInput"  name="deliveryAddress" id="deliveryAddress" placeholder="Delivery Address">
              </div>
            </div>

            <div class="form-group">
              <label for="deliveryDate" class="col-sm-12 control-label">Date of Event</label>
              <div class="col-sm-12">
                <input type="date" class="form-control requiredInput"  name="date" id="inputDate" placeholder="Date Of Event">
              </div>
            </div>

      </form>

      </div>

        <div class="card-footer">

          <div class="ui animated green button" tabindex="0" onclick="return submitCateringForm()" id="submitButton">
            <div class="visible content">Submit</div>
            <div class="hidden content">
              <i class="food icon"></i>
            </div>
        </div>

      </div>

  </div>

  </div>

  <div class="col-sm-4">
    
  </div>


</div>

<!--Start of script-->

  <script>

    function submitCateringForm(){
        var validated = true;

          $('.requiredInput').each(function(){

            $(this).parent().removeClass('field error');

              if($(this).val() == '') {

                validated = false;
                
                $(this).parent().addClass('field error');
              }

            });

          if(validated)
          {
            $('#submitButton').hide();

              var name = $('input[name="name"]').val();
              var phone = $('input[name="phone"]').val();
              var email = $('input[name="email"]').val();
              var expectedGuest = $('input[name="expectedGuest"]').val();
              var foodTrays = $('input[name="foodTrays"]').val();
              var description = $('#serviceInformation').val();
              var address = $('input[name="deliveryAddress"]').val();
              var date = $('#inputDate').val();
              var additionalDetails = $('#inputAdditionalDetails').val();
              var chaffers = $('#inputChafferStatus');

              if(chaffers.hasClass('checked'))
              {
                var needChaffer = "Yes";
              }
              else
              {
                var needChaffer = "NO";
              }

              $.post("<?php echo base_url() ?>CateringService/submitCateringRequest", {
                requestName:name,
                requestPhone:phone,
                requestEmail:email,
                requestexpectedGuest:expectedGuest,
                requestFoodTrays:foodTrays,
                requestDescription:description,
                requestAddress:address,
                requestDate:date,
                additionalDetails:additionalDetails,
                chaffers:needChaffer
              }, function(success)
              {
                UIkit.notification({
                message: 'Your catering request have been sent. A customer service representative will contact you soon',
                status: 'success',
                pos: 'top-center',
                timeout: 5000
              });

                setTimeout(function(){ location.assign('<?php echo base_url(); ?>CateringService') }, 5000);
               

              });

          }
    }

  </script>
