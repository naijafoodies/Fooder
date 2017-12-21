

<?php
	

	/**
	* This is the home page of naija foodies.
	*/


	class Home extends CI_Controller
	{
		
		public function __construct()
		{
			parent::__construct();

			//load libraries

			$this->load->helper('url');

			//libraries

			$this->load->library('session');

			$this->load->model('FoodDisplayModel');
			$this->load->model('HomeModel');

		}

		public function index()
		{

			//load Model

	      	$uniqueSessionId = $this->session->userdata('uniqueSessionId');

	      	$data['cartDetails'] = $this->FoodDisplayModel->grabCartDetails($uniqueSessionId);

	        //load views

	        $this->load->view('content/Home/headerfiles/homecssstructure.php');
	        $this->load->view('content/Home/headerfiles/homeheader.php',$data);
	        $this->load->view('content/Home/bodyfiles/index.php');
	        $this->load->view('content/Home/footerfiles/homefooterstructure.php');

		}

		public function getFoodOrigins()
		{

			$data['origins'] = $this->HomeModel->pullFoodOrigin();

			echo json_encode($data);
		}



	}

?>