<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_information extends CI_Controller {
	public function __construct() {
		parent::__construct();
		if( !$this->tank_auth->is_logged_in() ) {
			redirect('/authentication/login');
		}
	}
	
	public function index()
	{
		$this->template->load('dashboard/account_information/index');
	}
	public function view_information() {
		$this->template->load('dashboard/account_information/view_information');
	}
	public function change_username() {
		$this->template->load('dashboard/account_information/change_username');
	}
	public function change_email() {
		$this->template->load('dashboard/account_information/change_email');
	}
	public function change_password() {
		$this->template->load('dashboard/account_information/change_password');
	}
	public function delete_account() {
		$this->template->load('dashboard/account_information/delete_account');
	}
}
