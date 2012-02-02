<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		}
		
	}
	 
	public function index()
	{
		$data['scripts'] = array(
			base_url('application/assets/js/util.js'),
			base_url('application/views/dashboard/js/xhrfunctions.js')
		);
		
		$this->template->load('dashboard/index', $data);
	}
	
	public function personal_options() {
		$data['login'] = $this->tank_auth->get_username();
		$data['email'] = $this->tank_auth->get_email();
		$this->template->load('dashboard/personal_options', $data);
	}
}
