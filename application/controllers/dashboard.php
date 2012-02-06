<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{
		echo "dashboard main view";
	}
	
	public function information($subsection = null)
	{
		if( !$subsection ) {
			echo "information first view";
		} else {
			$this->$subsection();
		}
	}
	
	public function view_information($var = null) {
		echo "Viewing information with " . $var ;
	}
}
