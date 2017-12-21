<?php
/**
 * Created by PhpStorm.
 * User: Olusegun
 * Date: 11/25/2017
 * Time: 11:52 PM
 */
/**
 * TODO. This class needs to be refactored into sevaral libraries as an Adapter. There is likely going to be several payment option on the future
 */

require_once("application/interfaces/Sterilizer.php");
require_once("application/interfaces/ICart.php");


class CheckOut extends CI_Controller implements Sterilizer,ICart {

    protected $taxPercentage = 0.07;

    public function __construct() {

        parent::__construct();

        $this->load->helper("security");

        // load libraries

        $this->load->library("session");

    }


    /**
     *  Funtion uses the paypal API to make payment for order.
     */
    public function payWithStripe() {

        // Auto load stripe class
        require_once('vendor/autoload.php');

        $userData = $this->getCheckOutParams();

        // Start the implementation of stripe API

        try {

            \Stripe\Stripe::setApiKey("sk_test_u33MssjnRnt7S85wHzL97hrS");

            $charge = \Stripe\Charge::create(array(
                "amount" => $this->getOrderTotal($this->session->uniqueCartId,$userData['DeliveryMode']) * 100,
                "currency" => "USD",
                "source" => $userData['StripeToken'],
                "description" =>"You have successfully placed an order from Naija Foodies.",
                "metadata" => array('OrderId'=>$userData['OrderId']),
                "receipt_email" => $userData['EmailAddress'],
            ));

            // Send receipt

            if($charge->paid) {

                echo json_encode((object) [
                    "ID" => $userData['OrderId'],
                    "Message" => "Your Order have been placed successfully. Your order id is ". $userData['OrderId']. ". Your estimated arrival time is ".$this->getArrivalDate() . " 6PM - 9PM"
                ]);

                // send transaction email to customer and sales team

                $this->sendTransactionEmail($userData);

                $this->clearCart();
            }
            else {

                echo json_encode((object) [
                    "ID" => $userData['OrderId'],
                    "Message" => "Issues processsing your order"
                ]);
            }

        }
        catch(Exception $e) {

            // disable order from table

            $this->CheckoutModel->disableOrder($userData['OrderId']);

            echo json_encode((object) [

                "ID" => $e->getCode(),
                "Message" => $e->getMessage() . '<p>Please click <a href ='.base_url().'checkout'.'><strong><u>here</u></strong></a> to try again</p>'

            ]);
        }

    }

    /**
     * Function returns the estimated arrival data for an order. Factors responsible for data is the time order was placed. The normal cutoff time is 1pm. After
     * 1 pm, all orders will be placed between 6pm and 9pm the next day.
     */
    public function getArrivalDate() {

        if(date('Y-m-d H:i:s') > date('Y-m-d 13:00:00'))
        {
            $arrivalDate = "tomorrow ".date("m-d-Y", strtotime('tomorrow'));
        }
        else
        {
            $arrivalDate = "today ".date("m-d-Y");
        }

        return $arrivalDate;

    }

    /**
     *  Function uses the Paypal API to make payment for order
     *  TODO As company expands, this function will be implemented. Users would be able to pay using paypal. The implementation might be different.
     */
    public function payWithPaypal() {


    }


    /**
     * @param $arg
     * @return mixed
     * Function cleans up @param $arg
     */
    public static function sterilize($arg)
    {
        $newArg = trim($arg);
        $newArg = stripslashes($newArg);

        return $newArg;
    }

    /**
     * @param $phoneNumber
     * Function adds customer's phonenumber to the session array
     * @return string;
     */
    public function setCheckoutPhoneNumber($phoneNumber) {

        $this->session->set_userdata("phoneNumber",self::sterilize($phoneNumber));

        return (string) $this->session->phoneNumber;
    }

    /**
     * Function clears user cart. Basically empties the session
     */


    /**
     * Function gets user input and returns an array of it
     * @return array
     */
    public function getCheckOutParams() {

        // load model
        $this->load->model("DeliveryModel");
        $this->load->model("CheckoutModel");

        $purchaseToken = $this->input->post('token');

        $shippingCity = $this->DeliveryModel->fetchLocationDetails( self::sterilize($this->input->post('shippingCity')));

        $userData = array(

            "StripeToken" => self::sterilize($purchaseToken['id']),
            "ShippingAddress" => self::sterilize($this->input->post('shippingAddress')),
            "DeliveryMode" => self::sterilize($this->input->post('shippingCity')),
            "ShippingState" => self::sterilize($this->input->post("shippingState")),
            "ShippingZip" => self::sterilize($this->input->post("shippingZipCode")),
            "EmailAddress" => self::sterilize($this->input->post("emailAddress")),
            "RecordDisabled" => 0,
            "IsFulfilled" => 0,
            "FulfilmentStage" => 0,
            "OrderedBy" => date("Y-m-d H:i:s"),
            "ShippingName" => $purchaseToken["card"]["name"],
            "ShippingCity" => $shippingCity->city,
            "ShippingCountry" => "United States",
            "OrderCost" => $this->getOrderTotal($this->session->uniqueCartId,$shippingCity->id),
            "UniqueCartId" => $this->session->uniqueCartId,
            "Phone" => $this->session->phoneNumber

        );

        // submit Order Data

        $userData['OrderId'] = $this->CheckoutModel->saveOrder($userData);

        return $userData;

    }

