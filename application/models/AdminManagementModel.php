<?php
	
	/**
	* 
	*/
	class AdminManagementModel extends CI_Model
	{
		
		public function __construct()
		{
			parent::__construct();

			$this->load->database();
		}


		//////////////////////////////////////////////////////////////
		//							Admin Utitlities				//
		/////////////////////////////////////////////////////////////

		public function insertIntoTable($tableName,$data)
		{
			$this->db->insert($tableName,$data);
			
			return $this->db->insert_id();
		}

		public function updateFoodInventory($clause,$data)
		{
			$this->db->where('FoodId',$clause);
			$this->db->update('fooddetails',$data);
		}

		public function updateFoodPrice($clause,$data)
		{
			$this->db->where('FoodId',$clause);
			$this->db->update('foodprice',$data);
		}

		public function updateOrder($tableName,$clause,$data)
		{
			$this->db->where('OrderId',$clause);
			$this->db->update($tableName,$data);
		}

		// Meat Utitlities

		public function updateMeat($clause,$data)
		{
			$this->db->where('MeatId',$clause);
			$this->db->update('meatdetails',$data);
		}

		///////////////////////////////////////////////////////////////
		//					Login Section 							//
		//////////////////////////////////////////////////////////////

		public function grabUserData($userName)
		{
			// function fetches user data and return them as an array object

			//object declaration 

			$userDetails = NULL;

			$this->db->select('AdminId,Password');
			$this->db->from('adminusers');

			$this->db->where('Username',$userName);
			$this->db->where('RecordDisabled',0);

			$query = $this->db->get();

			if($query->num_rows() > 0)
			{
				$response = $query->row();

				$userDetails['AdminId'] = $response->AdminId;
				$userDetails['Password'] = $response->Password;
			}

			return $userDetails;
		}

		public function updateAdminPassword($tableName,$clause,$data)
		{
			$this->db->where('AdminId',$clause);
			$this->db->update($tableName,$data);
		}

		public function grabUserInformation($adminId)
		{
			/*
			*	Function  grabs infomation of user base on the id and returns as an object
			*/

			$userDetails = NULL;

			$this->db->select('FirstName,LastName,Email,PositionId,PermissionId,RecordDisabled,Address1,City,StateCode,ZipCode,Username');

			$this->db->from('adminusers');

			//clauses

			$this->db->where('AdminId',$adminId);

			$query = $this->db->get();

			if($query->num_rows() > 0)
			{
				$response = $query->row();

				$userDetails['FirstName'] = $response->FirstName;
				$userDetails['LastName'] = $response->LastName;
				$userDetails['Email'] = $response->Email;
				$userDetails['PositionId'] = $response->PositionId;
				$userDetails['PermissionId'] = $response->PermissionId;
				$userDetails['RecordDisabled'] = $response->RecordDisabled;
				$userDetails['Address1'] = $response->Address1;
				$userDetails['City'] = $response->City;
				$userDetails['StateCode'] = $response->StateCode;
				$userDetails['ZipCode'] = $response->ZipCode;
				$userDetails['Username'] = $response->Username;
			}
			return $userDetails;
		}


		////////////////////////////////////////////////////////////////////////////////////////////
		//							Order section 												//
		///////////////////////////////////////////////////////////////////////////////////////////

		public function grabOrderDetails($orderId)
		{
			/* 
			*	Function grab all Information about an order being placed and returns data in object
			*/

			$orderDetails = NULL;

			$this->db->select('O.OrderId,O.UniqueCartId,O.DeliveryMode,O.RecordDisabled,O.IsFulfilled,O.FulfilmentStage,O.OrderedBy,O.ShippingName,O.ShippingAddress,O.ShippingZip,O.ShippingState,O.ShippingCity,O.ShippingCountry,O.EmailAddress,O.OrderCost,O.Phone,O.AssignedTo,O.AssignedBy,FS.StageName,C.ClientName,AU.Username');

			$this->db->from('orders AS O');
			$this->db->join('fulfilmentstage AS FS','O.FulfilmentStage = FS.StageId','left');
			$this->db->join('clients AS C','O.AssignedTo = C.ClientId','left');
			$this->db->join('adminusers AS AU','O.AssignedBy = AU.AdminId','left');

			$this->db->where('OrderId',$orderId);

			$query = $this->db->get();

			if($query->num_rows() > 0)
			{
				$response = $query->row();

				$orderDetails['OrderId'] = $response->OrderId;
				$orderDetails['UniqueCartId'] = $response->UniqueCartId;
				$orderDetails['UniqueCartId'] = $response->UniqueCartId;
				$orderDetails['DeliveryMode'] = $response->DeliveryMode;
				$orderDetails['RecordDisabled'] = $response->RecordDisabled;
				$orderDetails['IsFulfilled'] = $response->IsFulfilled;
				$orderDetails['FulfilmentStage'] = $response->FulfilmentStage;
				$orderDetails['ShippingName'] = $response->ShippingName;
				$orderDetails['ShippingAddress'] = $response->ShippingAddress;
				$orderDetails['ShippingZip'] = $response->ShippingZip;
				$orderDetails['ShippingState'] = $response->ShippingState;
				$orderDetails['ShippingCity'] = $response->ShippingCity;
				$orderDetails['ShippingCountry'] = $response->ShippingCountry;
				$orderDetails['EmailAddress'] = $response->EmailAddress;
				$orderDetails['OrderCost'] = $response->OrderCost;
				$orderDetails['Phone'] = $response->Phone;
				$orderDetails['AssignedTo'] = $response->AssignedTo;
				$orderDetails['StageName'] = $response->StageName;
				$orderDetails['ClientName'] = $response->ClientName;
				$orderDetails['AssignedBy'] = $response->AssignedBy;
				$orderDetails['Username'] = $response->Username;

			}

			return $orderDetails;
		}

		public function grabOrderItems($uniqueId)
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

	    public function grabClientList()
	    {
	    	/**
	    	*	Function grabs all clients 
	    	*/

	    	$this->db->select('ClientId,Username,ClientName');
	    	$this->db->from('clients');

	    	$this->db->where('RecordDisabled',0);

	    	$query = $this->db->get();
	    	return($query->result_array());
	    }


	    public function grabClientDetails($clientId)
	    {	
	    	/* 
			*	Function fetches the details of a specific client and returns data as an object
			*/

			$clientData = NULL;

			$this->db->select('ClientId,Username,ClientName,Email');
			$this->db->from('clients');

			$this->db->where('ClientId',$clientId);

			$query = $this->db->get();

			if($query->num_rows() > 0)
			{
				$response = $query->row();

				$clientData['ClientId'] = $response->ClientId;
				$clientData['Username'] = $response->Username;
				$clientData['ClientName'] = $response->ClientName;
				$clientData['Email'] = $response->Email;

			}

			return $clientData;

	    }


	    public function grabAttachedOrders($adminId)
	    {
	    	/**
	    	*	Function grabs all the orders that have been assigned to you
	    	*/

	    	$this->db->select('OrderId,UniqueCartId,DeliveryMode,IsFulfilled,FulfilmentStage,OrderedBy');

	    	$this->db->from('orders');

	    	$this->db->where('AssignedBy',$adminId);

	    	$query = $this->db->get();
	    	return($query->result_array());
	    }

	    public function grabAllDayUnfulfilledOrders()
	    {
	    	/**
	    	*	Function grabs all unfulfilled for the day
	    	*/

	    	$this->db->select('O.OrderId,O.UniqueCartId,O.DeliveryMode,O.FulfilmentStage,O.OrderedBy,FS.StageName,DD.DeliveryPrice');

	    	$this->db->from('orders AS O');
	    	$this->db->join('fulfilmentstage AS FS','O.FulfilmentStage = FS.StageId','left');
	    	$this->db->join('deliverydetails AS DD','O.DeliveryMode = DD.DeliveryId','left');

	    	$this->db->where('O.RecordDisabled',0);
	    	$this->db->where('O.FulfilmentStage <>',5);
	    	$this->db->where('O.OrderedBy BETWEEN "'.date('Y-m-d 13:00:00',strtotime("-1 days")).'" AND "'.date('Y-m-d 13:00:00').'"', NULL, FALSE);
	    	$this->db->where('O.IsFulfilled',0);

	    	$query = $this->db->get();
	    	return($query->result_array());
	    }


	    public function grabAllDayFulfilledOrders()
	    {
	    	/**
	    	*	Function grabs all fulfilled for the day
	    	*/

	    	$clause = array('O.OrderedBy >='=>date('Y-m-d 00:00:00'),'O.IsFulfilled'=>1);

	    	$this->db->select('O.OrderId,O.UniqueCartId,O.DeliveryMode,O.FulfilmentStage,O.OrderedBy,FS.StageName,DD.DeliveryPrice');

	    	$this->db->from('orders AS O');
	    	$this->db->join('fulfilmentstage AS FS','O.FulfilmentStage = FS.StageId','left');
	    	$this->db->join('deliverydetails AS DD','O.DeliveryMode = DD.DeliveryId','left');

	    	$this->db->where('O.RecordDisabled',0);
	    	$this->db->where('O.FulfilmentStage',4);
	    	$this->db->where($clause);

	    	$query = $this->db->get();
	    	return($query->result_array());
	    }



	    public function grabAllDayOrder()
	    {
	    	/**
	    	*	Function grabs all fulfilled for the day
	    	*/

	    	$this->db->select('O.OrderId,O.UniqueCartId,O.DeliveryMode,O.FulfilmentStage,O.OrderedBy,FS.StageName,DD.DeliveryPrice');

	    	$this->db->from('orders AS O');
	    	$this->db->join('fulfilmentstage AS FS','O.FulfilmentStage = FS.StageId','left');
	    	$this->db->join('deliverydetails AS DD','O.DeliveryMode = DD.DeliveryId','left');

	    	$this->db->where('O.RecordDisabled',0);
	    	$this->db->where('O.OrderedBy BETWEEN "'.date('Y-m-d 13:00:00',strtotime("-1 days")).'" AND "'.date('Y-m-d 23:59:59').'"', NULL, FALSE);

	    	$query = $this->db->get();
	    	return($query->result_array());
	    }

	    public function grabUnassignedOrder()
	    {
	    	$clause = array('O.OrderedBy >='=>date('Y-m-d 00:00:00'),'O.OrderedBy <'=>date('Y-m-d 23:59:59'));

	    	$this->db->select('O.OrderId,O.UniqueCartId,O.DeliveryMode,O.FulfilmentStage,O.OrderedBy,FS.StageName,DD.DeliveryPrice');

	    	$this->db->from('orders AS O');
	    	$this->db->join('fulfilmentstage AS FS','O.FulfilmentStage = FS.StageId','left');
	    	$this->db->join('deliverydetails AS DD','O.DeliveryMode = DD.DeliveryId','left');

	    	$this->db->where('O.RecordDisabled',0);
	    	$this->db->where('O.AssignedBy IS NULL',NULL,FALSE);
	    	$this->db->where($clause);

	    	$query = $this->db->get();
	    	return($query->result_array());
	    }



	    //////////////////////////////////////////////////////////////////////////////
	    //						Food Management Section 							//
	    //////////////////////////////////////////////////////////////////////////////

	    public function grabAllFood()
	    {
	    	/**
	    	*	Function grabs all food in the table
	    	*/

	    	$this->db->select('FD.FoodId,FD.FoodName,FD.IsAvailable,FD.FoodStart,FD.FoodCategoryId,FD.Description,FD.DisplayImage,FC.FoodCategoryId,FC.CategoryName,FP.Regular,FP.HalfTray,FP.FullTray,C.ClientName');

	    	$this->db->from('fooddetails AS FD');

	    	$this->db->join('foodcategory AS FC','FD.FoodCategoryId = FC.FoodCategoryId','left');
	    	$this->db->join('foodprice AS FP','FD.FoodId = FP.FoodId','left');
	    	$this->db->join('clients AS C','FD.VendorId = C.ClientId','left');

	    	$this->db->where('FD.RecordDisabled',0);
	    	$this->db->order_by('FD.FoodName','ASC');

	    	$query = $this->db->get();
	    	return($query->result_array());
	    }

	    public function grabSpecificFood($foodId)
	    {
	      /**
	      * Function returns all the details of the specific food Id passed to it. It either returns details or a NULL value
	      * result of query is converting to php object to be able to access each data individually
	      */

	      //declare object variable as Null

	      $foodDetails = NULL;

	      $this->db->select('FD.FoodId,FD.FoodName,FD.FoodStart,FD.FoodCategoryId,FD.FoodOriginId,FD.IsAvailable,FD.Description,FD.DisplayImage,FD.VendorId,FP.Regular,FP.HalfTray,FP.FullTray,FC.CategoryName');

	      $this->db->from('fooddetails AS FD');
	      $this->db->join('foodprice AS FP','FD.FoodId = FP.FoodId','left');
	      $this->db->join('foodcategory AS FC','FD.FoodCategoryId = FC.FoodCategoryId','left');

	      //clauses

	      $this->db->where('FD.FoodId',$foodId);
	      $this->db->where('FD.RecordDisabled',0);

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
	        $foodDetails['FoodOriginId'] = $response->FoodOriginId;
	        $foodDetails['IsAvailable'] = $response->IsAvailable;
	        $foodDetails['Description'] = $response->Description;
	        $foodDetails['DisplayImage'] = $response->DisplayImage;
	        $foodDetails['VendorId'] = $response->VendorId;
	        $foodDetails['Regular'] = $response->Regular;
	        $foodDetails['HalfTray'] = $response->HalfTray;
	        $foodDetails['FullTray'] = $response->FullTray;
	        $foodDetails['CategoryName'] = $response->CategoryName;

	      }

	      return $foodDetails;

	    }

	    public function grabAllFoodCategory()
	    {
	    	/**
	    	*	Function grabs all food category
	    	*/

	    	$this->db->select('FoodCategoryId,CategoryName');
	    	$this->db->from('foodcategory');

	    	$this->db->where('RecordDisabled',0);

	    	$query = $this->db->get();

	    	return($query->result_array());

	    }

	    public function grabFoodOrigin()
	    {
	    	/**
	    	*	Function grabs all food origin in the database
	    	*/

	    	$this->db->select('FoodOriginId,OriginName');

	    	$this->db->from('foodorigin');

	    	$this->db->where('RecordDisabled',0);

	    	$query = $this->db->get();
	    	return($query->result_array());
	    }


	    //////////////////////////////////////////////////////////////////////
	    // 						Meat Management section 					//
	    //////////////////////////////////////////////////////////////////////

	    public function grabAllMeatDetails()
	    {
	    	/**
	    	*	Function grabs all meat details in the table
	    	*/

	    	$this->db->select('MD.MeatId,MD.MeatName,MD.MeatPrice,MD.VendorId,MD.IsAvailable,C.ClientName');

	    	$this->db->from('meatdetails AS MD');

	    	$this->db->join('clients AS C','MD.VendorId = C.ClientId','left');

	    	$this->db->where('MD.RecordDisabled',0);
	    	$this->db->where('MD.MeatName<>','None of these');

	    	$this->db->order_by('MD.MeatName','ASC');

	    	//get result

	    	$query = $this->db->get();
	    	return($query->result_array());
	    }

	    public function grabSpecificMeatDetails($meatId)
	    {
	    	/**
	    	*	Function grabs specific meat details and returns array object
	    	*/

	    	$meatDetails = NULL;

	    	$this->db->select('MeatId,MeatName,MeatPrice,VendorId,IsAvailable');

	    	$this->db->from('meatdetails');

	    	$this->db->where('MeatId',$meatId);

	    	//get result

	    	$query = $this->db->get();

	    	if($query->num_rows() > 0)
	    	{
	    		$response = $query->row();

	    		$meatDetails['MeatId'] = $response->MeatId;
	    		$meatDetails['MeatName'] = $response->MeatName;
	    		$meatDetails['MeatPrice'] = $response->MeatPrice;
	    		$meatDetails['VendorId'] = $response->VendorId;
	    		$meatDetails['IsAvailable'] = $response->IsAvailable;
	    	}

	    	return $meatDetails;
	    }


	    ////////////////////////////////////////////////////////////
	    // 			Delivery management Section       			  //
	    ///////////////////////////////////////////////////////////

	    public function grabAllDeliveryDetails()
	    {
	    	/**
	    	*	Function grabs all the delivery details in the database
	    	*/

	    	$this->db->select('DeliveryId,DeliveryCityName,DeliveryPrice,RecordDisabled,AuditDate,AuditUser');

	    	$this->db->from('deliverydetails');

	    	$this->db->where('DeliveryCityName<>','PickUp');

	    	//get results

	    	$query = $this->db->get();
	    	return($query->result_array());
	    }

	    public function updateDeliveryCity($clause,$data)
	    {
	    	/**
	    	*	Function performs updates for delivery table
	    	*/

	    	$this->db->where('DeliveryId',$clause);
	    	$this->db->update('deliverydetails',$data);
	    }

	    public function grabSpecificCityDetails($cityId)
	    {
	    	/**
	    	*	function grabs all city details and returns as an array object
	    	*/

	    	$cityDetails = NULL;

	    	$this->db->select('DeliveryId,DeliveryCityName,DeliveryPrice,RecordDisabled,AuditDate,AuditUser');

	    	$this->db->from('deliverydetails');

	    	$this->db->where('DeliveryId',$cityId);

	    	//get results

	    	$query = $this->db->get();

	    	if($query->num_rows() > 0)
	    	{
	    		$response = $query->row();

	    		$cityDetails['DeliveryId'] = $response->DeliveryId;
	    		$cityDetails['DeliveryCityName'] = $response->DeliveryCityName;
	    		$cityDetails['DeliveryPrice'] = $response->DeliveryPrice;
	    		$cityDetails['RecordDisabled'] = $response->RecordDisabled;
	    		$cityDetails['AuditDate'] = $response->AuditDate;
	    		$cityDetails['AuditUser'] = $response->AuditUser;

	    	}

	    	return $cityDetails;
	    }




	    //////////////////////////////////////////////////////////////////////////
	    //							Addon Management 							//
	    /////////////////////////////////////////////////////////////////////////

	    public function grabAllAddon()
	    {
	    	$this->db->select('AD.AddonId,AD.AddonName,AD.Price,AD.VendorId,AD.IsAvailable,C.ClientId,C.ClientName');

	    	$this->db->from('addondetails AS AD');

	    	$this->db->join('clients AS C','AD.VendorId = C.ClientId','left');

	    	$this->db->where('AD.AddonName <>','None of these');

	    	$this->db->order_by('AddonName','ASC');

	    	$query = $this->db->get();
	    	return($query->result_array());

	    }

	    public function grabSpecificAddon($addonId)
	    {
	    	$addonDetails = NULL;

			$this->db->select('AddonId,AddonName,Price,VendorId,IsAvailable');

			$this->db->from('addondetails');

			$this->db->where('AddonId',$addonId);
			$this->db->where('IsAvailable',0);

			$query = $this->db->get();

			if($query->num_rows() > 0)
			{
				$response = $query->row();

				$addonDetails['AddonId'] = $response->AddonId;
				$addonDetails['AddonName'] = $response->AddonName;
				$addonDetails['Price'] = $response->Price;
				$addonDetails['VendorId'] = $response->VendorId;
				$addonDetails['IsAvailable'] = $response->IsAvailable;
			}

			return $addonDetails;
	    }

	    public function updateAddonTable($addonId,$data)
	    {
	    	$this->db->where('AddonId',$addonId);
	    	$this->db->update('addondetails',$data);
	    }



		// End of modal 
	}

?>