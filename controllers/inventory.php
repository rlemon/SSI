<?php
class Inventory extends Controller {
	function __construct() {
		parent::__construct();
		Session::init();
		$logged = Session::get( 'logged_in' );
		if ( $logged == false ) {
			Session::destroy();
			header( 'location: ../login' );
			exit;
		}
		$this->view->js = array(
			'inventory/js/validation.jquery.js',
			'inventory/js/default.js'
		);
		$this->view->widgets = array(
			'inventory/widgets/default.php'
		);
		
		$this->view->sort = isset($_GET['sort']) ? $_GET['sort'] : 'id';
		$this->view->order = isset($_GET['order']) ? $_GET['order'] : 'ASC';
		$this->view->page = isset($_GET['page']) ? $_GET['page'] : 1;
		$this->view->limit = isset( $_GET[ 'limit' ] ) ? $_GET[ 'limit' ] : RESULTS_PER_PAGE;
		if( !isset( $_SERVER['HTTP_REFERER'] ) ) {
			$_SERVER['HTTP_REFERER'] = URL . 'inventory/';
		}
		$this->view->refer = isset( $_POST['refer'] ) ? $_POST['refer'] : $_SERVER['HTTP_REFERER'];
	}
	function index() {
		/* this is the default method for all controllers */
		$this->itemList();
	}
	/* Items functions */
	function itemList() {
		$filter = ' WHERE ';
		if ( isset( $_GET[ 'suppliers' ] ) && $_GET[ 'suppliers' ] != '' ) {
			$filter .= '(part_supplier_id IN (' . implode( ',', $_GET[ 'suppliers' ] ) . ')) AND ';
		}
		if ( isset( $_GET[ 'groups' ] ) && $_GET[ 'groups' ] != '' ) {
			$filter .= '(inv.id IN (SELECT item_id FROM group_item_mapping WHERE group_id IN (' . implode( ',', $_GET[ 'groups' ] ) . '))) AND ';
		}
		if ( isset( $_GET[ 'term' ] ) && !empty( $_GET[ 'term' ] ) ) {
			$filter .= '(inv.part_code LIKE "%' . $_GET[ 'term' ] . '%" OR inv.part_description LIKE "%' . $_GET[ 'term' ] . '%") AND ';
		}
		$filter .= '1';
		
		$this->view->suppliers = $this->model->getSuppliers();
		$this->view->groups = $this->model->getGroups();
		$filter .= ' ORDER BY ' . $this->view->sort . ' ' . $this->view->order . ' LIMIT ' . $this->view->limit . ' OFFSET ' . ( ( $this->view->page - 1 ) * $this->view->limit ) . ' ';
		$this->view->rowData = $this->model->getItems( $filter );
		$this->view->render( 'inventory/itemList' );
	}
	function createItem() {
		
		if ( isset( $_POST[ 'save' ] ) ) {
			$id = $this->model->addItem( $_POST[ 'part_code' ], $_POST[ 'part_description' ], $_POST[ 'part_supplier_id' ], $_POST[ 'supplier_part_code' ], $_POST[ 'loc' ], $_POST[ 'qty' ], $_POST[ 'unit_cost' ], $_POST[ 'groups' ] );
			header( 'Location: ' . $this->view->refer );
		}
		/** Default values for new item template */
		$this->view->items = array(
			'part_code' => 'DM_',
			'part_description' => 'No Description',
			'part_supplier_id' => '',
			'supplier_part_code' => 'SPC_',
			'loc' => 'X',
			'qty' => '0',
			'unit_cost' => '0.00',
			'groups' => array()
		);
		$this->view->suppliers = $this->model->getSuppliers();
		$this->view->groups = $this->model->getGroups();
		$this->view->render( 'inventory/createEditItem' );
	}
	function editItem( $id ) {
		if ( isset( $_POST[ 'save' ] ) ) {
			$this->model->updateItem( $_POST[ 'id' ], array(
				 'part_code' => $_POST[ 'part_code' ],
				'part_description' => $_POST[ 'part_description' ],
				'part_supplier_id' => $_POST[ 'part_supplier_id' ],
				'supplier_part_code' => $_POST[ 'supplier_part_code' ],
				'loc' => $_POST[ 'loc' ],
				'qty' => $_POST[ 'qty' ],
				'unit_cost' => $_POST[ 'unit_cost' ] 
			), $_POST[ 'groups' ] );
			header( 'Location: ' . $this->view->refer );
		}
		$filter = ' WHERE inv.id = ' . $id;
		$this->view->items = $this->model->getItems( $filter );
		$this->view->suppliers = $this->model->getSuppliers();
		$this->view->groups = $this->model->getGroups();
		$this->view->render( 'inventory/createEditItem' );
	}
	function deleteItem( $id ) {
		$this->model->deleteItem( $id );
		header( 'Location: ' . URL . 'inventory/itemList' );
	}
	/* Suppliers functions */
	function supplierList() {
		$filter = ' WHERE ';
		if ( isset( $_GET[ 'term' ] ) && !empty( $_GET[ 'term' ] ) ) { // should filtering be done on exact phrase or words
			$filter .= '(name LIKE "%' . $_GET[ 'term' ] . '%" OR description LIKE "%' . $_GET[ 'term' ] . '%" OR email LIKE "%' . $_GET[ 'term' ] . '%" OR telephone LIKE "%' . $_GET[ 'term' ] . '%" OR fax LIKE "%' . $_GET[ 'term' ] . '%" OR contact_name LIKE "%' . $_GET[ 'term' ] . '%" OR url LIKE "%' . $_GET[ 'term' ] . '%" ) AND ';
		}
		$filter .= '1';

		$filter .= ' ORDER BY ' . $this->view->sort . ' ' . $this->view->order . ' LIMIT ' . $this->view->limit . ' OFFSET ' . ( ( $this->view->page - 1 ) * $this->view->limit ) . ' ';
		$this->view->rowData = $this->model->getSuppliers( $filter );
		$this->view->render( 'inventory/supplierList' );
	}
	function createSupplier() { //name, $description, $email, $telephone, $fax, $url, $contact_name
		if ( isset( $_POST[ 'save' ] ) ) {
			$id = $this->model->addSupplier( $_POST[ 'name' ], $_POST[ 'description' ], $_POST[ 'email' ], $_POST[ 'telephone' ], $_POST[ 'fax' ], $_POST[ 'url' ], $_POST[ 'contact_name' ] );
			header( 'Location: ' . $this->view->refer );
		}
		/** Default values for new item template */
		$this->view->supplierDefaults = array(
			 'name' => '',
			'description' => '',
			'contact_name' => '',
			'email' => '',
			'telephone' => '',
			'fax' => '',
			'url' => '' 
		);
		$this->view->render( 'inventory/createSupplier' );
	}
	function editSupplier( $id ) {
		if ( isset( $_POST[ 'save' ] ) ) {
			$this->model->updateSupplier( $_POST[ 'id' ], array(
				 'name' => $_POST[ 'name' ],
				'description' => $_POST[ 'description' ],
				'contact_name' => $_POST[ 'contact_name' ],
				'email' => $_POST[ 'email' ],
				'telephone' => $_POST[ 'telephone' ],
				'fax' => $_POST[ 'fax' ],
				'url' => $_POST[ 'url' ] 
			) );
			header( 'Location: ' . $this->view->refer );
		}
		$filter = ' WHERE id = ' . $id;
		$this->view->suppliers = $this->model->getSuppliers( $filter );
		$this->view->render( 'inventory/editSupplier' );
	}
	function deleteSupplier( $id ) {
		$this->model->deleteSupplier( $id );
		header( 'Location: ' . URL . 'inventory/supplierList' );
	}
	/* Groups functions */
	function groupList() {
		$filter = ' WHERE ';
		if ( isset( $_GET[ 'term' ] ) && !empty( $_GET[ 'term' ] ) ) { // should filtering be done on exact phrase or words
			$filter .= '(name LIKE "%' . $_GET[ 'term' ] . '%" OR description LIKE "%' . $_GET[ 'term' ] . '%" ) AND ';
		}
		$filter .= '1';

		$filter .= ' ORDER BY ' . $this->view->sort . ' ' . $this->view->order . ' LIMIT ' . $this->view->limit . ' OFFSET ' . ( ( $this->view->page - 1 ) * $this->view->limit ) . ' ';
		$this->view->rowData = $this->model->getGroups( $filter );
		$this->view->render( 'inventory/groupList' );
	}
	function createGroup() {
		if ( isset( $_POST[ 'save' ] ) ) {
			$id = $this->model->addGroup( $_POST[ 'name' ], $_POST[ 'description' ] );
			header( 'Location: ' . $this->view->refer );
		}
		/** Default values for new item template */
		$this->view->groupDefaults = array(
			 'name' => '',
			'description' => 'No Description' 
		);
		$this->view->render( 'inventory/createGroup' );
	}
	function editGroup( $id ) {
		if ( isset( $_POST[ 'save' ] ) ) {
			$this->model->updateGroup( $_POST[ 'id' ], array(
				 'name' => $_POST[ 'name' ],
				'description' => $_POST[ 'description' ] 
			) );
			header( 'Location: ' . $this->view->refer );
		}
		$filter = ' WHERE id = ' . $id;
		$this->view->groups = $this->model->getGroups( $filter );
		$this->view->render( 'inventory/editGroup' );
	}
	function deleteGroup( $id ) {
		$this->model->deleteGroup( $id );
		header( 'Location: ' . URL . 'inventory/groupList' );
	}
}
