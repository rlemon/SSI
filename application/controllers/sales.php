<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sales extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		}
		
	}
	 
	public function index()
	{
		$data['scripts'] = array(
			base_url('application/assets/js/util.js')
		);
		$data['styles'] = array(

		);

		$this->template->load('sales/index', $data);
	}
	
}
