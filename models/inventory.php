
<?php
class Inventory_Model extends Model {
	/* Constructor
	 */
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
	public function deleteData( $table, $id ) {
		$ps = $this->db->prepare( 'DELETE FROM ' . $table . ' WHERE id = :id' );
		$ps->execute( array(
			 ':id' => $id 
		) );
	}
	/*
	 * GET ITEMS / SUPPLIERS / GROUPS
	 */
	public function getItems( $filter = '' ) {
		$sql_items = 'SELECT SQL_CALC_FOUND_ROWS
				inv.id, 
				inv.part_code, 
				inv.part_description, 
				inv.part_supplier_id, 
				sup.name as part_supplier_name, 
				inv.supplier_part_code, 
				inv.loc, 
				inv.qty, 
				inv.unit_cost
			FROM inventory AS inv 
			LEFT JOIN suppliers AS sup 
				ON inv.part_supplier_id = sup.id' . $filter;
		$items = $this->getData( $sql_items );
		$len = $this->getData( 'SELECT FOUND_ROWS();' );
		for ( $i = 0, $l = count( $items ); $i < $l; $i++ ) {
			$sql_groups = 'SELECT
					grp.id,
					grp.name
				FROM group_item_mapping AS map
				LEFT JOIN groups AS grp
					ON grp.id = map.group_id
				WHERE map.item_id = ' . $items[ $i ][ 'id' ];
			$groups = $this->getData( $sql_groups );
			$items[ $i ][ 'groups' ] = $groups;
		}
		return array(
			 $len[0]['FOUND_ROWS()'],
			$items 
		);
	}
	public function getGroups( $filter = '' ) {
		$sql = 'SELECT SQL_CALC_FOUND_ROWS * FROM groups ' . $filter;
		$groups = $this->getData( $sql );
		$len = $this->getData( 'SELECT FOUND_ROWS();' );
		return array(
			 $len[0]['FOUND_ROWS()'],
			$groups 
		);
	}
	public function getSuppliers( $filter = '' ) {
		$sql = 'SELECT SQL_CALC_FOUND_ROWS * FROM suppliers ' . $filter;
		$suppliers = $this->getData( $sql );
		$len = $this->getData( 'SELECT FOUND_ROWS();' );
		return array(
			 $len[0]['FOUND_ROWS()'],
			$suppliers 
		);
	}
	/*
	 * ADD ITEMS / SUPPLIERS / GROUPS
	 */
	public function addItem( $part_code, $part_description, $part_supplier_id, $supplier_part_code, $loc, $qty, $unit_cost, $groups ) {
		$ps = $this->db->prepare( 'INSERT INTO inventory (part_code, part_description, part_supplier_id, supplier_part_code, loc, qty, unit_cost) VALUES (:part_code, :part_description, :part_supplier_id, :supplier_part_code, :loc, :qty, :unit_cost)' );
		$ps->execute( array(
			 ':part_code' => $part_code,
			':part_description' => $part_description,
			':part_supplier_id' => $part_supplier_id,
			':supplier_part_code' => $supplier_part_code,
			':loc' => $loc,
			':qty' => $qty,
			':unit_cost' => $unit_cost 
		) );
		$id = $this->db->lastInsertId();
		for ( $i = 0, $l = count( $groups ); $i < $l; $i++ ) {
			$psg = $this->db->prepare( 'INSERT INTO group_item_mapping (item_id, group_id) VALUES (:item_id, :group_id)' );
			$psg->execute( array(
				 ':item_id' => $id,
				':group_id' => $groups[ $i ] 
			) );
		}
		return $id;
	}
	public function addSupplier( $name, $description, $email, $telephone, $fax, $url, $contact_name ) {
		$ps = $this->db->prepare( 'INSERT INTO suppliers (name, description, email, telephone, fax, url, contact_name) VALUES (:name, :description, :email, :telephone, :fax, :url, :contact_name)' );
		$ps->execute( array(
			 ':name' => $name,
			':description' => $description,
			':email' => $email,
			':telephone' => $telephone,
			':fax' => $fax,
			':url' => $url,
			':contact_name' => $contact_name 
		) );
		return $this->db->lastInsertId();
	}
	public function addGroup( $name, $description ) {
		$ps = $this->db->prepare( 'INSERT INTO groups (name, description) VALUES (:name, :description)' );
		$ps->execute( array(
			 ':name' => $name,
			':description' => $description 
		) );
		return $this->db->lastInsertId();
	}
	/*
	 * UPDATE ITEMS / SUPPLIERS / GROUPS
	 */
	public function updateItem( $id, $map, $groups ) {
		$this->updateData( 'inventory', $id, $map );
		$dbo = $this->db->exec( 'DELETE FROM group_item_mapping WHERE item_id = ' . $id );
		for ( $i = 0, $l = count( $groups ); $i < $l; $i++ ) {
			$this->addData( 'INSERT INTO group_item_mapping (item_id, group_id) VALUES (:item_id, :group_id)', array(
				 ':item_id' => $id,
				':group_id' => $groups[ $i ] 
			) );
		}
	}
	public function updateSupplier( $id, $map ) {
		$this->updateData( 'suppliers', $id, $map );
	}
	public function updateGroup( $id, $map ) {
		$this->updateData( 'groups', $id, $map );
	}
	/*
	 * DELETE ITEMS / SUPPLIERS / GROUPS
	 */
	public function deleteItem( $id ) {
		$this->deleteData( 'inventory', $id );
	}
	public function deleteSupplier( $id ) {
		$this->deleteData( 'suppliers', $id );
	}
	public function deleteGroup( $id ) {
		$this->deleteData( 'groups', $id );
	}
}
