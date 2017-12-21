<?php
/**
 * Created by PhpStorm.
 * User: Olusegun
 * Date: 11/17/2017
 * Time: 9:26 PM
 */


require_once ("application/interfaces/Sterilizer.php");

class Cart implements Sterilizer {

    protected $codeIgniter;
    private $cartId;

    public function __construct() {

        $this->codeIgniter = new CI_Controller();

        // load necessary libraries and helpers

        $this->codeIgniter->load->helpers(array('url'));

        $this->codeIgniter->load->library('session');

        // load database

        $this->codeIgniter->load->model('CartModel');
        $this->codeIgniter->load->model('SideModel');
        $this->codeIgniter->load->model('FoodModel');
        $this->codeIgniter->load->model('MeatModel');

        // set cart Id

        $this->createCart();

    }

    // Function creates a cart session of there is cart session yet

    private function createCart() {

        ///////////
        /// Function creates a cart session if there is not one in place
        /////////

        if(!$this->codeIgniter->session->has_userdata('uniqueCartId')) {

            $encryptedCartId = 'nf' . md5(session_id() .''. $_SERVER['REMOTE_ADDR'] .''. session_id());

            $this->codeIgniter->session->set_userdata(array('uniqueCartId'=>$encryptedCartId,'couponCode'=>'','phoneNumber'=>'null'));

            $this->cartId = $encryptedCartId;

            // lock session veriable

            session_write_close();
        }
        else {

            $this->cartId = $this->codeIgniter->session->uniqueCartId;

        }

}

    // Function gets cart ID

    public function getCartId() {

        return $this->cartId;
    }

    //  Function destroys cary session on user's request or on system request

    public function resetCart() {

        if(!session_destroy()) {

            $this->codeIgniter->session->sess_destroy();
        }

    }

    // Function gets all the cart item using the cartId

    public function getCartItems() {

        echo json_encode(['cartItems' => $this->codeIgniter->CartModel->fetchCartItems($this->getCartId())]);
    }


    /**
     *  Function gets description of all items in your cart.
     */
    public function getCartDetails() {

        $cartItems = $this->codeIgniter->CartModel->fetchCartItems($this->getCartId());

        $cartArray = array();

        foreach($cartItems AS $items) {

            $cartArray[] = (object) [

                'foodDetails' => $this->codeIgniter->FoodModel->fetchFoodDetails($items->foodId),
                'sideOneDetails' => $this->codeIgniter->SideModel->fetchSideDetails($items->sideOneId),
                'sideTwoDetails' => $this->codeIgniter->SideModel->fetchSideDetails($items->sideTwoId),
                'meatDetails' => $this->codeIgniter->MeatModel->fetchMeatDetails($items->meatId),
                'quantity' => $items->quantity,
                'orderId' => $items->orderId
            ];
        }

        echo json_encode($cartArray);
    }

    /**
     *  Function adds item to cart. Returns a 400 of food Id is sent
     */
    public function addItemToCart() {

        $this->createCart();

        $foodId = $this->codeIgniter->input->post('inputFoodId');

        // Check to see if user selected no options

        $sideOneId = ($this->codeIgniter->input->post('inputSideOneId') == -1) ? 14 : $this->codeIgniter->input->post('inputSideOneId');
        $sideTwoId = ($this->codeIgniter->input->post('inputSideTwoId') == -1) ? 14 : $this->codeIgniter->input->post('inputSideTwoId');

        $meatId = ($this->codeIgniter->input->post('inputMeatAndFishId') == -1) ? 1 : $this->codeIgniter->input->post('inputMeatAndFishId');
        $quantity = ($this->codeIgniter->input->post('inputQuantity') == 0) ? 1 : $this->codeIgniter->input->post('inputQuantity');

        // Validate food Id

        if(!$foodId) {

            http_response_code(400);
        }
        else {

            // Add item to cart

            $orderId = $this->codeIgniter->CartModel->addCartItem(array(

                'CartId' => $this->getCartId(),
                'FoodId' => $foodId,
                'SideOneId' => $sideOneId,
                'SideTwoId' => $sideTwoId,
                'MeatId' => $meatId,
                'CreatedDate' => date('Y-m-d H:i:s'),
                'Quantity' => $quantity,
                'RecordDisabled' => 0

            ));

            return $orderId;
        }

    }

    public function removeCartItem($itemId) {

        $serverResponse = $this->codeIgniter->CartModel->updateCart($itemId,array(

            'RecordDisabled' => 1,

        ));

    }


    public static function sterilize($arg)
    {

    }
}