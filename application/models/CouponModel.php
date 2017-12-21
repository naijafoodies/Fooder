<?php
/**
 * Created by PhpStorm.
 * User: Olusegun
 * Date: 11/25/2017
 * Time: 11:21 AM
 */

class CouponModel extends CI_Model {

    public function __construct() {

        parent::__construct();

        $this->load->database();
    }

    /**
     * @param $couponCode
     * @return int|object
     *  Function returns the cost of a coupon. Returns
     */
    public function fetchCouponCost($couponCode) {

        $this->db->select("CouponCost");

        $this->db->from('coupon');

        $this->db->where('CouponCode', $couponCode);
        $this->db->where('RecordDisabled',0);

        $this->db->limit(1);

        $query = $this->db->get();

        if($query->num_rows() > 0) {

            $result = $query->row();

            $cost = (object)[

                'cost' => $result->CouponCost
            ];

            if ($cost) {

                return number_format((double)$cost->cost,2);

            } else {
                return 0;
            }
        }
        else {
            return 0;
        }
    }

}