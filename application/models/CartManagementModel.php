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
	      $this->db->where('RecordDisabled',0);

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

	      $this->db->select('FD.FoodId,FD.FoodName,FD.FoodStart,FD.VendorId,FD.FoodCategoryId,FD.Description,FD.DisplayImage,');

	      $this->db->from('fooddetails AS FD');
	      $this->db->join('foodprice AS FP','FD.FoodId = FP.FoodId','left');

	      //clauses

	      $this->db->where('FD.FoodId',$foodId);
	      $this->db->where('FD.IsAvailable',0);

	      //get result

	      $query = $this->db->get();

	      if($query->num_rows() > 0)
	      {
	        $response = $query->row();

	        //pushing data objects into object variable

	        $foodDetails['FoodId'] = $response->FoodId;
	        $foodDetails['FoodName'] = $response->FoodName;
	        $foodDetails['FoodStart'] = $response->FoodStart;
	        $foodDetails['FoodCategoryId'] = $response->FoodCategoryId;
	        $foodDetails['Description'] = $response->Description;
	        $foodDetails['DisplayImage'] = $response->DisplayImage;
	        $foodDetails['VendorId'] = $response->VendorId;
 
	      }
	      
	      return $foodDetails;
	    }

	    public function grabAddons($vendorId)
	    {
	    	
	    	/**
	    	*	Function grabs all addons in the addon table. It will be loaded to the to the cart selector.
	    	*/

	    	//start of query

	    	$this->db->select('AddonId,AddonName,Price,VendorId,IsAvailable');

	    	$this->db->from('addondetails');

	    	$this->db->where('IsAvailable',0);
	    	$this->db->where('VendorId',$vendorId);

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
			$this->db->where('FoodSizeId',1);

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

	    	$this->db->select($keyword);

	    	$this->db->from('foodprice');

	    	$this->db->where('FoodId',$foodId);

	    	//fetch data

	    	$query = $this->db->get();

	    	if($query->num_rows() > 0)
	    	{
	    		$response = $query->row();

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

	    public function updateCart($tableName,$cartId,$data)
	    {
	    	/**
	    	*	Function updates cart 
	    	*/

	    	$this->db->where('OrderId',$cartId);
	    	$this->db->update($tableName,$data);
	    }

	    public function updateCartForPurchase($cartId,$data)
	    {
	    	$this->db->where('CartId',$cartId);
	    	$this->db->where('RecordDisabled',0);

	    	$this->db->update('usercart',$data);
	    }

	    public function grabAllMeat($vendorId)
	    {
	    	/**
	    	*	Function grabs all meat in stock
	    	*/

	    	$this->db->select('MeatId,MeatName,Meatprice,DisplayPicture');

	    	$this->db->from('meatdetails');

	    	$this->db->where('RecordDisabled',0);
	    	$this->db->order_by('MeatId','DESC');
	    	$this->db->where('VendorId',$vendorId);

	    	$query = $this->db->get();

	    	return($query->result_array());
	    }


	    public function grabMeatPrice($meatId)
	    {
	    	/**
	    	*	Function grabs price of meat and respond as an array object
	    	*/

	    	$meatDetails = NULL;

	    	$this->db->select('MeatId,MeatName,MeatPrice,DisplayPicture');

	    	$this->db->from('meatdetails');

	    	$this->db->where('MeatId',$meatId);
	    	$this->db->limit(1);

	    	$query = $this->db->get();

	    	if($query->num_rows() > 0)
	    	{
	    		$response = $query->row();

	    		$meatDetails['MeatId'] = $response->MeatId;
	    		$meatDetails['MeatName'] = $response->MeatName;
	    		$meatDetails['MeatPrice'] = $response->MeatPrice;
	    		$meatDetails['DisplayPicture'] = $response->DisplayPicture;

	    	}
	    	return $meatDetails;

	    }


	// End of class		
	}

?>