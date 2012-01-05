<?php

class Login extends Controller {

	function __construct() {
		parent::__construct();	
	}
	
	function index() 
	{
		$this->view->render('login/index');
	}
	
	function login()
	{
		if( $this->model->login() ) {
			header( 'location: ' . URL . 'dashboard' );
		} else {
			$message = 'Login Incorrect. Please try again.';
			$this->view->message = array('text' => $message);
			$this->view->render('login/index');
		}
	}

}
