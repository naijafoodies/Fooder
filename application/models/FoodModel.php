<?php
/**
 * Created by PhpStorm.
 * User: Olusegun
 * Date: 11/24/2017
 * Time: 9:03 PM
 */

class FoodModel extends CI_Model {

    public function __construct() {

        parent::__construct();

        $this->load->database();
    }

    public function fetchFoodDetails($foodId) {

        $this->db->select('F.FoodName, FP.Regular');

        $this->db->from('fooddetails AS F');

        $this->db->join('foodprice AS FP','F.FoodId = FP.FoodId','left');

        $this->db->where('F.FoodId', $foodId);

        $query = $this->db->get();

        $result = $query->row();

        $details = (object) [

            'name' => $result->FoodName,
            'cost' => (double)$result->Regular
        ];

        return $details;
    }

}