<div class="panel panel-info">

  <ol class="breadcrumb success" >

    <li><a href="<?php echo base_url(); ?>">Home</a></li>
    <li class="active">About Us</li>

  </ol>
  <!--Start of panel header -->

  <div>
    <h1 class="panel-title text-center" id="title" style="font-family: 'Macondo', cursive; font-size:30px;">About Us</h1>
  </div>

  <div class="panel-body" style="font-size:22px;">
    <p class="bodyOne" style="display:none;">Naija Foodies, LLC was created in 2017, and is the first ever online African restaurant in Indiana.
      It was created to give our customers an authentic African culinary experience delivered right to the
       convenience of their homes.</p>

    <p class="bodyTwo" style="display:none;">Naijafoodies.com was created in response to a need for a restaurant which would offer a
      variety of African delicacies at an affordable price while being within the reach of interested consumers.
       We have responded adequately to that need and will continue to improve our processes to ensure your complete
       satisfaction every time you order from us. </p>

      <div class="bodyThree" style="display:none;">
        <p>Naija Foodies, LLC is registered with the State’s Department of Health Food Protection services and licensed to deliver
        food to the public. We also have a certified food handler license approved by the State, and prepare all the food on our menu in a State approved/licensed
        commercial kitchen.</p>

        <p>Please contact us to receive more information about our licenses and compliance with the State Food Handling laws.</p>

      </div>



  </div>

  <script>
    $(document).ready(function() {
      $('.bodyOne').fadeIn(1000);
      $('.bodyTwo').slideToggle(1000);
      $('.bodyThree').slideToggle(1000);
    })

  </script>
