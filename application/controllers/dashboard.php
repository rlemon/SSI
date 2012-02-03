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
		$this->template->load('dashboard/index');
	}
	
	public function personal_options($loading_self = FALSE) {

		$data['scripts'] = array(
			base_url('application/assets/js/util.js'),
			base_url('application/views/dashboard/js/xhrfunctions.js')
		);
		$data['login'] = $this->tank_auth->get_username();
		$data['email'] = $this->tank_auth->get_email();
		$data['default_view'] = $this->load->view('dashboard/personal_options_form', $data, TRUE);
		if( $loading_self ) {
			echo $data['default_view'];
			return;
		} else {
			$this->template->load('dashboard/personal_options', $data);
		}
	}
}
