<?php


/**
 * Class Index
 * Class controls the home page of Naija Foodies.
 */

  class Index {

      // Because of flexibility and reuse of codes, Codeigniter's Controller will be used from @var $codeIgniter

      protected  $codeigniter;

      /**
       * Index constructor.
       */
      public function __construct()
      {
            $this->codeigniter = new CI_Controller();

            $this->codeigniter->load->helper('url');

      }

    // Method loads the homepage

    public function index()
    {
        $this->codeigniter->load->view("content/home.php");
    }

  }



