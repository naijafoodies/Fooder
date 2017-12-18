<?php
/**
 * Created by PhpStorm.
 * User: Olusegun
 * Date: 11/27/2017
 * Time: 8:19 PM
 */

class DeliveryModel extends CI_Model {

    public function __construct() {

        parent::__construct();

        $this->load->database();
    }

    public function fetchDeliveryLocationData() {

        $locations = array();

        $this->db->select('DeliveryId,DeliveryCityName,DeliveryPrice');

        $this->db->from('deliverydetails');

        $this->db->where('RecordDisabled', 0);

        $query = $this->db->get();

        foreach($query->result() AS $loc) {

            $locations[] = (object) [

                'id' => (int)$loc->DeliveryId,
                'city' => $loc->DeliveryCityName,
                'cost' => (double) $loc->DeliveryPrice

            ];
        }

        return $locations;
    }

    public function fetchLocationDetails($locationId) {

        $this->db->select('DeliveryId,DeliveryCityName,DeliveryPrice');

        $this->db->from('deliverydetails');

        $this->db->where('RecordDisabled', 0);
        $this->db->where('DeliveryId',$locationId);

        $this->db->limit(1);

        $query = $this->db->get();

        $result = $query->row();

            $location = (object) [

                'id' => (int)$result->DeliveryId,
                'city' => $result->DeliveryCityName,
                'cost' => (double)$result->DeliveryPrice

                ];

        return $location;
    }

}
