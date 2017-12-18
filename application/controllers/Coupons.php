<?php
/**
 * Created by PhpStorm.
 * User: Olusegun
 * Date: 11/25/2017
 * Time: 11:16 AM
 */

require_once("application/interfaces/Sterilizer.php");
require_once("application/interfaces/ISessionService.php");

class Coupons extends CI_Controller implements Sterilizer,ISessionService {

    public function __construct() {

        parent::__construct();

        $this->load->helper(array('url','security'));

        $this->load->library('session');

        $this->load->model("CouponModel");

    }

    public function getCouponCost($discountCode) {

        if(!$discountCode) {

            http_response_code(400);
        }
        else {

            self::sterilize($discountCode);

            // get coupon cost

            $couponCost = $this->CouponModel->fetchCouponCost($discountCode);

            if($this->addToSession($discountCode)) {

                echo json_encode(['couponCost'=>$couponCost]);
            }
            else {

                echo json_encode(['couponCost'=>$couponCost]);

            }

        }

    }

    public function removeCoupon() {

    }

    public function addCoupon() {

    }

    public static function sterilize($arg)
    {
        $arg = trim($arg);
        $arg = stripslashes($arg);

        $arg = filter_var($arg, FILTER_SANITIZE_STRIPPED);

        return $arg;
    }

    /***
     * @param $couponCode
     * @return bool
     */
    public function addToSession($couponCode) {

        $this->session->set_userdata('couponCode', $couponCode);

    }

    /**
     * Function gets the coupon code set by the user. it is dependent on the session Service library
     */
    public function getCouponCode() {

        $this->load->library('Sessionservice');

        echo json_encode(['couponCode'=>$this->session->couponCode]);
    }



}