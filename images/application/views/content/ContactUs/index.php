<div class="panel panel-info">

  <ol class="breadcrumb success" >

    <li><a href="<?php echo base_url(); ?>">Home</a></li>
    <li class="active">Contact Us</li>

  </ol>
  <!--Start of panel header -->

  <div>
    <h1 class="panel-title text-center" style="font-family: 'Macondo', cursive; font-size:30px;">Contact Us</h1>
  </div>

  <div class="panel-body">
      <div class="col-sm-3 pull-left">

          <table class="table" style="border:0 !important">
            <thead>
              <tr style="boder:0 !important">
                <th colspan="2" class="lead">Contact Information</th>
              </tr>
            </thead>

            <tbody>
              <tr style="border:0 !important">
                <td class="text-center" style="border:0 !important"><span class="glyphicon glyphicon-envelope"><span></td>
                <td style="border:0 !important"><strong>naijafoodies@gmail.com<strong></td>
              </tr>

              <tr style="border:0 !important">
                <td class="text-center" style="border:0 !important"><span class="glyphicon glyphicon-map-marker"><span></td>
                <td style="border:0 !important"><strong>2442 Central Ave, Indianapolis, IN 46205<strong></td>
              </tr>

            </tbody>

          </table>
      </div>


      <div class="col-sm-6">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3065.2014201405036!2d-86.15209968511776!3d39.80247350069184!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x886b511986501bf7%3A0xd4e70033b84d0fa7!2s2442+Central+Ave%2C+Indianapolis%2C+IN+46205!5e0!3m2!1sen!2sus!4v1493867663798" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
      </div>

      <div class="col-sm-3 pull-right">
        <table class="table" style="border:0 !important">
          <thead>
              <tr style="boder:0 !important">
                  <th colspan="2" class="lead">Customer Service</th>
              </tr>
          </thead>

          <tbody>

            <tr style="border:0 !important">
              <td class="text-center" style="border:0 !important"><span class="glyphicon glyphicon-user"><span></td>

              <td style="border:0 !important">
                <div class="form-group">
                  <div>
                    <input type="text" class="form-control requiredInput" name = "name" id="name" placeholder="Full Name">
                  </div>
                </div>
              </td>
            </tr>

            <tr style="border:0 !important">
              <td class="text-center" style="border:0 !important"><span class="glyphicon glyphicon-phone"><span></td>

              <td style="border:0 !important">
                <div class="form-group">
                  <div>
                    <input type="text" class="form-control requiredInput" name = "email" id="email" placeholder="Email Address">
                  </div>
                </div>
              </td>
            </tr>

            <tr style="border:0 !important">
              <td class="text-center" style="border:0 !important"><span class="glyphicon glyphicon-pencil"><span></td>

              <td style="border:0 !important">
                <div class="form-group">
                  <div>
                    <textarea class="form-control requiredInput" rows="3"  name="comments" id="comments" placeholder="Your Comments"></textarea>
                  </div>
                </div>
              </td>
            </tr>

            <tr>
              <td colspan="2" style="border:0 !important"><button type="button" class="submit btn btn-success center-block text-center">Submit</button>
            </tr>

          </tbody>
        </table>
        <div class="alert alert-success text-center center-block" role="alert"><i class="glyphicon glyphicon-ok"> </i> Form Submitted Successfully</div>
      </div>

  </div>

</div>

<script>
$(document).ready(function(){
  $('.alert').hide();

  $('.submit').on('click', function(){
    var valid = true;

    $('.requiredInput').each(function(){

      $(this).removeClass('errorField');

      if($(this).val() == ''){
        valid = false;
        $(this).addClass('errorField');
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
        })
        .done(function(data){
          $('.alert').show();
          setTimeout(function(){
            $('.submit').text('Submit');
          }, 2000);

          setTimeout(function(){
            $('.alert').hide();
          }, 2000);

          $('#name').val('');
          $('#email').val('');
          $('#comments').val('');
        })
        .fail(function(){
          $('.alert').removeClass('alert-success');
          $('.alert').addClass('alert-danger');

            $('.alert').show();

          setTimeout(function(){
              $('.alert').hide()
          }, 3000);

          $('.alert').removeClass('alert-danger');
          $('.alert').addClass('alert-success');

        });

    }

  });


});

</script>
