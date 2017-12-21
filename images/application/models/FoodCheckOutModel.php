<?php
/**
 *
 */
class FoodCheckOutModel extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  public function savePurchaseData($purchaseData)
  {
    //function saves data upon purchase

    $this->db->insert('purchaselog',$purchaseData);
  }

  public function grabDeliveryPrice()
  {
    $this->db->select('DeliveryId,DeliveryCityName,DeliveryPrice');
    $this->db->from('deliverydetails');

    $this->db->where('RecordDisabled',0);
    $this->db->order_by('DeliveryId','DESC');

    $query = $this->db->get();
    return($query->result_array());
  }

  public function grabSpecificDeliveryDetails($deliveryId)
  {
    //function grabs specific delivery Id and returns result as an object

    $deliveryDetails = NULL;

    $this->db->select('DeliveryId,DeliveryCityName,DeliveryPrice');
    $this->db->from('deliverydetails');

    $this->db->where('RecordDisabled',0);
    $this->db->where('DeliveryId',$deliveryId);

    $query = $this->db->get();

    if($query->num_rows() > 0)
    {
      $response = $query->row();

      $deliveryDetails['DeliveryId'] = $response->DeliveryId;
      $deliveryDetails['DeliveryCityName'] = $response->DeliveryCityName;
      $deliveryDetails['DeliveryPrice'] = $response->DeliveryPrice;

    }

    return $deliveryDetails;
  }

  public function insertIntoFoodCheckOut($tableName,$data)
  {
    $this->db->insert($tableName,$data);

    return $this->db->insert_id();
  }

  public function updateOrders($orderId,$data)
  {
    $this->db->where('OrderId',$orderId);
    $this->db->update('orders',$data);
  }


}

 ?>
