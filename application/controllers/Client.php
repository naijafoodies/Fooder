<?php 
	/**
	* Class manages admin activities
	*/
	class Client extends CI_Controller
	{
		
		public function __construct()
		{
			parent::__construct();
	      	$this->load->helper('url');
	      	$this->load->helper('file');
	      	$this->load->helper('security');

	      	$this->load->library('session');

	      	//load models

	     	 $this->load->model('ClientModel');
		}

		public function index()
		{
			/**
			*	Function is the entry point for the admin
			*/

			if(!$this->session->has_userdata('clientId'))
			{
				// loads login panel if session do not exist

				$this->load->view('content/theme/cssBoilerPlate.php');
	      		$this->load->view('content/Client/index.php');
	      		$this->load->view('content/theme/footer.php');
			}
			else
			{
				//loads admin console 

				$clientId = $this->session->userdata('clientId');

				$data['userData'] = $this->ClientModel->grabUserInformation($clientId);

				$this->load->view('content/theme/cssBoilerPlate.php');
	      		$this->load->view('content/theme/clientHeader.php',$data);
	      		$this->load->view('content/Client/console/index.php',$data);
	      		$this->load->view('content/theme/footer.php');
			}
			
		}

		public function validateLogin()
		{
			/**
			*	Function validates admin data. Processes it and sought new user, wrong data validation. If successful, it loads console
			*/

			$username = $this->security->xss_clean($this->input->post('username'));
			$password = $this->security->xss_clean($this->input->post('password'));


			$userData = $this->ClientModel->grabUserData($username);


			if($userData)
			{
				if($userData['Password'] == 'server1' && $password == 'server1')
				{
					//returns 1 if password has not been saved yet. loads update password

					$data['clientId'] = $userData['ClientId'];	

					//load update password view

					$this->load->view('content/Client/modal/login/updatePassword.php',$data);
					
				}
				else if(password_verify($password,$userData['Password']))
				{
					//login is valid

					//prepare session 

					$sessionData = array('clientId'=>$userData['ClientId']);
					$this->session->set_userdata($sessionData);

					echo 2;
				}
				else
				{
					//username exist but wrong password

					echo 1;
				}
			}
			else
			{
				//username does not exist at all

				echo 0;
			}

		}

		public function updatePassword()
		{
			$password = $this->input->post('password');
			$vPassword = $this->input->post('verifyPassword');
			$clientId = $this->input->post('clientId');

			echo $password. ' '. $vPassword;

			$dateNow = date('Y-m-d H:i:s');

			if($password != $vPassword)
			{
				echo '1';
			}
			else
			{
				$newPassword = password_hash($password,PASSWORD_DEFAULT);

				$updateData = array('Password'=>$newPassword,'AuditedBy'=>$clientId,'AuditDate'=>$dateNow);

				$response = $this->ClientModel->updateClientPassword('clients',$clientId,$updateData);
			}
		}

		public function mainConsole()
		{
			if($this->session->has_userdata('clientId'))
			{
				$clientId = $this->session->userdata('clientId');

				$data['userData'] = $this->ClientModel->grabUserInformation($clientId);

				$this->load->view('content/theme/cssBoilerPlate.php');
	      		$this->load->view('content/theme/clientHeader.php',$data);
	      		$this->load->view('content/Client/console/index.php',$data);
	      		$this->load->view('content/theme/footer.php');
			}
			else
			{
				redirect('/Client/');
			}
		}

		public function manageOrder()
		{
			/*
			*	Function grabs all information about an order
			*/

			$keyword = $this->input->post('keyword');

			$data['orderDetails'] = $this->ClientModel->grabOrderDetails($keyword);

			//get all order associated with unique Id

			$data['orderItems'] = $this->ClientModel->grabOrderItems($data['orderDetails']['UniqueCartId']); 

			$this->load->view('content/Client/ordermanagement/index.php',$data);
		}


		public function grabOrderDetails()
		{
			/** 
			*	Function fetches the details of on order
			*/

			//get keyword param

			$orderId = $this->security->xss_clean($this->input->post('keyword'));
			$clientId = $this->session->userdata('clientId');

			//get order Details

			$data['orderDetails'] = $this->ClientModel->grabOrderDetails($clientId,$orderId);

			//get all order associated with unique Id

			$data['orderItems'] = $this->ClientModel->grabOrderItems($data['orderDetails']['UniqueCartId']);
			$data['orderStatus'] = $this->ClientModel->grabFulfilmentStages();

			$this->load->view('content/Client/orderManagement/index.php',$data);
		}

		public function updateOrderStatus()
		{
			// updates order Status

			$orderId = $this->input->post('orderId');
			$status = $this->input->post('status');

			$dateNow = date('Y-m-d H:i:s');


			//@michael todo, notify when an order is fulfilled

			if($status == 4)
			{
				$updateData = array('IsFulfilled'=>1,'FulfilmentStage'=>$status,'DateFulfilled'=>$dateNow);
			}
			else
			{
				$updateData = array('FulfilmentStage'=>$status);
			}

			$this->ClientModel->updateOrder($orderId,$updateData);
		}



		// End of Admin controller
	}


?>