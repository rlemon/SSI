<?php

class Shipping extends Controller {

	function __construct() {
		parent::__construct();
		Session::init();
		$logged = Session::get('logged_in');
		if ($logged == false) {
			Session::destroy();
			header('location: ../login');
			exit;
		}
	}
	
	function index() 
	{	
		$this->view->render('shipping/index');
	}

}
