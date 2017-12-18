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

      $this->load->model('AboutUsModel');

    }

    public function index()
    {
      $this->load->view('content/AboutUs/index.php');
    }
  }
 ?>
