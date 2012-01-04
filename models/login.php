<?php
class Login_Model extends Model {
	public function __construct() {
		parent::__construct();
	}
	public function login() {
		$ps = $this->db->prepare( "SELECT id, username, role, ui_theme, last_login FROM users WHERE 
				username = :username AND password = MD5(:password)" );
		$ps->execute( array(
			':username' => $_POST[ 'username' ],
			':password' => $_POST[ 'password' ] 
		) );
		
		$data = $ps->fetch();
		$count = $ps->rowCount();
		
		if ( $count > 0 ) {
			$psu = $this->db->prepare( "UPDATE users SET last_login = CURRENT_TIMESTAMP WHERE id = :id" );
			$psu->execute( array(
				':id' => $data[ 'id' ]
			) );
			Session::init();
			Session::set( 'id', $data[ 'id' ] );
			Session::set( 'role', $data[ 'role' ] );
			Session::set( 'ui_theme', $data[ 'ui_theme' ] );
			Session::set( 'last_login', $data[ 'last_login' ] );
			Session::set( 'logged_in', true );
			header( 'location: ../dashboard' );
		} else {
			header( 'location: ../login' );
		}
	}
}
