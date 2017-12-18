<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();

class FoodDisplay extends CI_Controller{
    public function __construct()
    {
      parent::__construct();
      $this->load->helper('url');
      $this->load->helper('file');
      $this->load->library('session');

      //load models
      $this->load->model('FoodDisplayModel');

    }

    public function index()
    {
      //load Model

      $data['allFoodDetails'] = $this->FoodDisplayModel->grabAllFoodDetails();

      $uniqueSessionId = $this->session->userdata('uniqueSessionId');

      $data['cartDetails'] = $this->FoodDisplayModel->grabCartDetails($uniqueSessionId);

        //load views

        $this->load->view('content/theme/cssBoilerPlate.php');
        $this->load->view('content/theme/header.php',$data);
        $this->load->view('content/FoodDisplay/index.php', $data);
        $this->load->view('content/theme/footer.php');
    }

    public function viewMenu()
    {

      //function gets all the food available in the database. Also initializes our static session Id for cart

      //declare sessionId property

      if(!$this->session->has_userdata('uniqueSessionId'))
      {
        $sessionId = session_id();

        $uniqueSessionId = md5($sessionId.''.$sessionId);

        //set Unique session Id for cart update

        $sessionArray = array('uniqueSessionId'=>$uniqueSessionId);
        $this->session->set_userdata($sessionArray);
      }

      //grab all available food

      $uniqueSessionId = $this->session->userdata('uniqueSessionId');

      $data['allFoodDetails'] = $this->FoodDisplayModel->grabAllMenuItems();
      $data['cartDetails'] = $this->FoodDisplayModel->grabCartDetails($uniqueSessionId);

      //load view

      $this->load->view('content/theme/cssBoilerPlate.php');
      $this->load->view('content/theme/header.php',$data);
      $this->load->view('content/FoodDisplay/modal/viewFoodBase.php',$data);
      $this->load->view('content/theme/footer.php');
    }

    public function viewFood($foodId)
    {
      /**
      * Function opens direct page to food. Food shows all properties of food including price, ingredient,ratings and partner 
      * Page would be directed via codeigniter default route
      */ 

      //get details of food
      
      $data['foodDetails'] = $this->FoodDisplayModel->grabFoodDetails($foodId);

      //get number of items in the cart

      $data['cartDetails'] = $this->FoodDisplayModel->grabCartDetails($this->session->userdata('uniqueSessionId'));

      //load view. View is setup like the default naija foodies pattern. Header,content,footer

      $this->load->view('content/theme/cssBoilerPlate.php');
      $this->load->view('content/theme/header.php');
      $this->load->view('content/FoodDisplay/pages/foodDetailsView.php',$data);
      $this->load->view('content/theme/footer.php');
    }

    public function showFoodDetails()
    {
      //function loads view for a particular foodCode

      //variable declaration

      $foodId = $this->input->get_post('foodId');

      //load models
      $details = $this->FoodDisplayModel->grabSelectedFood($foodId);

      $data['details'] = $this->FoodDisplayModel->grabSelectedFood($foodId);
      $data['foodPrice'] = $this->FoodDisplayModel->getPrice($foodId);
      $data['allSoupDetails'] = $this->FoodDisplayModel->grabAllSoupDetails();
      $data['allAddons'] = $this->FoodDisplayModel->grabAllAddons();
      $data['deliveryModes'] = $this->FoodDisplayModel->grabAllDeliveryModes();
      $data['meatDetails'] = $this->FoodDisplayModel->grabAllMeatDetails();

      //load view

      if($details['FoodName']=='Meat Pie')
      {
        $this->load->view('content/FoodDisplay/modal/viewCustomPanel', $data);
      }
      else
      {
        $this->load->view('content/FoodDisplay/modal/viewSelectedFood.php', $data);
      }
    }

    public function getPrice()
    {
      //function gets all the price of the request item

      //variable declaration

      $foodPriceId = $this->input->post('foodId');
      $soupPriceId = $this->input->post('soupId');
      $addonPriceId = $this->input->post('addonId');
      $deliveryPriceId = $this->input->post('deliveryId');

      $data['quantity'] = $this->input->post('quantity');
      $data['foodPrice'] = $this->FoodDisplayModel->grabFoodPrice($foodPriceId);
      $data['addonPrice'] = $this->FoodDisplayModel->grabAddonPrice($addonPriceId);
      $data['deliveryPrice'] = $this->FoodDisplayModel->grabDeliveryPrice($deliveryPriceId);

      $this->load->view('content/FoodDisplay/modal/viewFoodPrice.php', $data);
    }

    public function foodSummary()
    {
      //function displays the summary of selected food

        //variable declaration

        $data['food'] = $this->input->post('food');
        $data['soup'] = $this->input->post('soup');
        $data['addon'] = $this->input->post('addon');
        $data['delivery'] = $this->input->post('delivery');
        $data['meat'] = $this->input->post('meat');
        $data['foodSelected'] = $this->input->post('selectedFood');
        $foodPriceId = $this->input->post('priceOfFood');
        $soupPriceId= $this->input->post('priceOfSoup');
        $addonPriceId = $this->input->post('priceOfAddon');
        $deliveryPriceId = $this->input->post('priceOfDelivery');
        $phone = $this->input->post('phone');

        $sessionData = array('Phone'=>$phone);
        $this->session->set_userdata($sessionData);

        //load modal

        $data['quantity'] = $this->input->post('quantity');
        $data['priceOfFood'] = $this->FoodDisplayModel->grabFoodPrice($foodPriceId);
        $data['priceOfAddon'] = $this->FoodDisplayModel->grabAddonPrice($addonPriceId);
        $data['priceOfDelivery'] = $this->FoodDisplayModel->grabDeliveryPrice($deliveryPriceId);


        $this->load->view('content/FoodDisplay/modal/foodSummary.php', $data);

    }

    public function getPhoneNumber()
    {
      $this->load->view('content/FoodDisplay/modal/getNumber.php');
    }

    public function processCustomOrder()
    {
      $data['totalPack'] = $this->input->post('pack');
      $data['piecesPerPack'] = $this->input->post('piecesPerPack');
      $data['totalCost'] = $this->input->post('totalCost');
      $data['phoneNumber'] = $this->input->post('phoneNumber');
      $data['deliveryMode'] = $this->input->post('deliveryMode');
      $data['deliveryId'] = $this->input->post('deliveryId');

      $sessionData = array('Phone'=>$data['phoneNumber']);
      $this->session->set_userdata($sessionData);


      $data['deliveryPrice'] = $this->FoodDisplayModel->grabDeliveryPrice($data['deliveryId']);
      $this->load->view('content/FoodDisplay/modal/viewProcessedCustomOrder.php',$data);

    }




}

 ?>
