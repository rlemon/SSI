<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Help extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	 
	public function index()
	{
		$data['scripts'] = array(
			base_url('application/assets/js/util.js')
		);
		$data['styles'] = array(

		);
		
		$this->template->load('help/index', $data);
	}
	
}
