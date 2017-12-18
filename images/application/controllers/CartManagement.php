<?php
	/**
	*	Class Manages every thing about cart. Constructor must initialize session because most of cart activities in the system is 
	*	controlled by sessions. Controller is tied with CartManagementModel
	*/

	class CartManagement extends CI_Controller
	{
		
		public function __construct()
		{
			parent::__construct();
	      	$this->load->helper('url');
	      	$this->load->helper('file');
	      	$this->load->library('session');

	      	//load models

	     	 $this->load->model('CartManagementModel');
		}

    	public function viewCart()
    	{
    		/**
    		*	Function opens new view for the cart. It displays all the Item the user has added to the cart using the 
    		* 	cartItem session array. It redirects to another page from the front end script
    		*/

    		//get unique Id

    		$uniqueId = $this->session->userdata('uniqueSessionId');

    		$data['cartDetails'] = $this->CartManagementModel->grabCartDetails($uniqueId);

    		$this->load->view('content/theme/cssBoilerPlate.php');
      		$this->load->view('content/theme/header.php',$data);
      		$this->load->view('content/Cart/index.php',$data);
      		$this->load->view('content/theme/footer.php');
    	}

    	public function viewAddToCart()
    	{
    		/** 
    		*	This function loads the add to cart modal. attached to it is the food Id. Intention is to use that 
    		*	opportunity to load all the cart at once to store in the table
    		*/	

    		$foodId = $this->input->get_post('foodId');
    		$data['foodId'] = $foodId;
    		$data['foodDetails'] = $this->CartManagementModel->grabFoodDetails($foodId);
    		$data['addonDetails'] = $this->CartManagementModel->grabAddons();
    		$data['sizeDetails'] = $this->CartManagementModel->grabFoodSizes();

    		//load modal view

    		$this->load->view('content/Cart/modal/viewAddToCart.php',$data);

    	}

    	public function addToCartTable()
    	{
    		/**
    		*	This is the cart session control point where ordered item is added to the cart table. A lot of data pull also happens to validate the data entered and pull relevant data from the database
    		*/

    		// setting variable to receive ajax post data

    		$foodId = $this->input->post('foodId');
    		$addonId = $this->input->post('addonId');
    		$sizeId= $this->input->post('sizeId');
    		$quantity = $this->input->post('quantity');

    		//start validating data gotten from front end

    		if(!$foodId || $quantity <= 0 || is_numeric($quantity) == FALSE)
    		{
    			//0 here means error in input value

    			echo '0';
    		}
    		else
    		{
    			//start getting a data from the database to fill the cart table
    			
    			//get foodPrice based on size. Declared an associative array to auto pick size

    			$keyword = array(1=>'Price',2=>'LargePrice');

    			//get food Price by sending foodid and clause as an argument. Name would also be included in the 

    			$foodPrice = $this->CartManagementModel->grabFoodPrice($foodId,$keyword[$sizeId]);

    			//get addon price and name 

    			$addonPrice = $this->CartManagementModel->grabAddonPrice($addonId);

    			//validate data to make sure there is no null value received.

    			if(!$foodPrice)
    			{
    				//One here means no food Id or ID matches

    				echo '1';
    			}
    			else
    			{
    				/**
    				*	//////Start of Cart Engineering ////////
    				*	Intenttion is to put all data into the cart. Cart order would be based off this session
    				*	To ensure accuracy in SESSION data, sessionid and IP address would be used as identifier in the cart table
    				*	This would be encrypted with md5 PHP hash just to keep the data significant. This is done when user opens the cart
    				*/

    				//get session ID

    				$uniqueId = $this->session->userdata('uniqueSessionId');

    				// compute Total Cost

    				$totalFoodPrice = $foodPrice['FoodPrice'] * $quantity;
    				$totalCost = $totalFoodPrice + $addonPrice['Price'];

    				$cartArray = array('CartId'=>$uniqueId,'FoodId'=>$foodId,'FoodName'=>$foodPrice['FoodName'],'FoodPrice'=>$foodPrice['FoodPrice'],'AddonName'=>$addonPrice['AddonName'],'AddonPrice'=>$addonPrice['Price'],'FoodSize'=>$sizeId,'DisplayImage'=>$foodPrice['DisplayImage'],'Quantity'=>$quantity,'RecordDisabled'=>0,'TotalCost'=>$totalCost);

    				//insert data into cart

    				$this->CartManagementModel->insertIntoCart($cartArray);
    				echo count($this->CartManagementModel->grabCartDetails($uniqueId));

    			}


    		}
    	}


	}
	// End of class
?>