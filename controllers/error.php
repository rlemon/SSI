<?php

class Error extends Controller {

	function __construct() {
		parent::__construct();
	}
	
	function index($message = null) {
		$this->view->msg = ( $message == null ) ? 'There was an error processing your request.' : $message;
		$this->view->render('error/index');
	}

}
