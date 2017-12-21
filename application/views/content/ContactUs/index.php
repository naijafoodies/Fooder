
<!-- Start of contact us page -->

<div class="container-fluid row center-block" style="margin-top: 2em;">

      <h2 class="ui center aligned icon header">
        <i class="address card icon"></i>
        Contact Us
      </h2>

  
  <div class="col-sm-12">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3065.2014201405036!2d-86.15209968511776!3d39.80247350069184!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x886b511986501bf7%3A0xd4e70033b84d0fa7!2s2442+Central+Ave%2C+Indianapolis%2C+IN+46205!5e0!3m2!1sen!2sus!4v1493867663798" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
  </div>


</div>

  <!-- End ofcontact us page -->

  <!-- Start of contact information and form field -->

  <div class="container-fluid row" style="margin-top: 1em;">

    <div class="col-sm-4 center-block">

      <div class="card w-75 text-center">

        <div class="card-header">
          Contact Information
        </div>

        <div class="card-block">

          <div class="ui list">

            <div class="item">
              <i class="mail icon"></i> 
              <div class="content">
                <a href="mailto:jack@semantic-ui.com">naijafoodies@gmail.com</a>
              </div>
            </div>

            <div class="item">
              <i class="marker icon"></i>
              <div class="content">
                2442 Central Ave, Indianapolis, IN 46205
              </div>
            </div>

            <div class="item">
              <i class="phone icon"></i>
              <div class="content">
                (317) 883 7205
              </div>
            </div>

        </div>
          
        </div>

      </div>

    </div>


    <div class="col-sm-4 col-xs-12">

    </div>

    <div class="col-sm-4 col-xs-12">

      <div class="card w-75 text-center">

        <div class="card-header">
          Customer Service
        </div>

        <div class="card-block">

          <form class="ui form">

            <div class="form-group">
              <div>
                <input type="text" class="form-control requiredInput" name = "name" id="name" placeholder="Full Name">
              </div>
            </div>

            <div class="form-group">
                <div>
                  <input type="text" class="form-control requiredInput" name = "email" id="email" placeholder="Email Address">
                </div>
           </div>      

          <div class="form-group">
              <div>
                <textarea class="form-control requiredInput" rows="3"  name="comments" id="comments" placeholder="Your Comments"></textarea>
              </div>
          </div>                  

          </form>

          
        </div>

        <div class="card-footer">
          <div class="ui animated green button" tabindex="0" onclick="return submitContactUs()">
            <div class="visible content">Submit </div>
            <div class="hidden content">
              <i class="right arrow icon"></i>
            </div>
          </div>          
        </div>

    </div>

  </div>


</div>



  <!-- Start of contact information and form field -->



<!-- End of contact us page -->




</div>

<script>

function submitContactUs()
{
  var valid = true;

    $('.requiredInput').each(function(){

      $(this).parent().removeClass('field error');

      if($(this).val() == ''){
        valid = false;
        $(this).parent().addClass('field error');
      }
    });

        if(valid){

      var name = $('input[name="name"]').val();
      var email = $('input[name = "email"]').val();
      var comments = $('#comments').val();

      $('.submit').text('Sending...');

        $.post('<?php echo base_url();?>ContactUs/submitComments', {
          name:name,
          email:email,
          comments:comments
        },function(response)
        {
          $('#name').val('');
          $('#email').val('');
          $('#comments').val('');

              UIkit.notification({
              message: 'Your message has been sent. A Customer service representative will contact you soon',
              status: 'success',
              pos: 'top-right',
              timeout: 5000
          });
        });

    }

}


</script>