    /**
     * Function calculates the total cost of the order, rebates, location cost, tax using the order total
     * @param cartId
     * @param $deliveryCityId
     * @return double
     */
    public function getOrderTotal($cartId,$deliveryCityId) {

        // load models

        $this->load->model("CartModel");
        $this->load->model("MeatModel");
        $this->load->model("SideModel");
        $this->load->model("DeliveryModel");
        $this->load->model("FoodModel");
        $this->load->model("CouponModel");

        $foodCost = 0;

        // @var total holds all cost of the order. This is calculated within the foreach loop

        // load cart Items

        $cartItems = $this->CartModel->fetchCartItems($cartId);
        $deliveryDetails = $this->DeliveryModel->fetchLocationDetails($deliveryCityId);

        foreach($cartItems AS $items) {

            $foodDetails = $this->FoodModel->fetchFoodDetails($items->foodId);
            $sideOneDetails = $this->SideModel->fetchSideDetails($items->sideOneId);
            $sideTwoDetails = $this->SideModel->fetchSideDetails($items->sideTwoId);
            $meatDetails = $this->MeatModel->fetchMeatDetails($items->meatId);

            $foodCost += ($foodDetails->cost * $items->quantity) + $sideOneDetails->cost + $sideTwoDetails->cost + $meatDetails->cost;

        }

        $total = $foodCost + $deliveryDetails->cost;
        $discount = $this->CouponModel->fetchCouponCost($this->session->couponCode);

        return $total + $this->getTaxAmount($total) - $discount;

    }


    /**
     * Funtion calculates the tax percentage of total passed as an arg
     * @param $totalCost
     * @return int
     */

    public function getTaxAmount($totalCost) {

        return number_format($totalCost * $this->taxPercentage,2);
    }

    /**
     * Function sends email using the email service library after purchase has been made. Function writes the data format for sales email and sends the email afterwards
     * Please check $this->getCheckOutParams() for details about $salesData
     * @param $salesData
     */
    public function sendTransactionEmail($salesData) {

        $this->load->library("Emailservice");

        $cartItems = $this->CartModel->fetchCartItems($salesData['UniqueCartId']);
        $deliveryDetails = $this->DeliveryModel->fetchLocationDetails($salesData['DeliveryMode']); // holds shipping information

        // This will hold the order details array. It is meant to be associative in nature and configured within the loop
        $orderDetails = array();

        foreach($cartItems AS $items) {

            $foodDetails = $this->FoodModel->fetchFoodDetails($items->foodId);
            $sideOneDetails = $this->SideModel->fetchSideDetails($items->sideOneId);
            $sideTwoDetails = $this->SideModel->fetchSideDetails($items->sideTwoId);
            $meatDetails = $this->MeatModel->fetchMeatDetails($items->meatId);

            $mealTotal = $foodDetails->cost + $sideOneDetails->cost + $sideTwoDetails->cost + $meatDetails->cost; // compute total for this meal

            // configure array for food details

            $orderDetails[] = [

                "foodName" => $foodDetails->name,
                "foodCost" => $foodDetails->cost,
                "quantity" => $items->quantity,
                "sideOne" => $sideOneDetails->name,
                "sideOneCost" => $sideOneDetails->cost,
                "sideTwo" => $sideTwoDetails->name,
                "sideTwoCost" => $sideTwoDetails->cost,
                "meat" => $meatDetails->name,
                "meatCost" => $meatDetails->cost,
                "mealTotal" => number_format($mealTotal,2)
            ];
        }

        $discount = $this->CouponModel->fetchCouponCost($this->session->couponCode);

        // set email data format

        $emailData = (object)[

            "orderId" => $salesData['OrderId'],
            "recipientEmail" => $salesData["EmailAddress"],
            "totalFoodCost" => $this->getOrderTotal($salesData['UniqueCartId'],$salesData['DeliveryMode']),
            "totalTax" => $this->getTaxAmount($this->getOrderTotal($salesData['UniqueCartId'],$salesData['DeliveryMode'])),
            "transactionId" => $salesData['UniqueCartId'],
            "discount" => $discount,
            "foodDetails" => $orderDetails,
            "deliveryDate" => $this->getArrivalDate(),
            "customerPhoneNumber" => $this->session->phoneNumber,
            "shippingCost" => $deliveryDetails->cost,
            "shippingAddress" => $salesData['ShippingAddress']. ' '. $salesData['ShippingCity']. ', '. $salesData['ShippingState']. ' '. $salesData['ShippingZip'] . ' United States'
        ];

        $this->emailservice->sendSalesEmail($emailData);

        $this->emailservice->sendAdminEmail($emailData);
    }


    /*
     * This is inherited from the ICart interface. Function will reset or clear the session array
     */
    public function clearCart()
    {
        if(!session_destroy()) {
            $this->session->sess_destroy();
        }
    }
}
