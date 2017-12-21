<?php
/**
 * Created by PhpStorm.
 * User: Olusegun
 * Date: 11/11/2017
 * Time: 2:40 AM
 */

require_once ("application/interfaces/Util.php");

class MenuModel implements Util {

    // Instance of CI model

    private $CIM;

    public function __construct()
    {
        $this->CIM = new CI_Model();

        $this->CIM->load->database();
    }

    public function fetchAvailableMenuItems() {

        $menuInventory = array();

        $this->CIM->db->select('F.FoodId,F.FoodName,F.IsAvailable,F.FoodCategoryId,F.FoodOriginId,F.Description,F.VendorId,F.DisplayImage,FP.FoodPriceId, FP.Regular, FC.CategoryName, FO.OriginName, V.VendorName');

        $this->CIM->db->from('fooddetails AS F');

        $this->CIM->db->join('foodprice AS FP','F.FoodId = FP.FoodPriceID','left');
        $this->CIM->db->join('foodcategory AS FC','F.FoodCategoryId = FC.FoodCategoryId','left');
        $this->CIM->db->join('foodorigin AS FO', 'F.FoodOriginID = FO.FoodOriginID','left');
        $this->CIM->db->join('vendors AS V','F.VendorId = V.VendorId','left');

        $this->CIM->db->where('F.RecordDisabled', 0);

        $query = $this->CIM->db->get();

        foreach($query->result() AS $inventoryItem) {

            $menuInventory[] = (object)[

                'foodId' => $inventoryItem->FoodId,
                'foodName' => $inventoryItem->FoodName,
                'isAvailable' => self::convertToBool($inventoryItem->IsAvailable),
                'foodCategoryID' => $inventoryItem->FoodCategoryId,
                'foodCategory' => $inventoryItem->CategoryName,
                'foodOriginID' => $inventoryItem->FoodOriginId,
                'foodOrigin' => $inventoryItem->OriginName,
                'description' => $inventoryItem->Description,
                'vendorID' => $inventoryItem->VendorId,
                'vendor' => $inventoryItem->VendorName,
                'image' => $inventoryItem->DisplayImage,
                'costId' => $inventoryItem->FoodPriceId,
                'cost' => $inventoryItem->Regular,

            ];
        }

        return $menuInventory;
    }

    public function fetchMenuDetails($menuId) {

        $this->CIM->db->select('F.FoodId, F.FoodName, F.FoodCategoryId, F.IsAvailable, F.VendorId, F.FoodOriginId, F.Description, F.DisplayImage, FC.CategoryName, FO.OriginName');

        $this->CIM->db->from('fooddetails AS F');

        $this->CIM->db->join('foodcategory AS FC','F.FoodCategoryId = FC.FoodCategoryId','left');
        $this->CIM->db->join('foodorigin AS FO', 'F.FoodOriginID = FO.FoodOriginID','left');

        $this->CIM->db->where('FoodId', $menuId);
        $this->CIM->db->limit(1);

        $query = $this->CIM->db->get();

        $result = $query->row();

        $foodDetails = (object) [

            'menuId' => (int)$result->FoodId,
            'menuName' => $result->FoodName,
            'availability' => self::convertToBool($result->IsAvailable),
            'categoryId' => (int)$result->FoodCategoryId,
            'category' => $result->CategoryName,
            'origin' => $result->OriginName,
            'vendorId' => (int)$result->VendorId,
            'image' => $result->DisplayImage,
            'description' => $result->Description

        ];

        return $foodDetails;

    }


