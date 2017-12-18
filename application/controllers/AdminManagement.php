<?php 
	/**
	* Class manages admin activities
	*/
	class AdminManagement extends CI_Controller
	{
		
		public function __construct()
		{
			parent::__construct();
	      	$this->load->helper('url');
	      	$this->load->helper('file');
	      	$this->load->helper('security');

	      	$this->load->library('session');
	      	$this->load->library('email');

	      	//load models

	     	 $this->load->model('AdminManagementModel');
		}

		public function index()
		{
			/**
			*	Function is the entry point for the admin
			*/

			if(!$this->session->has_userdata('adminId'))
			{
				// loads login panel if session do not exist

				$this->load->view('content/theme/cssBoilerPlate.php');
	      		$this->load->view('content/Admin/index.php');
	      		$this->load->view('content/theme/footer.php');
			}
			else
			{
				//loads admin console 

				redirect('/AdminManagement/mainConsole');
			}
			
		}

		public function validateLogin()
		{
			/**
			*	Function validates admin data. Processes it and sought new user, wrong data validation. If successful, it loads console
			*/

			$username = $this->security->xss_clean($this->input->post('username'));
			$password = $this->security->xss_clean($this->input->post('password'));


			$userData = $this->AdminManagementModel->grabUserData($username);


			if($userData)
			{
				if($userData['Password'] == 'server1' && $password == 'server1')
				{
					//returns 1 if password has not been saved yet. loads update password

					$data['adminId'] = $userData['AdminId'];	

					//load update password view

					$this->load->view('content/Admin/modal/login/updatePassword.php',$data);
					
				}
				else if(password_verify($password,$userData['Password']))
				{
					//login is valid

					//prepare session 

					$sessionData = array('adminId'=>$userData['AdminId']);
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
			$adminId = $this->input->post('adminId');

			echo $password. ' '. $vPassword;

			$dateNow = date('Y-m-d H:i:s');

			if($password != $vPassword)
			{
				echo '1';
			}
			else
			{
				$newPassword = password_hash($password,PASSWORD_DEFAULT);

				$updateData = array('Password'=>$newPassword,'AuditedBy'=>$adminId,'AuditDate'=>$dateNow);

				$response = $this->AdminManagementModel->updateAdminPassword('adminusers',$adminId,$updateData);
			}
		}

		public function logout()
		{
			$this->session->unset_userdata('adminId');

			$this->session->sess_destroy();

			//load logout page

			$this->load->view('content/theme/cssBoilerPlate.php');
	      	$this->load->view('content/Admin/logout.php');
	      	$this->load->view('content/theme/footer.php');
			
		}

		public function mainConsole()
		{
			if($this->session->has_userdata('adminId'))
			{
				$adminId = $this->session->userdata('adminId');

				$data['userData'] = $this->AdminManagementModel->grabUserInformation($adminId);

				$data['unfulfilledOrders'] = $this->AdminManagementModel->grabAllDayUnfulfilledOrders();
				$data['fulfilledOrders'] = $this->AdminManagementModel->grabAllDayFulfilledOrders();
				$data['totalorder'] = $this->AdminManagementModel->grabAllDayOrder();
				$data['allUnassignedOrders'] = $this->AdminManagementModel->grabUnassignedOrder();


				$this->load->view('content/theme/cssBoilerPlate.php');
	      		$this->load->view('content/theme/adminHeader.php',$data);
	      		$this->load->view('content/Admin/console/index.php',$data);
	      		$this->load->view('content/theme/footer.php');
			}
			else
			{
				redirect('/AdminManagement/');
			}
		}

		public function manageOrder()
		{
			/*
			*	Function grabs all information about an order
			*/

			$keyword = $this->input->post('keyword');

			$data['orderDetails'] = $this->AdminManagementModel->grabOrderDetails($keyword);

			//get all order associated with unique Id

			$data['orderItems'] = $this->AdminManagementModel->grabOrderItems($data['orderDetails']['UniqueCartId']); 
			$data['clientList'] = $this->AdminManagementModel->grabClientList();

			$this->load->view('content/Admin/ordermanagement/index.php',$data);
		}

		public function assignSales()
		{
			/* 
			*	Funtion assigns sales to clients 
			*/

			$userId = $this->session->userdata('adminId');
			$clientId = $this->input->post('clientId');
			$orderId = $this->input->post('orderId');

			//update ordr table 

			$updateData = array('AssignedTo'=>$clientId,'AssignedBy'=>$userId);

			$this->AdminManagementModel->updateOrder('orders',$orderId,$updateData);

			//get Client's email

			$email = $this->AdminManagementModel->grabClientDetails($clientId);

			if($email['Email'])
			{
				$this->sendSalesEmail($orderId,$email['Email']);
				echo "Sales email sent successfully";
			}
			else
			{
				echo "0";
			}

		}

		public function sendSalesEmail($orderId,$clientEmail)
		{
			$data['orderId'] = $orderId;
			$data['clientEmail'] = $clientEmail;

			$emailText = $this->load->view('emails/salesEmail.php',$data,TRUE);

		      $config['protocol'] = 'sendmail';
		      $config['mailpath'] = '/usr/sbin/sendmail';
		      $config['charset'] = 'iso-8859-1';
		      $config['wordwrap'] = TRUE;

		      $this->email->initialize($config);

		      $this->email->from('system@naijafoodies.com', 'Order Alert');
		      $this->email->to($clientEmail);
		      $this->email->set_mailtype("html");

		      $this->email->subject('Sales Order');
		      $this->email->message($emailText);

		      $this->email->send();
		}

		// End of Admin controller


		/**************************************************************************/
		//						Start of Food Inventory control					
		/**************************************************************************/

		public function viewFoodInventory()
		{
			/**
			*	Function shows the inventory control page
			*/

			if($this->session->has_userdata('adminId'))
			{
				$adminId = $this->session->userdata('adminId');

				$data['userData'] = $this->AdminManagementModel->grabUserInformation($adminId);
				$data['attachedOrders'] = $this->AdminManagementModel->grabAttachedOrders($adminId);
				$data['foodDetails'] = $this->AdminManagementModel->grabAllFood();

				$panel['foodButton'] = $this->load->view('content/Admin/inventorymanagement/buttons/foodButton.php',$data,TRUE);
				$panel['foodDetails'] = $this->load->view('content/Admin/inventorymanagement/pages/viewFoodTable.php',$data,TRUE);

				$this->load->view('content/theme/cssBoilerPlate.php');
	      		$this->load->view('content/theme/adminHeader.php',$data);
	      		$this->load->view('content/Admin/inventorymanagement/index.php',$panel);
	      		$this->load->view('content/theme/footer.php');
			}
			else
			{
				$this->index();
			}
		}

		public function viewAddFood()
		{
			if($this->session->has_userdata('adminId'))
			{
				//load food Category

				$data['foodCategory'] = $this->AdminManagementModel->grabAllFoodCategory();
				$data['vendors'] = $this->AdminManagementModel->grabClientList();
				$data['foodOrigin'] = $this->AdminManagementModel->grabFoodOrigin();

				//load modal

				$this->load->view('content/Admin/inventorymanagement/pages/modal/viewAddFood.php',$data);
			}
		}

		public function addFood()
		{
			$foodName = $this->input->post('inputFoodName');
			$inputFile = $this->input->post('user_file');
			$price = $this->input->post('inputRegularPrice');
			$halfTray = $this->input->post('inputHalfTray');
			$fullTray = $this->input->post('inputFullTray');
			$description = $this->input->post('inputDescription');
			$foodCategoryId = $this->input->post('inputFoodCategoryId');
			$vendor = $this->input->post('inputVendor');
			$foodOrigin = $this->input->post('inputOrigin');

			//set up file upload

			$fileName = $inputFile;

			$config['file_name'] = $fileName;
			$config['upload_path'] = './assets/uploads/menu/';
			$config['allowed_types'] = 'png|jpg|jpeg';
			$config['overwrite'] = TRUE;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload())
			{
			 $error = array('error' => $this->upload->display_errors());
			 print_r($error);
			}
			else
			{
				$dateNow = date('Y-m-d');

				$data = array('upload_data' => $this->upload->data());
			
				$fileName = str_replace(' ', '_', $fileName);

				$foodArray = array('FoodName'=>$foodName,'IsAvailable'=>0,'RecordDisabled'=>0,'FoodStart'=>$dateNow,'FoodCategoryId'=>$foodCategoryId,'FoodOriginId'=>$foodOrigin,'Description'=>$description,'DisplayImage'=>$fileName,'AuditUser'=>$this->session->userdata('adminId'),'AuditDate'=>$dateNow,'VendorId'=>$vendor);

				$foodId = $this->AdminManagementModel->insertIntoTable('fooddetails',$foodArray);

				$priceArray = array('FoodId'=>$foodId,'Regular'=>$price,'HalfTray'=>$halfTray,'FullTray'=>$fullTray,'RecordDisabled'=>0,'AuditedBy'=>$this->session->userdata('adminId'),'AuditDate'=>$dateNow);

				$priceStatus = $this->AdminManagementModel->insertIntoTable('foodprice',$priceArray);

			}
		}

		public function viewEditFood()
		{
			$foodId = $this->input->get_post('foodId');

			$data['foodId'] = $foodId;
			$data['foodDetails'] = $this->AdminManagementModel->grabSpecificFood($foodId);
			$data['foodCategories'] = $this->AdminManagementModel->grabAllFoodCategory();
			$data['vendors'] = $this->AdminManagementModel->grabClientList();
			$data['foodOrigin'] = $this->AdminManagementModel->grabFoodOrigin();

			$this->load->view('content/Admin/inventorymanagement/pages/modal/viewEditFood.php',$data);

		}

		public function submitEditFood()
		{
			$foodId = $this->input->post('inputFoodId');
			$foodName = $this->input->post('inputFoodName');
			$price = $this->input->post('inputRegularPrice');
			$halfTray = $this->input->post('inputHalfTray');
			$fullTray = $this->input->post('inputFullTray');
			$description = $this->input->post('inputDescription');
			$foodCategoryId = $this->input->post('inputFoodCategoryId');
			$availabilityStatus = $this->input->post('inputFoodStatus');
			$vendor = $this->input->post('inputVendor');
			$foodOrigin = $this->input->post('inputOrigin');

			$auditUser = $this->session->userdata('adminId');

			$dateNow = date('Y-m-d');

			//update Food

			$foodData = array('FoodName'=>$foodName,'FoodCategoryId'=>$foodCategoryId,'FoodOriginId'=>$foodOrigin,'Description'=>$description,'IsAvailable'=>$availabilityStatus,'VendorId'=>$vendor,'AuditUser'=>$auditUser,'AuditDate'=>$dateNow);

			$this->AdminManagementModel->updateFoodInventory($foodId,$foodData);

			//update Price

			$foodPriceData = array('Regular'=>$price,'HalfTray'=>$halfTray,'FullTray'=>$fullTray);

			$this->AdminManagementModel->updateFoodPrice($foodId,$foodPriceData);
		}


		public function showVerifyFood()
		{
			// Function loads the content for verification of food deletion

			$data['foodId'] = $this->input->get_post('foodId');

			$this->load->view('content/Admin/inventorymanagement/pages/modal/viewDeleteFoodConfirmation.php',$data);
		}

		public function submitDeleteFood()
		{
			/**
			*	Function disables food in the food database
			*/

			$foodId = $this->input->post('foodId');

			$auditUser = $this->session->userdata('adminId');

			$dateNow = date('Y-m-d');

			$foodData = array('RecordDisabled'=>1,'AuditUser'=>$auditUser,'AuditDate'=>$dateNow);

			$this->AdminManagementModel->updateFoodInventory($foodId,$foodData);
		}



		////////////////////////////////////////////////////////////////////////////////////////
		//							Start of meat inventory control							  //
		///////////////////////////////////////////////////////////////////////////////////////

		public function viewMeatInventory()
		{
			/**
			*	Function loads all the meat that is not deleted
			*/

			if($this->session->has_userdata('adminId'))
			{
				$adminId = $this->session->userdata('adminId');

				$data['userData'] = $this->AdminManagementModel->grabUserInformation($adminId);

				//grab all meats

				$data['allMeat'] = $this->AdminManagementModel->grabAllMeatDetails();

				//load meat table

				$this->load->view('content/theme/cssBoilerPlate.php');
	      		$this->load->view('content/theme/adminHeader.php',$data);
	      		$this->load->view('content/Admin/inventorymanagement/pages/viewMeatTable.php',$data);
	      		$this->load->view('content/theme/footer.php');

			}
			else
			{
				$this->index();
			}
		}

		public function viewEditMeat()
		{
			/**
			*	Function shows modal for editing meat
			*/

			$meatId = $this->input->get_post('meatId');

			$data['meatId'] = $meatId;

			//load meat details

			$data['meatDetails'] = $this->AdminManagementModel->grabSpecificMeatDetails($meatId);
			$data['allVendors'] = $this->AdminManagementModel->grabClientList();

			//load modal 

			$this->load->view('content/Admin/inventorymanagement/pages/meatmodal/viewEditMeat.php',$data);

		}

		public function submitEditMeat()
		{
			$meatId = $this->input->post('inputMeatId');
			$meatName = $this->input->post('inputMeatName');
			$meatCost = $this->input->post('inputMeatCost');
			$availabilityStatus = $this->input->post('inputMeatStatus');
			$vendor = $this->input->post('inputVendor');

			$dateNow = date('Y-m-d H:i:s');
			$adminId = $this->session->userdata('adminId');

			$updateArray = array('MeatName'=>$meatName,'MeatPrice'=>$meatCost,'IsAvailable'=>$availabilityStatus,'AuditedBy'=>$adminId,'AuditDate'=>$dateNow,'VendorId'=>$vendor);

			$this->AdminManagementModel->updateMeat($meatId,$updateArray);
		}

		public function viewDeleteMeat()
		{
			/**
			*	Function shows modal for deletion confirmation
			*/

			$meatId = $this->input->get_post('meatId');

			$data['meatId'] = $meatId;

			$this->load->view('content/Admin/inventorymanagement/pages/meatmodal/viewDeleteMeat.php',$data);
		}

		public function submitDeleteMeat()
		{
			/**
			*	Function confirms meat deletion
			*/

			$meatId = $this->input->post('meatId');

			$adminId = $this->session->userdata('adminId');
			$dateNow = date('Y-m-d H:i:s');

			$updateArray = array('RecordDisabled'=>1,'AuditedBy'=>$adminId,'AuditDate'=>$dateNow);

			$this->AdminManagementModel->updateMeat($meatId,$updateArray);
		}

		public function viewAddMeat()
		{
			/**
			*	Functions load modal for adding meat
			*/

			$data['allVendors'] = $this->AdminManagementModel->grabClientList();

			$this->load->view('content/Admin/inventorymanagement/pages/meatmodal/viewAddMeat.php',$data);
		}

		public function submitAddMeat()
		{
			$meatName = $this->input->post('inputMeatName');
			$meatCost = $this->input->post('inputMeatCost');
			$vendor = $this->input->post('inputVendor');

			$auditUser = $this->session->userdata('adminId');
			$dateNow = date('Y-m-d H:i:s');

			$meatData = array('MeatName'=>$meatName,'MeatPrice'=>$meatCost,'VendorId'=>$vendor,'IsAvailable'=>0,'DisplayPicture'=>NULL,'RecordDisabled'=>0,'AuditedBy'=>$auditUser,'AuditDate'=>$dateNow);

			$this->AdminManagementModel->insertIntoTable('meatdetails',$meatData);
		}


		///////////////////////////////////////////////////////////////////////////////////////
		// 								Start of delivery section 							 //
		///////////////////////////////////////////////////////////////////////////////////////

		public function viewDelivery()
		{
			/**
			*	Function show delivery table
			*/

			if($this->session->has_userdata('adminId'))
			{
				$adminId = $this->session->userdata('adminId');

				$data['userData'] = $this->AdminManagementModel->grabUserInformation($adminId);

				//grab all meats

				$data['deliveryDetails'] = $this->AdminManagementModel->grabAllDeliveryDetails();

				//load meat table

				$this->load->view('content/theme/cssBoilerPlate.php');
	      		$this->load->view('content/theme/adminHeader.php',$data);
	      		$this->load->view('content/Admin/inventorymanagement/pages/viewDeliveryTable.php',$data);
	      		$this->load->view('content/theme/footer.php');
			}
			else
			{
				$this->index();
			}
		}


		public function viewAddDelivery()
		{
			/**
			*	Function shows modal to add new delivery city
			*/

			$this->load->view('content/Admin/inventorymanagement/pages/deliverymodal/viewAddDelivery.php');

		}

		public function submitAddDeliveryCity()
		{
			/**
			*	Function adds new city to the city list
			*/

			$cityName = $this->input->post('inputCityName');
			$cityCost = $this->input->post('inputCityCost');

			$dateNow = date('Y-m-d H:i:s');
			$auditUser = $this->session->userdata('adminId');

			$deliveryData = array('DeliveryCityName'=>$cityName,'DeliveryPrice'=>$cityCost,'RecordDisabled'=>0,'AuditDate'=>$dateNow,'AuditUser'=>$auditUser);

			$this->AdminManagementModel->insertIntoTable('deliverydetails',$deliveryData);
		}

		public function toggleCity()
		{
			/**
			*	Function changes city status based on the intent passed to it
			*/

			$cityId = $this->input->post('cityId');
			$intent = $this->input->post('intent');

			$dateNow = date('Y-m-d H:i:s');
			$auditUser = $this->session->userdata('adminId');

			if($intent == 1)
			{
				$updateData = array('RecordDisabled'=>1,'AuditDate'=>$dateNow,'AuditUser'=>$auditUser);

				$this->AdminManagementModel->updateDeliveryCity($cityId,$updateData);
			}
			else if($intent == 0)
			{
				$updateData = array('RecordDisabled'=>0,'AuditDate'=>$dateNow,'AuditUser'=>$auditUser);

				$this->AdminManagementModel->updateDeliveryCity($cityId,$updateData);
			}
		}

		public function viewEditDelivery()
		{
			/**
			*	Function loads modal for viewing city details
			*/

			$cityId = $this->input->get_post('cityId');

			$data['cityId'] = $cityId;

			$data['deliveryDetails'] = $this->AdminManagementModel->grabSpecificCityDetails($cityId);

			//load modal

			$this->load->view('content/Admin/inventorymanagement/pages/deliverymodal/viewEditDelivery.php',$data);
		}

		public function submitEditCity()
		{
			/**
			*	Function submits new City details
			*/

			$cityName = $this->input->post('inputDeliveryCityName');
			$deliveryCost = $this->input->post('inputDeliveryCost');
			$status = $this->input->post('inputDeliveryStatus');
			$cityId = $this->input->post('inputCityId');

			$auditUser = $this->session->userdata('adminId');
			$dateNow = date('Y-m-d H:i:s');

			$updateData = array('DeliveryCityName'=>$cityName,'DeliveryPrice'=>$deliveryCost,'RecordDisabled'=>$status,'AuditDate'=>$dateNow,'AuditUser'=>$auditUser);

			$this->AdminManagementModel->updateDeliveryCity($cityId,$updateData);
		}

		public function viewReports()
		{
			/**
			*	function opens the report page
			*/

			if($this->session->has_userdata('adminId'))
			{

				//load view page

				$adminId = $this->session->userdata('adminId');

				$data['userData'] = $this->AdminManagementModel->grabUserInformation($adminId);

				//load alll vendors

				$data['allVendors'] = $this->AdminManagementModel->grabClientList();

				$this->load->view('content/theme/cssBoilerPlate.php');
	      		$this->load->view('content/theme/adminHeader.php',$data);
				$this->load->view('content/Admin/reports/index.php',$data);
				$this->load->view('content/theme/footer.php');

			}
			else
			{
				$this->index();
			}
		}



		/////////////////////////////////////////////////////////////////////////
		// 							Addon management section 				  //
		////////////////////////////////////////////////////////////////////////


		public function viewAddon()
		{
			/**
			*	Function displays addon page
			*/

			if($this->session->userdata('adminId'))
			{
				$adminId = $this->session->userdata('adminId');

				$data['userData'] = $this->AdminManagementModel->grabUserInformation($adminId);

				//load alll vendors

				$data['addons'] = $this->AdminManagementModel->grabAllAddon();

				$this->load->view('content/theme/cssBoilerPlate.php');
	      		$this->load->view('content/theme/adminHeader.php',$data);
				$this->load->view('content/Admin/inventorymanagement/pages/viewAddonTable.php',$data);
				$this->load->view('content/theme/footer.php');
			}
			else
			{
				$this->index();
			}
		}

		public function viewEditAddon()
		{
			// Function shows modal to edit adddon

			$addonId = $this->input->get_post('addonId');

			$data['allVendors'] = $this->AdminManagementModel->grabClientList();
			$data['addonDetails']  = $this->AdminManagementModel->grabSpecificAddon($addonId);

			$data['addonId'] = $addonId;

			//load modal

			$this->load->view('content/Admin/inventorymanagement/pages/addonmodal/viewEditAddon.php',$data);

		}

		public function submitEditAddon()
		{
			$addonName = $this->input->post('inputAddonName');
			$cost = $this->input->post('inputAddonCost');
			$vendor = $this->input->post('inputVendor');
			$status = $this->input->post('inputAddonStatus');
			$addonId = $this->input->post('inputAddonId');

			$auditUser = $this->session->userdata('adminId');
			$dateNow = date('Y-m-d');

			$addonArray = array('AddonName'=>$addonName,'Price'=>$cost,'VendorId'=>$vendor,'IsAvailable'=>$status,'AuditUser'=>$auditUser,'AuditDate'=>$dateNow);

			//update database

			$this->AdminManagementModel->updateAddonTable($addonId,$addonArray);
		}

		public function viewAddAddon()
		{
			/**
			*	Function shows addon modal
			*/

			$data['allVendors'] = $this->AdminManagementModel->grabClientList();

			$this->load->view('content/Admin/inventorymanagement/pages/addonmodal/viewAddAddon.php',$data);

		}

		public function submitAddAddon()
		{
			$addonName = $this->input->post('inputAddonName');
			$addonCost = $this->input->post('inputAddonCost');
			$vendor = $this->input->post('inputVendor');

			$auditUser = $this->session->userdata('adminId');
			$dateNow = date('Y-m-d');

			$addonArray = array('AddonName'=>$addonName,'Price'=>$addonCost,'VendorId'=>$vendor,'IsAvailable'=>0,'AuditUser'=>$auditUser,'AuditDate'=>$dateNow);

			$this->AdminManagementModel->insertIntoTable('addondetails',$addonArray);
		}


		public function verifyDeleteAddon()
		{
			/**
			*	Function displays modal to confirm deletion of addon
			*/

			$data['addonId'] = $this->input->post('addonId');

			$this->load->view('content/Admin/inventorymanagement/pages/addonmodal/viewDeleteAddon',$data);
		}


		public function submitDeleteAddon()
		{
			$addonId = $this->input->post('addonId');

			$auditUser = $this->session->userdata('adminId');
			$dateNow = date('Y-m-d');

			$addonArray = array('IsAvailable'=>1,'AuditUser'=>$auditUser,'AuditDate'=>$dateNow);

			$this->AdminManagementModel->updateAddonTable($addonId,$addonArray);
		}


		//End of admin management
	}
?>