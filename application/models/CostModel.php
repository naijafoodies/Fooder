<?php
/**
 * Created by PhpStorm.
 * User: Olusegun
 * Date: 11/11/2017
 * Time: 4:37 AM
 */

class CostModel {

    private $CIM;
    private $cost;
    private $total;


    public function __construct() {

        $this->CIM = new CI_Model();

        $this->CIM->load->database();
    }

    /**
     * @param $menuId
     * @return object
     */
    public function getMenuCost($menuId) {

        $this->CIM->db->select('FoodPriceId,Regular');

        $this->CIM->db->from('foodprice');

        $this->CIM->db->where('FoodId', $menuId);

        $query = $this->CIM->db->get();

        $result = $query->row();

        $menuCost = (object) [

            'id' => (int)$result->FoodPriceId,
            'cost' => (double)$result->Regular

        ];

        return $menuCost;

    }

    public static function getSideCost() {


    }

    public static function calculateTotal($cost, Tax $tax) {


    }

}