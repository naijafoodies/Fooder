<?php
  /**
   *
   */
  class Terms extends CI_Controller
  {

    function __construct()
    {
      parent::__construct();

      $this->load->helper('url');
      $this->load->helper('file');
    }

    public function termsAndConditions()
    {

      $this->load->view('content/Terms/termsAndConditions.php');
    }

    public function privacyPolicy()
    {
      $this->load->view('content/Terms/privacyPolicy.php');
    }

    public function ingredientStack()
    {
      $this->load->view('content/Terms/tingredientStack.php');
    }
  }

 ?>
