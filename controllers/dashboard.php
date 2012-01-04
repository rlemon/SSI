<?php

class Dashboard extends Controller {

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
		if( isset( $_POST['theme'] ) ) {
			$this->model->updateTheme( Session::get('id'), $_POST['theme'] );
		}
		$this->view->render('dashboard/index');
	}

}
