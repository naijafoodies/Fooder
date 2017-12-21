<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();

/**
 *
 */
class HowItWorks extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->helper('url');
    $this->load->helper('file');
    $this->load->library('session');

    $this->load->model('HowItWorksModel');
    $this->load->model('CartManagementModel');
  }

  public function index()
  {
        //functions loads content for how it works

        $uniqueId = $this->session->userdata('uniqueSessionId');

        $data['cartDetails'] = $this->CartManagementModel->grabCartDetails($uniqueId);

        $this->load->view('content/theme/cssBoilerPlate.php');
        $this->load->view('content/theme/header.php',$data);
        $this->load->view('content/HowItWorks/tutorial.php');
        $this->load->view('content/theme/footer.php');
  }


}


?>
