<?php
/**
 * Created by PhpStorm.
 * User: Olusegun
 * Date: 11/18/2017
 * Time: 3:59 AM
 */

class CartModel extends CI_Model {

    public function __construct() {

        parent::__construct();

        $this->load->database();
    }


    /**
     *  Function adds item to cart
     */
    public function addCartItem($cartItem) {

        $this->db->insert('cart',$cartItem);
        return $this->db->insert_id();
    }

    public function updateCart($itemId,$itemData) {

        $this->db->where('OrderId',$itemId);
        $this->db->update('cart',$itemData);

    }


    /***
     * Function fetches cart items that has the cart Id
     * @param $cartId
     * @return array
     */

    public function fetchCartItems($cartId) {

        $cartItems = array();

        $this->db->select('OrderId, CartId, FoodId, SideOneId, SideTwoId, MeatId, CreatedDate, ServiceDate, Quantity');

        $this->db->from('cart');

        $this->db->where('CartId',$cartId);
        $this->db->where('RecordDisabled', 0);

        $query = $this->db->get();

        foreach ($query->result() AS $items) {

            $cartItems[] = (object) [

                'orderId' => (int)$items->OrderId,
                'cartId' => $items->CartId,
                'foodId' => (int)$items->FoodId,
                'sideOneId' => (int)$items->SideOneId,
                'sideTwoId' => (int)$items->SideTwoId,
                'meatId' => (int)$items->MeatId,
                'createdDate' => $items->CreatedDate,
                'quantity' => (int)$items->Quantity
            ];
        }

        return $cartItems;
    }

}