<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notifications extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if( !$this->tank_auth->is_logged_in() ) {
			redirect('/authentication/login');
		}
	}
	public function index()
	{
		$this->template->load('dashboard/notifications/index');
	}
	public function notification_options() {
		$this->template->load('dashboard/notifications/notification_options');
	}
	
}
