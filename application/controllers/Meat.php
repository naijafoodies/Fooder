<?php
/**
 * Created by PhpStorm.
 * User: Olusegun
 * Date: 11/12/2017
 * Time: 2:59 PM
 */

class Meat {

    protected $codeIgniter;

    public function __construct() {

        $this->codeIgniter = new CI_Controller();

        $this->codeIgniter->load->model('MeatModel');

    }

    /**
     * @param $vendorId
     */
    public function getVendorMeat($vendorId) {

        echo json_encode(['meats'=>$this->codeIgniter->MeatModel->fetchVendorMeat($vendorId)]);

    }


    public function getMeatDetails($meatId) {

    }


}