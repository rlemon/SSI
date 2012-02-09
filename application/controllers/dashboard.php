<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if( !$this->tank_auth->is_logged_in() ) {
			redirect('/authentication/login');
		}
	}
	
	public function reroute($args) {
		$subsection = array_shift($args);
		if( $subsection ) {
			call_user_func_array(array(&$this, $subsection), $args);
			exit;
		}
	}

	public function index()
	{
		$this->template->load('dashboard/index');
	}
	
	/* INFORMATION
	 * */
	public function information()
	{
		$this->reroute(func_get_args());
		echo "Information index";
	}
	public function view_information($var = null) {
		echo "Viewing information with " . $var ;
	}
	public function change_username() {
		
	}
	public function change_email() {
		
	}
	public function change_password() {
		
	}
	public function delete_account() {
		
	}
	
	/* NOTIFICATIONS
	 * */
	public function notifications()
	{
		$this->reroute(func_get_args());
		echo "Notifications index";
	}
	public function view_notifications($var = null) {
		echo "Viewing notifications with " . $var ;
	}
	public function notifications_options() {
		
	}
	
	/* NOTES
	 * */
	public function notes()
	{
		$this->reroute(func_get_args());
		echo "Notes Index";
	}
	public function view_notes($var = null) {
		echo "Viewing notes with " . $var ;
	}
	public function view_note($id = null) {
		
	}
	public function add_note() {
		
	}
	public function edit_note($id = null) {
		
	}
	public function delete_note($id = null) {
		
	}
	
	/* Links
	 * */
	public function links()
	{
		$this->reroute(func_get_args());
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

