<?php

class Inventory extends Controller {

	function __construct() {
		parent::__construct();
		Session::init();
		$logged = Session::get('loggedIn');
		if ($logged == false) {
			Session::destroy();
			header('location: ../login');
			exit;
		}
		
		$this->view->js = array('inventory/js/default.js');
	}
	
	function index() {
		/* this is the default method for all controllers */
		$this->itemList();
	}


	/* Items functions */
	function itemList() {
		$filter = ' WHERE ';
		if( isset($_GET['suppliers']) && $_GET['suppliers'] != '' ) {
			$filter .= '(part_supplier_id IN (' . trim($_GET['suppliers'], ',') . ')) AND ';
		}
		if( isset($_GET['groups']) && $_GET['groups'] != '' ) {
			$filter .= '(inv.id IN (SELECT item_id FROM group_item_mapping WHERE group_id IN (' . trim($_GET['groups'], ',') . '))) AND ';
		}
		if( isset($_GET['text']) && !empty($_GET['text']) ) {
			$filter .= '(inv.part_code LIKE "%' . $_GET['text'] . '%" OR inv.part_description LIKE "%' . $_GET['text'] . '%") AND ';
		}
		$filter .= '1';
		
		$this->view->suppliers = $this->model->getSuppliers();
		$this->view->groups = $this->model->getGroups();
		$this->view->rowData = $this->model->getItems($filter);
		$this->view->render('inventory/itemList');
	}
	function createItem() {
		if( isset($_POST['submit']) ) {
			$id = $this->model->addItem($_POST['part_code'], $_POST['part_description'], $_POST['part_supplier_id'], $_POST['supplier_part_code'], $_POST['loc'], $_POST['qty'], $_POST['unit_cost'], $_POST['groups']);
			header('Location: ' . URL . 'inventory/itemList');
		}
		
		/** Default values for new item template */
		$this->view->itemDefaults = array(
			'part_code' => 'DM_',
			'part_description' => 'No Description',
			'supplier_part_code' => 'SPC_',
			'loc' => 'X',
			'qty' => '0',
			'unit_cost' => '0.00'
		);
		$this->view->suppliers = $this->model->getSuppliers();
		$this->view->groups = $this->model->getGroups();
		$this->view->render('inventory/createItem');
	}
	function editItem($id) {
		if( isset($_POST['submit']) ) {
			$this->model->updateItem($_POST['id'], array(
				'part_code' => $_POST['part_code'],
				'part_description' => $_POST['part_description'],
				'part_supplier_id' => $_POST['part_supplier_id'],
				'supplier_part_code' => $_POST['supplier_part_code'],
				'loc' => $_POST['loc'],
				'qty' => $_POST['qty'],
				'unit_cost' => $_POST['unit_cost']
			), $_POST['groups']);
			header('Location: ' . URL . 'inventory/itemList');
		}
		$filter = ' WHERE inv.id = ' . $id;
		$this->view->items = $this->model->getItems($filter);
		$this->view->suppliers = $this->model->getSuppliers();
		$this->view->groups = $this->model->getGroups();
		$this->view->render('inventory/editItem');
	}
	function deleteItem($id) {
		$this->model->deleteItem($id);
		header('Location: ' . URL . 'inventory/itemList');
	}

	/* Suppliers functions */
	function supplierList() {
		$filter = ' WHERE ';
		if( isset($_GET['text']) && !empty($_GET['text']) ) { // should filtering be done on exact phrase or words
			$filter .= '(name LIKE "%' . $_GET['text'] .
			'%" OR description LIKE "%' . $_GET['text'] .
			'%" OR email LIKE "%' . $_GET['text'] .
			'%" OR telephone LIKE "%' . $_GET['text'] .
			'%" OR fax LIKE "%' . $_GET['text'] .
			'%" OR contact_name LIKE "%' . $_GET['text'] .
			'%" OR url LIKE "%' . $_GET['text'] . '%" ) AND ';
		}
		$filter .= '1';
		
		$this->view->rowData = $this->model->getSuppliers($filter);
		$this->view->render('inventory/supplierList');
	}
	function createSupplier() { //name, $description, $email, $telephone, $fax, $url, $contact_name
		if( isset($_POST['submit']) ) {
			$id = $this->model->addSupplier($_POST['name'], $_POST['description'], $_POST['email'], $_POST['telephone'], $_POST['fax'], $_POST['url'], $_POST['contact_name']);
			header('Location: ' . URL . 'inventory/supplierList');
		}
		
		/** Default values for new item template */
		$this->view->supplierDefaults = array(
			'name' => '',
			'description' => 'No Description',
			'contact_name' => '',
			'email' => '',
			'telephone' => '',
			'fax' => '',
			'url' => ''
		);
		$this->view->render('inventory/createSupplier');
	}
	function editSupplier($id) {
		if( isset($_POST['submit']) ) {
			$this->model->updateSupplier($_POST['id'], array(
				'name' => $_POST['name'],
				'description' => $_POST['description'],
				'contact_name' => $_POST['contact_name'],
				'email' => $_POST['email'],
				'telephone' => $_POST['telephone'],
				'fax' => $_POST['fax'],
				'url' => $_POST['url']
			));
			header('Location: ' . URL . 'inventory/supplierList');
		}
		$filter = ' WHERE id = ' . $id;
		$this->view->suppliers = $this->model->getSuppliers($filter);
		$this->view->render('inventory/editSupplier');
	}
	function deleteSupplier($id) {
		$this->model->deleteSupplier($id);
		header('Location: ' . URL . 'inventory/supplierList');
	}
	
	/* Groups functions */
	function groupList() {
		$filter = ' WHERE ';
		if( isset($_GET['text']) && !empty($_GET['text']) ) { // should filtering be done on exact phrase or words
			$filter .= '(name LIKE "%' . $_GET['text'] .
			'%" OR description LIKE "%' . $_GET['description'] . '%" ) AND ';
		}
		$filter .= '1';
		
		$this->view->rowData = $this->model->getGroups($filter);
		$this->view->render('inventory/groupList');
	}
	function createGroup() {
		if( isset($_POST['submit']) ) {
			$id = $this->model->addGroup($_POST['name'], $_POST['description']);
			header('Location: ' . URL . 'inventory/groupList');
		}
		
		/** Default values for new item template */
		$this->view->groupDefaults = array(
			'name' => '',
			'description' => 'No Description'
		);
		$this->view->render('inventory/createGroup');
	}
	function editGroup($id) {
		if( isset($_POST['submit']) ) {
			$this->model->updateGroup($_POST['id'], array(
				'name' => $_POST['name'],
				'description' => $_POST['description']
			));
			header('Location: ' . URL . 'inventory/groupList');
		}
		$filter = ' WHERE id = ' . $id;
		$this->view->groups = $this->model->getGroups($filter);
		$this->view->render('inventory/editGroup');
	}
	function deleteGroup($id) {
		$this->model->deleteGroup($id);
		header('Location: ' . URL . 'inventory/groupList');
	}
}
