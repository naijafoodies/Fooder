<?php
/**
 * Created by PhpStorm.
 * User: Olusegun
 * Date: 11/12/2017
 * Time: 3:17 PM
 */

require_once("application/interfaces/Util.php");

class MeatModel implements Util {

    private $CIM;

    /**
     * MeatModel constructor.
     */
    public function __construct() {

        $this->CIM = new CI_Model();

        $this->CIM->load->database();

    }

    public function fetchVendorMeat($vendorID) {

        $meats = null;

        $this->CIM->db->select('MeatId, MeatName, MeatPrice, IsAvailable');

        $this->CIM->db->from('meat');

        $this->CIM->db->where('VendorId', $vendorID);
        $this->CIM->db->where('RecordDisabled', 0);

        $this->CIM->db->order_by('MeatName','ASC');

        $query = $this->CIM->db->get();

        foreach($query->result() AS $response) {

            $meats[] = (object) [

                'id'=> (int)$response->MeatId,
                'name'=> $response->MeatName,
                'cost' => (double) $response->MeatPrice,
                'available' => self::convertToBool($response->IsAvailable)
            ];
        }

        return $meats;

    }

    public function fetchMeatDetails($meatId) {

        $this->CIM->db->select('MeatName, MeatPrice');

        $this->CIM->db->from('meat');

        $this->CIM->db->where('MeatId', $meatId);

        $query = $this->CIM->db->get();
        $result = $query->row();

        $meatDetails = (object) [

            'name' => $result->MeatName,
            'cost' => (double)$result->MeatPrice

        ];

        return $meatDetails;

    }

    /**
     * @param $value
     * @return mixed converts value to a boolean
     * converts value to a boolean
     * @throws TypeError
     */
    public static function convertToBool($value)
    {

        if(gettype($value) !== 'string') {

            throw new TypeError("Expected a string. You ",1);
        }

        return $value === '0' ? true : false;
    }
}