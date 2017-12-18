<?php
/**
 * Created by PhpStorm.
 * User: Olusegun
 * Date: 11/11/2017
 * Time: 10:37 AM
 */

require_once("application/interfaces/Util.php");

class SideModel implements Util
{
    private $CIM;

    public function __construct() {

        $this->CIM = new CI_Model();

        $this->CIM->load->database();
    }

    public function getVendorSides($vendorId) {

        $sides = null;

        $this->CIM->db->select('SideId, SideName, Price, IsAvailable');

        $this->CIM->db->from('sides');

        $this->CIM->db->where('VendorId',$vendorId);
        $this->CIM->db->where('RecordDisabled', 0);
        $this->CIM->db->where('IsAvailable', 0);

        $query = $this->CIM->db->get();

        foreach($query->result() AS $response) {

            $sides[] = (object) [

                'id' => (int)$response->SideId,
                'name' => $response->SideName,
                'cost' => (double)$response->Price,
                'available' => self::convertToBool($response->IsAvailable)
            ];
        }

        return $sides;
    }

    /**
     * @param $sideId
     * @return null|object
     */
    public function fetchSideDetails($sideId) {

        $this->CIM->db->select('SideName, Price');

        $this->CIM->db->from('sides');

        $this->CIM->db->where('SideId', $sideId);

        $query = $this->CIM->db->get();

        $result = $query->row();

        $sides = (object) [

            'name' => $result->SideName,
            'cost' => (double)$result->Price
        ];

        return $sides;
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

            throw new TypeError("Expected an a string",1);
        }

        return $value === '0' ? true : false;
    }
}