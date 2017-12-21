<?php

  /**
   * funtion links to connects all about us entities
   */
  class AboutUs extends CI_Controller
  {

    function __construct()
    {
      parent::__construct();

      $this->load->helper('url');
      $this->load->helper('file');
      $this->load->library('session');

      $this->load->model('AboutUsModel');
      $this->load->model('CartManagementModel');

    }

    public function index()
    {
      $uniqueId = $this->session->userdata('uniqueSessionId');

      $data['cartDetails'] = $this->CartManagementModel->grabCartDetails($uniqueId);

      $this->load->view('content/theme/cssBoilerPlate.php');
      $this->load->view('content/theme/header.php',$data);
      $this->load->view('content/AboutUs/index.php',$data);
      $this->load->view('content/theme/footer.php');
      
    }
  }
 ?>
