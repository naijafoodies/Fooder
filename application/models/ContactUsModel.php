<?php
  /**
   *
   */
  class ContactUsModel extends CI_Model
  {

    function __construct()
    {
      parent::__construct();

      $this->load->database();
    }

    public function insertCommentLog($ticket){
      $this->db->insert('serviceticket',$ticket);
    }


  }



 ?>
