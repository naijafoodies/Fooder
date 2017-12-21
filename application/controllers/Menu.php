<?php
/**
 * Created by PhpStorm.
 * User: Olusegun
 * Date: 11/8/2017
 * Time: 11:23 PM
 */



class Menu
{
    private $codeIgniter;

    public function __construct()
    {
        $this->codeIgniter = new CI_Controller();

        // load helpers

        $this->codeIgniter->load->helpers(array('url'));

        $this->codeIgniter->load->library('session');

        // load models

        $this->codeIgniter->load->model('MenuModel');
        $this->codeIgniter->load->model('VendorModel');
        $this->codeIgniter->load->model('CostModel');
    }

    /**
     * Method fetches all available menu in the inventory
     */
    public function getAvailableMenu() {

        // get menu Inventory class

        echo  json_encode(['activeMenu' => $this->codeIgniter->MenuModel->fetchAvailableMenuItems()]);

    }

    // Function fetches menu based of the Id passed to it. It also grabs the details of the menu. This include, price, vendor e.t.c

    public function getMenu($menuId) {

        $menu['details'] = $this->codeIgniter->MenuModel->fetchMenuDetails($menuId);

        $menu['vendor'] = $this->codeIgniter->VendorModel->fetchVendorDetails($menu['details']->vendorId);

        $menu['cost'] = $this->codeIgniter->CostModel->getMenuCost($menuId);

        echo json_encode(['menuDetails' => $menu]);
    }

    public function getMenuByCategory($categoryId) {

        echo json_encode(['menu' => $this->codeIgniter->MenuModel->fetchCategoryMenu($categoryId)]);

    }

    public function getMenuByOrigin($originId) {

        if(!$originId) {

            throw new InvalidArgumentException("Expected an Origin ID");
        }

        echo json_encode(['menu' => $this->codeIgniter->MenuModel->fetchOriginMenu($originId)]);
    }


}