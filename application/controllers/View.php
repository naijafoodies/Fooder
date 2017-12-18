<?php
/**
 * Created by PhpStorm.
 * User: Olusegun
 * Date: 11/11/2017
 * Time: 4:57 AM
 * Purpose : Class contains all the views for the whole system
 */

require_once('application/interfaces/Sterilizer.php');

class View extends CI_Controller implements Sterilizer {

    public function __construct() {

        parent::__construct();

        $this->load->helper(array('url'));

    }

    /**
     * method loads the menu description page
     * @param $menuId
     */
    public function menuDescription($menuId) {

        $menuId = self::sterilize($menuId);

        $data['menuId'] = $menuId;

        $this->load->view('content/menudescription/index.php',$data);
    }

    // Shows all NF Menu

    public function menu() {

        $this->load->view('content/menu/menu.php');
    }


    // shows all menu from a particular origin

    public function categoryMenu($categoryId) {

        $categoryId = self::sterilize($categoryId);

        $data['categoryId'] = $categoryId;

        $this->load->view('content/menu/category/showMenu.php',$data);
    }

    // show view for menu from origins

    public function originMenu($originId) {

        $originId = self::sterilize($originId);

        $data['originId'] = $originId;

        $this->load->view('content/menu/origin/showMenu.php',$data);
    }

    /**
     * Function shows the cart view
     */
    public function showCart() {

        $this->load->view('content/cart/index.php');

    }

    public function showCheckout() {

        $this->load->view('content/checkout/index.php');
    }

    /**
     * @param $arg
     * @return mixed|string
     */
    public static function sterilize($arg)
    {
        $arg = trim($arg);
        $arg = stripSlashes($arg);
        $arg = filter_var($arg,FILTER_SANITIZE_NUMBER_INT);

        return $arg;
    }
}