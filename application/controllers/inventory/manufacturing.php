<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manufacturing extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if( !$this->tank_auth->is_logged_in() ) {
			redirect('/authentication/login');
		}
	}

	public function index()
	{
		$this->template->load('inventory/manufacturing/index');
	}

}

