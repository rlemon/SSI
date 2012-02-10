<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Links extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if( !$this->tank_auth->is_logged_in() ) {
			redirect('/authentication/login');
		}
	}
	public function index()
	{
		echo "Links Index";
	}
	public function view_links($var = null) {
		echo "Viewing links with " . $var ;
	}
	public function view_link($id = null) {
		
	}
	public function add_link() {
		
	}
	public function edit_link($id = null) {
		
	}
	public function delete_link($id = null) {
		
	}
}
