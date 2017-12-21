<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();

/**
 * class deals with everything relevant to catering service
 */
class CateringService extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->helper('file');
    $this->load->helper('form');
    $this->load->library('email');

    //load models
    $this->load->model('CateringServiceModel');
  }

  public function index()
  {
    //function loads default page of catering service

    $this->load->view('content/CateringService/cateringform.php');
  }

  public function submitCateringRequest(){

    //function submits catering request and mails naija foodies

    //mail functionalities

    $config['protocol'] = 'sendmail';
    $config['mailpath'] = '/usr/sbin/sendmail';
    $config['charset'] = 'iso-8859-1';
    $config['wordwrap'] = TRUE;

    $this->email->initialize($config);

    $name = $this->input->post('requestName');
    $phone = $this->input->post('requestPhone');
    $email = $this->input->post('requestEmail');
    $expectedGuest = $this->input->post('requestexpectedGuest');
    $foodTrays = $this->input->post('requestFoodTrays');
    $description = $this->input->post('requestDescription');
    $address = $this->input->post('requestAddress');
    $date = $this->input->post('requestDate');

    $data = array('RequestName'=>$name,'RequestPhone'=>$phone, 'RequestEmail'=>$email, 'RequestExpectedGuest'=>$expectedGuest,
                'RequestFoodTrays'=>$foodTrays, 'RequestDescription'=>$description, 'RequestAddress'=>$address, 'RequestDate'=>$date,
                'SubmissionDate'=>date('Y-m-d'));

    $this->CateringServiceModel->insertQuoteRequest($data);

    $text = '<style type="text/css">
          body,
          html,
          .body {
            background: #f3f3f3 !important;
          }
        </style>

        <container>

          <spacer size="16"></spacer>

          <row>
            <columns>
              <h1>REQUEST FOR FOOD QUOTE.</h1>
              <p>Request Generated On '. date('Y-m-d'). '</p>

              <spacer size="16"></spacer>

              <callout class="secondary">
                <row>
                  <columns large="6">
                    <p>
                      <strong>Name On Request</strong><br/>'.
                      $name . '
                    </p>
                    <p>
                      <strong>Email Address</strong><br/> '.
                      $email. '
                    </p>
                    <p>
                      <strong>Phone Number</strong><br/> '.
                      $phone. '
                    </p>

                    <p>
                      <strong>Number Of Expected Guest</strong><br/>
                       ' . $expectedGuest . '
                    </p>

                    <p>
                      <strong>Number Of Food Trays</strong><br/>
                       ' . $foodTrays . '
                    </p>

                    <p>
                      <strong>Description</strong><br/>
                       ' . $description . '
                    </p>

                    <p>
                      <strong>Address</strong><br/>
                       '. $address . '
                    </p>

                    <p>
                      <strong>Event Date</strong><br/>
                       ' .$date. '
                    </p>

                </row>
              </callout>

              <h4>Order Details</h4>


              <p>Admin Reply Needed</p>
            </columns>
          </row>
          <row class="footer text-center">
            <columns large="3">
              <img src="http://www.naijafoodies.com" alt="Naija Foodies">
            </columns>
            <columns large="3">
              <p>
                Call us at 317-998-7587<br/>

              </p>
            </columns>
            <columns large="3">
              <p>
                2442 Central Ave,<br/>
                Indianapolis, IN 46205
              </p>
            </columns>
          </row>
        </container>';

    $this->email->from('system@naijafoodies.com', 'Naija Foodies');
    $this->email->to('naijafoodies@gmail.com');
    $this->email->set_mailtype("html");
    $this->email->cc('olusegunakinyelure@gmail.com');
    $this->email->bcc('ugo_njoku@ymail.com');

    $this->email->subject('Quote Request');
    $this->email->message($text);

    $this->email->send();



  }

}


?>
