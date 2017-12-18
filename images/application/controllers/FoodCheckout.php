<?php
  //This controller is dedicated to our checkpout library

  use \Stripe\Stripe;
  use \Stripe\Charge;
  use \Stripe\Customer;

  class FoodCheckOut extends CI_Controller{

    public function __construct()
    {
      parent::__construct();
      $this->load->helper('url');
      $this->load->helper('file');
      $this->load->helper('security');

      $this->load->library('email');
      $this->load->library('session');

      $this->load->model('FoodCheckOutModel');
      $this->load->model('FoodDisplayModel');
      $this->load->model('CartManagementModel');

      //load models

    }

    public function viewCustomerDataForm()
    {
      //function loads the customer checkout form.

      $data['grossTotal'] = $this->input->get_post('grossTotal');

      //get all delivery types

      $data['deliveryCities'] = $this->FoodCheckOutModel->grabDeliveryPrice();

      $this->load->view('content/foodCheckOut/modal/customerCheckoutForm.php',$data);

    }

    public function getDeliveryPrice()
    {
      //function grabs delivery price based on the delivery Id passed to it

      $deliveryId = $this->security->xss_clean($this->input->post('deliveryId'));

      //validate delivery Id 

      if(!is_numeric($deliveryId) || $deliveryId < 0)
      {
        echo 0;
      }
      else
      {
        //get delivery price

        $data['deliveryPrice'] = $this->FoodCheckOutModel->grabSpecificDeliveryDetails($deliveryId);

        if(!$data['deliveryPrice'])
        {
          echo 1;
        }
        else
        {
          echo json_encode($data['deliveryPrice']);
        }
      }
    }

    public function registerUserData()
    {
      // Function receives user meta data from the view

      //get ajax call

      $phone = $this->input->post('phone');
      $deliveryId = $this->input->post('deliveryMode');

      //gross total would provide data for stripe not for real checkout

      $data['grossTotal'] = $this->input->post('gross');

      $newSessionData = array('phone'=>$phone,'deliveryId'=>$deliveryId);

      $this->session->set_userdata($newSessionData);

      // load addresses based on delivery mode selected

      if($deliveryId == 5)
      {
        $this->load->view('content/foodCheckout/modal/viewPickUpVenue.php',$data);
      }
      else
      {
        $this->load->view('content/foodCheckout/modal/viewDeliveryPage.php',$data);
      }

    }

    public function checkOutDelivery()
    {

      //function takes care of checking out including collecting raw data from stripe.js

      //collect data

      try {

          $runningTotal = 0;

          require_once('vendor/autoload.php');

          //compute running total from database

          //get cart Id

          $uniqueId = $this->session->userdata('uniqueSessionId');
          $deliveryId = $this->session->userdata('deliveryId');

          //get All orders

          $data['cartDetails'] = $this->CartManagementModel->grabCartDetails($uniqueId);

          //loop through cart to get running total

          foreach($data['cartDetails'] AS $foodPrice)
          {
            $runningTotal +=  $foodPrice['TotalCost'];
          }

          //get Delivery Price 

          $deliveryPrice = $this->FoodCheckOutModel->grabSpecificDeliveryDetails($deliveryId);
          $runningTotal += $deliveryPrice['DeliveryPrice'];

          //convert amount to cents for stripe

          $amount = $runningTotal * 100;

          if($amount > 0)
          {

            //submitData Data to Order Table

            $orderStatus = $this->recordSales();

            Stripe::setApiKey("sk_test_u33MssjnRnt7S85wHzL97hrS");

            //stripe form details

            $token = $this->input->post('stripeToken');
            $shippingName = $this->input->post('stripeBillingName');
            $shippingAddress = $this->input->post('stripeShippingAddressLine1');
            $shippingZip = $this->input->post('stripeShippingAddressZip');
            $shippingState = $this->input->post('stripeShippingAddressState');
            $shippingCity = $this->input->post('stripeShippingAddressCity');
            $shippingCountry = $this->input->post('stripeShippingAddressCountry');
            $emailAddress = $this->input->post('stripeEmail');

            $charge = Charge::create(
              array(
                  "amount" => $amount,
                  "currency" => "USD",
                  "source" => $token,
                  "description" =>$shippingName. ' -'. $emailAddress,
                 "metadata" => array('OrderId'=>$orderStatus,'Phone'=>$this->session->userdata('phone')),
              )
            );

            //update the order table 

            $updateData = array('StripeToken'=>$token,'ShippingName'=>$shippingName,'ShippingAddress'=>$shippingAddress,'ShippingZip'=>$shippingZip,'ShippingState'=>$shippingState,'ShippingCity'=>$shippingCity,
              'ShippingCountry'=>$shippingCountry,'EmailAddress'=>$emailAddress,'OrderCost'=>$runningTotal,'Phone'=>$this->session->userdata('phone'));

            $this->FoodCheckOutModel->updateOrders($orderStatus,$updateData);

            //save to database

              $sessionArray = array('uniqueSessionId','phone');

              //clear cart and array data

              $this->session->unset_userdata($sessionArray);

              redirect('/FoodDisplay/viewMenu','auto',301);
          }
          else
          {
            echo "<p>Order Not Placed. System Error </p>";
          }
        }

          catch (Exception $e)
           {
            $error = $e->getMessage();
            echo $error;
          }

    }

    public function checkOutPickUp()
    {

      //function takes care of checking out including collecting raw data from stripe.js

      //collect data

      try {

          $runningTotal = 0; 

          require_once('vendor/autoload.php');

          //compute running total from database

          //get cart Id

          $uniqueId = $this->session->userdata('uniqueSessionId');
          $deliveryId = $this->session->userdata('deliveryId');

          //get All orders

          $data['cartDetails'] = $this->CartManagementModel->grabCartDetails($uniqueId);

          //loop through cart to get running total

          foreach($data['cartDetails'] AS $foodPrice)
          {
            $runningTotal +=  $foodPrice['TotalCost'];
          }

          $deliveryPrice = $this->FoodCheckOutModel->grabSpecificDeliveryDetails($deliveryId);
          $runningTotal += $deliveryPrice['DeliveryPrice'];

          //convert amount to cents for stripe

          $amount = $runningTotal * 100;

          if($amount > 0)
          {
            $orderStatus = $this->recordSales();

            Stripe::setApiKey("sk_test_u33MssjnRnt7S85wHzL97hrS");

            //stripe form details

            $token = $this->input->post('stripeToken');
            $emailAddress = $this->input->post('stripeEmail');
            $name = $this->input->post('stripeBillingName');

            $charge = Charge::create(
              array(
                  "amount" => $amount,
                  "currency" => "USD",
                  "source" => $token,
                  "description" => "Pick Up location: 3748 Lafayette Rd, Indianapolis, IN 46222",
                 "metadata" => array('OrderId'=>$orderStatus,'Phone'=>$this->session->userdata('phone')),

              )
            );

            //update the order table 

            $updateData = array('StripeToken'=>$token,'EmailAddress'=>$emailAddress,'OrderCost'=>$runningTotal,'ShippingName'=>$name,'Phone'=>$this->session->userdata('phone'));

            $this->FoodCheckOutModel->updateOrders($orderStatus,$updateData);

            //save to database

              $sessionArray = array('uniqueSessionId','phone');

              //clear cart and array data

              $this->session->unset_userdata($sessionArray);


              redirect('/FoodDisplay');

            }
            else
            {
              echo "<p>Order Not Placed. System Error </p>";
            }
          } 
          catch (Exception $e)
          {
            $error = $e->getMessage();
            echo $error;
          }

    }

   public function recordSales()
   {

    /**
    * Function records sales to database and returns the sale Id. Sale ID would be used 
    * as a proof of purchase
    */

    //session data

    $uniqueId = $this->session->userdata('uniqueSessionId');
    $deliveryMode = $this->session->userdata('deliveryId');

    $dateNow = date('Y-m-d H:i:s');

    //set data structure

    $salesData = array('UniqueCartId'=>$uniqueId,'DeliveryMode'=>$deliveryMode,'RecordDisabled'=>0,'IsFulfilled'=>0,'FulfilmentStage'=>1,'OrderedBy'=>$dateNow);

    $response = $this->FoodCheckOutModel->insertIntoFoodCheckOut('orders',$salesData);

    return $response;

   }

   public function sendAdminNotification()
   {
      $emailText = "<header style = 'background:red;color:black;height:20px;text-align:center;'><h3>Naija Foodies</h3></header>";
      
   }

   public function sendCustomerNotification()
   {

   }



    public function sendMailNotificationToWorkers($foodName, $foodPrice, $shippingName)
    {
      $foodPrice /=100;
      $correspondence = array('kenomotosho@gmail.com','olusegunakinyelure@gmail.com');
      $config['protocol'] = 'sendmail';
      $config['mailpath'] = '/usr/sbin/sendmail';
      $config['charset'] = 'iso-8859-1';
      $config['wordwrap'] = TRUE;

      $this->email->initialize($config);

      $this->email->from('system@naijafoodies.com', 'Naija Foodies Purchase Alert');
      $this->email->to('eoyeyemi@gmail.com');
      $this->email->set_mailtype("html");
      $this->email->cc($correspondence);
      $this->email->bcc('ugo_njoku@ymail.com');

      $this->email->subject('Purchase Order');
      $this->email->message("<div class = 'container'>
                              <h1 class = 'text-center center-block'>Puchase Alert!</h1>
                              <p>An order of  $foodName worth $ $foodPrice  has been made on www.naijafoodies.com by $shippingName Please log on to stripe to approve receipt</p>" . "<p>Phone Number: " . $this->session->userdata('Phone') ."</p></div>");

      $this->email->send();


    }

  }

 ?>
