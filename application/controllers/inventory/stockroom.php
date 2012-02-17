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


	public function new_item($type='material')
	{
		$data['type'] = $type;
		if( $type !== 'material' ) {
			$data['stock_list'] = array(1,2,3);
		}
		$this->template->load('inventory/stockroom/new_item', $data);
	}

}

