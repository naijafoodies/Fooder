<?php
/**
 * Created by PhpStorm.
 * User: Olusegun
 * Date: 11/11/2017
 * Time: 3:19 AM
 */

class VendorModel {

    private $CIM;

    public function __construct() {

        $this->CIM = new CI_Model();

        $this->CIM->load->database();
    }

    public function fetchVendorDetails($vendorId) {

        $this->CIM->db->select('VendorName, VendorDisplayImage, Email');

        $this->CIM->db->from('vendors');
        $this->CIM->db->limit(1);

        $query = $this->CIM->db->get();
        $result = $query->row();

        $vendorDetails = (object)[

            'name' => $result->VendorName,
            'displayImage' => $result->VendorDisplayImage,
            'email' => $result->Email
        ];

        return $vendorDetails;

    }


}