    public function fetchCategoryMenu($categoryId) {

        $menuInventory = array();

        $this->CIM->db->select('F.FoodId,F.FoodName,F.IsAvailable,F.FoodCategoryId,F.FoodOriginId,F.Description,F.VendorId,F.DisplayImage,FP.FoodPriceId, FP.Regular, FC.CategoryName, FO.OriginName, V.VendorName');

        $this->CIM->db->from('fooddetails AS F');

        $this->CIM->db->join('foodprice AS FP','F.FoodId = FP.FoodPriceID','left');
        $this->CIM->db->join('foodcategory AS FC','F.FoodCategoryId = FC.FoodCategoryId','left');
        $this->CIM->db->join('foodorigin AS FO', 'F.FoodOriginID = FO.FoodOriginID','left');
        $this->CIM->db->join('vendors AS V','F.VendorId = V.VendorId','left');

        $this->CIM->db->where('F.FoodCategoryId', $categoryId);
        $this->CIM->db->where('F.RecordDisabled',0);

        $query = $this->CIM->db->get();

        foreach($query->result() AS $inventoryItem) {

            $menuInventory[] = (object)[

                'foodId' => (int)$inventoryItem->FoodId,
                'foodName' => $inventoryItem->FoodName,
                'isAvailable' => self::convertToBool($inventoryItem->IsAvailable),
                'foodCategoryID' => (int)$inventoryItem->FoodCategoryId,
                'foodCategory' => $inventoryItem->CategoryName,
                'foodOriginID' => (int)$inventoryItem->FoodOriginId,
                'foodOrigin' => $inventoryItem->OriginName,
                'description' => $inventoryItem->Description,
                'vendorID' => (int)$inventoryItem->VendorId,
                'vendor' => $inventoryItem->VendorName,
                'image' => $inventoryItem->DisplayImage,
                'costId' => (int)$inventoryItem->FoodPriceId,
                'cost' => (double)$inventoryItem->Regular,

            ];
        }

        return $menuInventory;
    }

    /**
     * @param $originId
     * Function fetches all the menu that belongs to a certain origin. Method is dependent on the originID
     * @return array
     * @throws ArgumentCountError
     */
    public function fetchOriginMenu($originId) {

        if(!$originId) {
            throw new ArgumentCountError("Expected at one argument. You provided none");
        }

        $menuInventory = array();

        $this->CIM->db->select('F.FoodId,F.FoodName,F.IsAvailable,F.FoodCategoryId,F.FoodOriginId,F.Description,F.VendorId,F.DisplayImage,FP.FoodPriceId, FP.Regular, FC.CategoryName, FO.OriginName, V.VendorName');

        $this->CIM->db->from('fooddetails AS F');

        $this->CIM->db->join('foodprice AS FP','F.FoodId = FP.FoodPriceID','left');
        $this->CIM->db->join('foodcategory AS FC','F.FoodCategoryId = FC.FoodCategoryId','left');
        $this->CIM->db->join('foodorigin AS FO', 'F.FoodOriginID = FO.FoodOriginID','left');
        $this->CIM->db->join('vendors AS V','F.VendorId = V.VendorId','left');

        $this->CIM->db->where('F.FoodOriginId', $originId);
        $this->CIM->db->where('F.RecordDisabled',0);

        $query = $this->CIM->db->get();

        foreach($query->result() AS $inventoryItem) {

            $menuInventory[] = (object)[

                'foodId' => (int)$inventoryItem->FoodId,
                'foodName' => $inventoryItem->FoodName,
                'isAvailable' => self::convertToBool($inventoryItem->IsAvailable),
                'foodCategoryID' => (int)$inventoryItem->FoodCategoryId,
                'foodCategory' => $inventoryItem->CategoryName,
                'foodOriginID' => (int)$inventoryItem->FoodOriginId,
                'foodOrigin' => $inventoryItem->OriginName,
                'description' => $inventoryItem->Description,
                'vendorID' => (int)$inventoryItem->VendorId,
                'vendor' => $inventoryItem->VendorName,
                'image' => $inventoryItem->DisplayImage,
                'costId' => (int)$inventoryItem->FoodPriceId,
                'cost' => (double)$inventoryItem->Regular,

            ];
        }

        return $menuInventory;


    }

    public static function convertToBool($value)
    {
        if(gettype($value) !== 'string') {

            throw new TypeError("Expected an a string",1);
        }

        return $value === '0' ? true : false;
    }

}