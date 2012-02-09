<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shipping extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if( /* no data is passed in the uri */ ) {
			// display landing page for this controller
		} else {
			// create new controller as passed n by the uri
			// all methods should be executed from this sub-controller
		}
	}
	
}

class ShippingSub extends CI_Controller {
	public function __construct() {
		parent::__construct();

		
	}
}
