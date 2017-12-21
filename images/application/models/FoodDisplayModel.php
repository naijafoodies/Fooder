<?php
  class FoodDisplayModel extends CI_Model
  {

    public function __construct(){

      //load CI Model class
      parent::__construct();

      //load other helpers

      $this->load->database();

    }

    public function grabAllFoodDetails()
    {
      //function fetches all food details

      //query

      $this->db->select('*');
      $this->db->from('fooddetails');
      $this->db->where('IsAvailable',0);

      //query results

      $query = $this->db->get();

      return ($query->result_array());
    }

    public function grabFoodDetails($foodId)
    {
      /**
      * Function returns all the details of the specific food Id passed to it. It either returns details or a NULL value
      * result of query is converting to php object to be able to access each data individually
      */

      //declare object variable as Null

      $foodDetails = NULL;

      $this->db->select('FoodId,FoodName,FoodStart,Price,LargePrice,FoodCategoryId,Description,DisplayImage');

      $this->db->from('fooddetails');

      //clauses

      $this->db->where('FoodId',$foodId);
      $this->db->where('IsAvailable',0);

      //get result

      $query = $this->db->get();

      if($query->num_rows() > 0)
      {
        $response = $query->row();

        //pushing data objects into object variable

        $foodDetails['FoodId'] = $response->FoodId;
        $foodDetails['FoodName'] = $response->FoodName;
        $foodDetails['FoodStart'] = $response->FoodStart;
        $foodDetails['Price'] = $response->Price;;
        $foodDetails['LargePrice'] = $response->LargePrice;
        $foodDetails['FoodCategoryId'] = $response->FoodCategoryId;
        $foodDetails['Description'] = $response->Description;
        $foodDetails['DisplayImage'] = $response->DisplayImage;

        return $foodDetails;
      }
      else
      {
        return $foodDetails;
      }
    }

    public function grabAllMenuItems()
    {
      $this->db->select('FD.FoodId,FD.FoodName,FD.IsAvailable,FD.FoodStart,FD.Description,FD.Price,FD.LargePrice,FD.FoodCategoryId,FD.DisplayImage,FC.CategoryName');

      $this->db->from('fooddetails AS FD');
      $this->db->join('foodcategory AS FC','FD.FoodCategoryId = FC.FoodCategoryId','left');
      $this->db->where('FD.IsAvailable',0);

      $query = $this->db->get();
      return($query->result_array());
    }

    public function grabAllDeliveryModes()
    {
      //function grabs all delivery mb_encoding_aliases

      $this->db->select('*');
      $this->db->from('deliverydetails');

      $query = $this->db->get();
      return($query->result_array());
    }

    public function grabSelectedFood($foodCode)
    {
      $foodDetails = NULL;

      //function grabs details of a selected food

      $this->db->select('Id,FoodName,IsAvailable,FoodId,Price,DisplayImage');
      $this->db->from('fooddetails');
      $this->db->where('FoodId', $foodCode);

      //query Results

      $query = $this->db->get();
      $response = $query->row();

      $foodDetails['Id'] = $response->Id;
      $foodDetails['FoodName'] = $response->FoodName;
      $foodDetails['IsAvailable'] = $response->IsAvailable;
      $foodDetails['FoodId'] = $response->FoodId;
      $foodDetails['Price'] = $response->Price;
      $foodDetails['DisplayImage'] = $response->DisplayImage;

      return $foodDetails;
    }

    public function grabCartDetails($uniqueId)
    {
      /*
      * Function grabs all the items accociated with passed unique Id 
      */

      $this->db->select('*');

      $this->db->from('usercart');

      $this->db->where('CartId',$uniqueId);

      $query = $this->db->get();
      return($query->result_array());
    }

    public function getAvailability($foodCode)
    {
      //function checks the availabilty of a food

      $this->db->select('IsAvailable');
      $this->db->from('foodDetails');
      $this->db->where('FoodId', $foodCode);

      $query = $this->db->get();
      return($query->result_array());

    }

    public function grabAllMeatDetails()
    {
        //function fetches all the meats available
        $this->db->select('*');
        $this->db->from('meatdetails');
        $this->db->where('IsAvailable',0);

        $query = $this->db->get();

        return ($query->result_array());
    }

    public function grabAllSoupDetails()
    {
      //function fetches all the soup available

      $this->db->select('*');
      $this->db->from('soupdetails');
      $this->db->where('IsAvailable',0);

      $query = $this->db->get();

      return ($query->result_array());
    }

    public function getPrice($foodCode)
    {
      //function grabs prices of food based in its food codeigniter

      $this->db->select('*');
      $this->db->from('price');
      $this->db->where('FoodId',$foodCode);

      $query = $this->db->get();

      return ($query->result_array());
    }

    public function grabAllAddons()
    {
      //function grabs all addons in the database

      $this->db->select('*');
      $this->db->from('addondetails');

      $query = $this->db->get();
      return($query->result_array());
    }

    public function grabFoodPrice($priceId)
    {
      //function selects food Price based on the Price Id

      $this->db->select('Price');
      $this->db->from('price');
      $this->db->where('PriceId',$priceId);

      $query = $this->db->get();
      return($query->result_array());

    }

    public function grabAddonPrice($addonId)
    {
      //function returns price of addon

      $this->db->select('Price');
      $this->db->from('addondetails');
      $this->db->where('AddonId', $addonId);

      $query = $this->db->get();
      return($query->result_array());
    }

    public function grabDeliveryPrice($deliveryId)
    {
      //function returns delivery price for set Id

      $this->db->select('Price');
      $this->db->from('deliverydetails');
      $this->db->where('DeliveryId',$deliveryId);

      //result

      $query = $this->db->get();
      return($query->result_array());
    }



  }

 ?>
