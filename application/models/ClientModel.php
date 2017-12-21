<?php
	
	/**
	* 
	*/
	class ClientModel extends CI_Model
	{
		
		public function __construct()
		{
			parent::__construct();

			$this->load->database();
		}

		public function updateOrder($orderId,$data)
		{
			$this->db->where('OrderId',$orderId);
			$this->db->update('orders',$data);
		}

		public function grabUserData($userName)
		{
			// function fetches user data and return them as an array object

			//object declaration 

			$userDetails = NULL;

			$this->db->select('ClientId,Password');
			$this->db->from('clients');

			$this->db->where('Username',$userName);
			$this->db->where('RecordDisabled',0);

			$query = $this->db->get();

			if($query->num_rows() > 0)
			{
				$response = $query->row();

				$userDetails['ClientId'] = $response->ClientId;
				$userDetails['Password'] = $response->Password;
			}

			return $userDetails;
		}

		public function updateClientPassword($tableName,$clause,$data)
		{
			$this->db->where('ClientId',$clause);
			$this->db->update($tableName,$data);
		}

		public function grabUserInformation($clientId)
		{
			/*
			*	Function  grabs infomation of user base on the id and returns as an object
			*/

			$userDetails = NULL;

			$this->db->select('Username,ClientName');

			$this->db->from('clients');

			//clauses

			$this->db->where('ClientId',$clientId);

			$query = $this->db->get();

			if($query->num_rows() > 0)
			{
				$response = $query->row();

				$userDetails['Username'] = $response->Username;
				$userDetails['ClientName'] = $response->ClientName;
			}

			return $userDetails;
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

	    public function grabOrderDetails($clientId,$orderId)
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

			$this->db->where('O.OrderId',$orderId);
			$this->db->where('O.AssignedTo',$clientId);

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

		public function grabFulfilmentStages()
		{
			//Func grabs all the fulfilment stages available

			$this->db->select('StageId,StageName');

			$this->db->from('fulfilmentstage');

			$this->db->where('RecordDisabled',0);

			$query = $this->db->get();

			return($query->result_array());
		}

		// End of modal 
	}

?>