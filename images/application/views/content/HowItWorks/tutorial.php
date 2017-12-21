<div class="panel panel-info">

  <ol class="breadcrumb success" >

    <li><a href="<?php echo base_url(); ?>">Home</a></li>
    <li class="active">How it works</li>

  </ol>
  <!--Start of panel header -->

  <div>
    <h1 class="panel-title text-center" style="font-family: 'Macondo', cursive; font-size:30px;">How It Works.</h1>
    <h3 class="text-center" style="font-family: 'Macondo', cursive; font-size:20px;">3 Easy steps</h3>
    <div class="progress">
  <div class="progress-bar" role="progressbar" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100" style="width:35%;">
    35%
  </div>
</div>

  </div>

  <div class="panel-body" style="font-size:21px;">

  <ul class="list-group">
      <li class="list-group-item" id="stepOne">
        <span class="h4">Step 1</span>
        <p>You build your dish and place your order for a choice Nigerian delicacy here with us at naijafoodies.com</p>
        <button class="btn btn-primary text-center center-block" type="button" id="stepOneButton">Continue to Step <span class="badge">2</span>
        </button>
      </li>

      <li class="list-group-item" id =  'stepTwo' style="display:none;">
        <span class="h4">Step 2</span>
        <p>Once your order is received, we will package a sizeable portion of food for you</p>
        <button class="btn btn-primary text-center center-block" type="button" id="stepTwoButton">Continue to Step <span class="badge">3</span>
        </button>
      </li>

      <li class="list-group-item" id="stepThree" style="display:none;"><span class="h4">Step 3</span>
        <p>We will deliver your food right to your door, based on the schedule below! </p><br/>

        <img class="img-thumbnail center-block content-center" src="<?php echo base_url();?>images/misc/schedule.jpg" alt="Schedule" width="600px;"style="height:600px;"/>


      </li>
    </ul>

</div>

<script>
  $(document).ready(function(){
    $('#stepOneButton').on('click', function(){
      $('#stepTwo').show();
      $('.progress-bar').attr('style','width:70%');
      $('.progress-bar').html('70%');
      $('#stepOneButton').fadeOut(500);
    });

    $('#stepTwoButton').on('click', function(){
      $('#stepThree').show();
      $('.progress-bar').attr('style','width:100%');
      $('.progress-bar').html('Completed');
      $('#stepTwoButton').slideToggle(500);
      $('#goToMenu').popover('show');
    });
  });
</script>
