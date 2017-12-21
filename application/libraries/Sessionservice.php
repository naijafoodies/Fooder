<?php
/**
 * Created by PhpStorm.
 * User: Olusegun
 * Date: 12/2/2017
 * Time: 11:45 AM
 * Function is used to manage session information. Initially wanted to implement php's sessionHandler interface but it will be too cubersome and expensive to manage those kind of data persolly so
 * i have left its implementation to Codeigniter. This session will only add and remove data from the super session global
 *
 */

class Sessionservice {

    private $sessionData;

    public function __construct() {

        $this->sessionData = $_SESSION;
    }

    /**
     * @param $key
     * @return bool
     * Function will get session session data if the key passed is available else it will return a false
     * usage would look like  $this->sessionservice->get('phoneNumber');
     */
    public function getSessionValue($key){

        // check type to make sure the passed param is the right datatype

        if(!is_string($key)) {
            throw new InvalidArgumentException("Expected a string. You provided ". gettype($key));
        }

        // Check if array key exist

        if(isset($this->sessionData[$key])) {

            return $this->sessionData[$key];

        }

        return false;
    }

    //------------------------------------------------------

    /**
     * @param $dataArray
     * @return string
     */
    public function setSessionData($dataArray) {

        if(!is_array($dataArray) && count($dataArray) < 1) {
            throw new InvalidArgumentException("Expected an array. Instead you passed ".gettype($dataArray). "::Length should be more than 1");
        }

        // set seesion data

        foreach ($dataArray AS $key=>$value) {

            $_SESSION[$key] = $value;
        }

        return true;
    }

}