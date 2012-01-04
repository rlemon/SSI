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
		if( isset( $_POST['save'] ) ) {
			$map = array('ui_theme' => $_POST['theme']);
			if( isset($_POST['old_password']) && isset($_POST['new_password']) && isset($_POST['confirm_password']) ) {
				if( $this->model->checkPassword( Session::get('id'), md5($_POST['old_password']) ) && $_POST['new_password'] == $_POST['confirm_password'] ) {
					$map = array_merge( $map, array(
						'password' => md5($_POST['new_password'])
					) );
				}
			}
			$this->model->updateProfile( Session::get('id'),  $map);
		}
		$this->view->render('dashboard/index');
	}
	function logout()
	{
		Session::destroy();
		header('location: ' . URL .  'login');
		exit;
	}
}
