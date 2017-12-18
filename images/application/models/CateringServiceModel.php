<?php

  /**
   * class takes care of datastore for catering controller
   */
  class CateringServiceModel extends CI_Model
  {

    //load constructor

    public function __construct()
    {
      parent::__construct();

      $this->load->database();
    }

    /**********************************************************
        Start of Catering service functions
    **********************************************************/

    public function insertQuoteRequest($quoteRequestData)
    {
        $this->db->insert('quoterequest',$quoteRequestData);
    }
  }

 ?>
