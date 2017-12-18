<?php

	/**
	* 
	*/
	class HomeModel extends CI_Model
	{
		
		public function __construct()
		{
			parent::__construct();
		}

		public function pullFoodOrigin()
		{
			$originDetails = array();

			$this->db->select('FoodOriginId,OriginName');
			$this->db->from('foodorigin');

			$this->db->where('RecordDisabled',0);

			$query = $this->db->get();

			foreach($query->result_array() AS $response)
			{
				$originDetails[] = array(

					"OriginId" => $response['FoodOriginId'],
					"OriginName" => $response['OriginName'],
				);
			}

			return $originDetails;

		}
	}



?>