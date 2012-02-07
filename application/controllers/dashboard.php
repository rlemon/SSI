<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{
		echo "dashboard main view";
	}
	
	/* INFORMATION
	 * */
	public function information()
	{
		$args = func_get_args();
		$subsection = array_shift($args);
		if( !$subsection ) {
			echo "information first view";
		} else {
			call_user_func_array(array(&$this, $subsection), $args);
		}
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
		$args = func_get_args();
		$subsection = array_shift($args);
		if( !$subsection ) {
			echo "notifications first view";
		} else {
			call_user_func_array(array(&$this, $subsection), $args);
		}
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
		$args = func_get_args();
		$subsection = array_shift($args);
		if( !$subsection ) {
			echo "notes first view";
		} else {
			call_user_func_array(array(&$this, $subsection), $args);
		}
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
		$args = func_get_args();
		$subsection = array_shift($args);
		if( !$subsection ) {
			echo "links first view";
		} else {
			call_user_func_array(array(&$this, $subsection), $args);
		}
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

