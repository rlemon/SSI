<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_information extends CI_Controller {
	public function __construct() {
		parent::__construct();
		if( !$this->tank_auth->is_logged_in() ) {
			redirect('/authentication/login');
		}
		$this->load->library('form_validation');
		$this->load->helper('send_email');
		$this->load->model('tank_auth/users');
	}
	
	public function index()
	{
		if ($message = $this->session->flashdata('message')) {
			echo $message;
		}
		$data = array();
		$data['userdata'] = $this->users->get_user_by_id( $this->session->userdata('user_id'), $this->session->userdata('status') );
		unset( $data['userdata']->password ); // don't need this... 
		$this->template->load('dashboard/account_information/index', $data);
	}
	public function change_username() {
		$this->template->load('dashboard/account_information/change_username');
	}
	public function change_email() {
		
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
		
		$data['errors'] = array();
		
		if( $this->form_validation->run() ) {
			if( !is_null( $data = $this->tank_auth->set_new_email( $this->form_validation->set_value('email'), $this->form_validation->set_value('password') ) ) ) {
				
				$data['site_name'] = $this->config->item('website_name', 'tank_auth');
				
				_send_email('change_email', $data['new_email'], $data);
				
				$this->session->set_flashdata('message', sprintf( $this->lang->line('auth_message_new_email_sent'), $data['new_email'] ) );
				redirect('dashboard/account_information/');
				
			} else {
				$errors = $this->tank_auth->get_error_message();
				foreach( $errors as $k => $v ) {
					$data['errors'][$k] = $this->lang->line($v);
				}
			}
		}
		
		$this->template->load('dashboard/account_information/change_email');
	}
	public function change_password() {
		$this->template->load('dashboard/account_information/change_password');
	}
	public function delete_account() {
		
		$this->template->load('dashboard/account_information/delete_account');
	}
}
