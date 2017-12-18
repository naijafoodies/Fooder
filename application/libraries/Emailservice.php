<?php
/**
 * Created by PhpStorm.
 * User: Olusegun
 * Date: 12/2/2017
 * Time: 12:49 PM
 */
require_once("system/libraries/Email.php");
require_once("system/core/Loader.php");

class Emailservice extends CI_Email
{

    /**
     * @var array
     * This is the default confifguration of the controller. This is to be instantiated with the CI_Email class. This can be modified using the
     * reinitialize method
     */
    private $defaultConfiguration = [

        "protocol" => "sendmail",
        "mailpath" => '/usr/sbin/sendmail',
        "charset" => 'iso-8859-1',
        "wordwrap" => TRUE,
        "mailtype" => "html",
        "validate" => true,
        "priority" => 5,

    ];

    //------------------------------------------------------

    /****
     * @var CI_Loader
     * Function will instance of the CI_Loader class
     */
    private $load;

    //---------------------------------------------------------------


    /**
     * @var array
     * If reinitialize is to be used, array holds all the fields allowed to be modified
     */
    private $allowedInitializers = array("protocol","wordwrap","mailtype","validate","priority");

    //--------------------------------------------------------------------


    /**
     * @var array
     * This is the email recipient of the admin members to receive emails. This is temporary for the scope of the project as this array might glow or shrink
     */
    private $adminEmailRecipient = array("naijafoodies@gmail.com","oakinyelure@hotmail.com",'eoyeyemi@gmail.com','ugo_njoku@ymail.com','olaique88@gmail.com');

    //------------------------------------------------------------------------


    /**
     * Emailservice constructor.
     * This is the default constructor. it initializes the Email intializer with the default configuration
     */
    public function __construct() {

        // load Email initializer to CI_Email

        parent::__construct($this->defaultConfiguration);

        // get instance of of Loader class to be able to load the view

        $this->load = new CI_Loader();

    }

    //------------------------------------------------------------------------------------------

    // Function reinitializes the intializer which is passed to the CI_email. This will be the new param to be used by the base class to send emails

    public function reInitialize($initializerParam) {

        // Check the type of arguiment passed

        if(!is_array($initializerParam)) {
            throw new InvalidArgumentException("Expected an array. You provided " . gettype($initializerParam));
        }

        /**
         * Search through the array to make sure the initializers are of supported types. This would rewrite the default initializer to be used for intialization.
         * This relies on the CI_email intializer to rewrite its default intializer
         */

        foreach ($initializerParam AS $key=>$initializer) {

            if(in_array($key,$this->allowedInitializers)) {

                $this->defaultConfiguration[$key] = $initializer;
            }
        }

        $this->initialize($this->defaultConfiguration);
    }

    //--------------------------------------------------------------------------------

    /**
     * @param $salesData
     *  Function send sales email. it receives
     * @return bool
     */

    public function sendSalesEmail($salesData) {

        if(!is_object($salesData)) {

            throw new InvalidArgumentException("Expected a an object. You gave a ".gettype($salesData));
        }
        else {

            $data = (object)[

                'order' => $salesData
            ];

            $this->from("sales@naijafoodies.com","Naija Foodies");
            $this->to($salesData->recipientEmail);

            $this->subject("Order Summary");

            $message = $this->load->view("emails/customerEmail.php",$data,TRUE);
            $this->message($message);
            $this->send();

            return  true;
        }

    }

    //-------------------------------------------------------------------------------

    /**
     * @param $salesData
     * @return bool
     */
    public function sendAdminEmail($salesData) {

        if(!is_object($salesData)) {

            throw new InvalidArgumentException("Expected a an object. You gave a ".gettype($salesData));
        }
        else {

            $data = (object)[

                'order' => $salesData
            ];

            $this->from("system@naijafoodies.com","Naija Foodies");
            $this->to($this->adminEmailRecipient);

            $this->subject("Purchase Summary");

            $message = $this->load->view("emails/customerEmail.php",$data,TRUE);
            $this->message($message);
            $this->send();

            return  true;
        }

    }



}
