<?php

class CheckoutModel extends CI_Model
{

  public function __construct()
  {
    parent::__construct();

    $this->load->database();
  }

  public function saveOrder($checkoutData)
  {
      //function saves data upon purchase

      $this->db->insert('orders', $checkoutData);

      return $this->db->insert_id();

  }

  public function disableOrder($orderId) {

      $this->db->where('OrderId', $orderId);
      $this->db->update('orders',array('RecordDisabled'=>0));

  }


}

