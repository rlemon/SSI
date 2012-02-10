<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notes extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if( !$this->tank_auth->is_logged_in() ) {
			redirect('/authentication/login');
		}
	}
	public function index()
	{
		$this->template->load('dashboard/notes/index');
	}
	public function view_note() {
		$this->template->load('dashboard/notes/view_note');
	}
	public function create_note() {
		$this->template->load('dashboard/notes/create_note');
	}
	public function edit_note($id = null) {
		$this->template->load('dashboard/notes/edit_note');
	}
	public function delete_note($id = null) {
		$this->template->load('dashboard/notes/delete_note');
	}
	

}
