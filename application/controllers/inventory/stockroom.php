<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stockroom extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if( !$this->tank_auth->is_logged_in() ) {
			redirect('/authentication/login');
		}
	}

	public function index()
	{
		$this->template->load('inventory/stockroom/stock_list');
	}


	public function new_item()
	{
		$data['scripts'] = array(
			'/public_files/js/stockroom.js'
		);
		$this->template->load('inventory/stockroom/new_item', $data);
	}
}

