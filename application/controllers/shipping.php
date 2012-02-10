<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shipping extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}
	public function index1() {
		echo "index1";
	}
	public function index($var){
		echo $var;
	}
}

