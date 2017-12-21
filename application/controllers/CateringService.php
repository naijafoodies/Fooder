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

      $this->load->library('session');

     //load models

      $this->load->model('CartManagementModel');

      $this->load->model('CateringServiceModel');
  }

  public function index()
  {
    //function loads default page of catering service

    $uniqueId = $this->session->userdata('uniqueSessionId');

    $data['cartDetails'] = $this->CartManagementModel->grabCartDetails($uniqueId);

    $this->load->view('content/theme/cssBoilerPlate.php');
    $this->load->view('content/theme/header.php',$data);
    $this->load->view('content/CateringService/cateringform.php');
    $this->load->view('content/theme/footer.php');
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
    $additionalRequest = $this->input->post('additionalDetails');
    $needChaffers = $this->input->post('chaffers');

    $data = array('RequestName'=>$name,'RequestPhone'=>$phone, 'RequestEmail'=>$email, 'RequestExpectedGuest'=>$expectedGuest,
                'RequestFoodTrays'=>$foodTrays, 'RequestDescription'=>$description,'AdditionalComments'=>$additionalRequest,'NeedChaffers'=>$needChaffers,'RequestAddress'=>$address, 'RequestDate'=>$date,
                'SubmissionDate'=>date('Y-m-d'));

    $this->CateringServiceModel->insertQuoteRequest($data);

    $recipients = array($email,'naijafoodies@gmail.com');

    $emailText = $this->load->view('emails/cateringRequest.php',$data,TRUE);

    $this->email->from('admin@naijafoodies.com', 'Naija Foodies');
    $this->email->to($recipients);
    $this->email->set_mailtype("html");

    $this->email->subject('Catering Quote Request');
    $this->email->message($emailText);

    $this->email->send();

  }

}


?>
