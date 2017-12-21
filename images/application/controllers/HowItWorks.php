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

    $this->load->model('HowItWorksModel');
  }

  public function index()
  {
        //functions loads content for how it works

        $this->load->view('content/HowItWorks/tutorial.php');
  }


}


?>
