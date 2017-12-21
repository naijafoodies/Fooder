<?php
	/**
	*	Class controls database inflow and outflow of cart data. it is mainly tied with CartManagementController
	*/

	class CartManagementModel extends CI_Model
	{
		
		public function __construct()
		{
			parent::__construct();

			//load database

			$this->load->database();
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

		public function grabAllAddons()
    	{
      		//function grabs all addons in the database

      		$this->db->select('*');
      		$this->db->from('addondetails');

      		$this->db->where('IsAvailable',0);

      		$query = $this->db->get();
      		return($query->result_array());
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

	    public function grabAddons()
	    {
	    	/**
	    	*	Function grabs all addons in the addon table. It will be loaded to the to the cart selector.
	    	*/

	    	//start of query

	    	$this->db->select('AddonId,AddonName,Price,IsAvailable');

	    	$this->db->from('addondetails');
	    	$this->db->where('IsAvailable',0);

	    	$query = $this->db->get();

	    	//return query as an array 
	    	return($query->result_array());

	    }

	    public function grabFoodSizes()
	    {
	    	/**
			*	Function grabs all the food Sizes in the foodsize table. Query is returned as an array
			*/

			$this->db->select('FoodSizeId,FoodSizeName');
			$this->db->from('foodsize');

			$this->db->where('RecordDisabled',0);

			$query = $this->db->get();

			//return query as an array
			return($query->result_array());
	    }

	    public function grabFoodPrice($foodId,$keyword)
	    {
	    	/**
	    	* Function grabs food price based on the foodId and keyword provided. The keyword is where to look in the database or data to fetch in the table. Data is returned as an object not an array
	    	*/

	    	//declare object variable

	    	$priceDetails = NULL;

	    	$this->db->select('FoodName,DisplayImage,'.$keyword.'');

	    	$this->db->from('fooddetails');

	    	$this->db->where('FoodId',$foodId);

	    	//fetch data

	    	$query = $this->db->get();

	    	if($query->num_rows() > 0)
	    	{
	    		$response = $query->row();

	    		$priceDetails['FoodName'] = $response->FoodName;
	    		$priceDetails['DisplayImage'] = $response->DisplayImage;
	    		$priceDetails['FoodPrice'] = $response->$keyword;
	    	}

	    	return $priceDetails;
	    }

	    public function grabAddonPrice($addonId)
	    {
	    	/**
	    	*	Function grabs addon name and price for the specific addon Id argumane tpassed from the controller. Response is an array object
	    	*/

	    	//declare object variable

	    	$addonDetails = NULL;

	    	$this->db->select('AddonName,Price');

	    	$this->db->from('addondetails');

	    	$this->db->where('AddonId',$addonId);

	    	//fetch data

	    	$query = $this->db->get();

	    	if($query->num_rows() > 0)
	    	{
	    		$response = $query->row();

	    		$addonDetails['AddonName'] = $response->AddonName;
	    		$addonDetails['Price'] = $response->Price;
	    	}

	    	return $addonDetails;
	    }

	    public function insertIntoCart($data)
	    {
	    	$this->db->insert('usercart',$data);
	    }


	// End of class		
	}

?>