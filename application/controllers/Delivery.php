<?php
/**
 * Created by PhpStorm.
 * User: Olusegun
 * Date: 11/27/2017
 * Time: 8:14 PM
 */

class Delivery extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->helpers(array('url'));

        $this->load->model('DeliveryModel');
    }

    public function getDeliveryLocations() {

        echo json_encode(['locations'=>$this->DeliveryModel->fetchDeliveryLocationData()]);
    }

}