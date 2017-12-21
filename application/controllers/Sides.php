<?php
/**
 * Created by PhpStorm.
 * User: Olusegun
 * Date: 11/11/2017
 * Time: 10:34 AM
 */

class Sides {

    private $codeIgniter;

    /**
     * Sides constructor.
     */
    public function __construct() {

        $this->codeIgniter = new CI_Controller();

        $this->codeIgniter->load->model('SideModel');

    }

    /**
     * Function fetches all the sides for a partitular vendor through a GET request
     * @param $vendorId
     */
    public function getVendorSides($vendorId) {

        echo json_encode(['sides'=>$this->codeIgniter->SideModel->getVendorSides($vendorId)]);
    }

    public function getSideDetails($sideId) {

    }




}