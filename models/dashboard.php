<?php

class Dashboard_Model extends Model {

	public function __construct() {
		parent::__construct();
	}
	/* generic use DB functions	 */
	public function getData( $sql, $vars = null ) {
		$ps = $this->db->prepare( $sql );
		$ps->setFetchMode( PDO::FETCH_ASSOC );
		if ( $vars ) {
			$ps->execute( $vars );
		} else {
			$ps->execute();
		}
		return $ps->fetchAll();
	}
	public function addData( $prepared_statement, $vars ) {
		$ps = $this->db->prepare( $prepared_statement );
		$ps->execute( $vars );
	}
	public function updateData( $table, $id, $map /* Array(column=>value)*/ ) {
		$sql = '';
		$data = array();
		foreach ( $map as $col => $val ) {
			$data[ ':' . $col . '_val' ] = $val;
			$sql .= $col . ' = :' . $col . '_val,';
		}
		$data[ ':id' ] = $id;
		$ps = $this->db->prepare( 'UPDATE ' . $table . ' SET ' . rtrim( $sql, ',' ) . ' WHERE id = :id' );
		$ps->execute( $data );
	}
	
	public function updateProfile($id, $map) {
		if( empty( $map ) ) {
			return;
		}
		
		$this->updateData( 'users', $id, $map);
		
		if( isset( $map['ui_theme'] ) ) {
			Session::set('ui_theme', $map['ui_theme']);
		}
	}
	
	public function checkPassword($id, $password) {
		$res = $this->getData( 'SELECT password FROM users WHERE id = :id', array(
			':id' => $id
		) );
		if( $res[0]['password'] != $password ) {
			return false;
		}
		return true;
	}
	
}
