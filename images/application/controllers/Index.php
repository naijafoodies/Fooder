<?php
  class Index extends CI_Controller{

    public function __construct()
    {
      parent::__construct();
    }

    public function index()
    {
      redirect('/FoodDisplay/','auto',301);
    }

  }


 ?>
