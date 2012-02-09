<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if( !$this->tank_auth->is_logged_in() ) {
			redirect('/authentication/login');
		}
	}
	
	public function reroute($args) {
		$sub = array_shift($args);
		if( $sub ) {
			call_user_func_array(array($this, $sub), $args);
			return true;
		}
		return false;
	}

	public function index()
	{
		$this->template->load('dashboard/index');
	}
	
	/* INFORMATION
	 * */
	public function account_information()
	{
		if( $this->reroute(func_get_args()) ) return;
		$this->template->load('dashboard/account_information/index');
	}
	public function view_information() {
		$this->template->load('dashboard/account_information/view_information');
	}
	public function change_username() {
		$this->template->load('dashboard/account_information/change_username');
	}
	public function change_email() {
		$this->template->load('dashboard/account_information/change_email');
	}
	public function change_password() {
		$this->template->load('dashboard/account_information/change_password');
	}
	public function delete_account() {
		$this->template->load('dashboard/account_information/delete_account');
	}
	
	/* NOTIFICATIONS
	 * */
	public function notifications()
	{
		if( $this->reroute(func_get_args()) ) return;
		$this->template->load('dashboard/notifications/index');
	}
	public function notification_options() {
		$this->template->load('dashboard/notifications/notification_options');
	}
	
	/* NOTES
	 * */
	public function notes()
	{
		if( $this->reroute(func_get_args()) ) return;
		$this->template->load('dashboard/notes/index');
	}
	public function view_note() {
		$this->template->load('dashboard/notes/view_note');
	}
	public function add_note() {
		$this->template->load('dashboard/notes/add_note');
	}
	public function edit_note($id = null) {
		$this->template->load('dashboard/notes/edit_note');
	}
	public function delete_note($id = null) {
		$this->template->load('dashboard/notes/delete_note');
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

