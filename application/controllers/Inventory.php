<?php
/**
 * Created by PhpStorm.
 * User: Olusegun
 * Date: 11/12/2017
 * Time: 2:59 PM
 */

class Inventory extends CI_Controller {

    /**
     * Food constructor.
     */
    public function __construct() {

        parent::__construct();

        $this->load->helper(array('url'));
    }



}